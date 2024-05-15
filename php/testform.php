<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Upload Form</title>
</head>
<body>
    <form method="post" >
        <!-- <button name="subaru-submit">Submit</button> -->
    </form>
</body>
</html>


<?php
include('../php/db_conn.php');


$group_members = array();
$course = $_POST['course-sel'];
$yns = $_POST['yns-sel'];



for ($i = 1; $i <= 5; $i++) {
    $member_name = $_POST['group-members-cont' . $i];
    for ($j = 0; $j <2; $j++) {
        $group_ID = $j;
    }

    if (!empty($member_name)) {
        
        
        $group_members[] = $member_name;
    }
}



foreach ($group_members as $member_name) {
    $group_no = $_POST['group-sel'];
    

    $sql0 = "INSERT INTO group_members (group_ID, name, group_number, course, yearnsection) VALUES ('$group_ID','$member_name','$group_no','$course','$yns')";
    if ($db_conn->query($sql0) !== TRUE) {
        echo "Error: " . $sql0 . "<br>" . $db_conn->error;
    }
    exit;
    $group_ID++;
}
    ?>