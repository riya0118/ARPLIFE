<?php
session_start();
require("config/dbconnect.php");
if (isset($_SESSION['profileview']) && $_SESSION['profileview'] == 0) {
    header("location:index.php");
}
if(isset($_POST['addbtn'])){
$addr = $pin = $addtype = $country = $state = $city = '';
$addressid = $_POST['addressid'];
$customerid = $_POST['customerid'];
    $addr = $_POST['addr'];
    $pin = $_POST['pin'];
    $addtype = $_POST['addtype'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    
$addaddr = "insert into al_addresses(addr_stateid,addr_cityid,addr_countryid,addr_customerid,addr_address,addr_pincode,addr_addresstype) values( $state , $city , $country , $customerid , '$addr' , $pin , '$addtype')"; 
$res = mysqli_query($conn, $addaddr);
if ($res) {
   header("location:address.php?customerid=$customerid");
}
else
{
    
}
}