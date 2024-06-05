<?php
include('../php/db_conn.php');
include('../php/comments.php');
include('../php/title_proposal_display1.php');
include('../php/title_proposal_display_2_3.php');

// 
// if (isset($_POST["view-research-title2"])) {
//     $_SESSION['view-research-title-id2'] = $_POST["view-research-title2"];
//     header("location: ../html/student_MOR_11.php ");
// }
$id = $_SESSION['student-id'];
$uid = $_SESSION['view-research-title-id2'];


// echo $uid. "wth";

$sql10 = "SELECT tb.id, tb.title_proposal_id, tp.id, tp.title, tp.filename, tp2.response, tb.research_adviser, f.id, f.faculty_name, tp.status, tp2.adviser_response
FROM title_proposals_2 tp2
INNER JOIN thesis_basic_info AS tb ON tp2.thesis = tb.id
INNER JOIN faculty_users AS f ON tb.research_adviser = f.id
INNER JOIN title_proposals AS tp ON tb.title_proposal_id = tp.id WHERE user_id = $id AND title_proposal_id = $uid";

$result10 = $db_conn->query($sql10);

$sql11 = "SELECT c.committee, c.thesis, c.response, f.id, tb.id, tb.title_proposal_id, tp.id, f.faculty_name
FROM committees c
INNER JOIN faculty_users AS f ON c.committee = f.id
INNER JOIN thesis_basic_info AS tb ON c.thesis = tb.id
INNER JOIN title_proposals AS tp ON tb.title_proposal_id = tp.id WHERE user_id = $id AND title_proposal_id = $uid";

$res11 = $db_conn->query($sql11);


// $sql6 = "SELECT tb.id,  tb.title_proposal_id, t.title, t.filename, t.status
//           FROM thesis_basic_info as tb
//           INNER JOIN title_proposals as t ON tb.title_proposal_id = t.id
//           WHERE user_id = $id AND title_proposal_id =$uid ";

// $result6 = $db_conn->query($sql6);
if (!isset($_SESSION['view-research-title-id2'])) {
    header("location: ../html/student_MOR_10.php");
}
if (isset($_POST['rejected-dir-button'])) {
    header("location: ../html/student_MOR_6.php");
}
if (isset($_POST['title-proceed-button'])) {
    header("location: ../html/student_MOR_12.php");
}
if (isset($_POST['view-paper-button'])) {
    header("location: ../html/student_MOR_12.php");
}

$rows = 0;
if ($result10->num_rows > 0) {
    while ($row = $result10->fetch_assoc()) {
        $rows++;
        $title = $row['title'];
        $filename = $row['filename'];
        $ovaresponse = $row['response'];
        $resad = $row['faculty_name'];
        $status = $row['adviser_response'];
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title> Student MOR </title>
    <!-- temporary title for now, supposed changes as per title proposals -->
    <link rel="stylesheet" href="../css/main_style.css">
    <link rel="icon" type="image/x-icon" href="../img/book-half.png">
    <link rel="stylesheet" href="../css/navbar.css">
    <script src="../javascript/navbar.js"></script>
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
    <div class="content" id="page11">
        <div class="title-header-content" id="title-header-content-page11">
            <button onclick="history.back()" class="return-button"><img src="../img/icon-back.png" id="return-button" /></button>
            <p id="title-header-proposal">Proposal Research Title: </p>
            <p id="title-header-info">
                <?php

                echo $title;

                ?>
            </p>
            <?php



            $col = ($ovaresponse == "Approved") ? "#198754" : (($ovaresponse == "Conditional") ? "#DC8116" : (($ovaresponse == "Rejected") ? "#DC3545" : "#817b7b"));
            echo '<p class="display-result-title" id="response-cont2" style="background-color:' . $col . '">'
                . $ovaresponse;
            '</p>';
            ?>
        </div>
        <div class="cont-cont">
            <div class="comment-recommendation-cont">
                <p class="info-sub-title" id="com-rec-p">Comment/Recommendation</p>
                <!-- data from db should be displayed here. -->
                <div class="comment-sect">

                    <?php

                    $student_comment = "SELECT sc.id, sc.comments, sc.time_stamp, sc.thesis_id, sc.student_id, su.id, su.student_name 
                                        FROM student_comments sc
                                        INNER JOIN student_users as su ON sc.student_id = su.id
                                        WHERE thesis_id = $uid and student_id = $id";
                    $student_comment_res = $db_conn->query($student_comment);

                    if ($student_comment_res->num_rows > 0) {
                        while ($row = $student_comment_res->fetch_assoc()) {
                            $rows++;
                            $student_name = $row['student_name'];
                            $comment = $row['comments'];
                            $time = $row['time_stamp'];
                            $time1 = strtotime($time);
                            $formattedtime = date ('D , d F Y', $time1);

                            echo '<div class="comments-cont" id="comment-1"><img src="../img/avatar-placeholder _- Change image here.png" />';
                            echo "<p class='profile-name-comment'>" . $student_name . "</p>";
                            echo "<p class='comment-date'>" .$formattedtime. "</p>";
                            echo "<p class='comment-cont-info'>" .$comment. "</p>";
                            echo "<button onclick='' class='reply-button'>Reply here</button></div>";
                        }
                    }

                    ?>

                </div>
                <form action="" method="POST">
                    <div class="comment-textarea-sect">
                        <div class="comments-cont" id="comment-textarea">
                            <img src="../img/avatar-placeholder _- Change image here.png" />
                            <textarea placeholder="Write your thoughts.." name="student-comment-textarea" class="comment-textarea"></textarea>
                            <button onclick="" class="fulvuos-button" id="add-button" name="comment-button">Add</button>
                        </div>
                    </div>
                    <?php
                    if ($ovaresponse == "Approved" or $ovaresponse == "Conditional") {
                        echo "<div class='buttons-view-proceed' id='approved-button-dir'> <button class='fulvuos-button' id='title-proceed-button' name='view-paper-button'>View Paper</button> <button class='fulvuos-button' id='title-proceed-button' name='title-proceed-button'>Proceed to Title Defense</button> </div>";
                    } elseif ($ovaresponse == "Processing") {
                        echo "<div class='buttons-view-proceed'><p class='response-ind' style='color:#DC8116;'> Please wait for the Research Adviser's and Research Committees' responses..</div>";
                    } else {
                        // $Rejectdir = '../html/student_MOR_6.php';

                        echo "<div class='buttons-view-proceed'><p class='response-ind' style='color:#DC3545;'> Please upload another title proposal. </p> <button class='fulvuos-button' name = 'rejected-dir-button'>Upload Another Paper</button></div> ";
                    }
                    ?>

                </form>
            </div>

            <div class="approval-cont">
                <p class="info-sub-title" id="approval-responses-title">Approval Responses <?php echo "(" . $all_count . "/" . $overall_res_res . ")"; ?></p>
                <!-- research advisor response -->
                <div class="research-advisor-cont">
                    <div class="cat-title">
                        <div class="info-sub-title" id="research-advisor-title">Research Adviser</div>
                        <div class="info-sub-title" id="research-response status">Status</div>
                    </div>
                    <div class="faculty-section-response">
                        <p class="faculty-name-section"> Prof. <?php echo $resad; ?></p>
                        <?php $col2 = ($status == "Approved") ? "#198754" : (($status == "Conditional") ? "#DC8116" : (($status == "Rejected") ? "#DC3545" : "#817b7b"));

                        echo '<p class="display-result-title" id="title-responses" style="background-color:' . $col2 . '">' . $status . '</p>' ?>
                    </div>
                </div>
                <!-- research committee response -->
                <div class="research-committee-cont" id="mor-page11">
                    <div class="cat-title">
                        <div class="info-sub-title" id="research-committee-title">Research Committee</div>
                        <div class="info-sub-title" id="research-response status">Status</div>
                    </div>
                    <!-- should be pulled from db, iterate to 12 committee -->

                    <?php
                    if ($res11->num_rows > 0) {
                        while ($row = $res11->fetch_assoc()) {
                            $rows++;
                            $committee = $row['faculty_name'];
                            $res = $row['response'];
                            $col3 = ($res == "Approved") ? "#198754" : (($res == "Conditional") ? "#DC8116" : (($res == "Rejected") ? "#DC3545" : "#817b7b"));


                            echo '<div class="faculty-section-response">
                                <p class="faculty-name-section">Prof. ' . $committee . '</p>
                                <p class="display-result-title" id="title-responses" style="background-color:' . $col3 . '">' . $res . '</p>
                            </div>';
                        }
                    }


                    ?>







                </div>
            </div>
        </div>
    </div>

</body>

</html>