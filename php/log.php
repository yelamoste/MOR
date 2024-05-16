<?php
require('../php/db_conn.php');




if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['student_signin'])) {
        $sischool_id = $_POST['signin_student_id'];
        $sipassword = $_POST['signin_student_pass'];

        $usersql = "SELECT * FROM student_users WHERE  school_id = '$sischool_id' and password = '$sipassword'";

        $result = mysqli_query($db_conn, $usersql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            session_start();
            
            $_SESSION['student-id'] = $row['id'];
            $_SESSION['student-name'] = $row['student_name'];
           

            header("location: ../html/student_MOR_4.php");
        } else {
            echo "<script> alert('Login Failed'); </script>";
        }
    }

    if (isset($_POST['student_signup'])) {

        $suwebmail = $_POST['student_webmail'];
        $suschool_id = $_POST['signup_student_id'];
        $supassword = $_POST['signup_student_pass'];
        $supassword = password_hash($supassword, PASSWORD_DEFAULT);

        $sql = "UPDATE student_users 
                SET student_webmail = '$suwebmail' , password = '$supassword' 
                WHERE school_id = '$suschool_id'";


        if (mysqli_query($db_conn, $sql)) {
            echo "<script> alert('Recorded Successfully'); </script>";
        } else {
            echo "<script> alert('Sign Up Failed') </script>" . mysqli_error($db_conn);
        }
    }
}
