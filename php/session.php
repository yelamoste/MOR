<?php
include('../php/db_conn.php');

if (isset($_SESSION['uniq_id'])) {

    $sql6 = "SELECT tb.title_proposal_id, t.title, t.filename, t.status
    FROM thesis_basic_info as tb
    INNER JOIN title_proposals as t ON tb.title_proposal_id = t.id
    WHERE user_id = $id ";

    $result = mysqli_query($db_conn, $sql6);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        session_start();

        $_SESSION['uniq_id'] = true;
        $_SESSION['uniq_id'] = $row['id'];


        header("location: ../html/student_MOR_7.php");
    }
}
?>