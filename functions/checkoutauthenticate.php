<?php
session_start();
if (isset($_POST['addaddress'])) {

    $subtotal = '';
    $gst = '';
    $customerid = ((isset($_POST['customerid'])) ? $_POST['customerid'] : '' );
    $subtotal = ((isset($_POST['subtotal'])) ? $_POST['subtotal'] : '');
    $gst = ((isset($_POST['gst'])) ? $_POST['gst'] : '');

    

    header("location:../checkout.php?subtotal=$subtotal&gst=$gst&customerid=$customerid");
} else if (isset($_SESSION['customerid']) && $_SESSION['customerid'] != '') {
    $subtotal = '';
    $gst = '';
    $customerid = '';
    $subtotal = ((isset($_GET['subtotal'])) ? $_GET['subtotal'] : '');
    $gst = ((isset($_GET['gst'])) ? $_GET['gst'] : '');
    $customerid = ((isset($_SESSION['customerid'])) ? $_SESSION['customerid'] : '');

    header("location:../billingdetails.php?subtotal=$subtotal&gst=$gst&customerid=$customerid");
} else {
    header("location:../login.php");
}
