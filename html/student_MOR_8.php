<?php
include('../php/db_conn.php');
include('../php/session_student.php');
include('../php/comments.php');


if (isset($_POST["committee-proceed-button"])) {
    $_SESSION['committee-proceed-button'] = $_POST["committee-proceed-button"];
    header("location: ../html/student_MOR_9.php ");
}
if (!isset($_SESSION['view-research-title-id'])) {
    header("location: ../html/student_MOR_7.php");
}
if (isset($_POST['rejected-dir-button'])) {
    header("location: ../html/student_MOR_6.php");
}
$id = $_SESSION['student-id'];

$uid = $_SESSION['view-research-title-id'];
$sql6 = "SELECT tb.id,  tb.title_proposal_id, t.title, t.filename, t.status
          FROM thesis_basic_info as tb
          INNER JOIN title_proposals as t ON tb.title_proposal_id = t.id
          WHERE user_id = $id AND title_proposal_id =$uid ";

$result6 = $db_conn->query($sql6);

$rows = 0;
if ($result6->num_rows > 0) {
    while ($row = $result6->fetch_assoc()) {
        $rows++;
        $title = $row['title'];
        $filename = $row['filename'];
        $status = $row['status'];
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title> Student MOR </title>
    <!-- temporary title for now, supposed changes as per title proposals -->
    <link rel="stylesheet" href="../css/main_style.css">
    <link rel="stylesheet" href="../css/log.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="icon" type="image/x-icon" href="../img/book-half.png">
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

    <!-- content -->
    <div class="content" id="page11">
        <div class="title-header-content" id="title-header-content-page11">
            <button onclick="window.location.href='student_MOR_7.php';" class="return-button"><img src="../img/icon-back.png" id="return-button" /></button>
            <p id="title-header-proposal">Proposal Research Title: </p>
            <p id="title-header-info">
                <?php
                for ($i = 0; $i < $rows; $i++) {
                    echo $title;
                }
                ?>
            </p>
            <?php


            $col = ($status == "Approved") ? "#198754" : (($status == "Conditional") ? "#DC8116" : (($status == "Rejected") ? "#DC3545" : "#817b7b"));
            echo '<p class="display-result-title" id="response-cont2" style="background-color:' . $col . '">'
                . $status;
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
                        while ($row1 = $student_comment_res->fetch_assoc()) {
                            $student_name = $row1['student_name'];
                            $comment = $row1['comments'];
                            $time = $row1['time_stamp'];
                            $time1 = strtotime($time);
                            $formattedtime = date('D , d F Y', $time1);

                            echo '<div class="comments-cont" id="comment-1"><img src="../img/avatar-placeholder _- Change image here.png" />';
                            echo "<p class='profile-name-comment'>" . $student_name . "</p>";
                            echo "<p class='comment-date'>" . $formattedtime . "</p>";
                            echo "<p class='comment-cont-info'>" . $comment . "</p>";
                            echo "<button onclick='' class='reply-button'>Reply here</button></div>";
                        }
                    }
                    echo $uid;
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
                    if ($status == "Approved" or $status == "Conditional") {
                        echo "<div class='buttons-view-proceed'> <button class='fulvuos-button' id='committee-proceed-button' name='committee-proceed-button'>Proceed to Step 2</button> </div>";
                    } elseif ($status == "Processing") {
                        echo "<div class='buttons-view-proceed'><p class='response-ind' style='color:#DC8116;'> Please wait for the Research Adviser's response..</div>";
                    } else {
                        echo "<div class='buttons-view-proceed'><p class='response-ind' style='color:#DC3545;'> Please upload another title proposal. </p><button class='fulvuos-button' name = 'rejected-dir-button'>Upload Another Paper</button></div> ";
                    }
                    ?>

                </form>
            </div>
            <div class="preview-cont">

                <?php

                for ($i = 0; $i < $rows; $i++) {
                    $pdfPath = "../pdf/" . $filename;
                    echo "<embed src='$pdfPath#toolbar=0' id='embed-pdf'></embed>";
                }

                ?>
            </div>
        </div>
        <?php
        echo "<div class='zoom-button' id='zoom-button' name='zoom-button' title='Enlarge Research Paper' onclick='PopUp()'></div>";
        echo "<div class='zoom-dir' id='zoom-dir' name='zoom-dir'>
                        <div class='zoom-dir-exit' id='zoom-dir-exit' name='zoom-dir-exit' onclick='PopUpExit()'></div>
                        <embed src='$pdfPath#toolbar=0' id='embed-pdf'></embed>
                        </div>";

        ?>
    </div>
    </div>
</body>

</html>

<script src="../javascript/navbar.js">

</script>