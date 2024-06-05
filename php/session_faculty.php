<?php
include('../php/db_conn.php');

session_start();

if (!isset($_SESSION['faculty-id'])) {
    header("location: ../html/index.php");
}
    echo "<div style='width:100%;height: 20px;position:absolute;background: black;font-family: InterRegular;color: white;'><p> SESSION LOGGED IN: ".$_SESSION['faculty-name']. "     ID: ".$_SESSION['faculty-id']."</p></div>";


    
?>

