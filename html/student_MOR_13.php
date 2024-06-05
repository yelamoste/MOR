<?php
include('../php/db_conn.php');

include('../php/session_student.php');
include('../php/title_proposal_display1.php');

$id = $_SESSION['student-id'];

// if (!isset($_SESSION['committeesel'])) {
//     header("location: ../html/student_MOR_9.php");
//   }
if (isset($_POST["view-research-title3"])) {
    $_SESSION['view-research-title-id3'] = $_POST["view-research-title3"];
    header("location: ../html/student_MOR_14.php");
  }
  

//   $sql10 = "SELECT tb.id, tb.title_proposal_id, tp.id, tp.title, tp.filename, tp2.response
//   FROM title_proposals_3 tp3
//   INNER JOIN thesis_basic_info AS tb ON tp2.thesis = tb.id
//   INNER JOIN title_proposals AS tp ON tb.title_proposal_id = tp.id ";
  
  $sql10 = "SELECT tp3.id, tp2.id, tp3.thesis3, tp2.thesis, tb.id, tb.title_proposal_id, tp.id, tp.title, tp.filename, tp3.response
  FROM title_proposals_3 tp3
  INNER JOIN title_proposals_2 AS tp2 ON tp3.thesis3 = tp2.id
  INNER JOIN thesis_basic_info AS tb ON tp2.thesis = tb.id
  INNER JOIN title_proposals AS tp ON tb.title_proposal_id = tp.id ";
  
  $result10 = $db_conn->query($sql10);
  
?>
<!DOCTYPE html>
<html>

<head>
    <title> Student MOR </title>
    <!-- temporary title for now, supposed changes as per title proposals -->
    <link rel="stylesheet" href="../css/main_style.css">
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
    </div>
    <div class="content">
        <!-- bg color of content for visualization of the size of the box -->
        <div class="title-header-content">
            <button onclick="window.location.href='../html/student_MOR_5.php';" class="return-button"><img src="../img/icon-back.png" id="return-button" /></button>
            <p id="title-header"> Title Defense - Research Panelist </p>
        </div>

        <div class="research-info-container">
            <div class="research-details">
                <div class="research-brief-details-cont">
                    <div class="research-brief-details">
                        <div class="research-brief-details-members">
                            <p class="info-sub-title" id="label1">Group Members: <br></p>
                            <p class="details">
                                <?php
                                // connected to title_proposal_display1.php

                                if ($result6->num_rows > 0) {
                                    // output data of each row
                                    $gid = 0;
                                    while ($row1 = $result6->fetch_assoc()) {
                                        $gid = $row1["group_members"];
                                        break;
                                    }

                                    $stmt1 = $db_conn->prepare("SELECT name FROM group_members WHERE id=?");
                                    $stmt1->bind_param("i", $gid);
                                    $stmt1->execute();

                                    $result1 = $stmt1->get_result();
                                    $row2 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                                    $temp =  implode('',$row2);
                                    $temp2 = explode(',',$temp);
                                    echo implode('<br>',$temp2);


                                } else {
                                    echo "0 results";
                                }

                                ?>
                            </p>
                        </div>
                        <div class="research-brief-details-sub-title">
                            <p class="info-sub-title">Research Advisor:</p>
                            <p class="details">
                                <?php
                                // connected to title_proposal_display1.php
                                if ($result2->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result2->fetch_assoc()) {
                                        echo  $row["faculty_name"] .   "<br>";
                                    }
                                } else {
                                    echo "0 results";
                                }

                                ?> </p>
                            <p class="info-sub-title">Course & Section:</p>
                            <p class="details">
                                <?php
                                // connected to title_proposal_display1.php

                                if ($result3->num_rows > 0) {
                                    while ($row = $result3->fetch_assoc()) {

                                        $course = $row['courses'];
                                        $yns =  $row['yearnsection'];

                                        echo "$course $yns <br>";
                                    }
                                } else {
                                    echo "0 results";
                                }

                                ?>
                            </p>
                            <p class="info-sub-title">Group Number:</p>
                            <p class="details">
                                <?php
                                // connected to title_proposal_display1.php

                                if ($result4->num_rows > 0) {
                                    while ($row = $result4->fetch_assoc()) {

                                        $group = $row['group_number'];

                                        echo "$group <br>";
                                    }
                                } else {
                                    echo "0 results";
                                }

                                ?>
                            </p>
                        </div>


                    </div>
                    <div class="update-info">
                        <a href="#">Update Information</a>
                    </div>
                </div>
                <!-- Proposed Research Titles -->

                <div class="research-proposes-cont">
                    <p>Proposed Research Titles</p>

                    <?php
                    // connected to title_proposal_display1.php
                    if ($result10->num_rows > 0) {
                        while ($row = $result10->fetch_assoc()) {
                            $title = $row['title'];
                            $filename = $row['filename'];
                            $response = $row['response'];
                            $pdfPath = "../pdf/" . $filename;
                            $proposal_id = $row['title_proposal_id'];

                    ?>
                            <form action="" method="POST">
                                <div class="research-title-cont" onclick="PdfPreview('<?php echo $pdfPath; ?>')">
                                    <div class="research-title-cont-cont">
                                        <p class="info-sub-title" id="title-label">Title:</p>
                                        <p class="details" id="research-title">
                                            <?php echo $title; ?>
                                        </p>
                                    </div>
                                    <div class="research-result-cont">
                                        <div class="display-result">

                                            <?php


                                            $col = ($response == "Approved") ? "#198754" : (($response == "Conditional") ? "#DC8116" : (($response == "Rejected") ? "#DC3545" : "#817b7b"));
                                            echo '<p class="display-result-title" id="response-cont" style="background-color:' . $col . '">'
                                                . $response;
                                            '</p>';
                                            ?>

                                        </div>


                                        <?php

                                        //connect this to student_MOR_8, and user ID, and whatever you clicked, that is the only data
                                        echo  " <button class='view' type='submit' value=' $proposal_id' name='view-research-title3' id='view-research-title3' >View</button>";
                                        ?>


                                        <button class="remove" type="button" id="remove-research-title">Remove</button>
                                    </div>
                                </div>
                            </form>
                    <?php
                        }
                    } else {
                        echo "No results found.";
                    }

                    ?>
                </div>

            </div>
            <div class="research-preview">
                <embed src="../pdf/Title-Proposal-Template.pdf#toolbar=0" id="embed-pdf"></embed>
            </div>

        </div>
    </div>


</body>

</html>
<script src="../javascript/navbar.js">
    function PdfPreview(pdfPath) {
        document.getElementById('embed-pdf').src = pdfPath + "#toolbar=0";
    }
</script>