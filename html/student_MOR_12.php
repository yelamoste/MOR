<?php
include('../php/db_conn.php');
include('../php/title_proposal_display_2_2.php');


// if (!isset($_SESSION['committee-proceed-button'] )) {
//     header("location: ../html/student_MOR_8.php ");
// }

$id = $_SESSION['student-id'];

$uid = $_SESSION['view-research-title-id2'];
// $sql7 = "SELECT tb.id,  tb.title_proposal_id, t.title, t.filename, t.status, tb.research_adviser, f.id, f.faculty_name
//           FROM thesis_basic_info as tb
//           JOIN title_proposals as t ON tb.title_proposal_id = t.id
//           JOIN faculty_users as f ON tb.research_adviser = f.id
//           WHERE user_id = $id AND title_proposal_id = $uid
//           ";

if (isset($_POST["panelist_submit"])) {
  $_SESSION['panelist-submit-ses'] = $_POST["panelist_submit"];
  header("location: ../html/student_MOR_13.php ");
}

$sql7 = "SELECT tb.id, tb.title_proposal_id, t.title, t.filename, t.status, tb.research_adviser, f.id AS faculty_id, f.faculty_name
          FROM thesis_basic_info AS tb
          JOIN title_proposals AS t ON tb.title_proposal_id = t.id
          JOIN faculty_users AS f ON tb.research_adviser = f.id
          WHERE user_id = $id AND title_proposal_id = $uid";

$result7 = $db_conn->query($sql7);

$rows = 0;
$title = '';
$filename = '';
$status = '';
$researchadv = '';

if ($result7->num_rows > 0) {
  while ($row = $result7->fetch_assoc()) {
    $rows++;
    $title = $row['title'];
    $filename = $row['filename'];
    $status = $row['status'];
    $researchadv = $row['faculty_name'];
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
      <h2>Title Defense</h2>
      <hr>
      <form method="post" id="info-form" onsubmit=" check(this)">  
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
              <p class="research-committee-cont">Select the (3) approval committee for your Title Proposal.<span>*</span></p>
              <p class="extra-details" >Ensure that each group within a section selects the same three panelists.</p>

            </div>
            <div class="committees-cont">
              <?php
              $sql8 = "SELECT * FROM faculty_users";
              // $sql9 = "SELECT c.committee, f.id, f.faculty_name, tb.id, c.thesis, tb.title_proposal_id, tp.id
              //           FROM committees c
              //           INNER JOIN faculty_users AS f ON c.committee = f.id
              //           INNER JOIN thesis_basic_info AS tb ON tb.id = c.thesis
              //           INNER JOIN title_proposals AS tp ON tb.title_proposal_id = tp.id  
              //           WHERE user_id = $id AND tp.id = $uid AND thesis";

              $result8 = $db_conn->query($sql8);
              // $result9 = $db_conn->query($sql9);

//               if ($result9->num_rows > 0) {
//                 while ($row = $result9->fetch_assoc()) {
//                   $committees = $row['committee'];
//                   $thesis = $row['thesis'];
// echo $committees.'<br>';


//                 }
//               }
              
              if ($result8->num_rows > 0) {
                while ($row = $result8->fetch_assoc()) {
                  $fid = $row['id'];
                  $faculty_name = $row['faculty_name'];

                  // disabling the research adviser for a damn reason that they can't be a committee of the research under their advisory.
                  $isDisabled = ($faculty_name == $researchadv )  ? 'disabled' : '';


                  echo '<div class="committee-option">
                  <input type="checkbox" onchange="CheckBox()" name="panelistsel[]" value="' . $fid . '" class="committee-checkbox" id="panelist' . $fid . '"' . $isDisabled . ' >
                  <label for="panelist' . $fid . '" >' . $faculty_name . '</label></div>';
                }
              } else {
                echo "No faculty available";
              }
              ?>
            </div>
            <div class="details-action-cont" id="mor-6-action-cont">
              <button class="details-action-clear" id="details-action-clear-but" onclick="ClearButton()">Clear</button>
              <button class="details-action-submit" title= "submit" name="panelist_submit" onclick="confirm()">Submit</button>
            </div>
          </div>
        </div>
    </div>
    </form>
    </div>
  </section>
</body>

</html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
  function ClearButton() {
    alert('You sure?');
    document.getElementById("info-form").reset();
  }

  function Output() {

    var fileInput = document.getElementById('mor-1-3-file-upload').files[0].name;

    console.log(1);
    console.log(fileInput);

    document.getElementById("demo").innerHTML = fileInput;
  }

  function confirm(){

    alert('Are you sure you want to submit this form?'); 
    }

  // for limiting selection of committees


$(function(){
	$('form').each(function(){
		var frm=$(this);
		$(this).find('input[type=checkbox]').click(function(){
			var len=$(frm).find('input[type=checkbox]:checked').length;
			if(len>3)
			{
				
				$(this).attr('checked',false);
				alert('You can only select 3 panelists');
				//  $(frm).find('input[type=checkbox]').attr('disabled',true);
      }
		});
	});
});
</script>