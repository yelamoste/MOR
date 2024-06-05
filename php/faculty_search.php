<?php
require('../php/db_conn.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['search-button'])) {
        echo "Hello<br>";

        $search_input = $_POST['search-input-field'];

        $sql = "SELECT dp2p.id as dp2p_id, dp2p.thesis_id as dp2p_thesis_id, dp1p.id as dp1p_id, dp1p.thesis_id as dp1p_thesis_id, 
            tp3.id as tp3_id, tp3.thesis3, tp2.id as tp2_id, tp2.thesis, tb.id as tb_id, tb.user_id as tb_user_id, 
            tb.title_proposal_id, tb.research_adviser, tb.group_members, tb.user_id, tp.id as tp_id, tp.title, tp.filename, 
            f.id as f_id, f.faculty_name, gm.id as gm_id, gm.name, gm.group_number, gm.course, gm.yearnsection, su.id as su_id, 
            su.student_name, gn.id as gn_id, gn.group_number, cr.id as cr_id, cr.courses, yns.id as yns_id, yns.yearnsection
            FROM thesis_basic_info as tb
            LEFT JOIN dp2_panelists AS dp2p ON tb.id = dp2p.thesis_id
            LEFT JOIN dp1_panelists AS dp1p ON dp2p.thesis_id = dp1p.id
            LEFT JOIN title_proposals_3 as tp3 ON dp1p.thesis_id = tp3.id
            LEFT JOIN title_proposals_2 as tp2 ON tp3.thesis3 = tp2.id
            LEFT JOIN title_proposals as tp ON tb.title_proposal_id = tp.id
            LEFT JOIN faculty_users as f ON tb.research_adviser = f.id
            LEFT JOIN group_members as gm ON tb.group_members = gm.id
            LEFT JOIN student_users as su ON tb.user_id = su.id
            LEFT JOIN group_numbers as gn ON gm.group_number = gn.id
            LEFT JOIN courses as cr ON gm.course = cr.id
            LEFT JOIN yearnsection as yns ON gm.yearnsection = yns.id
            WHERE gm.name LIKE ? OR tp.title LIKE ? OR f.faculty_name LIKE ? OR su.student_name LIKE ? 
            OR yns.yearnsection LIKE ? OR cr.courses LIKE ? ";

        // Prepare the statement
        if ($searchdb = $db_conn->prepare($sql)) {
            $search_param = "%" . $search_input . "%";

            // Bind the parameters
            $searchdb->bind_param("ssssss", $search_param, $search_param, $search_param, $search_param, $search_param, $search_param);

            // Execute the statement
            $searchdb->execute();

            // Get the result
            $search_input_res = $searchdb->get_result();


            // Close the statement
            $searchdb->close();
        } else {
            echo "Failed to prepare the SQL statement.";
        }
    }
}
