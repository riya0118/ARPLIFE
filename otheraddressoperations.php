<?php
require("config/dbconnect.php");
session_start();
if (isset($_SESSION['profileview']) && $_SESSION['profileview'] == 0) {
    header("location:index.php");
}else{
    session_abort();
}
if (isset($_POST['deletebtn'])) {
    $addid = $_POST['addressid'];
    $custid=$_POST['customerid'];
    $deleqry = "DELETE from al_addresses where addr_addressid=$addid";
    $deleteresult = mysqli_query($conn, $deleqry);
    if ($deleteresult == 1) {
            header("location:address.php?customerid=$custid");
    }
    else
    {
        echo "fail";
    }
}else if(isset($_POST['setbtn'])){
    $addressid = $_POST['addressid'];
    $customerid=$_POST['customerid'];

    //CHECK DEFAULT
    $checkdefaultquery="UPDATE al_addresses SET addr_inuse=0 WHERE addr_customerid=$customerid";
    $checkdefaultresult=mysqli_query($conn,$checkdefaultquery);
    
    //SET DEFAULT
    $setdefaultquery="UPDATE al_addresses SET addr_inuse=1 WHERE addr_addressid=$addressid AND addr_customerid=$customerid";
    $setdefaultresult=mysqli_query($conn,$setdefaultquery);
    if($setdefaultresult){
        header("location:address.php?customerid=$customerid");
    }
}
