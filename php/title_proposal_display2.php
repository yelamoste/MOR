<?php
include("../php/db_conn.php");
include("../php/session_student.php");
// PHP form connected to student_MOR_9.php



if ($_SERVER['REQUEST_METHOD'] == "POST") {

   

    if (isset($_POST["committee-submit"])) {

        
        $id = $_SESSION['student-id'];
        $uid = $_SESSION['view-research-title-id'];
        
        $defaultValue = "Processing";

        $thesis_id_result = $db_conn->query("SELECT id FROM thesis_basic_info WHERE user_id = $id AND title_proposal_id = $uid LIMIT 1");
        if ($thesis_id_result && $thesis_id_result->num_rows > 0) {
            $thesis_row = $thesis_id_result->fetch_assoc();
            $thesis_id = $thesis_row['id'];
        } else {
            die("Could not retrieve thesis id");
        }
    
        // Check the number of existing committee for the thesis
        $sql_check_count = "SELECT COUNT(*) as committee_count FROM committees WHERE thesis = ?";
        $stmt_check_count = $db_conn->prepare($sql_check_count);
        if (!$stmt_check_count) {
            die("Prepare failed: " . $db_conn->error);
        }
        $stmt_check_count->bind_param("i", $thesis_id);
        $stmt_check_count->execute();
        $result_check_count = $stmt_check_count->get_result();
        $row_check_count = $result_check_count->fetch_assoc();
        $committee_count = $row_check_count['committee_count'];

        // Check if the number of committees is already 12
        if ($committee_count >= 12) {
            echo "<script>alert('Maximum number of committees reached for this thesis.'); 
            window.location.href='../html/student_MOR_10.php';</script>";
            exit;
        }

       
        foreach ($_POST['committeesel'] as $selectedCommittee) {

            $sql_check_duplicate = "SELECT * FROM committees WHERE committee = ? AND thesis = ?";
            $stmt_check_duplicate = $db_conn->prepare($sql_check_duplicate);
            if (!$stmt_check_duplicate) {

                die("Prepare failed: " . $db_conn->error);

            }
            $stmt_check_duplicate->bind_param("ii", $selectedCommittee, $thesis_id);
            $stmt_check_duplicate->execute();
            $result_check_duplicate = $stmt_check_duplicate->get_result();

            if ($result_check_duplicate->num_rows == 0) {

                $sql_insert = "INSERT INTO committees (committee, thesis, response) VALUES (?, ?, ?)";
                $stmt_insert = $db_conn->prepare($sql_insert);
                if (!$stmt_insert) {
                    die("Prepare failed: " . $db_conn->error);
                }
                $stmt_insert->bind_param("iis", $selectedCommittee, $thesis_id, $defaultValue);
                if ($stmt_insert->execute()) {
                    echo "New record created successfully for committee $selectedCommittee<br>";
                } else {
                    echo "Error: " . $stmt_insert->error;
                }
            } else {
                echo "Record already exists for committee $selectedCommittee and thesis $thesis_id<br>";
            }
        }
        // Update committee count after each insertion
        $committee_count++;
        if ($committee_count > 12) {
            echo "<script>alert('Maximum number of committees reached for this thesis.'); 
            window.location.href='../html/student_MOR_10.php';</script>";
            exit;
        }


        $check_query = "SELECT COUNT(*) AS count FROM title_proposals_2 WHERE thesis = $thesis_id ";
        $check_result = $db_conn->query($check_query);

        if (!$check_result) {
            die("Query failed: " . $db_conn->error);
        }

        $row = $check_result->fetch_assoc();
        $count = $row['count'];
        $adviser_response = "Processing";

        // if ($count == 0) {
        //     // Combination doesn't exist, proceed with the insertion
        //     $insert_query = "INSERT INTO title_proposals_2 (thesis, response, adviser_response)
        //                      VALUES ($thesis_id, $defaultValue, $defaultValue)";
        //     $insert_result = $db_conn->query($insert_query);

        //     if (!$insert_result) {
        //         die("Query failed: " . $db_conn->error);
        //     } else {
        //         echo "Data inserted successfully.";
        //     }
        // } else {
        //     // Combination already exists, no need to insert
        //     echo "Data already exists.";
        // }
        
        if ($count == 0) {
            // Combination doesn't exist, proceed with the insertion
            $insert_query = "INSERT INTO title_proposals_2 (thesis, response, adviser_response) VALUES (?, ?, ?)";
            $stmt_insert = $db_conn->prepare($insert_query);
            if (!$stmt_insert) {
                die("Prepare failed: " . $db_conn->error);
            }
            $stmt_insert->bind_param("iss", $thesis_id, $defaultValue, $adviser_response );
            if ($stmt_insert->execute()) {
                echo "<script>alert('Data inserted successfully.');</script>";
            } else {
                echo "Error: " . $stmt_insert->error;
            }
            
            

            header("Location: ../html/student_MOR_10.php");
        } else {
            // Combination already exists, no need to insert
            echo "<script>alert('Data already exists.');</script>";
        }
        
    } else {
        die("Could not retrieve thesis id");
        // $db_conn->close();
    }



    // FOR PANELIST SUBMIT
    
}

    // if ("SELECT title_proposals_2.thesis, title_proposals_2.response" != "SELECT DISTINCT c.thesis, '$defaultValue'"){

    //     $thesis2 = $db_conn->query("INSERT INTO title_proposals_2 (thesis, response)
    //     SELECT DISTINCT c.thesis, '$defaultValue'
    //     FROM committees as c
    //     INNER JOIN thesis_basic_info as tb ON c.thesis = tb.id");

    // if (!$thesis2) {
    //     die("Prepare failed: " . $db_conn->error);
    //     exit();
    // }
    // }


// $sql->close();



// $sql10 = "SELECT tb.id, c.id, f.id, c.committee, f.faculty_name, tb.group_members
//         FROM committees as c
//         JOIN group_members as gm ON gm.id = tb.group_members
//         JOIN title_proposals as tp ON tp.id = tb.title_proposal_id
//         JOIN faculty_users as f ON f.id = tb.research_adviser AND f.id = c.committee
//         JOIN thesis_basic_info as tb ON tb.id = c.thesis" ;

// $sql10 = "SELECT c.thesis, tb.title_proposal_id, tp.id AS proposal_id,
//         tb.id AS thesis_id, 
//         c.id AS committee_id, 
//         f.id AS faculty_id, 
//         c.committee, 
//         f.faculty_name, 
//         tb.group_members,
//         tp.title, 
//         tp.filename, 
//         c.response
//     FROM thesis_basic_info tb
//     INNER JOIN committees c ON tb.id = c.thesis
//     INNER JOIN title_proposals tp ON tp.id = tb.title_proposal_id
//     INNER JOIN faculty_users f ON f.id = tb.research_adviser
//     WHERE f.id = c.committee";
?>