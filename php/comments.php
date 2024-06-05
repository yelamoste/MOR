<?php
include('../php/db_conn.php');
$time_stamp = date('Y-m-d H:i:s');


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['comment-button'])) {


        $comment = $_POST['student-comment-textarea'];
        if (session_status() == PHP_SESSION_NONE) {
            // include('../php/session_student.php');
            session_start();
        }

        $student_id = $_SESSION['student-id'];
        $thesis_id = $_SESSION['view-research-title-id'] ?? $_SESSION['view-research-title-id2'] ??  $_SESSION['view-research-title-id3'] ?? null;

        echo $comment;
        
        echo $time_stamp;
        echo $student_id;
        echo $thesis_id;

        $commentsql = $db_conn->prepare("INSERT INTO student_comments (student_id, thesis_id, comments, time_stamp) VALUES (?, ?, ?, ?)");
        if (!$commentsql) {
            echo "Prepare failed: (" . $db_conn->errno . ") " . $db_conn->error;
            exit();
        }
        $commentsql->bind_param("iiss", $student_id, $thesis_id, $comment, $time_stamp);

        if (!$commentsql->execute()) {
            echo "Execute failed: (" . $commentsql->errno . ") " . $commentsql->error;
            $commentsql->close();
            exit();
        }
        // echo $commentsql;
    }
}
