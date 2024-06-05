<?php
include("../php/db_conn.php");
// include("../php/session_student.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['view-research-title-id2'])) {
    die("Session variables are not set.");
}

$uid = $_SESSION['view-research-title-id2'];

// Get the count of approved and rejected responses
$rescount = "SELECT COUNT(*) AS all_count 
             FROM committees AS c
             INNER JOIN thesis_basic_info AS tb ON c.thesis = tb.id
             INNER JOIN title_proposals AS tp ON tb.title_proposal_id = tp.id
             WHERE c.response IN ('Approved', 'Rejected') AND tp.id = $uid";

$all_count_result = $db_conn->query($rescount);

if (!$all_count_result) {
    die("Query failed: " . $db_conn->error);
}

$all_row = $all_count_result->fetch_assoc();
$all_count = $all_row['all_count'];

// Get the count of all statuses including 'Approved', 'Rejected', and 'Processing'
$overall_res = "SELECT COUNT(*) AS overall_approved 
                FROM committees as c  
                INNER JOIN thesis_basic_info AS tb ON c.thesis = tb.id
                INNER JOIN title_proposals AS tp ON tb.title_proposal_id = tp.id 
                WHERE c.response IN ('Approved','Rejected','Processing') AND tp.id = $uid";

$overall_res_result = $db_conn->query($overall_res);

if (!$overall_res_result) {
    die("Query failed: " . $db_conn->error);
}

$overall_res_row = $overall_res_result->fetch_assoc();
$overall_res_res = $overall_res_row['overall_approved'];


// to display data of all statuses
// echo "Number of all statuses per id: " . $overall_res_res . "<br>";

// Get the count of approved statuses
$approved_res = "SELECT COUNT(*) AS approved_res 
                FROM committees as c  
                INNER JOIN thesis_basic_info AS tb ON c.thesis = tb.id
                INNER JOIN title_proposals AS tp ON tb.title_proposal_id = tp.id 
                WHERE c.response = 'Approved' AND tp.id = $uid";

$approved_res_result = $db_conn->query($approved_res);

if (!$approved_res_result) {
    die("Query failed: " . $db_conn->error);
}

$approved_res_row = $approved_res_result->fetch_assoc();
$approved_res_res = $approved_res_row['approved_res'];


// to see the number of responsees
// echo "Number of approved statuses: " . $approved_res_res . "<br>";

// If conditions are met, update the response in title_proposals_2
if ($all_count == 12) {
    if ($approved_res_res > 7) {
        // Fetch the thesis ID to be updated
        $fetchThesisIdQuery = "SELECT tb.id
                               FROM thesis_basic_info tb
                               WHERE tb.title_proposal_id = $uid";

        $fetchThesisIdResult = $db_conn->query($fetchThesisIdQuery);

        if ($fetchThesisIdResult->num_rows > 0) {
            $thesisIdRow = $fetchThesisIdResult->fetch_assoc();
            $thesisId = $thesisIdRow['id'];

            $updateCommitteeRes = "UPDATE title_proposals_2 
                                   SET response = 'Approved' 
                                   WHERE thesis = $thesisId";

            $update_result = $db_conn->query($updateCommitteeRes);

            if (!$update_result) {
                die("Update failed: " . $db_conn->error);
            }
        } else {
            echo "Thesis ID not found.<br>";
        }
    } else {
        $fetchThesisIdQuery = "SELECT tb.id
                               FROM thesis_basic_info tb
                               WHERE tb.title_proposal_id = $uid";

        $fetchThesisIdResult = $db_conn->query($fetchThesisIdQuery);

        if ($fetchThesisIdResult->num_rows > 0) {
            $thesisIdRow = $fetchThesisIdResult->fetch_assoc();
            $thesisId = $thesisIdRow['id'];
                
            $updateCommitteeRes = "UPDATE title_proposals_2 
                                    SET response = 'Rejected' 
                                    WHERE thesis = $thesisId";

            $update_result = $db_conn->query($updateCommitteeRes);
            
            if (!$update_result) {
                die("Update failed: " . $db_conn->error);
            } 
        }
    }
} 
?>
