<?php
include('../php/db_conn.php');
include('../php/session_student.php');


?>

<script src="../javascript/navbar.js"></script>
<!DOCTYPE html>
<html>

<head>
    <title>Student Methods of Research</title>
    <!-- temporary title for now, supposed changes as per title proposals -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/main_style.css">
    <link rel="stylesheet" href="../css/navbar.css">
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
    
    <section class="student-mor5-main-cont">
        <div class="student-mor-tabs" id="student-mor-tabs-cont">
            <div class="title-cont" id="student-mor-title-cont">
                <button onclick="history.back()" class="return-button"><img src="../img/icon-back.png" id="return-button"  /></button>
                <h1>Methods of Research</h1>
            </div>
            <div class="content-cont" id="student-mor5-cont-cont">
                
                <div class="directory-cont" id="research-advisor-cont">
                    <p class="directory-cont-title">For Title Proposal - Research Adviser</p>
                    <div class="button-cont">
                        <button onclick="window.location.href = 'student_MOR_7.php';" class="continue-button">Continue</button>
                    </div>    
                </div>

                <div class="directory-cont" id="research-committee-cont">
                    <p class="directory-cont-title">For Title Proposal - Research Committee</p>
                    <div class="button-cont">
                        <button onclick="window.location.href = 'student_MOR_9.php';" class="continue-button">Continue</button>
                    </div>
                </div>
                
                <div class="directory-cont" id="research-panelist-cont">
                    <p class="directory-cont-title">For Title Defense - Research Panelist</p>
                    <div class="button-cont">
                        <button onclick="window.location.href = 'student_MOR_13.html';" class="continue-button">Continue</button>
                    </div>
                </div>
            </div>
            
        </div>
    
    </section> 
</body>
</html>