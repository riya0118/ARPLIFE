<?php
require("config/dbconnect.php");
$subcategoryid = (isset($_GET["subcategoryid"]) ? intval($_GET["subcategoryid"]) : '');
$categoryid = (isset($_GET["categoryid"]) ? intval($_GET["categoryid"]) : '');
$brandid = (isset($_GET["brandid"]) ? intval($_GET["brandid"]) : '');
$gender = (isset($_GET["gender"]) ? $_GET["gender"] : '');
$setbrandid = '';
?>



<!doctype html>
<html>

<!-- head-tag -->
<?php include("mainincludes/csslinks.php"); ?>

<style>
    .customul {
        overflow: scroll;
        height: 200px;
    }

    .main-view .facets {
        width: 20%;
        min-height: 1000px;
        float: left;
        padding: 10px;
    }


    button.btn-two {
        font-size: 20px;
        color: #fff;
        background: #1d1b1b;
        padding: 13px 44px;
        border-radius: 0px;
        font-family: 'Roboto Condensed', sans-serif;
        font-weight: 700;
        margin-top: 10px;
        position: relative;
        text-transform: uppercase;
    }

    button.btn-two:hover:before {
        width: 100%;
    }

    button.btn-two:hover:after {
        width: 100%;
    }

    button.btn-two::before {
        position: absolute;
        content: '';
        width: 20px;
        height: 66px;
        top: -5px;
        left: -6px;
        border: 2px solid #1d1b1b;
        border-right: none;
        -o-transition: all 0.3s ease-in;
        -webkit-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
    }

    button.btn-two::after {
        position: absolute;
        content: '';
        width: 20px;
        height: 66px;
        top: -5px;
        right: -6px;
        border: 2px solid #1d1b1b;
        border-left: none;
        -o-transition: all 0.3s ease-in;
        -webkit-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
    }
</style>

<body id="home-version-1" class="home-version-1" data-style="default">
    <div class="site-content">


        <!-- header -->
        <?php include("mainincludes/header.php") ?>

        <!-- Breadcrumb -->
        <section class="breadcrumb-area" style="padding: 130px 0 10px;">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bc-inner">
                            <p><a href="index.php">Home |</a> Shop</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Shop Area -->
        <section class="shop-area">
            <div class="container-fluid custom-container" style="margin-right: 10px;">
                <div class=" row loadmorediv">
                    <div class="order-2 order-lg-1 col-lg-3 col-xl-3">
                        <div class=" shop-sidebar left-side">
                            <div class="sidebar-widget category-widget">

                                <div style="font-size: 30px;">
                                    <h1>Refine By</h1>
                                </div><span></span>

                                <input type="hidden" name="" id="gender" class="gender" value="<?= $gender ?>">
                                <input type="hidden" name="" id="category" class="gender" value="<?= $categoryid ?>">
                                <input type="hidden" name="" id="subcategory" class="gender" value="<?= $subcategoryid ?>">
                                <input type="hidden" name="" id="brand" class="gender" value="<?= $brandid ?>">

                                <div class="search-filter">
                                    <input type="text" id="search_box" placeholder="Search Product....">
                                    
                                </div>
                                </br>

                                <div class="categories_filter">
                                    <h6> PRODUCT CATEGORIES</h6>
                                    <?php
                                    $getcatquery = "SELECT * from category_master";
                                    $getcatresult = mysqli_query($conn, $getcatquery);
                                    if (mysqli_num_rows($getcatresult) > 0) {
                                        while ($getcat = mysqli_fetch_array($getcatresult)) {
                                            $setcat = $getcat['catm_categoryname']; ?>
                                            <ul>
                                                <li><a href="#">
                                                        <input type="checkbox" class="common_selector categories" value="<?= $getcat['catm_categoryid'] ?> "> &nbsp;
                                                        <a href="#"><?= strtoupper($getcat['catm_categoryname']) ?></a>
                                                    </a> <span></span></li>

                                            </ul>

                                    <?php }
                                    }

                                    ?>
                                </div>
                                </br>
                                <!-- </div> -->

                                <!-- <div class="sidebar-widget range-widget"> -->
                                <div class="price_filter">
                                    <h6><u>SEARCH BY PRICE</u></h6>
                                    <div class="price-range">
                                        <div id="slider-range"></div>
                                        <input type="hidden" name="" id="hidden_min_price">
                                        <input type="hidden" name="" id="hidden_max_price">
                                        <span>Price :</span>
                                        <input type="text" id="amount" readonly>
                                    </div>
                                </div>
                                </br>
                                <!-- </div> -->

                                <!-- <div class="sidebar-widget category-widget"> -->

                                <div class="brands_filter">
                                    <h6>Brands</h6>
                                    <ul class="customul">
                                        <?php
                                        if ($categoryid != '') {
                                            $getbrandquery = "SELECT DISTINCT (bm_brandname) , bm_brandid from brand_master where bm_categoryid=$categoryid ";
                                        } elseif ($subcategoryid != '') {
                                            $getbrandquery = "SELECT DISTINCT (bm_brandname) , bm_brandid from brand_master , product_master  where pm_subcategoryid=$subcategoryid and pm_brandid=bm_brandid ";
                                        } else {
                                            $getbrandquery = "SELECT  DISTINCT (bm_brandname) , bm_brandid from brand_master , product_master where bm_brandid=pm_brandid and pm_type='$gender'";
                                        }
                                        $getbrandresult = mysqli_query($conn, $getbrandquery);
                                        if (mysqli_num_rows($getbrandresult) > 0) {
                                            while ($getbrand = mysqli_fetch_array($getbrandresult)) {
                                                $setbrand = $getbrand['bm_brandname'];
                                                $setbrandid = $getbrand['bm_brandid']
                                        ?>
                                                <li><a href="#">
                                                        <input type="checkbox" class="common_selector brands" value="<?= $getbrand['bm_brandid'] ?>"> &nbsp;
                                                        <a href="#"><?= strtoupper($getbrand['bm_brandname']) ?></a>
                                                    </a> <span></span></li>


                                        <?php }
                                        }

                                        ?>
                                    </ul>

                                </div>
                                </br>
                                <!-- </div>
                                    </br>
                                <div class="sidebar-widget color-widget"> -->
                                <div class="color_filter">
                                    <h6><u>PRODUCT COLOR</u></h6>
                                    <ul>
                                        <?php
                                        if ($subcategoryid != '') {
                                            $getcolorsquery = "SELECT DISTINCT(pc_colorname) from al_productcolor , product_master where pm_productid=pc_productid and pm_subcategoryid= $subcategoryid ";
                                        } elseif ($categoryid != '') {
                                            $getcolorsquery = "SELECT DISTINCT(pc_colorname) from al_productcolor , product_master where pm_productid=pc_productid and pm_categoryid=$categoryid ";
                                        } else {
                                            $getcolorsquery = "SELECT DISTINCT(pc_colorname) from al_productcolor , product_master where pm_productid=pc_productid and pm_type='$gender'";
                                        }
                                        $getcolorresult = mysqli_query($conn, $getcolorsquery);
                                        if (mysqli_num_rows($getcolorresult) > 0) {
                                            while ($getcolors = mysqli_fetch_array($getcolorresult)) {
                                                $setcolor = $getcolors['pc_colorname']; ?>
                                                <li>

                                                    <input type="checkbox" class="common_selector color" name="color" value="<?= $setcolor ?>">
                                                    <a style="color:<?= $setcolor ?>;  " href="#">
                                                        <?= $setcolor ?>
                                                    </a>
                                                </li>
                                        <?php }
                                        }
                                        ?>
                                    </ul>
                                </div>
                                </br>

                                <div class="size_filter">
                                    <h6><u>SIZE & FIT</u></h6>
                                    <ul class="customul">

                                        <?php
                                        if ($subcategoryid != '') {
                                            $getsizequery = "SELECT DISTINCT(ps_size) from al_productsize , product_master  where pm_productid=ps_productid and pm_subcategoryid=$subcategoryid ";
                                        } elseif ($categoryid != '') {
                                            $getsizequery = "SELECT DISTINCT(ps_size) from al_productsize , product_master  where pm_productid=ps_productid and pm_categoryid=$categoryid ";
                                        } else {
                                            $getsizequery = "SELECT DISTINCT(ps_size) from al_productsize , product_master where pm_productid=ps_productid ";
                                        }

                                        $sizeres = mysqli_query($conn, $getsizequery);
                                        if (mysqli_num_rows($sizeres) > 0) {
                                            while ($getsizerow = mysqli_fetch_array($sizeres)) { ?>
                                                <li><a href="#">
                                                        <input type="checkbox" class="common_selector size" value="<?= $getsizerow['ps_size'] ?>"> &nbsp;
                                                        <a href="#"><?= $getsizerow['ps_size'] ?></option>
                                                        </a> <span></span></li>
                                        <?php  }
                                        }

                                        ?>
                                    </ul>
                                </div>
                                </br>

                                <!-- </div>


                                <div class="sidebar-widget discount-widget"> -->
                                <div class="discount_filter">
                                    <h6>Discount</h6>
                                    <?php
                                    $getdiscountquery = "SELECT * from discount_master";
                                    $getdiscountresult = mysqli_query($conn, $getdiscountquery);
                                    if (mysqli_num_rows($getdiscountresult) > 0) {
                                        while ($getdiscount = mysqli_fetch_array($getdiscountresult)) {
                                            $setdiscount = $getdiscount['dm_discountname']; ?>
                                            <ul>
                                                <li><a href="#">
                                                        <input type="checkbox" class="common_selector discount" value="<?= $getdiscount['dm_discountid'] ?>"> &nbsp;
                                                        <a href="#"><?= strtoupper($getdiscount['dm_discountname']) ?></a>
                                                    </a> <span></span></li>

                                            </ul>


                                    <?php }
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 order-lg-2 col-lg-9 col-xl-9">
                        <div class="section-heading pb-30">
                            <h3>Our <span>Products</span></h3>
                        </div>
                        <!-- Showing Products -->
                        <div class="shop-content ">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row loadmorediv filter_data">

                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.tab-pane-->
                        </div>

                    </div>
                    <!-- /.shop-content -->
                </div>
            </div>
    </div>
    </section>

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

    <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
    <script src="dependencies/jquery-ui/js/jquery-ui.min.js"></script>
    <script src="assets/js/btnloadmore.js"></script>
    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>

    <script>
        var html = `<input class="color-checkbox__input" id="avail_colors" name="colour" type="radio">
                    <label class="color-checkbox" for="avail_colors" id="col-Black-label"></label>
                    <span></span>`;
        var jqueryarray = JSON.parse('<?php echo json_encode($colors); ?>');
        $.each(jqueryarray, function(index, val) {
            $('#col-' + val + '-label').css("background-color", val);
        });
    </script>
    <script>
        $(document).change(function() {
            $('input:checkbox').each(function() {
                if ($(this).is(':checked')) {
                    filter_data();
                }

            });
        });

        function filter_data() {
            var action = 'fetch_data';
            var gen = $('#gender').val();
            var cat = $('#category').val();
            var subcat = $('#subcategory').val();
            var brandvar = $('#brand').val();
            if (cat == '') {
                cat = 0;
            }
            if (subcat == '') {
                subcat = 0;
            }
            if (brandvar == '') {
                brandvar = 0;
            }
            var categories = get_filter('categories');
            var minprice = $("#hidden_min_price").val();
            var maxprice = $('#hidden_max_price').val();
            var brands = get_filter('brands');
            var color = get_filter('color');
            var size = get_filter('size');
            var discount = get_filter('discount');
            // if (gen.length > 0 || categories.length > 0 || brands.length > 0 || color.length > 0 || size.length > 0 || discount.length > 0) {

            $.ajax({
                type: "POST",
                url: "filtered_data.php",
                data: {
                    action: action,
                    gender: gen,
                    category: cat,
                    subcategory: subcat,
                    brand: brandvar,
                    categories: categories,
                    minimum_price: minprice,
                    maximum_price: maxprice,
                    brands: brands,
                    color: color,
                    size: size,
                    discount: discount
                },
                success: function(data) {
                    $('.filter_data').html(data);
                }
            });
            // }
        }

        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }
    </script>
    <script>
        $(document).ready(function() {

            filter_data();

            $('.loadmorediv').btnLoadmore({
                showItem: 12,
                whenClickBtn: 6,
                textBtn: 'Load more',
                classBtn: 'btn-two'
            });

            $("#search_box").keyup(function() {
                var search = $(this).val();
                //  alert(search);

                if (search != '') {
                    $.ajax({
                        type: "POST",
                        url: "search_filter.php",
                        data: {
                            search: search
                        },
                        success: function(data) {
                            $('.filter_data').html(data);
                        }
                    });
                }
            });

            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 10000,
                values: [1000, 6000],
                slide: function(event, ui) {
                    $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                    $('#hidden_min_price').val(ui.values[0]);
                    $('#hidden_max_price').val(ui.values[1]);
                    filter_data();
                }
            });
            $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));

        });
    </script>

</body>

</html>