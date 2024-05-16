<?php
include('../php/db_conn.php');
include('../php/log.php');
include('../php/session.php');
include('../php/display.php');



?>

<!DOCTYPE html>
<html>

<head>
    <title> Student MOR </title>
    <!-- temporary title for now, supposed changes as per title proposals -->
    <link rel="stylesheet" href="../css/main_style.css">
    <link rel="stylesheet" href="../css/log.css">
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
            <button onclick="history.back()" class="return-button"><img src="../img/icon-back.png" id="return-button" /></button>
            <p id="title-header-proposal">Proposal Research Title: </p>
            <p id="title-header-info">
                <?php
                if ($result6->num_rows > 0) {
                    while ($row = $result6->fetch_assoc()) {
                    
                        echo $row['title'];
                        
                        
                    }}
                ?>
            </p>
        </div>
        <div class="cont-cont">
            <div class="comment-recommendation-cont">
                <p class="info-sub-title" id="com-rec-p">Comment/Recommendation</p>
                <!-- data from db should be displayed here. -->

                <div class="comments-cont" id="comment-1">
                    <img src="../img/avatar-placeholder _- Change image here.png" />
                    <p class="profile-name-comment">Prof. Juan Dela Cruz Dimagiba</p>
                    <p class="comment-date">1 day ago</p>
                    <p class="comment-cont-info">Lorem ipsum dolor sit amet, vince adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <button onclick="" class="reply-button">Reply here</button>
                </div>
                <div class="comments-cont" id="comment-2">
                    <img src="../img/avatar-placeholder _- Change image here.png" />
                    <p class="profile-name-comment">Prof. Juan Dela Cruz Dimagiba</p>
                    <p class="comment-date">1 day ago</p>
                    <p class="comment-cont-info">Lorem ipsum dolor sit amet, vince adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    <button onclick="" class="reply-button">Reply here</button>
                </div>
                <div class="comments-cont" id="comment-3">
                    <img src="../img/avatar-placeholder _- Change image here.png" />
                    <p class="profile-name-comment">Prof. Juan Dela Cruz Dimagiba</p>
                    <p class="comment-date">1 day ago</p>
                    <p class="comment-cont-info">Lorem ipsum dolor sit amet, vince adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    <button onclick="" class="reply-button">Reply here</button>
                </div>
                <div class="comments-cont" id="comment-textarea">
                    <img src="../img/avatar-placeholder _- Change image here.png" />
                    <textarea placeholder="Autosize height based on content lines" class="comment-textarea"></textarea>
                    <button onclick="" class="fulvuos-button" id="add-button">Add</button>
                </div>
                <div class="buttons-view-proceed">
                    <button onclick="" class="fulvuos-button" id="view-button">View the paper</button>
                    <button onclick="" class="fulvuos-button " id="proceed-button">Proceed to Title Defense</button>
                </div>

            </div>
            <div class="preview-cont">
                <?php
                if ($result6->num_rows > 0) {
                    while ($row = $result6->fetch_assoc()) {
                        $pdfPath = "../pdf/" . $filename;


                        echo "<embed src='$pdfPath'#toolbar=0' id='embed-pdf'></embed>";
                    }
                } else {
                    echo "No results found.";
                }

                ?>
            </div>
        </div>
    </div>

</body>

</html>

<script src="../javascript/navbar.js">
    
</script>