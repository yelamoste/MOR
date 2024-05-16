<?php
include('../php/db_conn.php');
include('../php/session_student.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Methods of Research</title>
    <!-- temporary title for now, supposed changes as per title proposals -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/main_style.css">
    <link rel="stylesheet" href="../css/log.css">
    <link rel="icon" type="image/x-icon" href="../img/book-half.png">
    <!-- <link rel="preconnect" href="../html/successpage.html"> -->
</head>

<body>
    <div class="navbar">
        <img src="../img/book-half.png" id="navbar-cmpe-logo" />

        <p id="navbar-header">CpEng Research Library</p>

        <span><a href="#"> Homepage</a></span>
        <div class="profile">
            <img src="../img/person-circle.png" id="navbar-profile" />
        </div>
    </div>
    <div class="cont-cont-block-page">
        <div class="title-cont-block">
            <p>Computer Engineering Research Courses</p>
            <span>Lorem ipsum dolor sit amet consectetur adipiscing eli mattis sit phasellus mollis sit aliquam sit nullam.</span>
        </div>
        <div class="courses-cont">
            <div class="course-cont-cont" id="mor-cont">
                <img src="../img/filler-img.webp">
                <p class="subject-course">Methods of Research</p>
                <p class="subject-code">Course Code: CMPE 123456</p>
                <button onclick="MorContinue()" class="proceed-button" id="mor-directory">Continue</button>
            </div>
            <div class="course-cont-cont" id="dp1-cont">
                <img src="../img/filler-img.webp">
                <p class="subject-course">Design Project 1</p>
                <p class="subject-code">Course Code: CMPE 123456</p>
                <button onclick="Dp1Continue()" class="proceed-button" id="dp1-directory">Continue</button>
            </div>
            <div class="course-cont-cont" id="dp2-cont">
                <img src="../img/filler-img.webp">
                <p class="subject-course">Design Project 2</p>
                <p class="subject-code">Course Code: CMPE 123456</p>
                <button onclick="Dp2Continue()" class="proceed-button" id="dp2-directory">Continue</button>
            </div>
        </div>

    </div>

</body>

</html>
<script>
    function MorContinue() {
        window.location.href = 'student_MOR_5.php';
    }
</script>