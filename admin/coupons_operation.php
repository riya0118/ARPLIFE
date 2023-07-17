<?php

require("../config/dbconnect.php");
if(isset($_POST['coupon_editbtn'])){
    $couponid=$_POST['couponid'];
    $newcouponcode=$_POST['couponcode'];
    $newdiscount=$_POST['discount'];
    $newminamount=$_POST['minamount'];
    $newmaxamount=$_POST['maxamount'];
    $newstartsat=$_POST['startsat'];
    $newendsat=$_POST['endsat'];

    $editcoupon="UPDATE coupons_master SET cpn_couponcode='$newcouponcode', cpn_allotteddiscount=$newdiscount,cpn_minamount=$newminamount,cpn_maxamount=$newmaxamount,starts_at='$newstartsat',ends_at='$newendsat' WHERE cpn_couponid=$couponid ";
    
    if(mysqli_query($conn,$editcoupon)){
        header("location:coupons.php");
    }
}
else if(isset($_POST["coupon_addbtn"])){
    session_start();
    $getcouponcode = array();
    $getcouponcodequery = "SELECT * FROM coupons_master";
    $couponresult = mysqli_query($conn, $getcouponcodequery);
    if (mysqli_num_rows($couponresult) > 0) {
        while ($getdata = mysqli_fetch_array($couponresult)) {
            array_push($getcouponcode, $getdata['cpn_couponcode']);
        }
    }
        $addcouponcode=$_POST['couponcode'];
        $adddiscount=$_POST['discount'];
        $addminamount=$_POST['minamount'];
        $addmaxamount=$_POST['maxamount'];
        $addstartsat=$_POST['startsat'];
        $addendsat=$_POST['endsat'];

        $flag=0;
        foreach($getcouponcode as $couponcode){
            if($addcouponcode==$couponcode){
                $_SESSION['msg']='coupon already exists';
                $flag=1;
                header("location:manage_coupons.php");
            }
        }
        if($flag==0){
            $addcoupon_query="insert into coupons_master( cpn_couponcode, cpn_allotteddiscount,cpn_minamount,cpn_maxamount,starts_at,ends_at) values('$addcouponcode', $adddiscount ,$addminamount, $addmaxamount,'$addstartsat' ,' $addendsat')";
            $res=mysqli_query($conn,$addcoupon_query);
            header("location:coupons.php");
        }
        
}
else if(isset($_POST['action_method']) && $_POST['action_method'] == 'delete_coupon'){
    $is_deleted=0;
    $dcouponid=$_POST['couponid'];
    if(!empty($dcouponid)){
        foreach($dcouponid as $coupon_id){
            $delete_coupon="delete from coupons_master where cpn_couponid=$coupon_id";
            if(mysqli_query($conn,$delete_coupon)){
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
