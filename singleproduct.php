<?php
require("config/dbconnect.php");
$productid = $_GET['productid'];
$setsubcategory = $setstatus = $getcategoryforscdropdown = $set_product_brand = $catid = $checkrowcount = '';
$set_product_category  = $set_product_description =  $set_product_status = $getbrandid = $getcatid = '';
$getproductquery = "select * from product_master where pm_productid=$productid ";
$res = mysqli_query($conn, $getproductquery);
if (mysqli_num_rows($res) > 0) {
    while ($getrow = mysqli_fetch_array($res)) {
        $set_product_category = (($getrow['pm_categoryid'] != '') ? $getrow['pm_categoryid'] : '');
        $set_product_subcategory = (($getrow['pm_subcategoryid'] != '') ? $getrow['pm_subcategoryid'] : '');
        $set_product_brand = (($getrow['pm_brandid'] != '') ? $getrow['pm_brandid'] : '');
        $set_product_name = (($getrow['pm_productname'] != '') ? $getrow['pm_productname'] : '');
        $set_product_description = (($getrow['pm_description'] != '') ? $getrow['pm_description'] : '');
        $set_product_price = (($getrow['pm_price'] != '') ? $getrow['pm_price'] : '');
        $set_product_discount = (($getrow['pm_discountid'] != '') ? $getrow['pm_discountid'] : '');
        $set_product_stock = (($getrow['pm_stock'] != '') ? $getrow['pm_stock'] : '');
        $set_product_image = (($getrow['pm_image'] != '') ? $getrow['pm_image'] : '');
        $set_product_type = (($getrow['pm_type'] != '') ? $getrow['pm_type'] : '');
        $set_product_status = (($getrow['pm_isactive'] != '') ? $getrow['pm_isactive'] : '');
    }
    if ($set_product_brand != '') {
        $getbrandquery = "SELECT bm_brandname from brand_master where bm_brandid=$set_product_brand";
        $brandresult = mysqli_query($conn, $getbrandquery);
        $getbrandrow = mysqli_fetch_array($brandresult);
        $getbrand = $getbrandrow['bm_brandname'];
    }
    if ($set_product_stock > 0) {
        $available = 1;
    } else {
        $available = 0;
    }
}
?>
<!doctype html>
<html>

<!-- head-tag -->
<?php include("mainincludes/csslinks.php"); ?>
<style>
    .color-checkboxes #col-Purple-label {
        background: purple;
    }
</style>

<body id="home-version-1" class="home-version-1" data-style="default">
    <div class="site-content">


        <!-- header -->
        <?php include("mainincludes/header.php") ?>

        <section class="breadcrumb-area">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bc-inner">
                            <p><a href="#">Home |</a> Shop</p>
                        </div>
                    </div>
                    <!-- /.col-xl-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>

        <!--=========================-->
        <!--=        Shop area          =-->
        <!--=========================-->

        <section class="shop-area single-product">
            <div class="container-fluid custom-container">
                <div class="row">
                    <!-- /.col-xl-3 -->
                    <div class="order-1 order-md-2  col-lg-9 col-xl-10">
                        <div class="row">
                            <div class="col-lg-6 col-xl-5">
                                <!-- Product View Slider -->
                                <div class="quickview-slider">
                                    <div class="slider-for">
                                        <div class="">
                                            <img height="500rem" src="admin/images/uploads/<?= $set_product_image ?>" alt="<?= $set_product_image ?>">
                                        </div>
                                        <?php
                                        $customerid = '';
                                        $customerid = ((isset($_SESSION['customerid'])) ? $_SESSION['customerid'] : '');
                                        if ($customerid != '') {
                                            $checkcartproductquery = "SELECT * from al_cart where crt_productid=$productid ";
                                        } else {
                                            $checkcartproductquery = "SELECT * from al_visitorcart where vc_productid=$productid ";
                                        }
                                        $checkcartproductresult = mysqli_query($conn, $checkcartproductquery);
                                        if ($checkcartproductresult) {
                                            $checkrowcount = mysqli_num_rows($checkcartproductresult);
                                        }
                                        $getimages = "SELECT * from al_productimages where pi_productid=$productid";
                                        $imgres = mysqli_query($conn, $getimages);
                                        if (mysqli_num_rows($imgres) > 0) {
                                            while ($getrow = mysqli_fetch_array($imgres)) { ?>
                                                <div class="">
                                                    <img height="500rem" src="admin/images/uploads/<?= $getrow['pi_imagename'] ?>" alt="<?= $getrow['pi_imagename'] ?>">
                                                </div>
                                        <?php }
                                        }
                                        ?>
                                    </div>

                                    <div class="slider-nav">
                                        <div class="">
                                            <img height="150rem" src="admin/images/uploads/<?= $set_product_image ?>" alt="<?= $set_product_image ?>">
                                        </div>
                                        <?php
                                        $getimages = "SELECT * from al_productimages where pi_productid=$productid";
                                        $imgres = mysqli_query($conn, $getimages);
                                        if (mysqli_num_rows($imgres) > 0) {
                                            while ($getrow = mysqli_fetch_array($imgres)) { ?>
                                                <div class="">
                                                    <img height="150rem" src="admin/images/uploads/<?= $getrow['pi_imagename'] ?>" alt="<?= $getrow['pi_imagename'] ?>">
                                                </div>
                                        <?php }
                                        }
                                        ?>

                                    </div>
                                </div>
                                <!-- /.quickview-slider -->
                            </div>
                            <!-- /.col-xl-6 -->

                            <div class="col-lg-6 col-xl-6">
                                <div class="product-details">
                                    <h5 class="pro-title"><a href="javascript:void()"><?= strtoupper($getbrand) ?></a></h5>
                                    <h5 class="pro-title"><a href="javascript:void()"><?= $set_product_name ?></a></h5>
                                    <span class="price">Availibility: <span style="<?= ($available != 1) ? 'color:red; font-size:large;' : 'font-size:large;' ?> "><?= ($available) == 1 ? 'In stock' : 'Out of stock' ?></span></span><span class="price">|</span>
                                    <span class="price">Price : &#X20B9;<?= $set_product_price ?></span>
                                    <div class="size-variation">
                                        <span>size :</span>
                                        <select name="productsizes" class="productsizes" id="sizedropdown">
                                            <option value="choose" selected disabled>Choose</option>
                                            <?php
                                            $getsizequery = "SELECT * from al_productsize where ps_productid= $productid";
                                            $sizeres = mysqli_query($conn, $getsizequery);
                                            if (mysqli_num_rows($sizeres) > 0) {
                                                while ($getsizerow = mysqli_fetch_array($sizeres)) {
                                            ?>
                                                    <option id="productsize" value="<?= $getsizerow['ps_sizeid'] ?>"><?= $getsizerow['ps_size'] ?></option>
                                            <?php  }
                                            }

                                            ?>
                                        </select>
                                        <p id="err"></p>
                                    </div>
                                    <div class="color-checkboxes">
                                        <h4>Color:</h4>
                                        <?php
                                        $getcolorsquery = "SELECT * from al_productcolor where pc_productid=$productid";
                                        $getcolorresult = mysqli_query($conn, $getcolorsquery);

                                        $colors = array();
                                        if (mysqli_num_rows($getcolorresult) > 0) {
                                            while ($getcolors = mysqli_fetch_array($getcolorresult)) {
                                                array_push($colors, $getcolors['pc_colorname']); ?>
                                                <input class="color-checkbox__input" id="avail_colors" name="colour" type="radio">
                                                <label class="color-checkbox" for="avail_colors" id="col-<?= $getcolors['pc_colorname'] ?>-label"></label>
                                                <span></span>
                                        <?php }
                                        }
                                        ?>
                                        <div class="printcolors" id="printcolors"></div>
                                    </div>

                                    <div class="add-tocart-wrap">
                                        <?php
                                        if ($available == 1) {
                                            if ($checkrowcount > 0) { ?>
                                                <a href="cart.php?customerid=<?= $customerid ?>" class="add-to-cart"><i class="flaticon-shopping-purse-icon"></i>Go to Cart</a>
                                            <?php } else { ?>
                                                <a href="javascript:void()" id="cartbtn" onclick="cartinsertion(<?= $productid ?>,<?= $customerid ?>)" class="add-to-cart"><i class="flaticon-shopping-purse-icon"></i>Add to Cart</a>
                                            <?php }
                                            ?>
                                        <?php } else { ?>
                                            <a href="javascript:void()" style="text-decoration:line-through ;" class="add-to-cart"><i class="flaticon-shopping-purse-icon"></i>Add to Cart</a>
                                        <?php }
                                        ?>

                                    </div>
                                </div>
                                <!-- /.product-details -->
                            </div>
                            <!-- /.col-xl-6 -->

                            <div class="col-xl-12">
                                <div class="product-des-tab">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ADDITIONAL INFORMATION</a>
                                        </li>
                                    </ul>

                                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="prod-bottom-tab-sin">
                                            <h5>Description</h5>
                                            <?php
                                            $attributeqry = "select * from al_productattribute ,attributes_master where pa_productid=$productid and pa_attributeid=am_attributeid";
                                            $attributeresult = mysqli_query($conn, $attributeqry); ?>
                                            <?php
                                            if (mysqli_num_rows($attributeresult) > 0) {
                                                while ($getrow = mysqli_fetch_array($attributeresult)) {
                                                    $getattributename = $getrow['am_attributename'];
                                                    $getattributevalue = $getrow['pa_value']; ?>

                                                    <div class="info-wrap">
                                                        <div class="sin-aditional-info">
                                                            <div class="first" style="font-weight:800 ;">
                                                                <?= $getattributename ?>
                                                            </div>
                                                            <div class="secound">
                                                                <?= $getattributevalue ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                            <?php }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="prod-bottom-tab-sin description">
                                                <h5>Related Products</h5>
                                                <div class="quickview-slider">
                                                    <div class="slider-nav">
                                                        <?php
                                                        $getrelatedproducts = "SELECT * from product_master where pm_subcategoryid=$set_product_subcategory and pm_type='$set_product_type'";
                                                        $relatedproductsres = mysqli_query($conn, $getrelatedproducts);
                                                        if (mysqli_num_rows($relatedproductsres) > 0) {
                                                            while ($getrow = mysqli_fetch_array($relatedproductsres)) { ?>
                                                                <div class="">
                                                                    <img height="300rem" src="admin/images/uploads/<?= $getrow['pm_image'] ?>" alt="<?= $getrow['pm_image'] ?>">
                                                                    <div class="mid-wrapper">
                                                                        <h5 class="pro-title"><a href="javascript:void()"><?= $getbrand ?></a></h5>
                                                                        <h5 class="pro-title"><a href="singleproduct.php?productid=<?= $getrow['pm_productid'] ?>"><?= $getrow['pm_productname'] ?></a></h5>
                                                                        <h5 class="pro-title"><?= ($getrow['pm_type'] == 'M' ? 'Male' : 'Female') ?> / <span>&nbsp; &#X20B9;<?= $getrow['pm_price'] ?></span></h5>
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <!-- /.row -->
                                    </div>
                                    <!-- /.col-xl-9 -->

                                </div>
                            </div>
                        </div>
                    </div>

        </section> <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.shop-area -->


    <!-- footer -->
    <?php include("mainincludes/footer.php"); ?>


    <!-- Back to top-->

    <?php include("mainincludes/backtotop.php"); ?>


    <!-- Popup -->

    <?php // include("mainincludes/popup.php"); 
    ?>


    </div>
    <!-- /#site -->

    <!-- Dependency Scripts -->
    <script src="dependencies/jquery/jquery.min.js"></script>
    <script src="dependencies/popper.js/popper.min.js"></script>
    <script src="dependencies/bootstrap/js/bootstrap.min.js"></script>
    <script src="dependencies/owl.carousel/js/owl.carousel.min.js"></script>
    <script src="dependencies/wow/js/wow.min.js"></script>
    <script src="dependencies/isotope-layout/js/isotope.pkgd.min.js"></script>
    <script src="dependencies/imagesloaded/js/imagesloaded.pkgd.min.js"></script>
    <script src="dependencies/jquery.countdown/js/jquery.countdown.min.js"></script>
    <script src="dependencies/gmap3/js/gmap3.min.js"></script>
    <script src="dependencies/venobox/js/venobox.min.js"></script>
    <script src="dependencies/slick-carousel/js/slick.js"></script>
    <script src="dependencies/headroom/js/headroom.js"></script>
    <script src="dependencies/jquery-ui/js/jquery-ui.min.js"></script>
    <script src="admin/plugins/validation/jquery.validate.min.js"></script>
    <script>
        $('#sizedropdown').change(function() {
            $('#err').css("color", "white");
        })

        function cartinsertion(pid, cid) {
            if (pid != '' && cid != '' && cid != undefined) {
                getsize = $('#sizedropdown').val();
                if (getsize != null) {
                    $.ajax({
                        url: "cartinsertion.php",
                        data: {
                            productid: pid,
                            customerid: cid,
                            mode: 'insert'
                        },
                        type: 'POST',
                        success: function(response) {
                            $('#cartcount').html('<i class="fa fa-shopping-cart" aria-hidden="true"></i>' + response);
                            $('.add-to-cart').html('<i class="flaticon-shopping-purse-icon"></i>' + 'Go to Cart');
                            $('.add-to-cart').attr("href", "cart.php?customerid=<?= $customerid ?>");
                            $(".add-to-cart").prop("onclick", null).off("click");
                            alert("Added to cart");

                        }
                    });
                } else {
                    $('#err').css("color", "red");
                    $('#err').html("Please select a size");
                }
            } else if (pid != '') {
                getsize = $('#sizedropdown').val()
                if (getsize != null) {
                    $.ajax({
                        url: "visitorcartinsertion.php",
                        data: {
                            productid: pid,
                            mode: 'insert'
                        },
                        type: 'POST',
                        success: function(response) {
                            $('#cartcount').html('<i class="fa fa-shopping-cart" aria-hidden="true"></i>' + response);
                            $('.add-to-cart').html('<i class="flaticon-shopping-purse-icon"></i>' + 'Go to Cart');
                            $('.add-to-cart').attr("href", "cart.php");
                            $(".add-to-cart").prop("onclick", null).off("click");
                            alert("Added to cart");

                        }
                    });

                } else {
                    $('#err').css("color", "red");
                    $('#err').html("Please select a size");
                }
            }
        }

        var html = `<input class="color-checkbox__input" id="avail_colors" name="colour" type="radio">
                    <label class="color-checkbox" for="avail_colors" id="col-Black-label"></label>
                    <span></span>`;
        var jqueryarray = JSON.parse('<?php echo json_encode($colors); ?>');
        $.each(jqueryarray, function(index, val) {
            $('#col-' + val + '-label').css("background-color", val);
        });
    </script>
    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>

</body>



</html>