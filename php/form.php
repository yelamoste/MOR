<?php

include("../php/db_conn.php");



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST["subaru-submit"])) {

        session_start();
        $student_id = $_SESSION['student-id'];
        $student_id = $db_conn->real_escape_string($student_id);



        // TABLE 'group_members'


        $group_members = array();
        $course = $_POST['course-sel'];
        $yns = $_POST['yns-sel'];
        $group_no = $_POST['group-sel'];


        for ($i = 1; $i <= 5; $i++) {
            $member_name = $_POST['group-members-cont' . $i];
            if (!empty($member_name)) {

                $group_members[] = $member_name;
            }
        }
        foreach ($group_members as $member_name) {



            // $sql0 = "INSERT INTO group_members (user_id, name, group_number, course, yearnsection) VALUES (`$student_id` , `$member_name` , `$group_no` , `$course` , `$yns`)";
            // if ($db_conn->query($sql0) !== TRUE) {
            //     echo "Error: " . $sql0 . "<br>" . $db_conn->error;
            // }
            $stmt1 = $db_conn->prepare("INSERT INTO group_members (user_id, name, group_number, course, yearnsection) VALUES (?, ?, ?, ?, ?)");
            $stmt1->bind_param("isiss", $student_id, $member_name, $group_no, $course, $yns);
            $stmt1->execute();
            $stmt1->close();
        }






        // TABLE 'title_proposals'


        $title_proposal = array();

        for ($i = 1; $i <= 3; $i++) {
            $titles = $_POST['title-textarea' . $i];
            if (!empty($titles)) {
                $title_proposal[] = $titles;
            }
        }

        foreach ($title_proposal as $titles) {

            $target_dir = "../pdf/";
            $target_file = $target_dir . basename($_FILES["pdfFile"]["name"]);
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


            if ($fileType != "pdf" || $_FILES["pdfFile"]["size"] > 2000000) {
                echo "<script>alert(File size exceeded over 2MB);</script>";
            } else {
                if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $target_file)) {
                    $filename = $_FILES["pdfFile"]["name"];
                    $folder_path = $target_dir;
                    $time_stamp = date('Y-m-d H:m:s');
                }
            }
            $escapedTitles = mysqli_real_escape_string($db_conn, $titles);

            $defaultValue = "Processing";

            // $sql4 = "INSERT INTO title_proposals (title, filename, folder_path, time_stamp, status) VALUES ('$escapedTitles','$filename','$folder_path','$time_stamp','$defaultValue')";
            // if ($db_conn->query($sql4) !== TRUE) {
            //     echo "Error" . $sql4 . "<br>" . $db_conn->error;
            // }
            $stmt2 = $db_conn->prepare("INSERT INTO title_proposals (title, filename, folder_path, time_stamp, status) VALUES (?, ?, ?, ?, ?)");
            $stmt2->bind_param("sssss", $escapedTitles, $filename, $folder_path, $time_stamp, $defaultValue);
            $stmt2->execute();
            $stmt2->close();


            // TABLE thesis_basic_info
            $research_adv = $_POST['research-adviser-sel'];
            $sql5 = "INSERT INTO thesis_basic_info (user_id, group_members, research_adviser, title_proposal_id)
                     VALUES (
                        '$student_id',
                        (SELECT DISTINCT group_number FROM  group_members WHERE group_number = '$group_no' and yearnsection = '$yns' and course = '$course' ORDER BY group_number LIMIT 1),
                        '$research_adv',
                        (SELECT MAX(id) FROM title_proposals))
                    ";
            $sql6 = "INSERT INTO theses (thesis_info) SELECT MAX(id) FROM thesis_basic_info";



            if ($db_conn->query($sql5) & $db_conn->query($sql6)  === TRUE) {
                echo "<script>" . "alert( Data inserted successfully into groups table );" . "</script>";
                header("location: ../html/student_MOR_7.php");
            } else {
                echo "Error: " . $sql5 . "<br>" . $db_conn->error;
            }
        }


        // TABLE theses
        $tcsql1 = "INSERT INTO faculty_roles (theses) SELECT MAX(id) FROM theses";

        if ($db_conn->query($tcsql1)   !== TRUE) {
            echo "Error: " . $tcsql1 . "<br>" . $db_conn->error;
        }
    }
}


// For Research Adviser Selection

$sql1 = "SELECT id, faculty_name FROM faculty_users";
$result1 = $db_conn->query($sql1);


// For Courses Selection
$sql2 = "SELECT id, courses FROM courses";
$result2 = $db_conn->query($sql2);


// For Year and Section Selection
$sql3 = "SELECT id, yearnsection FROM yearnsection";
$result3 = $db_conn->query($sql3);


// For Year and Section Selection
$sql7 = "SELECT id, group_number FROM group_numbers";
$result7 = $db_conn->query($sql7);



// Close connection
$db_conn->close();
