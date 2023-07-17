<?php
require("../config/dbconnect.php");
$productid = (isset($_GET["productid"]) ? intval($_GET["productid"]) : '');
$product_method = (isset($_GET["productid"]) ? 'edit' : 'add');
$setsubcategory = $setstatus = $getcategoryforscdropdown = '';
$set_product_category  = $set_product_description =  $set_product_status = $set_product_name = '';
if ($product_method == 'edit') {
    $getproductquery = "select * from product_master where pm_productid=$productid ";
    $res = mysqli_query($conn, $getproductquery);
    if (mysqli_num_rows($res) > 0) {
        $getrow = mysqli_fetch_array($res);
        $set_product_category = (($getrow['pm_categoryid'] != '') ? $getrow['pm_categoryid'] : '');
        $set_product_subcategory = (($getrow['pm_subcategoryid'] != '') ? $getrow['pm_subcategoryid'] : '');
        $set_product_brand = (($getrow['pm_brandid'] != '') ? $getrow['pm_brandid'] : '');
        $set_product_name = (($getrow['pm_productname'] != '') ? $getrow['pm_productname'] : '');
        $set_product_description = (($getrow['pm_description'] != '') ? $getrow['pm_description'] : '');
        $set_product_price = (($getrow['pm_price'] != '') ? $getrow['pm_price'] : '');
        $set_product_discount = (($getrow['pm_discountid'] != '') ? $getrow['pm_discountid'] : '');
        $set_product_stock = (($getrow['pm_stock'] != '') ? $getrow['pm_stock'] : '');
        $set_product_type = (($getrow['pm_type'] != '') ? $getrow['pm_type'] : '');
        $set_product_status = (($getrow['pm_isactive'] != '') ? $getrow['pm_isactive'] : '');
    }
}
?>
<style>
    .error {
        color: #F00;
        background-color: #FFF;
    }

    .displayimage {
        line-height: 2.65;
        border: 1px solid rgba(0, 0, 0, .15);
        height: 180px;
        width: 45%;
        margin-bottom: 10px;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<?php require_once("../admin/includes/constants.php"); ?>
<?php include(INCLUDESCOMP_DIR . "csslinks.php"); ?>
<!-- FOR MULTISELECT -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="multiselect-15/fonts/icomoon/style.css">

<link rel="stylesheet" href="multiselect-15/css/jquery.multiselect.css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="multiselect-15/css/bootstrap.min.css">

<!-- Style -->
<link rel="stylesheet" href="multiselect-15/css/style.css">
<!-- FOR MULTISELECT END -->

<body>

    <!--*******************
        Preloader start
    ********************-->
    <?php include(INCLUDESCOMP_DIR . "preloader.php"); ?>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Logo start
        ***********************************-->
        <?php include(INCLUDESCOMP_DIR . "logo.php"); ?>
        <!--**********************************
            Logo end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->

        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
        <?php include(INCLUDESCOMP_DIR . "header.php"); ?>
        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include(INCLUDESCOMP_DIR . "sidebar.php"); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="row page-titles mx-0" style="background-color:lavender;  ">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo BASE_DIR . 'index.php' ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="">Manage Product</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important;  ">
                <div class="col-lg-12">
                    <div class="card" style="margin-bottom: 0px;">
                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-validation">
                                    <form class="product_frm" method="POST" action="products_operation.php" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <input type="hidden" value="<?= $productid ?>" name="productid" id="productid">
                                            <label class="col-lg-4 col-form-label" for="product_category">Category
                                            </label>
                                            <div class="col-lg-6">
                                                <!-- CATEGORY ID FOR EDIT     -->
                                                <input type="hidden" value="<?= $set_product_subcategory ?>" name="getsubcategory" id="getsubcategory">
                                                <select class="form-control" id="categorydropdown" name="product_category">
                                                    <option disabled selected value=''>Choose...</option>
                                                    <?php
                                                    $sql = "SELECT * from category_master";
                                                    $res = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($res) > 0) {
                                                        while ($row = mysqli_fetch_array($res)) { ?>
                                                            <?php if ($product_method == 'edit' && $set_product_category == $row['catm_categoryid']) { ?>
                                                                <option value="<?= $row['catm_categoryid'] ?>" selected><?= $row['catm_categoryname'] ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?= $row['catm_categoryid'] ?>"><?= $row['catm_categoryname'] ?></option>
                                                    <?php  }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_subcategory">Sub Category
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="subcategorydropdown" name="product_subcategory">
                                                    <option disabled selected value="">Choose...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_brand">Brand
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="hidden" value="<?= $set_product_brand ?>" name="getbrand" id="getbrand">
                                                <select class="form-control" id="branddropdown" name="product_brand">
                                                    <option value="" disabled selected>Choose...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_name">Product Name
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" value="<?= $set_product_name ?>" class="customtext" id="product_name" name="product_name" placeholder="Enter a productname..">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_description">Description
                                            </label>
                                            <div class="col-lg-6">
                                                <textarea class="customtext" id="product_description" name="product_description" rows="5" placeholder="give desired description..."><?= $set_product_description ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_size">Size
                                            </label>
                                            <div class="col-lg-6">
                                                <select name="product_sizes[]" multiple="multiple" class="3col active form-control">
                                                    <?php
                                                    $getsizes = "SELECT * from al_productsize where ps_productid=$productid";
                                                    $sizearr = array();
                                                    $selectedflag = 0;
                                                    $sizeresult = mysqli_query($conn, $getsizes);
                                                    if (mysqli_num_rows($sizeresult) > 0) {
                                                        while ($getsizes = mysqli_fetch_array($sizeresult)) {
                                                            array_push($sizearr, $getsizes['ps_size']);
                                                        } ?>
                                                        <optgroup label="Upperwear">

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == 'XS') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="XS">XS</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="XS">XS</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            }
                                                            ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == 'S') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="S">S</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="S">S</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == 'M') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="M">M</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="M">M</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == 'L') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="L">L</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="L">L</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == 'XL') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="XL">XL</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="XL">XL</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == 'XXL') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="XXL">XXL</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="XXL">XXL</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == 'XXXL') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="XXXL">XXXL</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="XXXL">XXXL</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                        </optgroup>

                                                        <optgroup label="Footwear">

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '5') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="5">5</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="5">5</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '5.5') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="5.5">5.5</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="5.5">5.5</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '6') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="6">6</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="6">6</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '6.5') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="6.5">6.5</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="6.5">6.5</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '7') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="7">7</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="7">7</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '7.5') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="7.5">7.5</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="7.5">7.5</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '8') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="8">8</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="8">8</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '8.5') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="8.5">8.5</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="8.5">8.5</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '9') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="9">9</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="9">9</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '9.5') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="9.5">9.5</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="9.5">9.5</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '10') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="10">10</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="10">10</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '10.5') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="10.5">10.5</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="10.5">10.5</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '11') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="11">11</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="11">11</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '11.5') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="11.5">11.5</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="11.5">11.5</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '12') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="12">12</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="12">12</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '12.5') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="12.5">12.5</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="12.5">12.5</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '13') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="13">13</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="13">13</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '13.5') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="13.5">13.5</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="13.5">13.5</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '14') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="14">14</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="14">14</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '14.5') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="14.5">14.5</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="14.5">14.5</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '15') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="15">15</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="15">15</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                        </optgroup>

                                                        <optgroup label="Bottomwear">

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '26') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="26">26</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="26">26</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '28') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="28">28</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="28">28</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '30') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="30">30</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="30">30</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '32') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="32">32</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="32">32</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '34') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="34">34</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="34">34</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '36') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="36">36</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="36">36</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '38') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="38">38</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="38">38</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '40') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="40">40</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="40">40</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '42') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="42">42</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="42">42</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == '44') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="44">44</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="44">44</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>

                                                        </optgroup>

                                                        <optgroup label="Accessories & bags & Jewelleries">



                                                            <?php foreach ($sizearr as $size) {
                                                                if ($size == 'OS') {
                                                                    $selectedflag = 1; ?>
                                                                    <option selected value="OS">One Size</option>
                                                                <?php break;
                                                                }
                                                            }
                                                            if ($selectedflag != 1) { ?>
                                                                <option value="OS">One Size</option>
                                                            <?php } else {
                                                                $selectedflag = 0;
                                                            } ?>


                                                        </optgroup>

                                                    <?php } else { ?>
                                                        <optgroup label="Upperwear">
                                                            <option value="XS">XS</option>
                                                            <option value="S">S</option>
                                                            <option value="M">M</option>
                                                            <option value="L">L</option>
                                                            <option value="XL">XL</option>
                                                            <option value="XXL">XXL</option>
                                                            <option value="XXXL">XXXL</option>
                                                        </optgroup>
                                                        <optgroup label="Footwear">
                                                            <option value="5">5</option>
                                                            <option value="5.5">5.5</option>
                                                            <option value="6">6</option>
                                                            <option value="6.5">6.5</option>
                                                            <option value="7">7</option>
                                                            <option value="7.5">7.5</option>
                                                            <option value="8">8</option>
                                                            <option value="8.5">8.5</option>
                                                            <option value="9">9</option>
                                                            <option value="9.5">9.5</option>
                                                            <option value="10">10</option>
                                                            <option value="10.5">10.5</option>
                                                            <option value="11">11</option>
                                                            <option value="11.5">11.5</option>
                                                            <option value="12">12</option>
                                                            <option value="12.5">12.5</option>
                                                            <option value="13">13</option>
                                                            <option value="13.5">13.5</option>
                                                            <option value="14">14</option>
                                                            <option value="14.5">14.5</option>
                                                            <option value="15">15</option>
                                                        </optgroup>
                                                        <optgroup label="Bottomwear">
                                                            <option value="26">26</option>
                                                            <option value="28">28</option>
                                                            <option value="30">30</option>
                                                            <option value="32">32</option>
                                                            <option value="34">34</option>
                                                            <option value="36">36</option>
                                                            <option value="38">38</option>
                                                            <option value="40">40</option>
                                                            <option value="42">42</option>
                                                            <option value="44">44</option>
                                                        </optgroup>
                                                        <optgroup label="Accessories & bags & Jewelleries">
                                                            <option value="OS">OS</option>

                                                        </optgroup>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_color">Color
                                            </label>
                                            <div class="col-lg-6">
                                                <select name="product_colors[]" multiple="colors" class="4col active form-control">
                                                    <?php
                                                    $getcolours = "SELECT * from al_productcolor where pc_productid=$productid ";
                                                    $selectedflag = 0;
                                                    $colorarr = array();
                                                    $colorresult = mysqli_query($conn, $getcolours);
                                                    if (mysqli_num_rows($colorresult) > 0) {
                                                        while ($getrows = mysqli_fetch_array($colorresult)) {
                                                            array_push($colorarr, $getrows['pc_colorname']);
                                                        } ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Red') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Red">Red</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Red">Red</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Green') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Green">Green</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Green">Green</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Blue') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Blue">Blue</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Blue">Blue</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Yellow') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Yellow">Yellow</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Yellow">Yellow</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Black') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Black">Black</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Black">Black</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'White') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="White">White</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="White">White</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Orange') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Orange">Orange</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Orange">Orange</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Maroon') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Maroon">Maroon</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Maroon">Maroon</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Brown') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Brown">Brown</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Brown">Brown</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Mustard') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Mustard">Mustard</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Mustard">Mustard</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Gray') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Gray">Gray</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Gray">Gray</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Olive') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Olive">Olive</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Olive">Olive</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Pink') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Pink">Pink</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Pink">Pink</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Purple') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Purple">Purple</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Purple">Purple</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Navy') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Navy">Navy</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Navy">Navy</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Khaki') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Khaki">Khaki</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Khaki">Khaki</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Silver') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Silver">Silver</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Silver">Silver</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Gold') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Gold">Gold</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Gold">Gold</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>

                                                        <?php foreach ($colorarr as $color) {
                                                            if ($color == 'Lightpink') {
                                                                $selectedflag = 1; ?>
                                                                <option selected value="Lightpink">Rose Gold</option>
                                                            <?php break;
                                                            }
                                                        }
                                                        if ($selectedflag != 1) { ?>
                                                            <option value="Lightpink">Rose Gold</option>
                                                        <?php } else {
                                                            $selectedflag = 0;
                                                        }
                                                        ?>


                                                    <?php } else { ?>
                                                        <option value="Red">Red</option>
                                                        <option value="Green">Green</option>
                                                        <option value="Blue">Blue</option>
                                                        <option value="Yellow">Yellow</option>
                                                        <option value="Black">Black</option>
                                                        <option value="White">White</option>
                                                        <option value="Orange">Orange</option>
                                                        <option value="Maroon">Maroon</option>
                                                        <option value="Brown">Brown</option>
                                                        <option value="Mustard">Mustard</option>
                                                        <option value="Gray">Gray</option>
                                                        <option value="Olive">Olive</option>
                                                        <option value="Pink">Pink</option>
                                                        <option value="Navy">Navy</option>
                                                        <option value="Khaki">Khaki</option>
                                                        <option value="Purple">Purple</option>
                                                        <option value="Silver">Silver</option>
                                                        <option value="Gold">Gold</option>
                                                        <option value="Lightpink">Rose Gold</option>

                                                    <?php  } ?>

                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_price">Price
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" value="<?= $set_product_price ?>" class="customtext" id="product_price" name="product_price" placeholder="Enter price..">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_discount">Discount
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" name="product_discount">
                                                    <option value="">Choose...</option>
                                                    <?php
                                                    $sql = "SELECT * from discount_master";
                                                    $res = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($res) > 0) {
                                                        while ($row = mysqli_fetch_array($res)) {
                                                            if ($product_method == 'edit' && $set_product_discount == $row['dm_discountid']) { ?>
                                                                <option selected value="<?= $row['dm_discountid'] ?>"><?= $row['dm_discountname'] ?></option>
                                                            <?php  } else { ?>
                                                                <option value="<?= $row['dm_discountid'] ?>"><?= $row['dm_discountname'] ?></option>
                                                            <?php  }
                                                            ?>
                                                    <?php  }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_stock">Stock
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" value="<?= $set_product_stock ?>" class="customtext" id="product_stock" name="product_stock" placeholder="Enter stock..">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_image">Image
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="file" class="form-control-file" name="product_image" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_moreimages">Additional images
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="file" class="form-control-file" name="product_additionalimages[]" multiple="" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_gender">Gender
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" name="product_gender">
                                                    <?php
                                                    if ($set_product_type == null) { ?>
                                                        <option value="" selected disabled>Choose...</option>
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    <?php } else if ($set_product_type == 'M') { ?>
                                                        <option value="" disabled>Choose...</option>
                                                        <option selected value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    <?php } else if ($set_product_type == 'F') { ?>
                                                        <option value="" disabled>Choose...</option>
                                                        <option value="M">Male</option>
                                                        <option selected value="F">Female</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <di v class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="product_status">Status
                                            </label>
                                            <div class="col-lg-6">
                                                <select id="product_status" name="product_status" class="form-control">
                                                    <?php
                                                    if ($set_product_status == null) { ?>
                                                        <option value="" selected disabled>Choose...</option>
                                                        <option value="1">Enabled</option>
                                                        <option value="0">Disabled</option>
                                                    <?php } else if ($set_product_status == 1) { ?>
                                                        <option value="" disabled>Choose...</option>
                                                        <option selected value="1">Enabled</option>
                                                        <option value="0">Disabled</option>
                                                    <?php } else if ($set_product_status == 0) { ?>
                                                        <option value="" disabled>Choose...</option>
                                                        <option value="1">Enabled</option>
                                                        <option selected value="0">Disabled</option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                </div>
                                <?php if ($product_method == 'add') { ?>
                                    <button type="submit" id="product_addbtn" name="product_addbtn" class="btn btn-dark">Add</button>
                                <?php } else if ($product_method == 'edit') { ?>
                                    <button type="submit" id="product_editbtn" name="product_editbtn" class="btn btn-dark">Edit</button>
                                <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid end  -->
    </div>
    <!--**********************************
            Content body end
        ***********************************-->


    <!--**********************************
            Footer start
        ***********************************-->
    <?php include(INCLUDESCOMP_DIR . "footer.php");    ?>
    <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="multiselect-15/js/jquery-3.3.1.min.js"></script>
    <script src="multiselect-15/js/popper.min.js"></script>
    <script src="multiselect-15/js/bootstrap.min.js"></script>
    <script src="multiselect-15/js/jquery.multiselect.js"></script>
    <script src="multiselect-15/js/main.js"></script>
    <script src="multiselect-15/js/color.js"></script>
    <script src="<?php echo PLUGINS_DIR ?>validation/jquery.validate.min.js"></script>
    <script>
        //jquery validation
        $(document).ready(function() {
            getcategory = $('#categorydropdown').val();
            getsubcategory = $('#getsubcategory').val();
            if (getsubcategory != '') {
                $.ajax({
                    url: "populatesubcategory.php",
                    data: {
                        c_id: getcategory,
                        product_method: "edit",
                        s_id: getsubcategory
                    },
                    type: 'POST',
                    success: function(response) {
                        var resp = $.trim(response);
                        $("#subcategorydropdown").html(resp);
                    }
                });
            } else {
                $("#subcategorydropdown").html("<option selected disabled value=''>Choose...</option>");
            }

            getbrand = $('#getbrand').val();
            if (getcategory != '') {
                $.ajax({
                    url: "populatebrands.php",
                    data: {
                        cat_id: getcategory,
                        product_method: "edit",
                        b_id: getbrand
                    },
                    type: 'POST',
                    success: function(response) {
                        var resp = $.trim(response);
                        $("#branddropdown").html(resp);
                    }
                });
            } else {
                $("#branddropdown").html("<option selected disabled value=''>Choose...</option>");
            }

            //ON CHANGE
            $("#categorydropdown").change(function() {
                var category_id = $(this).val();
                if (category_id != "") {
                    $.ajax({
                        url: "populatesubcategory.php",
                        data: {
                            c_id: category_id
                        },
                        type: 'POST',
                        success: function(response) {
                            var resp = $.trim(response);
                            $("#subcategorydropdown").html(resp);
                        }
                    });
                } else {
                    $("#subcategorydropdown").html("<option selected disabled value=''>Choose...</option>");
                }
            });

            $("#categorydropdown").change(function() {
                var category_id = $(this).val();
                if (category_id != "") {
                    $.ajax({
                        url: "populatebrands.php",
                        data: {
                            cat_id: category_id
                        },
                        type: 'POST',
                        success: function(response) {
                            var resp = $.trim(response);
                            $("#branddropdown").html(resp);
                        }
                    });
                } else {
                    $("#branddropdown").html("<option selected disabled value=''>Choose...</option>");
                }
            });

            $('#product_editbtn').click(function() {
                jQuery(".product_frm").validate({
                    rules: {
                        product_category: 'required',
                        product_subcategory: 'required',
                        product_brand: 'required',
                        product_name: 'required',
                        product_price: 'required',
                        product_stock: 'required',
                        product_gender: 'required',
                        product_status: 'required'
                    },
                    messages: {
                        product_category: 'select a category',
                        product_subcategory: 'select a subcategory',
                        product_brand: 'select a brand',
                        product_name: 'product name is required',
                        product_price: ' product price is required',
                        product_stock: ' product stock is required',
                        product_gender: 'choose the gender',
                        product_status: 'status is required'
                    },
                    highlight: function(element) {
                        $(element).last().addClass('error')
                    },
                    unhighlight: function(element) {
                        $(element).last().removeClass('error')
                    }
                });
            });

            $("#product_addbtn").click(function() {
                // e.preventDefault();
                jQuery(".product_frm").validate({
                    rules: {
                        product_category: 'required',
                        product_subcategory: 'required',
                        product_brand: 'required',
                        product_name: 'required',
                        product_size: 'required',
                        product_price: 'required',
                        product_stock: 'required',
                        product_image: 'required',
                        product_gender: 'required',
                        product_status: 'required'
                    },
                    messages: {
                        product_category: 'select a category',
                        product_subcategory: 'select a subcategory',
                        product_brand: 'select a brand',
                        product_name: 'product name is required',
                        product_size: ' product size is required',
                        product_price: ' product price is required',
                        product_stock: ' product stock is required',
                        product_image: ' product image is required',
                        product_gender: 'choose the gender',
                        product_status: 'status is required'
                    },
                    highlight: function(element) {
                        $(element).last().addClass('error')
                    },
                    unhighlight: function(element) {
                        $(element).last().removeClass('error')
                    }
                });
            });

        });
    </script>
</body>

</html>