<?php
session_start();
require("config/dbconnect.php");
if (isset($_SESSION['profileview']) && $_SESSION['profileview'] == 0) {
    header("location:index.php");
}
if (isset($_POST['updatebtn'])) {
    $addr = $pin = $addtype = $country = $state = $city = '';
    $addressid = $_POST['addressid'];
    $customerid = $_POST['customerid'];
    $addr = $_POST['addr'];
    $pin = $_POST['pin'];
    $addtype = $_POST['addtype'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];

    $editaddr = "UPDATE al_addresses SET addr_stateid=$state,addr_cityid=$city,addr_countryid=$country,addr_customerid=$customerid ,addr_address='$addr' ,addr_pincode=$pin, addr_addresstype='$addtype' WHERE addr_addressid=$addressid";
    $res = mysqli_query($conn, $editaddr);
    if ($res) {
        header("location:address.php?customid=$customerid");
    }
}
