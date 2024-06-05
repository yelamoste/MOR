<?php
include('../php/db_conn.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['faculty_signin'])) {
        $fiwebmail = $_POST['signin_faculty_webmail'];
        $fipassword = $_POST['signin_faculty_pass'];

        $stmt3 = $db_conn->prepare("SELECT id, faculty_name, password FROM faculty_users WHERE faculty_webmail = ?");
        if (!$stmt3) {
            die("Prepare failed: " . $db_conn->error);
        }
        // $username = trim($_POST["login_username"]); //
        // $password = trim($_POST["login_password"]); //
        // $hashed_password = password_hash($_POST["login_password"], PASSWORD_DEFAULT);

        $stmt3->bind_param("s", $fiwebmail);
        $stmt3->execute();
        $result3 = $stmt3->get_result();

        if ($result3->num_rows == 1) {
            $row = $result3->fetch_assoc();
            // Verify password

            echo "i've got breaking news";
            if (password_verify($fipassword, $row['password'])) {
                session_start();

                $_SESSION['loggedin'] = TRUE;
                $_SESSION['faculty-id'] = $row['id'];
                $_SESSION['faculty-name'] = $row['faculty_name'];

                echo $_SESSION['faculty-id'];
                header("Location: ../html/student_MOR_4.php");
                // exit;

                echo "oo";
                
            } else {
                echo "<script> alert('Login Failed: Invalid password.'); </script>";
            } 
        }    else {

                echo "<script> alert('Login Failed: No such user found.'); </script>";
    
            }
         

        $stmt3->close();
    }

    if (isset($_POST['faculty_signup'])) {
        $fuwebmail = $_POST['signup_faculty_webmail'];
        $fuschool_id = $_POST['signup_faculty_id'];
        $fupassword = $_POST['signup_faculty_pass'];

        // Hash the password before storing it
        $hashed_password = password_hash($fupassword, PASSWORD_DEFAULT);

        // Prepare and bind
        $stmt2 = $db_conn->prepare("UPDATE faculty_users SET faculty_webmail = ?, password = ? WHERE school_id = ?");
        if (!$stmt2) {
            die("Prepare failed: " . $db_conn->error);
        }
        $stmt2->bind_param("sss", $fuwebmail, $hashed_password, $fuschool_id);

        if ($stmt2->execute()) {
            echo "<script> alert('Recorded Successfully'); </script>";
        } else {
            echo "<script> alert('Sign Up Failed'); </script>" . $stmt2->error;
        }

        $stmt2->close();
    }
}






// password testing
// $db_pass = $row['password'];
        // $hashpass = '$2y$10$e4krnyH8O3lwraaQLNThru78ReKqBjbOjpC1tIGEvQSHf6aOvvWGi';
        

        // $get = password_get_info($hashpass);
        // echo $get;
        // $passwordhash = password_verify($fipassword, $hashpass);


        // if($passwordhash){
        //     echo "verified";
        // } else {
        //     echo "not";
        // }


        
        
        // echo $passwordhash."hash";
        // echo $fipassword;
        // echo $db_pass;

