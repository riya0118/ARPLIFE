<?php
session_start();
require("../config/dbconnect.php");
if (isset($_POST['attribute_editbtn'])) {
    $newpaid = (($_POST['productattributeid'] != '') ? $_POST['productattributeid'] : '');
    $newproductid = (($_POST['productid'] != '') ? $_POST['productid'] : '');
    $newattribute = (($_POST['attributename'] != '') ? $_POST['attributename'] : '');
    $newattributevalue = (($_POST['attributevalue'] != '') ? $_POST['attributevalue'] : '');

    $editattribute = "UPDATE al_productattribute SET pa_productid=$newproductid , pa_attributeid = $newattribute, pa_value= '$newattributevalue'  WHERE pa_productattributeid=$newpaid ";

    if (mysqli_query($conn, $editattribute)) {
        header("location:attributes.php");
    }
} else if (isset($_POST["attribute_addbtn"])) {
    session_start();

    $attribute = $_POST['attributename'];
    $value = $_POST['attributevalue'];
    $productid = $_POST['productid'];
    $flag = 0;
    $getattributenames = array();
    $getattributenamequery = "SELECT * FROM al_productattribute where pa_productid=$productid";
    $attributeresult = mysqli_query($conn, $getattributenamequery);
    if (mysqli_num_rows($attributeresult) > 0) {
        while ($getdata = mysqli_fetch_array($attributeresult)) {
            array_push($getattributenames, $getdata['pa_attributeid']);
        }
    }

    foreach ($getattributenames as $attributenames) {
        if ($attributenames == $attribute) {
            $_SESSION['msg'] = 'attribute already exists';
            $flag = 1;
            header("location:manage_attributes.php");
        }
    }
    if ($flag == 0) {
        $addattribute_query = "insert into al_productattribute(pa_productid, pa_attributeid, pa_value) values($productid, $attribute, '$value')";
        $res = mysqli_query($conn, $addattribute_query);
        header("location:attributes.php");
    }
} else if (isset($_POST['action_method']) && $_POST['action_method'] == 'delete_attribute') {
    $is_deleted = 0;
    $attributeIds = $_POST['productattributeid'];
    if (!empty($attributeIds)) {
        foreach ($attributeIds as $attribute_id) {
            $delete_attribute = "delete from al_productattribute where pa_productattributeid=$attribute_id";
            if (mysqli_query($conn, $delete_attribute)) {
                $is_deleted = 1;
            } else {
                $is_deleted = 0;
                return false;
            }
        }
        if ($is_deleted == 1) {
            echo "success";
        } else {
            echo "fail";
        }
    }
}
