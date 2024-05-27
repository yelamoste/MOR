<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>
    <form method="post">
        <p> Insert New Users </p>

        <div class="section-form" id="student-sect">
            <p> Student form </p>
            <label for="student_name">Name:</label>
            <input type="text" name="student_name" id="student_name" placeholder="Juan Dela Cruz"> <br>
            <label for="school_id">School Id:</label>
            <input type="text" name="sschool_id" id="school_id" placeholder="YYYY-12345-MN-X">
            <button name="student-form-button" value="submit">Submit</button>
        </div>
        <div class="section-form" id="faculty-sect">
            <p> Faculty form </p>
            <label for="faculty_name">Name:</label>
            <input type="text" name="faculty_name" id="faculty_name" placeholder="Juan Dela Cruz"> <br>
            <label for="school_id">School Id:</label>
            <input type="text" name="fschool_id" id="school_id" placeholder="YYYY-12345-MN-X"> <br>
            <label for="faculty_webmail">Faculty Webmail:</label>
            <input type="email" name="faculty_webmail" id="faculty_webmail" placeholder="jdc@iskolarngbayan.pup.edu.ph"> <br>
            <label for="department-sel">Department:</label>
            <select class="department" id="department-sel" name="department-sel">
                <option value="0">Please Select:</option>
                <option value="Computer Engineering">Computer Engineering</option>
                <option value="Civil Engineering">Civil Engineering</option>
                <option value="Architecture">Architecture</option>
                <option value="Mechanical Engineering">Mechanical Engineering</option>
            </select>
            <button name="faculty-form-button" value="submit">Submit</button>
        </div>
    </form>
</body>

</html>


<?php
include('../php/db_conn.php');

$sname = $_POST['student_name'];
$sid = $_POST['sschool_id'];
$fname = $_POST['faculty_name'];
$fid = $_POST['fschool_id'];
$fwebmail = $_POST['faculty_webmail'];
$fdept = $_POST['department-sel'];

echo "connected";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST["student-form-button"])) {
        $studentSql = "INSERT INTO student_users (student_name, school_id, student_webmail, password) 
                        VALUES ('$sname','$sid','not-yet-set','not-yet-set')";
        if ($db_conn->query($studentSql) !== TRUE) {
            echo "ERROR" . $db_conn->error;
        }
    }

    if (isset($_POST["faculty-form-button"])) {
        $facultySql = "INSERT INTO faculty_users (faculty_name, school_id, faculty_webmail, department, password) 
        VALUES ('$fname','$fid','$fwebmail','$fdept','not-yet-set')";
        if ($db_conn->query($facultySql) !== TRUE) {
            echo "ERROR" . $db_conn->error;
        }
    }


    // TABLE `users`

    $studentQuery = "SELECT id FROM student_users";
    $studentResult = $db_conn->query($studentQuery);
    if ($studentResult && $studentResult->num_rows > 0) {
        $roles = 'student';
        $row = $studentResult->fetch_assoc();
        $user_id = $row['id'];
    
    } else {

        $facultyQuery = "SELECT id FROM faculty_users";
        $facultyResult = $db_conn->query($facultyQuery);
        if ($facultyResult && $facultyResult->num_rows > 0) {
            $roles = 'faculty';
            $row = $facultyResult->fetch_assoc();
            $user_id = $row['MAX(id)'];
        } else {
            echo "No user found in both tables.";
            exit;
        }
    }
    
    $insertQuery = $db_conn->prepare("INSERT INTO users (user_id, roles) VALUES (?, ?)");
    $insertQuery->bind_param("is", $user_id, $roles);
    
    if ($insertQuery->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $insertQuery->error;
    }
    
    $insertQuery->close();
    
    // $userSql = "SELECT u.user_id, s.id, f.id 
    // FROM users as u
    // INNER JOIN student_users as s ON u.user_id = s.id
    // INNER JOIN faculty_users as f ON u.user_id = f.id
    // LIMIT 1";
    // if ($db_conn->query($userSql) !== TRUE) {
    //     echo "ERROR" . $db_conn->error;
    // }
}

$db_conn->close();
?>