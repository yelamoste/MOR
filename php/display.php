<?php
include('../php/db_conn.php');

if (isset($_SESSION['student-id'])) {
    $id = $_SESSION['student-id'];

    $sql1 = "SELECT name FROM group_members WHERE user_id = $id LIMIT 5";
    $result1 = $db_conn->query($sql1);

    $sql2 = "SELECT tb.research_adviser, f.faculty_name 
        FROM thesis_basic_info as tb
        INNER JOIN faculty_users as f ON tb.research_adviser = f.id
        WHERE user_id = $id
        LIMIT 1";
    $result2 = $db_conn->query($sql2);

    $sql3 = "SELECT gm.course, gm.yearnsection, c.courses, y.yearnsection
        FROM group_members as gm
        INNER JOIN courses as c ON gm.course = c.id
        INNER JOIN yearnsection as y ON gm.yearnsection = y.id 
        WHERE user_id = $id
        LIMIT 1";
    $result3 = $db_conn->query($sql3);

    $sql4 = "SELECT group_number FROM group_members  
            WHERE user_id = $id
            LIMIT 1";
    $result4 = $db_conn->query($sql4);

    $sql5 = "SELECT tb.title_proposal_id, t.title, t.filename, t.status
         FROM thesis_basic_info as tb
         INNER JOIN title_proposals as t ON tb.title_proposal_id = t.id
         WHERE user_id = $id";
    $result5 = $db_conn->query($sql5);


}




// if (isset($_SESSION['u_id'])) {
//     $uid = $_SESSION['u_id'];


//     $sql6 = "SELECT tb.id,  tb.title_proposal_id, t.title, t.filename, t.status
//          FROM thesis_basic_info as tb
//          INNER JOIN title_proposals as t ON tb.title_proposal_id = t.id
//          WHERE user_id = $id AND id = $uid ";
//         $result6 = $db_conn->query($sql6);

//     echo($result6);
// }





if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST["view-research-title"])) {

        header("Location: ../html/student_MOR_8.php");
    }
}


// $sql4 = "SELECT  FROM group_members  LIMIT 1";
// $result4 = $db_conn->query($sql4);

$db_conn->close();
