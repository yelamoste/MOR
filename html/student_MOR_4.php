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
    <link rel="stylesheet" href="../css/navbar.css">
    <script src="../javascript/navbar.js"></script>
    <link rel="icon" type="image/x-icon" href="../img/book-half.png">
    <!-- <link rel="preconnect" href="../html/successpage.html"> -->
</head>

<body>
    <div class="navbar">
        <img src="../img/book-half.png" id="navbar-cmpe-logo" />

        <p id="navbar-header">CpEng Research Library</p>

        <span><a href="#"> Homepage</a></span>
        <div class="profile" onclick="profileDropDown()">
            <img src="../img/person-circle.png" id="navbar-profile" />
            <div class="profile-dropdown-cont" id="profile-dropdown-cont">
                <div class="profile-dropdown" id="profile-dropdown">
                    <div class="profile-name">
                        <p>Welcome, <?php echo $_SESSION['student-name']; ?>
                    </div>
                    <div class="log-out">
                        <p id="log-out"><a href="../php/logout.php">Log out</a></p>
                    </div>
                </div>
            </div>
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
                <?php


                $u_id = $_SESSION['student-id'];

                $dp1 = "SELECT dp1.id, dp1.thesis_proposal, tp3.id, tp3.thesis3, tp2.id, tp2.thesis, tb.id, tb.user_id 
                        FROM dp1_thesis_proposal as dp1
                        INNER JOIN title_proposals_3 as tp3 ON dp1.thesis_proposal = tp3.id
                        INNER JOIN title_proposals_2 as tp2 ON tp3.thesis3 = tp2.id
                        INNER JOIN thesis_basic_info AS tb ON tp2.thesis = tb.id
                        WHERE tb.user_id = $u_id";
                $dp1res = $db_conn->query($dp1);

                $dp1p = "SELECT dp1p.id, dp1p.thesis_id, tp3.id, tp3.thesis3, tp2.id, tp2.thesis, tb.id, tb.user_id  
                            FROM dp1_panelists AS dp1p
                            INNER JOIN title_proposals_3 as tp3 ON dp1p.thesis_id = tp3.id
                            INNER JOIN title_proposals_2 as tp2 ON tp3.thesis3 = tp2.id
                            INNER JOIN thesis_basic_info tb ON tp2.thesis = tb.id
                            WHERE tb.user_id = $u_id";
                $dp1pres = $db_conn->query($dp1p);


                if ($dp1res && $dp1res->num_rows > 0) {
                    echo "<button name='dp1-directory' title='Check Details' class='proceed-button' id='dp1-directory'>Continue</button>";
                } else {
                    $isDisabled = ($dp1pres && $dp1pres->num_rows == 0) ? 'disabled' : '';
                    echo "<button style='background-color: #e3ac6a; pointer-events: none;' name='continuebutton3'  class='proceed-button' title='Button disabled' id='dp1-directory' $isDisabled >Continue</button>";
                }
                ?>

            </div>
            <div class="course-cont-cont" id="dp2-cont">
                <img src="../img/filler-img.webp">
                <p class="subject-course">Design Project 2</p>
                <p class="subject-code">Course Code: CMPE 123456</p>
                <?php


                $u_id = $_SESSION['student-id'];

                $dp2 = "SELECT dp2.id, dp2.thesis_proposal, dp1.id, dp1.thesis_proposal, tp3.id, tp3.thesis3, tp2.id, tp2.thesis, tb.id, tb.user_id 
                        FROM dp2_thesis_proposal as dp2
                        INNER JOIN dp1_thesis_proposal as dp1 ON dp2.thesis_proposal = dp1.id
                        INNER JOIN title_proposals_3 as tp3 ON dp1.thesis_proposal = tp3.id
                        INNER JOIN title_proposals_2 as tp2 ON tp3.thesis3 = tp2.id
                        INNER JOIN thesis_basic_info AS tb ON tp2.thesis = tb.id
                        WHERE tb.user_id = $u_id";
                $dp2res = $db_conn->query($dp2);

                $dp2p = "SELECT dp2p.id, dp2p.thesis_id, dp1p.id, dp1p.thesis_id, tp3.id, tp3.thesis3, tp2.id, tp2.thesis, tb.id, tb.user_id  
                            FROM dp2_panelists AS dp2p
                            INNER JOIN dp1_panelists AS dp1p ON dp2p.thesis_id = dp1p.id
                            INNER JOIN title_proposals_3 as tp3 ON dp1p.thesis_id = tp3.id
                            INNER JOIN title_proposals_2 as tp2 ON tp3.thesis3 = tp2.id
                            INNER JOIN thesis_basic_info tb ON tp2.thesis = tb.id
                            WHERE tb.user_id = $u_id";
                $dp2pres = $db_conn->query($dp2p);


                if ($dp2res && $dp2res->num_rows > 0) {
                    echo "<button name='dp2-directory' title='Check Details' class='proceed-button' id='dp2-directory'>Continue</button>";
                } else {
                    $isDisabled = ($dp2pres && $dp2pres->num_rows == 0) ? 'disabled' : '';
                    echo "<button style='background-color: #e3ac6a; pointer-events: none;' name='continuebutton3'  class='proceed-button' title='Button disabled' id='dp2-directory' $isDisabled >Continue</button>";
                }
                ?>

            </div>
        </div>

    </div>

</body>

</html>
<script>
    function MorContinue() {
        window.location.href = 'student_MOR_5.php';
    }

    function Dp1Continue() {
        window.location.href = 'student_DP1.html';
    }

    function Dp2Continue() {
        window.location.href = 'student_DP2.html';
    }
</script>