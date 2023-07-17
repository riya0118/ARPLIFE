<?php
    session_start();
require("../config/dbconnect.php");
if(isset($_POST['brand_editbtn'])){
    $brandid= strtolower($_POST['brandid']) ;
    $newcategory= strtolower($_POST['brand_category']) ;
    $newbrand= strtolower($_POST['brandname']) ;
    $gender=$_POST['gender'];
    $newstatus= strtolower($_POST['status']);
    $editbrand="UPDATE brand_master SET bm_brandname='$newbrand', bm_categoryid=$newcategory , bm_gender='$gender', bm_isactive=$newstatus WHERE bm_brandid=$brandid ";

    if(mysqli_query($conn,$editbrand)){
        header("location:brands.php");
    }
}
else if(isset($_POST["brand_addbtn"])){
    $getbrandnames = array();
    $getbrandnamequery = "SELECT * FROM brand_master";
    $brandresult = mysqli_query($conn, $getbrandnamequery);
    if (mysqli_num_rows($brandresult) > 0) {
        while ($getdata = mysqli_fetch_array($brandresult)) {
            array_push($getbrandnames, $getdata['bm_brandname']);
        }
    }
        $category=strtolower( $_POST['brand_category']);
        $brand=strtolower($_POST['brandname']) ;
        $gender=$_POST['gender'];
        $status= strtolower($_POST['status']) ;
        $flag=0;
        if($flag==0){
            $addbrand_query="insert into brand_master(bm_brandname , bm_categoryid , bm_isactive,bm_gender) values('$brand' , $category , $status, '$gender')";
            $res=mysqli_query($conn,$addbrand_query);
            header("location:brands.php");
        }
        
}

else if(isset($_POST['action_method']) && $_POST['action_method'] == 'delete_brand'){
    $is_deleted=0;
    $brandIds=$_POST['brandid'];
    if(!empty($brandIds)){
        foreach($brandIds as $brand_id){
            $delete_brand="delete from brand_master where bm_brandid=$brand_id";
            if(mysqli_query($conn,$delete_brand)){
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
