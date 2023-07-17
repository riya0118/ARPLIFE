<?php

require("../config/dbconnect.php");
if(isset($_POST['editcategoriesbtn'])){
    $catid=$_POST['categoryid'];
    $newcategory=$_POST['categoryname'];
    $newdesc=$_POST['category_description'];
    $newstatus=$_POST['status'];
    $editcategory="UPDATE category_master SET catm_categoryname='$newcategory', catm_description='$newdesc', catm_isactive=$newstatus WHERE catm_categoryid=$catid ";
    
    if(mysqli_query($conn,$editcategory)){
        header("location:categories.php");
    }
}
else if(isset($_POST["addcategoriesbtn"])){
    session_start();
    $getcategorynames = array();
    $getcategorynamequery = "SELECT * FROM category_master";
    $catresult = mysqli_query($conn, $getcategorynamequery);
    if (mysqli_num_rows($catresult) > 0) {
        while ($getdata = mysqli_fetch_array($catresult)) {
            array_push($getcategorynames, $getdata['catm_categoryname']);
        }
    }
    $category=$_POST['categoryname'];
    $desc=$_POST['category_description'];
    $status=$_POST['status'];
    $flag=0;
    foreach($getcategorynames as $catnames){
        if($catnames==$category){
            $_SESSION['msg']='category already exists';
            $flag=1;
            header("location:manage_categories.php");
        }
    }
    if($flag==0){
        $addcat_query="insert into category_master(catm_categoryname , catm_description , catm_isactive) values('$category' , '$desc' , $status)";
        $res=mysqli_query($conn,$addcat_query);
        header("location:categories.php");
    }
        
}
else if(isset($_POST['action_method']) && $_POST['action_method'] == 'delete_category'){
    $is_deleted=0;
    $categoryIds=$_POST['categoryid'];
    if(!empty($categoryIds)){
        foreach($categoryIds as $cat_id){
            $delete_cat="delete from category_master where catm_categoryid=$cat_id";
            if(mysqli_query($conn,$delete_cat)){
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
