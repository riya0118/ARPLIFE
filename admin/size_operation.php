<?php
require("../config/dbconnect.php");
if(isset($_POST['size_editbtn'])){
    $sizeid= $_POST['sizeid'] ;
    $newstatus= $_POST['status'];
    $editsize="UPDATE al_productsize SET ps_isactive=$newstatus WHERE ps_sizeid=$sizeid ";

    if(mysqli_query($conn,$editsize)){
        header("location:size.php");
    }
}
?>