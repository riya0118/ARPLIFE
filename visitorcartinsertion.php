<?php
require("config/dbconnect.php");
session_start();
$visitorid = session_id();
if ((isset($_POST['productid']) && $_POST['productid'] != '') && $_POST['mode'] == 'insert') {
    $productid = mysqli_real_escape_string($conn, $_POST['productid']);
    $cartinsertquery = "INSERT into al_visitorcart(vc_visitorid,vc_productid) values('$visitorid',$productid) ";
    $cartresult = mysqli_query($conn, $cartinsertquery);
    if ($cartresult) {
        $getcartqtyquery = "SELECT * from al_visitorcart where vc_visitorid='$visitorid'";
        $qtyresult = mysqli_query($conn, $getcartqtyquery);
        if ($qtyresult) {
            if (mysqli_num_rows($qtyresult) > 0) {
                $getquantity = mysqli_num_rows($qtyresult);
                echo $getquantity;
            }
        }
    } else {
        echo "Process Failed !";
    }
} else if ($_POST['mode'] == 'delete' && (isset($_POST['cartid']) && $_POST['cartid'] != '')) {
    $deletefromcart = "DELETE from al_visitorcart where vc_cartid=" . $_POST['cartid'];
    $deleteresult = mysqli_query($conn, $deletefromcart);
    if ($deleteresult == 1) {
        echo "success";
    } else {
        echo "failed";
    }
} else if ($_POST['mode'] == 'updatequantity' && (isset($_POST['cartid']) && $_POST['cartid'] != '') && (isset($_POST['productquantity']) && $_POST['productquantity'] != '')) {
    $getquantity = $_POST['productquantity'];
    $cartid = $_POST['cartid'];
    $updatequantityquery = "UPDATE al_visitorcart set vc_quantity=$getquantity where vc_cartid=$cartid ";
    $updateresult = mysqli_query($conn, $updatequantityquery);
}
