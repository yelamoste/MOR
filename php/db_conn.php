<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "mor_db";

$db_conn = mysqli_connect($host, $user, $password, $db);

    if(mysqli_connect_errno()){
        die("Failed to connect to database: ".mysqli_connect_error());
    }

    // if($db_conn){
    //     echo("connected");
    // }

    
?>