<?php

require("../config/dbconnect.php");
if(isset($_POST['subcategoryeditbtn'])){
    $subcatid=$_POST['subcategoryid'];
    $category=$_POST['categories'];
    $gender=$_POST['gender'];
    $newsubcategory=$_POST['subcategoryname'];
    $newdesc=$_POST['subcat_description'];
    $newstatus=$_POST['status'];
    $editsubcategory="UPDATE al_subcategory SET sc_categoryid=$category, sc_subcategoryname='$newsubcategory' , sc_gender='$gender' , sc_description='$newdesc', sc_isactive=$newstatus WHERE sc_subcategoryid=$subcatid ";
    
    if(mysqli_query($conn,$editsubcategory)){
        header("location:subcategories.php");
    }
}
else if(isset($_POST["subcategoryaddbtn"])){
    session_start();
    $getsubcategorynames = array();
    $getsubcategorynamequery = "SELECT * FROM al_subcategory";
    $subcatresult = mysqli_query($conn, $getsubcategorynamequery);
    if (mysqli_num_rows($subcatresult) > 0) {
        while ($getdata = mysqli_fetch_array($subcatresult)) {
            array_push($getsubcategorynames, $getdata['sc_subcategoryname']);
        }
    }
    $category=$_POST['categories'];
    $subcategory=$_POST['subcategoryname'];
    $gender=$_POST['gender'];
    $desc=$_POST['subcat_description'];
    $status=$_POST['status'];
    $flag=0;
    foreach($getsubcategorynames as $subcatnames){
        if($subcatnames==$subcategory){
            $_SESSION['msg']='subcategory already exists';
            $flag=1;
            header("location:managesubcategories.php");
        }
    }
    if($flag==0){
        $addcat_query="insert into al_subcategory(sc_categoryid , sc_subcategoryname , sc_gender , sc_description , sc_isactive) values($category , '$subcategory', '$gender' ,'$desc' , $status)";
        $res=mysqli_query($conn,$addcat_query);
        header("location:subcategories.php");
    }
   
}
else if(isset($_POST['action_method']) && $_POST['action_method'] == 'delete_subcategory'){
    $is_deleted=0;
    $subcategoryIds=$_POST['subcategoryid'];
    if(!empty($subcategoryIds)){
        foreach($subcategoryIds as $subcat_id){
            $delete_subcat="delete from al_subcategory where sc_subcategoryid=$subcat_id";
            if(mysqli_query($conn,$delete_subcat)){
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
