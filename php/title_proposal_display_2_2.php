<?php
include('../php/db_conn.php');
include('../php/session_student.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST["panelist_submit"])) {

        if (!isset($_SESSION['student-id']) || !isset($_SESSION['view-research-title-id2'])) {
            die("Session variables are not set.");
        }

        $id = $_SESSION['student-id'];
        $uid = $_SESSION['view-research-title-id2'];

        // Get the thesis ID
        $thesis_id_query = "SELECT tp2.id
                            FROM title_proposals_2 as tp2 
                            INNER JOIN thesis_basic_info as tb ON tp2.thesis = tb.id
                            INNER JOIN title_proposals as tp ON tb.title_proposal_id = tp.id 
                            WHERE tb.user_id = ? AND tb.title_proposal_id = ? LIMIT 1";
        $stmt_thesis_id = $db_conn->prepare($thesis_id_query);
        $stmt_thesis_id->bind_param("ii", $id, $uid);
        $stmt_thesis_id->execute();
        $thesis_id_result = $stmt_thesis_id->get_result();

        //   echo  $thesis_id_query;
        if ($thesis_id_result && $thesis_id_result->num_rows > 0) {
            $thesis_row = $thesis_id_result->fetch_assoc();
            $thesis_id = $thesis_row['id'];
        } else {
            die("Could not retrieve thesis id");
        }

        // Check the number of existing panelists for the thesis
        $sql_check_count = "SELECT COUNT(*) as panelist_count FROM panelists WHERE thesis = ?";
        $stmt_check_count = $db_conn->prepare($sql_check_count);
        if (!$stmt_check_count) {
            die("Prepare failed: " . $db_conn->error);
        }
        $stmt_check_count->bind_param("i", $thesis_id);
        $stmt_check_count->execute();
        $result_check_count = $stmt_check_count->get_result();
        $row_check_count = $result_check_count->fetch_assoc();
        $panelist_count = $row_check_count['panelist_count'];

        // Check if the number of panelists is already 3
        if ($panelist_count >= 3) {
            echo "<script>alert('Maximum number of panelists reached for this thesis.'); window.location.href='../html/student_MOR_13.php';</script>";
            exit;
        }

        // Process each selected panelist
        foreach ($_POST['panelistsel'] as $selectedPanelist) {

            // Check for duplicate entry for panelist and thesis combination
            $sql_check_duplicate2 = "SELECT * FROM panelists WHERE panelist = ? AND thesis = ?";
            $stmt_check_duplicate2 = $db_conn->prepare($sql_check_duplicate2);
            if (!$stmt_check_duplicate2) {
                die("Prepare failed: " . $db_conn->error);
            }
            $stmt_check_duplicate2->bind_param("ii", $selectedPanelist, $thesis_id);
            $stmt_check_duplicate2->execute();
            $result_check_duplicate2 = $stmt_check_duplicate2->get_result();

            // Insert new panelist if no duplicate found and the maximum count is not reached
            if ($result_check_duplicate2->num_rows == 0) {
                $sql_insert2 = "INSERT INTO panelists (panelist, thesis, response) VALUES (?, ?, ?)";
                $stmt_insert2 = $db_conn->prepare($sql_insert2);
                if (!$stmt_insert2) {
                    die("Prepare failed: " . $db_conn->error);
                }
                $response = 'Processing';
                $stmt_insert2->bind_param("iis", $selectedPanelist, $thesis_id, $response);
                if ($stmt_insert2->execute()) {
                    echo "<script>alert('New record created successfully for panelist $selectedPanelist');</script>";
                } else {
                    echo "Error: " . $stmt_insert2->error;
                }
            } else {
                echo "<script>alert('Record already exists for panelist $selectedPanelist and thesis $thesis_id');</script>";
            }

            // Update panelist count after each insertion
            $panelist_count++;
            if ($panelist_count >= 3) {
                echo "<script>alert('Maximum number of panelists reached for this thesis.'); window.location.href='../html/student_MOR_13.php';</script>";
                break;
            }

            // Check if the panelist entry already exists in title_proposals_3
            $check_query = "SELECT COUNT(*) AS count FROM title_proposals_3 WHERE thesis3 = ?";
            $stmt_check_query = $db_conn->prepare($check_query);
            $stmt_check_query->bind_param("i", $thesis_id);
            $stmt_check_query->execute();
            $check_result = $stmt_check_query->get_result();

            if (!$check_result) {
                die("<script>alert('Query failed: " . $db_conn->error . "');</script>");
            }

            $row = $check_result->fetch_assoc();
            $count = $row['count'];
            $adviser_response = "Processing";

            if ($count == 0) {
                // Combination doesn't exist, proceed with the insertion
                $insert_query = "INSERT INTO title_proposals_3 (thesis3, response, adviser_response) VALUES (?, ?, ?)";
                $stmt_insert = $db_conn->prepare($insert_query);
                if (!$stmt_insert) {
                    die("Prepare failed: " . $db_conn->error);
                }
                $stmt_insert->bind_param("iss", $thesis_id, $response, $adviser_response );
                if ($stmt_insert->execute()) {
                    echo "<script>alert('Data inserted successfully.');</script>";
                } else {
                    echo "Error: " . $stmt_insert->error;
                }
            } else {
                // Combination already exists, no need to insert
                echo "<script>alert('Data already exists.');</script>";
            }
        }
    }
}
?>
