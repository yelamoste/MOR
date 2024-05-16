<?php
include('../php/db_conn.php');

session_start();

if (!isset($_SESSION['student-id'])) {
    header("location: ../html/index.php");
}

