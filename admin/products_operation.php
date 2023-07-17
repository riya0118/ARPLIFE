<?php
require("../config/dbconnect.php");
function reArrayFiles($file_post)
{
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);
    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}


if (isset($_POST["product_addbtn"])) {
    session_start();
    $getproductnames = array();
    $getproductquery = "SELECT * FROM product_master";

    $productresult = mysqli_query($conn, $getproductquery);
    if (mysqli_num_rows($productresult) > 0) {
        while ($getdata = mysqli_fetch_array($productresult)) {
            array_push($getproductnames, $getdata['pm_productname']);
        }
    }
    $product = $_POST['product_name'];
    $flag = 0;
    foreach ($getproductnames as $productnames) {
        if ($productnames == $product) {
            $_SESSION['msg'] = 'product already exists';
            $flag = 1;
            header("location:manage_products.php");
        }
    }
    if ($flag == 0) {
        $category = $_POST['product_category'];
        $subcategory = $_POST['product_subcategory'];
        $brand = $_POST['product_brand'];
        $productname = $_POST['product_name'];
        $description = $_POST['product_description'];
        $price = $_POST['product_price'];
        $discount = $_POST['product_discount'];
        $stock = $_POST['product_stock'];
        $gender = $_POST['product_gender'];
        $status = $_POST['product_status'];
        $filetmp_path = $_FILES['product_image']['tmp_name'];
        $dest_path = "images/uploads/" . $_FILES['product_image']['name'];
        $imagename = $_FILES['product_image']['name'];
        move_uploaded_file($filetmp_path, $dest_path);
        if ($discount == '') {
            $addproduct_query = "insert into product_master(pm_categoryid , pm_subcategoryid , pm_brandid , pm_productname , pm_description , pm_price , pm_stock , pm_image , pm_type , pm_isactive)values($category , $subcategory , '$brand' , '$productname' , '$description' ,  $price , $stock ,'$imagename', '$gender' , $status)";
        } else {
            $addproduct_query = "insert into product_master(pm_categoryid , pm_subcategoryid , pm_brandid , pm_productname , pm_description , pm_price , pm_discountid , pm_stock , pm_image , pm_type , pm_isactive)values($category , $subcategory , '$brand' , '$productname' , '$description' ,  $price , $discount , $stock ,'$imagename', '$gender' , $status)";
        }
        $res = mysqli_query($conn, $addproduct_query);
        if ($res) {
            $lastproductquery = " SELECT * from product_master order by pm_productid desc limit 1;";
            $reslastproduct = mysqli_query($conn, $lastproductquery);
            if (mysqli_num_rows($reslastproduct) > 0) {
                $getdata = mysqli_fetch_array($reslastproduct);
                $getlastproductid = $getdata['pm_productid'];
            }
        }

        if (isset($_POST['product_sizes']) && $_POST['product_sizes'] != '' && isset($_FILES['product_additionalimages'])) {
            $sizes = $_POST['product_sizes'];
            foreach ($sizes as $size) {
                $insertsizequery = "insert into al_productsize(ps_productid , ps_size) values($getlastproductid,'$size')";
                $sizeresult = mysqli_query($conn, $insertsizequery);
            }
            if (isset($_POST['product_colors']) && $_POST['product_colors'] != '' && isset($_FILES['product_additionalimages'])) {
                $colors = $_POST['product_colors'];
                foreach ($colors as $color) {
                    $insertcolorquery = "insert into al_productcolor(pc_productid ,pc_colorname) values($getlastproductid,'$color')";
                    $colorresult = mysqli_query($conn, $insertcolorquery);
                }
            }
            $file_array = reArrayFiles($_FILES['product_additionalimages']);
            for ($i = 0; $i < count($file_array); $i++) {
                move_uploaded_file($file_array[$i]['tmp_name'], "images/uploads/" . $file_array[$i]['name']);
                $imagename = $file_array[$i]['name'];
                $addmoreimagesquery = "insert into al_productimages(pi_productid , pi_imagename) values($getlastproductid,'$imagename')";
                $imageres = mysqli_query($conn, $addmoreimagesquery);
            }
            if ($sizeresult) {
                if ($imageres) {
                    header("location:products.php");
                }
            }
        } else {
            header("location:manage_products.php");
        }
    }
}  //EDIT BTN
else if (isset($_POST['product_editbtn'])) {
    $productid = (($_POST['productid'] != '') ? $_POST['productid'] : '');
    $product_category = (($_POST['product_category'] != '') ? $_POST['product_category'] : '');
    $product_subcategory = (($_POST['product_subcategory'] != '') ? $_POST['product_subcategory'] : '');
    $product_brand = (($_POST['product_brand'] != '') ? $_POST['product_brand'] : '');
    $product_name = (($_POST['product_name'] != '') ? $_POST['product_name'] : '');
    $product_description = (($_POST['product_description'] != '') ? $_POST['product_description'] : '');
    $product_price = (($_POST['product_price'] != '') ? $_POST['product_price'] : '');
    $product_discount = (($_POST['product_discount'] != '') ? $_POST['product_discount'] : '');
    $product_stock = (($_POST['product_stock'] != '') ? $_POST['product_stock'] : '');
    $product_type = (($_POST['product_gender'] != '') ? $_POST['product_gender'] : '');
    $product_status = (($_POST['product_status'] != '') ? $_POST['product_status'] : '');
    $imagename = $_FILES['product_image']['name'];
    if ($imagename != '') {
        $filetmp_path = $_FILES['product_image']['tmp_name'];
        $dest_path = "images/uploads/" . $_FILES['product_image']['name'];
        move_uploaded_file($filetmp_path, $dest_path);
    } else {
        $getcurrentimage = "SELECT pm_image from product_master where pm_productid=$productid";
        $imgres = mysqli_query($conn, $getcurrentimage);
        if (mysqli_num_rows($imgres) > 0) {
            $getimage = mysqli_fetch_array($imgres);
            $currentimage = $getimage['pm_image'];
            if ($imagename == '') {
                $imagename = $currentimage;
            }
        }
    }

    if ($product_discount != '') {
        $editproductquery = "UPDATE product_master set pm_categoryid=$product_category , pm_subcategoryid=$product_subcategory , pm_brandid=$product_brand , pm_productname='$product_name' , pm_description='$product_description', pm_price=$product_price , pm_discountid=$product_discount , pm_stock=$product_stock , pm_image='$imagename' , pm_type='$product_type' , pm_isactive=$product_status where pm_productid=$productid ";
    } else {
        $editproductquery = "UPDATE product_master set pm_categoryid=$product_category , pm_subcategoryid=$product_subcategory , pm_brandid=$product_brand , pm_productname='$product_name' , pm_description='$product_description' , pm_price=$product_price , pm_stock=$product_stock , pm_image='$imagename' , pm_type='$product_type' , pm_isactive=$product_status where pm_productid=$productid ";
    }
    //IF PRODUCT EDIT IS SUCCESS THEN EDIT SIZE , COLOR AND IMAGES
    if (mysqli_query($conn, $editproductquery)) {

        if (isset($_POST['product_sizes']) && $_POST['product_sizes'] != '' && isset($_FILES['product_additionalimages'])) {
            $deletecurrentsizes = "DELETE FROM al_productsize where ps_productid=$productid";
            $deletecurrentimages = "DELETE from al_productcolor where pc_productid=$productid";
            mysqli_query($conn, $deletecurrentsizes);
            mysqli_query($conn, $deletecurrentimages);

            // INSERTING SIZES
            $sizes = $_POST['product_sizes'];
            foreach ($sizes as $size) {
                $insertsizequery = "insert into al_productsize(ps_productid , ps_size) values($productid,'$size')";
                $sizeresult = mysqli_query($conn, $insertsizequery);
            }

            // INSERTING COLORS
            if (isset($_POST['product_colors']) && $_POST['product_colors'] != '' && isset($_FILES['product_additionalimages'])) {
                $colors = $_POST['product_colors'];
                foreach ($colors as $color) {
                    $insertcolorquery = "insert into al_productcolor(pc_productid ,pc_colorname) values($productid,'$color')";
                    $colorresult = mysqli_query($conn, $insertcolorquery);
                }
            }

            // INSERTING IMAGES
            $file_array = reArrayFiles($_FILES['product_additionalimages']);
            if (count($file_array) > 0) {
                for ($i = 0; $i < count($file_array); $i++) {
                    move_uploaded_file($file_array[$i]['tmp_name'], "images/uploads/" . $file_array[$i]['name']);
                    $imagename = $file_array[$i]['name'];
                    $addmoreimagesquery = "insert into al_productimages(pi_productid , pi_imagename) values($productid,'$imagename')";
                    $imageres = mysqli_query($conn, $addmoreimagesquery);
                }
            }

            if ($sizeresult) {
                if ($colorresult) {
                    header("location:products.php");
                }
            }
        } else {
            header("location:manage_products.php");
        }
    }
} else if (isset($_POST['action_method']) && $_POST['action_method'] == 'delete_product') {
    $productids = $_POST['productid'];
    $is_deleted = 0;
    if (!empty($productids)) {
        foreach ($productids as $pid) {
            $deletequery = "delete from product_master where pm_productid=$pid";
            if (mysqli_query($conn, $deletequery)) {
                $is_deleted = 1;
            } else {
                $is_deleted = 0;
                return false;
            }
        }
        if ($is_deleted == 1) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
