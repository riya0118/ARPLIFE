<?php
require("config/dbconnect.php");
if (isset($_POST['action'])) {
    $flag = 0;
    $category = '';
    $brand = '';
    $subcategory = '';

    $wishlistrowcount = '';
    $customerid = '';
    $customerid = ((isset($_SESSION['customerid'])) ? $_SESSION['customerid'] : '');

    if (isset($_POST['gender'])) {
        $gen = $_POST['gender'];
        if (isset($_POST['category']) && $_POST['category'] != 0) {
            $category = $_POST['category'];
        } else if (isset($_POST['subcategory']) && $_POST['subcategory'] != 0) {
            $subcategory = $_POST['subcategory'];
        } else if (isset($_POST['brand']) && $_POST['brand'] != 0) {
            $brand = $_POST['brand'];
        }
    }

    $qry = "SELECT DISTINCT(pm_productid), pm_productname , pm_image , pm_price , pm_type, pm_brandid from product_master, al_productcolor, al_productsize where pm_productid=pc_productid and pm_productid=ps_productid and pm_isactive=1 and pm_type='$gen'";

    //Category Filter
    if (isset($_POST['categories'])) {
        $flag = 1;
        $category_filter = implode(',', $_POST['categories']);
        $qry .= " AND pm_categoryid IN($category_filter)";
    }

    //Price Filter
    if (isset($_POST['minimum_price'], $_POST['maximum_price']) && !empty($_POST['minimum_price']) && !empty($_POST['maximum_price'])) {
        $flag = 1;
        $qry .= " AND pm_price between '" . $_POST['minimum_price'] . "' AND '" . $_POST['maximum_price'] . "' and pm_type='$gen' and pm_isactive=1";
    }

    //Brand Filter
    if (isset($_POST['brands'])) {
        $flag = 1;
        $brand_filter = implode(',', $_POST['brands']);
        $qry .= " AND pm_brandid IN($brand_filter)";
    }

    //Color Filter
    if (isset($_POST['color'])) {
        $flag = 1;
        $color_filter = implode("','", $_POST['color']);
        $qry .= " AND pc_colorname IN('" . $color_filter . "')";
    }

    //Size Filter
    if (isset($_POST['size'])) {
        $flag = 1;
        $size_filter = implode("','", $_POST['size']);
        $qry .= "AND ps_size IN('" . $size_filter . "')";
    }

    //Discount Filter
    if (isset($_POST['discount'])) {
        $flag = 1;
        $discount_filter = implode(',', $_POST['discount']);
        $qry .= " AND pm_discountid IN($discount_filter)";
    }

    if ($flag == 0 && $category != '') {
        $qry = "SELECT * from product_master where pm_type='$gen' and pm_categoryid=$category  ";
    } else if ($flag == 0 && $subcategory != '') {
        $qry = "SELECT * from product_master where pm_type='$gen' and  pm_subcategoryid=$subcategory  ";
    } else if ($flag == 0 && $brand != '') {
        $qry = "SELECT * from product_master where pm_type='$gen' and pm_brandid=$brand ";
    }

    $res = mysqli_query($conn, $qry);
    $rowcount = mysqli_num_rows($res);

    if ($rowcount > 0) {
        $output = '';
        while ($row = mysqli_fetch_array($res)) {
            $setimage = $row['pm_image'];
            $setgender = $row['pm_type'];
            if ($setgender == 'M') {
                $setgender = 'Male';
            } else {
                $setgender = 'Female';
            }
            $setpid = $row['pm_productid'];
            $setpname = $row['pm_productname'];
            $setprice = $row['pm_price'];

            $getbrandquery = "SELECT bm_brandname from brand_master where bm_brandid=" . $row['pm_brandid'];
            $brandresult = mysqli_query($conn, $getbrandquery);
            $getbrandrow = mysqli_fetch_array($brandresult);
            $getbrand = $getbrandrow['bm_brandname'];

            $wishlistcheck = "SELECT * from al_wishlist where wl_productid=$setpid";
            $wishlistcheckresult = mysqli_query($conn, $wishlistcheck);
            if ($wishlistcheckresult) {
                $wishlistrowcount = mysqli_num_rows($wishlistcheckresult);
            }

            $output = $output .
                '<div class="col-sm-6 col-xl-4">
                    <div class="sin-product style-two">
                        <a href="singleproduct.php?productid=' . $setpid . '">
                        <div class="pro-img">
                            <img src="admin/images/uploads/' . $setimage . '" height="300rem">
                        </div>
                        <div class="mid-wrapper"  >
                            <h5 class="pro-title"><a href="javascript:void()">' . $getbrand . '</a></h5>
                            <h5 class="pro-title"><a style="text-align:center;" href="singleproduct.php?productid=' . $setpid . '">' . $setpname . '</a></h5>
                            <p style="text-align:center;" >' . $setgender . '<span> / &#X20B9;' . $setprice . '</span></p>
                        </div>
                        <div class="icon-wrapper">';
                            if ($wishlistrowcount < 0 || $wishlistrowcount == '') {
                                $output = $output .
                                    '<div class="add-to-cart">
                                        <input type="hidden" name="" id="flagfield" value="">';
                                        if ($customerid !=  '') {
                                            echo "condition2";
                                            $output = $output .
                                            '<a class="add-to-wishlist' . $p_id . '" onclick="addtowishlist(' . $p_id . ', ' . $customerid . ')" href="javascript:void()"><i class="flaticon-valentines-heart"></i> Add to Wishlist</a>';
                                        }
                                        $output = $output .
                                    '</div>';
                                } else if ($wishlistrowcount > 0) {
                                    $output = $output .
                                    '<div class="add-to-cart">
                                        <a href="javascript:void()" class="acustom"><i class="flaticon-valentines-heart"></i> Added to Wishlist</a>
                                    </div>';
                                } else {
                                    echo "No data";
                                }
                            $output = $output . 
                        '</div>
                    </div>
                </div>';
        }
        echo $output;
    } else {
        $output = '<h3>No Data Found</h3>';
    }
}
