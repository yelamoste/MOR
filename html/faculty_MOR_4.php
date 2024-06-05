<?php
include('../php/db_conn.php');
include('../php/session_faculty.php');
include('../php/faculty_search.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <!-- temporary title for now, supposed changes as per title proposals -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/main_style.css">
    <link rel="stylesheet" href="../css/log.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/faculty_main_style.css">
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
                        <p>Welcome, <?php echo $_SESSION['faculty-name']; ?>
                    </div>
                    <div class="log-out">
                        <p id="log-out"><a href="../php/logout.php">Log out</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cont-cont-block-page">
        <div class="cont-cont-block-main">
            <div class="theses-cont">
                <div class="title-cont-cont">
                    <h1>Overview</h1>
                    <form method="post">
                        <div class="search-field">
                            <input class="search-input-field" name="search-input-field" type="text" placeholder="Search Thesis Proposals, Title Proposals, and Authors ">
                            <button class="search-button" name="search-button">Search</button>
                        </div>
                    </form>
                    <div class="thesis-block-cont">
                        <div class="thesis-block-cont-cont">
                            <?php
                            
                            echo "<p class='search-input'>Search Input: " . htmlspecialchars($search_input) . "</p>";
                            ?>
                            <p class="title-block-cont">Thesis Proposals</p>
                            <!-- <div class="sorting-sect"></div> -->
                        </div>
                        <div class="thesis-cont">

                            <?php



                            if ($search_input_res && $search_input_res->num_rows > 0) {
                                // echo 'Henlo<br>';
                                while ($search_row = $search_input_res->fetch_assoc()) {
                                    // Process and display each row as needed
                                    $group_members_cat = htmlspecialchars($search_row['name'] ?? 'N/A');
                                    $research_adviser_cat = htmlspecialchars($search_row['faculty_name'] ?? 'N/A');
                                    $title = htmlspecialchars($search_row['title'] ?? 'N/A');
                                    $filename = htmlspecialchars($search_row['filename'] ?? 'N/A');
                                    $student_user = htmlspecialchars($search_row['student_name'] ?? 'N/A');
                                    $course = htmlspecialchars($search_row['courses'] ?? 'N/A');
                                    $groupno = htmlspecialchars($search_row['group_number'] ?? 'N/A');
                                    $yns = htmlspecialchars($search_row['yearnsection'] ?? 'N/A');


                                    echo '<div class="thesis-cont-cont">
                                        <p class="thesis-title">' . $title . '</p>
                                        <div class="sec-dir">
                                        <button class="text-directory" value ="" onclick = "courseSearch()"id="course">' . $course . '</button>
                                        <button class="text-directory"  id="groupno" onclick = "groupNo()"> Group:   ' . $groupno . '</button>
                                        </div>
                                        <div class="sec-dir">
                                        <button class="text-directory" id="subject" onclick = "Subject()">Methods of Research</button>
                                        </div>
                                        <div class="sec-dir">
                                        <button class="text-directory" id="research_adv" onclick = "ResearchAdv()"> Research Adviser:   ' . $research_adviser_cat . '</button>
                                        
                                        <div class="button-div"><button class="view-button" id="view-paper" name="view-directory">View</button></div>
                                        </div>
                                        </div>';


                                    //     echo "Course: " . $course . "<br>";
                                    //     echo "Group number: " . $groupno . "<br>";
                                    //     echo "Year & Section: " . $yns . "<br>";
                                    //     echo "Group Members: " . $group_members_cat . "<br>";
                                    //     echo "Research Adviser: " . $research_adviser_cat . "<br>";
                                    //     echo "Title: " . $title . "<br>";
                                    //     echo "Filename: " . $filename . "<br>";
                                    //     echo "Student User: " . $student_user . "<br><br>";
                                }
                            } else {
                                echo "<p class='no-results-txt'>No results found for the search query.</p>";
                            } ?>


                        </div>



                    </div>
                </div>



            </div>
            <div class="notification-cont">
                <div class="notif-title"><p>Notification</p></div>
                <div class="notification-cont-cont">

                        <div class="notif-bar">
                            <div class="notif-username">Mayari </div>
                            <div class="action"> has choosen you as their Research Adviser for Methods of Research</div>
                            <div class="date-time">Jan 10, 2010</div>
                        </div>

                        <div class="notif-bar">
                            <div class="notif-username">Mayari</div>
                            <div class="action">has choosen you as their Research Adviser for Methods of Research</div>
                            <div class="date-time">Jan 10, 2010</div>
                        </div>
                        
                        <div class="notif-bar">
                            <div class="notif-username">Mayari</div>
                            <div class="action">has choosen you as their Research Adviser for Methods of Research</div>
                            <div class="date-time">Jan 10, 2010</div>
                        </div>

                </div>

            </div>

















        </div>
    </div>
</body>

</html>
<script>

const SearchInput = document.querySelector(".search-input-field");


function courseSearch(){
    SearchInput.value = SearchInput.value + "Course";
}

function groupNo(){
    SearchInput.value = SearchInput.value + "Group";
}

function Subject(){
    SearchInput.value = SearchInput.value + "Subject";
}

function ResearchAdv(){
    SearchInput.value = SearchInput.value + "Research Adviser";
}
</script>

<!-- comment section -->
<!-- <div class="comments-cont" id="comment-textarea">
            <img src="../img/avatar-placeholder _- Change image here.png" />
            <textarea placeholder="Write your thoughts.." name="student-comment-textarea" class="comment-textarea"></textarea>
            <button onclick="" class="fulvuos-button" id="add-button" name="comment-button">Add</button>
        </div> -->