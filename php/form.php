<?php
include("../php/db_conn.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["subaru-submit"])) {

    $student_id = $_SESSION['student-id'];
    $student_id = $db_conn->real_escape_string($student_id);

    // TABLE 'group_members'
    $members = [
        $db_conn->real_escape_string($_POST['group-members-cont1']),
        $db_conn->real_escape_string($_POST['group-members-cont2']),
        $db_conn->real_escape_string($_POST['group-members-cont3']),
        $db_conn->real_escape_string($_POST['group-members-cont4']),
        $db_conn->real_escape_string($_POST['group-members-cont5'])
    ];

    // Use a specific delimiter for implode
    $members_name = implode("; ", $members);  // Use '; ' as a delimiter instead of ', '
    $course = $db_conn->real_escape_string($_POST['course-sel']);
    $yns = $db_conn->real_escape_string($_POST['yns-sel']);
    $group_no = $db_conn->real_escape_string($_POST['group-sel']);

    $stmt1 = $db_conn->prepare("INSERT INTO group_members (user_id, name, group_number, course, yearnsection) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt1) {
        echo "Prepare failed: (" . $db_conn->errno . ") " . $db_conn->error;
        exit();
    }
    $stmt1->bind_param("isiss", $student_id, $members_name, $group_no, $course, $yns);

    if (!$stmt1->execute()) {
        echo "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
        $stmt1->close();
        exit();
    }
    $stmt1->close();

    // TABLE 'title_proposals'
    $title_proposals = [];
    for ($i = 1; $i <= 3; $i++) {
        if (!empty($_POST['title-textarea' . $i])) {
            $title_proposals[] = $db_conn->real_escape_string($_POST['title-textarea' . $i]);
        }
    }

    $uploadOk = 1;
    $target_dir = "../pdf/";
    $target_file = $target_dir . basename($_FILES["pdfFile"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($fileType != "pdf" || $_FILES["pdfFile"]["size"] > 2000000) {
        echo "<script>alert('File size exceeded over 2MB or incorrect file type');</script>";
        $uploadOk = 0;
    }

    if ($uploadOk && move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $target_file)) {
        $filename = $_FILES["pdfFile"]["name"];
        $folder_path = $target_dir;
        $time_stamp = date('Y-m-d H:i:s');

        foreach ($title_proposals as $title) {
            $stmt2 = $db_conn->prepare("INSERT INTO title_proposals (title, filename, folder_path, time_stamp, status) VALUES (?, ?, ?, ?, 'Processing')");
            if (!$stmt2) {
                echo "Prepare failed: (" . $db_conn->errno . ") " . $db_conn->error;
                exit();
            }
            $stmt2->bind_param("ssss", $title, $filename, $folder_path, $time_stamp);

            if (!$stmt2->execute()) {
                echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
                $stmt2->close();
                exit();
            }
            $stmt2->close();

            // Get the last inserted ID for the title proposal
            $title_proposal_id = $db_conn->insert_id;

            // TABLE 'thesis_basic_info'
            $research_adv = $db_conn->real_escape_string($_POST['research-adviser-sel']);
            $stmt3 = $db_conn->prepare("INSERT INTO thesis_basic_info (user_id, group_members, research_adviser, title_proposal_id)
                VALUES (
                    ?, 
                    (SELECT id FROM group_members WHERE user_id = ? ORDER BY id DESC LIMIT 1),
                    ?, 
                    ?
                )
            ");
            if (!$stmt3) {
                echo "Prepare failed: (" . $db_conn->errno . ") " . $db_conn->error;
                exit();
            }
            $stmt3->bind_param("iisi", $student_id, $student_id, $research_adv, $title_proposal_id);

            if (!$stmt3->execute()) {
                echo "Execute failed: (" . $stmt3->errno . ") " . $stmt3->error;
                $stmt3->close();
                exit();
            }
            $stmt3->close();
        }

        echo "<script>alert('Data inserted successfully');</script>";
        header("location: ../html/student_MOR_7.php");
        exit();
    } else {
        echo "<script>alert('File upload failed');</script>";
    }
}
?>
