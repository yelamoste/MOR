<?php
include("../php/db_conn.php");
include("../php/form.php");

include('../php/session_student.php');


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
            <h2>Student Researcher Information</h2>
            <hr>
            <form method="POST" id="info-form" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to submit this form?');">
                <div class="details-cont">
                    <div class="details-submission-cont" id="form-input-cont">
                        <div class="group-members-cont">
                            <p class="group-members-cont">Group Members:<span>*</span></p>
                            <label for="group-members-cont" name="group-members-cont"></label>
                            <input class="group-members" type="text" name="group-members-cont1" value="" placeholder="Ex. Dela Cruz, Juan" autocomplete="off" required/>
                            <input class="group-members" type="text" name="group-members-cont2" value="" placeholder="Ex. Dela Cruz, Juan" autocomplete="off" required/>
                            <input class="group-members" type="text" name="group-members-cont3" value="" placeholder="Ex. Dela Cruz, Juan" autocomplete="off" required/>
                            <input class="group-members" type="text" name="group-members-cont4" value="" placeholder="Ex. Dela Cruz, Juan" autocomplete="off" required/>
                            <input class="group-members" type="text" name="group-members-cont5" value="" placeholder="Ex. Dela Cruz, Juan" autocomplete="off" required/>
                        </div>
                        <div class="other-details-cont">
                            <div class="other-details-cont-cont" id="research-adviser-sel-cont">
                                <p class="other-details-cont" id="container">Research Adviser:<span>*</span></p>
                                <label for="research-adviser-sel" name="research-adviser-sel"></label>
                                <?php
                                // Check if there are any rows returned
                                if ($result1->num_rows > 0) {
                                    // Output a select dropdown
                                    echo '<select name="research-adviser-sel" id="research-adviser-sel" >';
                                    echo '<option value="">Select Option</option>'; // Optional default option
                                    // Loop through the rows
                                    while ($row = $result1->fetch_assoc()) {
                                        // Output an option tag for each row
                                        echo '<option value="' . $row["id"] . '">' . $row["faculty_name"] . '</option>';
                                    }
                                    echo '</select>';
                                } else {
                                    echo '<select name="research-adviser-sel" id="research-adviser-sel" >';
                                    echo '<option value="">No data found</option>';
                                    echo '</select>';
                                }
                                ?>
                            </div>
                            <div class="other-details-cont-sel">
                                <div class="other-details-cont-cont" id="course-sel-cont">
                                    <p class="other-details-cont" id="container">Course:<span>*</span></p>
                                    <?php
                                    // Check if there are any rows returned
                                    if ($result2->num_rows > 0) {
                                        // Output a select dropdown
                                        echo '<select name="course-sel" id="course-sel" required>';
                                        echo '<option value="">Please select:</option>'; // Optional default option
                                        // Loop through the rows
                                        while ($row2 = $result2->fetch_assoc()) {
                                            // Output an option tag for each row
                                            echo '<option value="' . $row2["id"] . '">' . $row2["courses"] . '</option>';
                                        }
                                        echo '</select>';
                                    } else {
                                        echo '<select name="course-sel" id="course-sel" >';
                                        echo '<option value="">No data found</option>';
                                        echo '</select>';
                                    }
                                    ?>
                                </div>
                                <div class="other-details-cont-cont" id="yns-sel-cont">
                                    <p class="other-details-cont" id="container">Year and Section:<span>*</span></p>
                                    <?php
                                    // Check if there are any rows returned
                                    if ($result3->num_rows > 0) {
                                        // Output a select dropdown
                                        echo '<select name="yns-sel" id="yns-sel" required>';
                                        echo '<option value="">Please select:</option>'; // Optional default option
                                        // Loop through the rows
                                        while ($row3 = $result3->fetch_assoc()) {
                                            // Output an option tag for each row
                                            echo '<option value="' . $row3["id"] . '">' . $row3["yearnsection"] . '</option>';
                                        }
                                        echo '</select>';
                                    } else {
                                        echo '<select name="yns-sel" id="yns-sel" >';
                                        echo '<option value="">No data found</option>';
                                        echo '</select>';
                                    }
                                    ?>
                                </div>
                                <div class="other-details-cont-cont" id="group-sel-cont">
                                    <p class="other-details-cont" id="container">Group number:<span>*</span></p>
                                    <?php
                                    // Check if there are any rows returned
                                    if ($result7->num_rows > 0) {
                                        // Output a select dropdown
                                        echo '<select name="group-sel" id="group-sel" required>';
                                        echo '<option value="">Please select:</option>'; // Optional default option
                                        // Loop through the rows
                                        while ($row4 = $result7->fetch_assoc()) {
                                            // Output an option tag for each row
                                            echo '<option value="' . $row4["id"] . '">' . $row4["group_number"] . '</option>';
                                        }
                                        echo '</select>';
                                    } else {
                                        echo '<select name="yns-sel" id="yns-sel" >';
                                        echo '<option value="">No data found</option>';
                                        echo '</select>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="details-submission-cont" id="mor-6-submission-cont">
                        <p>Provide the title/s of your research below. <span>*</span></p>
                        <textarea class="title-proposal" name="title-textarea1" required></textarea>
                        <textarea class="title-proposal" name="title-textarea2" required></textarea>
                        <textarea class="title-proposal" name="title-textarea3" required></textarea>
                        <p>Upload the files below. <span>*</span></p>




                        <label for="pdfFile" class="drag-file-upload" id="drag-file-upload">
                            <img src="../img/drag.svg" id="drag-file-upload-logo">
                            <span class="description">Upload the chapter 1 to 3 of your thesis for Title Defense</span>

                            <input onchange="Output()" name="pdfFile" type="file" class="drag-file-upload-inputfile" id="pdfFile" accept=".pdf" hidden required/>
                        </label>

                        <p id="demo"></p>

                        <div class="details-action-cont" id="mor-6-action-cont">
                            <button class="details-action-clear" onclick="ClearButton()">Clear</button>
                            <button class="details-action-submit" value="submit" name="subaru-submit">Submit</button>
                        </div>
                        <!-- <div class="pop-up" id="popup">
                            <p> Do you really want to submit the form? </p>
                            <button onclick="Cancel()">Cancel</button>
                            <button id="subaru-submit" >Submit</button>
                        </div> -->

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

        var fileInput = document.getElementById('pdfFile').files[0].name;

        console.log(1);
        console.log(fileInput);

        document.getElementById("demo").innerHTML = fileInput;
    }



    // function SubmitButton() {
    //     let popUp = document.getElementById('popup');

    //     popUp.style.display = "block";
    //     console.log(asdas);
    // }
</script>