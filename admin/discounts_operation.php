<?php

require("../config/dbconnect.php");
if(isset($_POST['discount_editbtn'])){
    $discountid=$_POST['discountid'];
    $newdiscount=$_POST['discountname'];
    $discountpercent=$_POST['discountpercentage'];
    $newstatus=$_POST['status'];
    $editdiscount="UPDATE discount_master SET dm_discountname='$newdiscount',dm_discountpercent=$discountpercent, dm_isactive=$newstatus WHERE dm_discountid=$discountid ";
    
    if(mysqli_query($conn,$editdiscount)){
        header("location:productdiscounts.php");
    }
}
else if(isset($_POST["discount_addbtn"])){
    session_start();
    $getdiscountnames = array();
    $getdiscountnamequery = "SELECT * FROM discount_master";
    
    $discountresult = mysqli_query($conn, $getdiscountnamequery);
    if (mysqli_num_rows($discountresult) > 0) {
        while ($getdata = mysqli_fetch_array($discountresult)) {
            array_push($getdiscountnames, $getdata['dm_discountname']);
        }
    }
        $discount=$_POST['discountname'];
        $discountpercent=$_POST['discountpercentage'];
        $status=$_POST['status'];
        $flag=0;
        foreach($getdiscountnames as $discountnames){
            if($discountnames==$discount){
                $_SESSION['msg']='Discount already exists';
                $flag=1;
                header("location:manage_productdiscounts.php");
            }
        }
        if($flag==0){
            $adddiscount_query="insert into discount_master(dm_discountname ,dm_discountpercent, dm_isactive) values('$discount' ,$discountpercent, $status)";
            $res=mysqli_query($conn,$adddiscount_query);
            header("location:productdiscounts.php");
        }
        
}
else if(isset($_POST['action_method']) && $_POST['action_method'] == 'delete_discount'){
    $is_deleted=0;
    $discountIds=$_POST['discountid'];
    if(!empty($discountIds)){
        foreach($discountIds as $discount_id){
            $delete_discount="delete from discount_master where dm_discountid=$discount_id";
            if(mysqli_query($conn,$delete_discount)){
                $is_deleted=1;
            }
            else{
                $is_deleted=0;
                return false;
            }
        }
        if($is_deleted==1){
            echo "success";
        }
        else{
            echo "fail";
        }
    }
}
