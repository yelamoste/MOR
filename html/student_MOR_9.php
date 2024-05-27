<?php
include('../php/db_conn.php');
include('../php/session_student.php');


// if (!isset($_SESSION['committee-proceed-button'] )) {
//     header("location: ../html/student_MOR_8.php ");
// }
$id = $_SESSION['student-id'];

if (isset($_POST["committee-submit"])) {

  header("Location: ../html/student_MOR_10.html");
}

$sql8 = "SELECT * FROM faculty_users";
$result8 = $db_conn->query($sql8);



$uid = $_SESSION['view-research-title-id'];
$sql7 = "SELECT tb.id,  tb.title_proposal_id, t.title, t.filename, t.status
          FROM thesis_basic_info as tb
          INNER JOIN title_proposals as t ON tb.title_proposal_id = t.id
          WHERE user_id = $id AND title_proposal_id =$uid ";

$result7 = $db_conn->query($sql7);

$rows = 0;
if ($result7->num_rows > 0) {
  while ($row = $result7->fetch_assoc()) {
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
  <title> Title Defense </title>

  <link rel="stylesheet" href="../css/main_style.css">
  <link rel="stylesheet" href="../css/log.css">
  <link rel="icon" type="image/x-icon" href="../img/cmpe_logo.jpg">

</head>

<body>
  <section class="main-cont">
    <div class="title-cont">
      <button onclick="history.back()" class="return-button"><img src="../img/icon-back.png" id="return-button" /></button>
      <h1>Methods of Research</h1>
    </div>
    <div class="content-cont">
      <h2>Research Approval Committee</h2>
      <hr>
      <form method="post" id="info-form" onsubmit="return confirm('Are you sure you want to submit this form? \nYou selected the following:\n<?php echo '-Shuta';?>');">
        <div class="details-cont">
          <div class="details-submission-cont" id="mor-6-submission-cont">

            <?php

            for ($i = 0; $i < $rows; $i++) {
              $pdfPath = "../pdf/" . $filename;
              echo "<embed src='$pdfPath#toolbar=0' id='embed-pdf'></embed>";
            }

            ?>
          </div>

          <div class="details-submission-cont" id="form-input-cont">
            <div class="research-committee-cont">
              <p class="research-committee-cont">Select the (12) approval committee for your Title Proposal<span>*</span></p>

            </div>
            <div class="committees-cont">
              <?php

              if ($result8->num_rows > 0) {
                while ($row = $result8->fetch_assoc()) {
                  $id = $row['id'];
                  $faculty_name = $row['faculty_name'];

                  echo '<div class="committee-option">
                  <input type="checkbox" onchange="CheckBox()" id="committee" name="committee[]" class="committee-checkbox">
                  <label for="committee">' . $faculty_name . '</label></div>';
                }
              }
              ?>
            </div>
            <div class="details-action-cont" id="mor-6-action-cont">
              <button class="details-action-clear" onclick="ClearButton()">Clear</button>
              <button class="details-action-submit" name="committee-submit">Submit</button>
            </div>
          </div>
        </div>
    </div>
    </form>
    </div>
  </section>
</body>

</html>
<script>
  function ClearButton() {
    document.getElementById("info-form").reset();
  }

  function Output() {

    var fileInput = document.getElementById('mor-1-3-file-upload').files[0].name;

    console.log(1);
    console.log(fileInput);

    document.getElementById("demo").innerHTML = fileInput;
  }

  function SubmitButton() {
    // temporary cause it needs to be validated

  }

  function CheckBox() {
    let committeeCb = document.getElementsByClassName('committee-checkbox');

    console.log(committeeCb);
  }
</script>