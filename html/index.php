<?php
    require("../php/log.php");
    require("../php/log_faculty.php");



    // if (isset($_SESSION['student-id'])){ // check if student is logged in

    //     header("location: ../html/student_MOR_4.php"); // redirect 
    // }
    if (isset($_SESSION['faculty-id'])){ // check if faculty is logged in

        header("location: ../html/faculty_MOR_4.php"); // redirect 
    }
   
?>


<!DOCTYPE html>
<html>
<head>
    <title>Welcome!</title>
    <link rel="stylesheet" href="../css/main_style.css">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/log.css">
    <link rel="icon" type="image/x-icon" href="../img/book-half.png">
    
    <!-- <link rel="preconnect" href="../html/successpage.html"> -->

</head>


<body>
    
    <div class="container-block">
        <!-- image placeholder -->
        <div class="cont-cont-block" id="img-block">

        </div>
        <!-- form -->
        <div class="cont-cont-block" id="form-block">
            <div class="cont-cont-form-block" id="option-block">
                <div class="title-block">
                    <img src="../img/cmpe_logo.jpg">
                    <p class="form-title-block">Computer Engineering Research Library</p>
                    <span>commodo quis imperdiet massa tincidunt nunc pulvinar sapien et</span>
                </div>
                <div class="option-buttons">
                    <button onclick="StudentResearcher()">Student Researcher</button>
                    <button onclick="Faculty()">Faculty</button>
                    <!-- <button onclick="Admin()">Admin</button> -->
                </div>
            </div>

            <!-- div directory for buttons -->

            <!-- SIGN IN -->
            
            <!-- student-researchers -->
            <div class="sign-cont" id="signin-sr-cont">
                <form action="" method="post">
                    <div class="title-block">
                        <img src="../img/cmpe_logo.jpg">
                        <p class="form-title-block">Student Researcher</p>
                        <span>commodo quis imperdiet massa tincidunt nunc pulvinar sapien et</span>
                    </div>
                    <div class="login-form">
                        <input class="input-form" type="text" id="signin_student_id" name="signin_student_id" placeholder="Student number" required/>
                        <input class="input-form" type="password" id="signin_student_pass" name="signin_student_pass" placeholder="Password" required/>
                        <button type="submit" class="submit-button" name="student_signin">Submit</button>
                        <button onclick="StudentSignUp()" class="sign-button">Sign Up Here</button>
                    </div>
                </form>
            </div>
            
            <!-- SIGN UP -->

            <!-- student-researchers -->
    
            <div class="sign-cont" id="signup-sr-cont">
                <form action="" method="post">
                    <div class="title-block">
                        <img src="../img/cmpe_logo.jpg">
                        <p class="form-title-block">Student Researcher</p>
                        <span>commodo quis imperdiet massa tincidunt nunc pulvinar sapien et</span>
                    </div>
                    <div class="login-form">
                        <input class="input-form" type="text" id="signup_student_id" name="signup_student_id" placeholder="Student number" required/>
                        <input class="input-form" type="email" id="student_webmail" name="student_webmail" placeholder="PUP webmail" required/>
                        <input class="input-form" type="password" id="signup_student_pass" name="signup_student_pass" placeholder="Password" required/>
                        <button type="submit" class="submit-button" name="student_signup">Submit</button>
                        <button onclick="StudentSignIn()" class="sign-button" >Sign In Here</button>
                    </div>
                </form>
            </div>
            
            
            <!-- SIGN IN -->
            <!-- Faculty -->
            
            <div class="sign-cont" id="signin-faculty-cont">
                <form action="" method="post">
                    <div class="title-block">
                        <img src="../img/cmpe_logo.jpg">
                        <p class="form-title-block">Faculty</p>
                        <span>commodo quis imperdiet massa tincidunt nunc pulvinar sapien et</span>
                    </div>
                    <div class="login-form">
                        <input class="input-form" type="email" id="signin_faculty_webmail" name="signin_faculty_webmail" placeholder="PUP webmail" required/>
                        <input class="input-form" type="password" id="signin_faculty_pass" name="signin_faculty_pass" placeholder="Password" required/>
                        <button type="submit" class="submit-button" name="faculty_signin" >Submit</button>
                        <button onclick="FacultySignUp()" class="sign-button">Sign Up Here</button>
                    </div>
                </form>
            </div>
            
            <!-- SIGN UP -->
            <!-- Faculty -->
                
            <div class="sign-cont" id="signup-faculty-cont">
                <form action="" method="post">
                    <div class="title-block">
                        <img src="../img/cmpe_logo.jpg">
                        <p class="form-title-block">Faculty</p>
                        <span>commodo quis imperdiet massa tincidunt nunc pulvinar sapien et</span>
                    </div>
                    <div class="login-form">
                        <input class="input-form" type="text" id="signup_faculty_id" name="signup_faculty_id" placeholder="Faculty ID number" required/>
                        <input class="input-form" type="email" id="signup_faculty_webmail" name="signup_faculty_webmail" placeholder="PUP webmail" required/>
                        <input class="input-form" type="password" id="signup_faculty_pass" name="signup_faculty_pass" placeholder="Password" required/>
                        <button type="submit" class="submit-button" name="faculty_signup">Submit</button>
                        <button onclick="FacultySignIn()" class="sign-button">Sign In Here</button>
                    </div>
                </form>
            </div>
            

<!-- REASON FOR REMOVING THIS IS FOR SECURITY PURPOSES. ADMIN SHOULD BE SEPARATED FROM USERS. -->

            <!-- SIGN IN -->
            <!-- Admin -->
            
            <!-- <div class="sign-cont" id="signin-admin-cont">
                <form action="" method="post">
                    <div class="title-block">
                        <img src="../img/cmpe_logo.jpg">
                        <p class="form-title-block">Administrator</p>
                        <span>commodo quis imperdiet massa tincidunt nunc pulvinar sapien et</span>
                    </div>
                    <div class="login-form">
                        <input class="input-form" type="email" id="signin_admin_webmail" name="signin_admin_webmail" placeholder="PUP webmail" required/>
                        <input class="input-form" type="password" id="signin_admin_pass" name="signin_admin_pass" placeholder="Password" required/>
                        <button type="submit" class="submit-button" name="admin_signin">Submit</button>
                        <button onclick="AdminSignUp()" class="sign-button">Sign Up Here</button>
                    </div>
                </form>
            </div>
            
             SIGN UP Admin                 

            <div class="sign-cont" id="signup-admin-cont">
                <form action="" method="post">
                    <div class="title-block">
                        <img src="../img/cmpe_logo.jpg">
                        <p class="form-title-block">Administrator</p>
                        <span>commodo quis imperdiet massa tincidunt nunc pulvinar sapien et</span>
                    </div>
                    <div class="login-form">
                        <input class="input-form" type="email" id="signup_admin_webmail" name="signup_admin_webmail" placeholder="PUP webmail" required/>
                        <input class="input-form" type="password" id="signup_admin_pass" name="signup_admin_pass" placeholder="Password" required/>
                        <button type="submit" class="submit-button" name="admin_signup">Submit</button>
                        <button onclick="AdminSignIn()" class="sign-button">Sign In Here</button>
                    </div>
                </form>
            </div>
             --> 

        </div>

        </div>

    </div>


</body>

</html>
<script src="../javascript/index.js">
    

</script>