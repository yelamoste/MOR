<?php
require('../php/db_conn.php');

session_start();



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['student_signin'])) {
        $sischool_id = $_POST['signin_student_id'];
        $sipassword = $_POST['signin_student_pass'];

        $stmt0 = $db_conn->prepare("SELECT id, student_name, password FROM student_users WHERE school_id = ?");
        if (!$stmt0) {
            die("Prepare failed: " . $db_conn->error);
        }
        $stmt0->bind_param("s", $sischool_id);
        $stmt0->execute();
        $result = $stmt0->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verify password
            if (password_verify($sipassword, $row['password'])) {
                session_start();
                $_SESSION['student-id'] = $row['id'];
                $_SESSION['student-name'] = $row['student_name'];
                header("Location: ../html/student_MOR_4.php");
                exit;
            } else {
                echo "<script> alert('Login Failed: Invalid password.'); </script>";
            }
        } else {
            echo "<script> alert('Login Failed: No such user found.'); </script>";
        }

        $stmt0->close();
    }
    if (isset($_POST['student_signup'])) {
        $suwebmail = $_POST['student_webmail'];
        $suschool_id = $_POST['signup_student_id'];
        $supassword = $_POST['signup_student_pass'];

        // Hash the password before storing it
        $hashed_password = password_hash($supassword, PASSWORD_DEFAULT);

        $stmt1 = $db_conn->prepare("UPDATE student_users SET student_webmail = ?, password = ? WHERE school_id = ?");
        if (!$stmt1) {
            die("Prepare failed: " . $db_conn->error);
        }
        $stmt1->bind_param("sss", $suwebmail, $hashed_password, $suschool_id);

        if ($stmt1->execute()) {
            echo "<script> alert('Recorded Successfully'); </script>";
        } else {
            echo "<script> alert('Sign Up Failed'); </script>" . $stmt1->error;
        }

        $stmt1->close();
    }
}
