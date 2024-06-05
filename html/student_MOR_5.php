<?php
include('../php/db_conn.php');
include('../php/session_student.php');
// include('../php/title_proposal_display2.php');



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["continuebutton"])) {
        header("Location: ../html/student_MOR_10.php");
    }
    if (isset($_POST["continuebutton2"])) {
        $_SESSION['committee-proceed-button'] = $_POST["continuebutton2"];
        header("location: ../html/student_MOR_9.php ");
    }
    if (isset($_POST["continuebutton3"])) {
        header("Location: ../html/student_MOR_5.php");
    }
    if (isset($_POST["paneldir1"])) {
        header("Location: ../html/student_MOR_13.php");
    }
    if (isset($_POST["paneldir2"])) {
        header("Location: ../html/student_MOR_12.php");
    }
    if (isset($_POST["paneldir3"])) {
        header("Location: ../html/student_MOR_5.php");
    }
}
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
    <section class="student-mor5-main-cont">
        <div class="student-mor-tabs" id="student-mor-tabs-cont">
            <div class="title-cont" id="student-mor-title-cont">
                <button onclick="window.location.href='../html/student_MOR_4.php';" class="return-button"><img src="../img/icon-back.png" id="return-button" /></button>
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
                        <form method="post">
                            <?php


                            $u_id = $_SESSION['student-id'];

                            $tp2 = "SELECT tp2.id, tp2.thesis, tb.id, tb.user_id 
                                    FROM title_proposals_2 tp2
                                    INNER JOIN thesis_basic_info AS tb ON tp2.thesis = tb.id
                                    WHERE tb.user_id = $u_id";
                            $tp2res = $db_conn->query($tp2);

                            $commit = "SELECT c.id, c.thesis, tb.id, tb.user_id  
                            FROM committees AS c
                            INNER JOIN thesis_basic_info tb ON c.thesis = tb.id
                            WHERE tb.user_id = $u_id";
                            $commitres = $db_conn->query($commit);


                            if ($tp2res && $tp2res->num_rows > 0) {
                                echo "<button name='continuebutton' title='Check Details' class='continue-button' >Continue</button>";
                            } else{
                                $isDisabled = ($commitres && $commitres->num_rows == 0) ? 'disabled' : '';
                                echo "<button style='background-color: #e3ac6a; pointer-events: none;' name='continuebutton3'  class='continue-button' title='Button disabled' id='dir2-button' $isDisabled >Continue</button>";
                            }
                            ?>



                    </div>
                </div>

                <div class="directory-cont" id="research-panelist-cont">
                    <p class="directory-cont-title">For Title Defense - Research Panelist</p>
                    <div class="button-cont">
                        <?php
                        $u_id = $_SESSION['student-id'];

                        $tp3 = "SELECT tp3.id, tp3.thesis3, tp2.id, tp2.thesis, tb.id, tb.user_id
                                FROM title_proposals_3 tp3 
                                INNER JOIN title_proposals_2 AS tp2 ON tp3.thesis3 = tp2.id
                                INNER JOIN thesis_basic_info AS tb ON tp2.thesis = tb.id
                                WHERE tb.user_id = $u_id";
                        $tp3res = $db_conn->query($tp3);

                        $panel = "SELECT p.id, p.thesis, tb.id, tb.user_id  
                                    FROM panelists AS p
                                    INNER JOIN thesis_basic_info tb ON p.thesis = tb.id
                                    WHERE user_id = $u_id";
                        $panelres = $db_conn->query($panel);


                        if ($tp3res && $tp3res->num_rows > 0) {
                            echo "<button name='paneldir1' title='Check Details' class='continue-button' >Continue</button>";
                        } else {
                            $isDisabled1 = ($panelres && $panelres->num_rows == 0) ? 'disabled' : '';
                            echo "<button style='background-color: #e3ac6a; pointer-events: none;' name='paneldir3' class='continue-button' title='Button disabled' id='dir2-button' $isDisabled1 >Continue</button>";
                        }

                        ?>
                    </div>
                </div>
                </form>

            </div>

        </div>

    </section>
</body>

</html>