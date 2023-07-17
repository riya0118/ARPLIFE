<?php
require("../config/dbconnect.php");
if(isset($_POST['orders_editbtn'])){
    $orderid= $_POST['orderid'] ;
    $newstatus= $_POST['orderstatus'];
    $editorder="UPDATE al_customerorder SET co_orderstatusid=$newstatus WHERE co_orderid=$orderid ";

    if(mysqli_query($conn,$editorder)){
        header("location:orders.php");
    }
}
?>