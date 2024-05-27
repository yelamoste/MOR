function profileDropDown() {
    let dropdown = document.getElementById("profile-dropdown-cont");
    //  dropdown.style.display = "block";
    if (dropdown.style.display === "none") {
        dropdown.style.display = "block";
    } else {
        dropdown.style.display = "none";
    }
    console.log(1);
}
let zoomd = document.getElementById('zoom-dir');

// for student_MOR_8 pdfzoom
function PopUp() {

    zoomd.style.display = "block";
}
function PopUpExit(){
    zoomd.style.display = "none";
}