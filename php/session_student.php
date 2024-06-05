<?php
include('../php/db_conn.php');

session_start();

if (!isset($_SESSION['student-id'])) {
    header("location: ../html/index.php");
}
    echo "<div style='width:100%;height: 20px;position:absolute;background: black;font-family: InterRegular;color: white;'><p> SESSION LOGGED IN: ".$_SESSION['student-name']. "     ID: ".$_SESSION['student-id']."</p></div>";
    

    
?>

