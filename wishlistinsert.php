<?php
require("config/dbconnect.php");
session_start();
if ((isset($_POST['mode']) && $_POST['mode'] == 'insert')) {
    $customerid = ((isset($_POST['customerid'])) ? $_POST['customerid'] : '');
    $productid = ((isset($_POST['productid'])) ? $_POST['productid'] : '');
    if ($customerid != '' && $productid != '') {
        $wishlistinsertion = "INSERT into al_wishlist(wl_customerid,wl_productid) values($customerid,$productid)";
        $insertionresult = mysqli_query($conn, $wishlistinsertion);
        if ($insertionresult == 1) {

            echo "success";
        } else {
            echo "failed";
        }
    }
}
if (isset($_POST['mode']) && $_POST['mode'] == 'delete') {
    $wishlistid = ((isset($_POST['wishlistid'])) ? $_POST['wishlistid'] : '');
    $wishlistdeletion = "DELETE FROM al_wishlist where wl_wishlistid=$wishlistid";
    $deletionresult = mysqli_query($conn, $wishlistdeletion);
    if ($deletionresult == 1) {

        echo "success";
    } else {
        echo "failed";
    }
}

if (isset($_POST['mode']) && $_POST['mode'] == 'move') {
    $flag = 0;
    $customerid = ((isset($_POST['customerid'])) ? $_POST['customerid'] : '');
    $productid = ((isset($_POST['productid'])) ? $_POST['productid'] : '');
    $quantity = ((isset($_POST['quantity'])) ? $_POST['quantity'] : '');
    $wishlistid = ((isset($_POST['wishlistid'])) ? $_POST['wishlistid'] : '');
    $checkproduct = "SELECT * from al_cart where crt_productid=$productid and crt_customerid=$customerid";
    $productresult = mysqli_query($conn, $checkproduct);
    if ($productresult) {
        $checkrowcount = mysqli_num_rows($productresult);
        if ($checkrowcount > 0) {
            $flag = 1;
        }
    }
    if ($flag == 0) {
        $movetocartquery = "INSERT into al_cart(crt_customerid,crt_productid,crt_quantity) values($customerid,$productid,$quantity)";
        $moveresult = mysqli_query($conn, $movetocartquery);
    }
    $wishlistdeletion = "DELETE FROM al_wishlist where wl_wishlistid=$wishlistid";
    $deletionresult = mysqli_query($conn, $wishlistdeletion);
    if ($deletionresult == 1 && $flag == 0) {
        $flag = 0;
        echo "success";
    } else if ($checkrowcount > 0 && $flag == 1) {
        echo "exists";
    } else {
        echo "failed";
    }
}
