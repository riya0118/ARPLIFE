<?php
require("config/dbconnect.php");
session_start();
if ((isset($_POST['productid']) && $_POST['productid'] != '') && (isset($_POST['customerid']) && $_POST['customerid'] != '') && $_POST['mode'] == 'insert') {
    $productid = mysqli_real_escape_string($conn, $_POST['productid']);
    $customerid = mysqli_real_escape_string($conn, $_POST['customerid']);
    $cartinsertquery = "INSERT into al_cart(crt_customerid,crt_productid) values($customerid,$productid) ";
    $cartresult = mysqli_query($conn, $cartinsertquery);
    if ($cartresult) {
        $getcartqtyquery = "SELECT * from al_cart where crt_customerid=$customerid";
        $qtyresult = mysqli_query($conn, $getcartqtyquery);
        if ($qtyresult) {
            if (mysqli_num_rows($qtyresult) > 0) {
                $getquantity = mysqli_num_rows($qtyresult);
                echo $getquantity;
                // $_SESSION['reloadheader']=1;
                // header("location:mainincludes/header.php");
            }
        }
    } else {
        echo "Process Failed !";
    }
} else if ($_POST['mode'] == 'delete' && (isset($_POST['cartid']) && $_POST['cartid'] != '')) {
    $deletefromcart = "DELETE from al_cart where crt_cartid=" . $_POST['cartid'];
    $deleteresult = mysqli_query($conn, $deletefromcart);
    if ($deleteresult == 1) {
        echo "success";
    } else {
        echo "failed";
    }
} else if ($_POST['mode'] == 'updatequantity' && (isset($_POST['cartid']) && $_POST['cartid'] != '') && (isset($_POST['productquantity']) && $_POST['productquantity'] != '')) {
    $getquantity=$_POST['productquantity'];
    $cartid=$_POST['cartid'];
    $updatequantityquery="UPDATE al_cart set crt_quantity=$getquantity where crt_cartid=$cartid ";
    $updateresult=mysqli_query($conn,$updatequantityquery);
    
}
