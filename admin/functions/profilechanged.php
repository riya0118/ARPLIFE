<?php
session_start();
require("../includes/constants.php");   
require("../../config/dbconnect.php");
$getadminid = $_SESSION['admin_id'];
if (isset($_POST['modal1_savebtn'])) {  
    $filetmp_path = $_FILES['profile_image']['tmp_name'];
    $dest_path = "../images/user/" . $_FILES['profile_image']['name'];
    $profileimagename = $_FILES['profile_image']['name'];
    if (move_uploaded_file($filetmp_path, $dest_path)) {
        echo "file uploaded successfully";
    } else {
        echo "upload failed";
    }
    $newadminname = $_POST['adminname'];

    $editqry = "update admin_master set am_adminname='$newadminname', am_profileimage='$profileimagename' where am_adminid=$getadminid";
    mysqli_query($conn, $editqry);
     header("location:../adminprofile.php");
} elseif (isset($_POST['modal2_savebtn'])) {
    $newdesc = $_POST['desc'];
    $newmobile = $_POST['mobile'];
    $newemail = $_POST['email'];
    $newdob = $_POST['dob'];

    $editmeqry = "update admin_master set am_description='$newdesc', am_mobile='$newmobile', am_email='$newemail', am_dob='$newdob' where am_adminid=$getadminid";
    // if(mysqli_query($conn, $editqry)){
    //     include(INCLUDESCOMP_DIR . "preloader.php");
    // }
    if(mysqli_query($conn, $editmeqry)){
        header("location:../adminprofile.php");
    }
} elseif (isset($_POST['modal3_savebtn'])) {
    $newaddress = $_POST['address'];
    $newpincode = $_POST['pincode'];
    // $newcountry = $_POST['countrydropdown'];
    // $newstate = $_POST['statetdropdown'];
    // $newcity = $_POST['citydropdown'];

    $editaddqry = "update admin_master set am_address='$newaddress', am_pincode=$newpincode where am_adminid=$getadminid";
    // , am_countryid=$newcountry, am_stateid=$newstate, am_cityid=$newcity
    // if(mysqli_query($conn, $editaddqry)){
    //     include(INCLUDESCOMP_DIR . "preloader.php");
    // }
    if(mysqli_query($conn, $editaddqry)){
        header("location:../adminprofile.php");
    }
}
