
let sistudent = document.getElementById('signin-sr-cont');
let sifaculty = document.getElementById('signin-faculty-cont');
let siadmin = document.getElementById('signin-admin-cont');
let sustudent = document.getElementById('signup-sr-cont');
let sufaculty = document.getElementById('signup-faculty-cont');
let suadmin = document.getElementById('signup-admin-cont');
let option = document.getElementById('option-block');


function StudentResearcher(){
    sistudent.style.display = "block";    
    option.style.display = "none";
}
function Faculty(){
    sifaculty.style.display = "block";    
    option.style.display = "none";
}
function Admin(){
    siadmin.style.display = "block";    
    option.style.display = "none";
}

function StudentSignIn(){
    sistudent.style.display = "block";    
    sustudent.style.display = "none";
}
function FacultySignIn(){
    sifaculty.style.display = "block";    
    sufaculty.style.display = "none";
}

function AdminSignIn(){
    siadmin.style.display = "block";    
    suadmin.style.display = "none";
}

function StudentSignUp(){
    sustudent.style.display = "block";    
    sistudent.style.display = "none";
}
function FacultySignUp(){
    sufaculty.style.display = "block";    
    sifaculty.style.display = "none";
}

function AdminSignUp(){
    suadmin.style.display = "block";    
    siadmin.style.display = "none";
}
// function StudentSubmit(){
//     window.location.href = 'student_MOR_4.php';
// }