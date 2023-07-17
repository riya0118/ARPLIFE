<?php
require("config/dbconnect.php");
$wishlistrowcount = '';
?>

<!doctype html>
<html>
<style>
    .acustom {
        color: red !important;
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
<!-- head-tag -->
<?php include("mainincludes/csslinks.php"); ?>


<body id="home-version-1" class="home-version-1" data-style="default">
    <div class="site-content">


        <!-- header -->
        <?php include("mainincludes/header.php") ?>
        <?php

        $customerid = '';
        $customerid = ((isset($_SESSION['customerid'])) ? $_SESSION['customerid'] : '');


        ?>
        <!--=========================-->
        <!--=        Slider         =-->
        <!--=========================-->



        <section class="slider-wrapper">
            <div class="slider-start slider-2 owl-carousel owl-theme">

                <div class="item">
                    <img src="media/images/banner/f4.jpg" alt="">
                    <div class="container-fluid custom-container slider-content">
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-8 col-md-6 offset-md-1 col-lg-6 offset-xl-2 col-xl-5 mr-auto">
                                <div class="slider-text style-two mob-align-left">
                                    <h1 class="animated fadeIn"><span>Apply coupons</span> <br>get 40%!</h1>
                                    <p class="animated fadeIn">BIGBOLD40.</p>
                                    <a class="animated fadeIn btn-two" href="shop.php?gender=F">shopping now</a>
                                </div>
                            </div>
                            <!-- Col End -->
                        </div>
                        <!-- Row End -->
                    </div>
                </div>

                <div class="item">
                    <img src="media/images/banner/f2.jpg" alt="">
                    <div class="container-fluid custom-container slider-content">
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-8 col-md-8 col-lg-6 ml-auto">
                                <div class="slider-text style-two">
                                    <h1 class="animated fadeIn"><span>Summer Sale</span> 20%!</h1>
                                    <p class="animated fadeIn">On the Widest catalogue.</p>
                                    <a class="animated fadeIn btn-two" href="#">shop now</a>
                                </div>
                            </div>
                            <!-- Col End -->
                        </div>
                        <!-- Row End -->
                    </div>
                </div>



                <div class="item">
                    <img src="media/images/banner/f1.jpg" alt="">
                    <div class="container-fluid custom-container slider-content">
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-8 col-md-8 col-lg-6 ml-auto">
                                <div class="slider-text style-two">
                                    <h1 class="animated fadeIn"><span>COUPON</span> 40%!</h1>
                                    <p class="animated fadeIn">SURAT40.</p>
                                    <a class="animated fadeIn btn-two" href="shop.php?gender=F">shopping now</a>
                                </div>
                            </div>
                            <!-- Col End -->
                        </div>
                        <!-- Row End -->
                    </div>
                </div>

            </div>
        </section>
        <!-- Slides end -->




        <!--=========================-->
        <!--= Product banner style two  =-->
        <!--=========================-->
        <section class="category-area padding-120">
            <div class="container-fluid custom-container">
                <div class="category-carousel owl-carousel owl-theme">


                    <div class="sin-category">
                        <img src="media/images/banner/2.png" height="300rem" alt="">
                        <div class="cat-name">
                            <a href="shop.php?categoryid=25&gender=F">
                                <h5>Women</h5>
                                <h5>Acces<span>sories</span></h5>
                            </a>
                        </div>
                    </div>

                    <div class="sin-category">
                        <img src="media/images/blog/p2.jpg" height="300rem" alt="">
                        <div class="cat-name">
                            <a href="shop.php?categoryid=20&gender=F">
                                <h5>Women</h5>
                                <h5>Western<span>Wear</span></h5>
                            </a>
                        </div>
                    </div>

                    <div class="sin-category">
                        <img src="media/images/product/f.jpg" height="300rem" alt="">
                        <div class="cat-name">
                            <a href="shop.php?categoryid=26&gender=M">
                                <h5>man</h5>
                                <h5>Foot<span>wear</span></h5>
                            </a>
                        </div>
                    </div>



                    <div class="sin-category">
                        <img src="media/images/product/c4.jpg" height="300rem" alt="">
                        <div class="cat-name">
                            <a href="shop.php?subcategoryid=22&gender=M">
                                <h5>watch</h5>
                                <h5>Acces<span>sories</span></h5>
                            </a>
                        </div>
                    </div>


                </div>
                <!-- .row -->
            </div>
            <!-- .container-fluid -->
        </section>

        <!--=========================-->
        <!--= Product banner style two  =-->
        <!--=========================-->


        <section class="main-product">
            <div class="container container-two">
                <div class="section-heading">
                    <h3>Welcome to <span>product</span></h3>
                </div>
                <!-- /.section-heading-->
                <div class="row">
                    <div class="col-xl-12 ">
                        <div class="pro-tab-filter style-two">
                            <ul class="pro-tab-button">
                                <li class="filter active" data-filter="*">ALL</li>
                                <li class="filter" data-filter=".two">Bags</li>
                                <li class="filter" data-filter=".three">Footwear</li>
                                <li class="filter" data-filter=".four">Ethnic Wear</li>
                            </ul>

                            <div class="grid row">
                                <!-- single product -->
                                <?php
                                $qry = "select * from product_master ";
                                $res = mysqli_query($conn, $qry);
                                $rowcount = mysqli_num_rows($res);
                                if ($rowcount > 0) {
                                    while ($row = mysqli_fetch_array($res)) {
                                        $getbrandquery = "SELECT bm_brandname from brand_master where bm_brandid=" . $row['pm_brandid'];
                                        $brandresult = mysqli_query($conn, $getbrandquery);
                                        $getbrandrow = mysqli_fetch_array($brandresult);
                                        $getbrand = $getbrandrow['bm_brandname'];
                                        $p_id = $row['pm_productid'];
                                        //CHECK FOR PRODUCT EXISTING IN WISHLIST
                                        $wishlistcheck = "SELECT * from al_wishlist where wl_productid=$p_id";
                                        $wishlistcheckresult = mysqli_query($conn, $wishlistcheck);
                                        if ($wishlistcheckresult) {
                                            $wishlistrowcount = mysqli_num_rows($wishlistcheckresult);
                                        }
                                ?>
                                        <div class=" grid-item * col-6 col-md-6  col-lg-4 col-xl-3">

                                            <div class="sin-product style-two">
                                                <a href="singleproduct.php?productid=<?= $row['pm_productid'] ?>">
                                                    <div class="pro-img">

                                                        <img src="admin/images/uploads/<?= $row['pm_image'] ?>" id="single" height="400rem">
                                                    </div>
                                                </a>

                                                <div class="mid-wrapper">
                                                    <h5 class="pro-title"><a href="javascript:void()"><?= $getbrand ?></a></h5>
                                                    <h5 class="pro-title"><a href="singleproduct.php?productid=<?= $row['pm_productid'] ?>">
                                                            <?= $row['pm_productname'] ?></a></h5>
                                                    <h5 class="pro-title"><?= ($row['pm_type'] == 'M' ? 'Male' : 'Female') ?> / <span>
                                                            &#X20B9;<?= $row['pm_price'] ?></span></h5>
                                                </div>

                                                <div class="icon-wrapper">
                                                    <?php if ($wishlistrowcount < 0 || $wishlistrowcount == '') { ?>
                                                        <div class="add-to-cart">
                                                            <input type="hidden" name="" id="flagfield" value="">
                                                            <?php if ($customerid != '') { ?>
                                                                <a class="add-to-wishlist<?= $p_id ?>" onclick="addtowishlist(<?= $p_id ?>,<?= $customerid ?>)" href="javascript:void()"><i class="flaticon-valentines-heart"></i> Add to Wishlist</a>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } else if ($wishlistrowcount > 0) { ?>
                                                        <div class="add-to-cart">
                                                            <a href="javascript:void()" class="acustom"><i class="flaticon-valentines-heart"></i> Added to Wishlist</a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>

                                <?php
                                    }
                                }
                                ?>

                            </div>
                           

                            <div class="grid row">
                                <!-- single product -->
                                <?php
                                $qry = "select * from product_master where pm_categoryid=28 ";
                                $res = mysqli_query($conn, $qry);
                                $rowcount = mysqli_num_rows($res);

                                if ($rowcount > 0) {
                                    while ($row = mysqli_fetch_array($res)) {
                                        $p_id = $row['pm_productid'];
                                        $getbrandquery = "SELECT bm_brandname from brand_master where bm_brandid=" . $row['pm_brandid'];
                                        $brandresult = mysqli_query($conn, $getbrandquery);
                                        $getbrandrow = mysqli_fetch_array($brandresult);
                                        $getbrand = $getbrandrow['bm_brandname'];
                                        //CHECK FOR PRODUCT EXISTING IN WISHLIST
                                        $wishlistcheck = "SELECT * from al_wishlist where wl_productid=$p_id";
                                        $wishlistcheckresult = mysqli_query($conn, $wishlistcheck);
                                        if ($wishlistcheckresult) {
                                            $wishlistrowcount = mysqli_num_rows($wishlistcheckresult);
                                        }
                                ?>
                                        <div class=" grid-item two col-6 col-md-6  col-lg-4 col-xl-3">

                                            <div class="sin-product style-two">
                                                <a href="singleproduct.php?productid=<?= $row['pm_productid'] ?>">
                                                    <div class="pro-img">

                                                        <img src="admin/images/uploads/<?= $row['pm_image'] ?>" id="single" height="400rem">
                                                    </div>
                                                </a>

                                                <div class="mid-wrapper">
                                                    <h5 class="pro-title"><a href="javascript:void()"><?= $getbrand ?></a></h5>
                                                    <h5 class="pro-title"><a href="singleproduct.php?productid=<?= $row['pm_productid'] ?>"><?= $row['pm_productname'] ?></a></h5>
                                                    <h5 class="pro-title"><?= ($row['pm_type'] == 'M' ? 'Male' : 'Female') ?> / <span>&nbsp; &#X20B9;<?= $row['pm_price'] ?></span></h5>
                                                </div>

                                                <div class="icon-wrapper">
                                                    <?php if ($wishlistrowcount < 0 || $wishlistrowcount == '') { ?>
                                                        <div class="add-to-cart">
                                                            <input type="hidden" name="" id="flagfield" value="">
                                                            <?php if ($customerid != '') { ?>
                                                                <a class="add-to-wishlist<?= $p_id ?>" onclick="addtowishlist(<?= $p_id ?>,<?= $customerid ?>)" href="javascript:void()"><i class="flaticon-valentines-heart"></i> Add to Wishlist</a>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } else if ($wishlistrowcount > 0) { ?>
                                                        <div class="add-to-cart">
                                                            <a href="javascript:void()" class="acustom"><i class="flaticon-valentines-heart"></i> Added to Wishlist</a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                }
                                ?>
                            </div>

                            <div class="grid row">
                                <!-- single product -->
                                <?php
                                $qry = "select * from product_master where pm_categoryid=26 ";
                                $res = mysqli_query($conn, $qry);
                                $rowcount = mysqli_num_rows($res);

                                if ($rowcount > 0) {
                                    while ($row = mysqli_fetch_array($res)) {
                                        $p_id = $row['pm_productid'];
                                        $getbrandquery = "SELECT bm_brandname from brand_master where bm_brandid=" . $row['pm_brandid'];
                                        $brandresult = mysqli_query($conn, $getbrandquery);
                                        $getbrandrow = mysqli_fetch_array($brandresult);
                                        $getbrand = $getbrandrow['bm_brandname'];
                                        //CHECK FOR PRODUCT EXISTING IN WISHLIST
                                        $wishlistcheck = "SELECT * from al_wishlist where wl_productid=$p_id";
                                        $wishlistcheckresult = mysqli_query($conn, $wishlistcheck);
                                        if ($wishlistcheckresult) {
                                            $wishlistrowcount = mysqli_num_rows($wishlistcheckresult);
                                        }
                                ?>
                                        <div class=" grid-item three col-6 col-md-6  col-lg-4 col-xl-3">

                                            <div class="sin-product style-two">
                                                <a href="singleproduct.php?productid=<?= $row['pm_productid'] ?>">
                                                    <div class="pro-img">

                                                        <img src="admin/images/uploads/<?= $row['pm_image'] ?>" id="single" height="400rem">
                                                    </div>
                                                </a>

                                                <div class="mid-wrapper">
                                                    <h5 class="pro-title"><a href="javascript:void()"><?= $getbrand ?></a></h5>
                                                    <h5 class="pro-title"><a href="singleproduct.php?productid=<?= $row['pm_productid'] ?>"><?= $row['pm_productname'] ?></a></h5>
                                                    <h5 class="pro-title"><?= ($row['pm_type'] == 'M' ? 'Male' : 'Female') ?> / <span>&nbsp; &#X20B9;<?= $row['pm_price'] ?></span></h5>
                                                </div>

                                                <div class="icon-wrapper">
                                                    <?php if ($wishlistrowcount < 0 || $wishlistrowcount == '') { ?>
                                                        <div class="add-to-cart">
                                                            <input type="hidden" name="" id="flagfield" value="">
                                                            <?php if ($customerid != '') { ?>
                                                                <a class="add-to-wishlist<?= $p_id ?>" onclick="addtowishlist(<?= $p_id ?>,<?= $customerid ?>)" href="javascript:void()"><i class="flaticon-valentines-heart"></i> Add to Wishlist</a>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } else if ($wishlistrowcount > 0) { ?>
                                                        <div class="add-to-cart">
                                                            <a href="javascript:void()" class="acustom"><i class="flaticon-valentines-heart"></i> Added to Wishlist</a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                }
                                ?>
                            </div>


                            <div class="grid row">
                                <!-- single product -->
                                <?php
                                $qry = "select * from product_master where pm_categoryid=11 ";
                                $res = mysqli_query($conn, $qry);
                                $rowcount = mysqli_num_rows($res);

                                if ($rowcount > 0) {
                                    while ($row = mysqli_fetch_array($res)) {
                                        $p_id = $row['pm_productid'];
                                        $getbrandquery = "SELECT bm_brandname from brand_master where bm_brandid=" . $row['pm_brandid'];
                                        $brandresult = mysqli_query($conn, $getbrandquery);
                                        $getbrandrow = mysqli_fetch_array($brandresult);
                                        $getbrand = $getbrandrow['bm_brandname'];
                                        //CHECK FOR PRODUCT EXISTING IN WISHLIST
                                        $wishlistcheck = "SELECT * from al_wishlist where wl_productid=$p_id";
                                        $wishlistcheckresult = mysqli_query($conn, $wishlistcheck);
                                        if ($wishlistcheckresult) {
                                            $wishlistrowcount = mysqli_num_rows($wishlistcheckresult);
                                        }
                                ?>
                                        <div class=" grid-item four col-6 col-md-6  col-lg-4 col-xl-3">

                                            <div class="sin-product style-two">
                                                <a href="singleproduct.php?productid=<?= $row['pm_productid'] ?>">
                                                    <div class="pro-img">

                                                        <img src="admin/images/uploads/<?= $row['pm_image'] ?>" id="single" height="400rem">
                                                    </div>
                                                </a>

                                                <div class="mid-wrapper">
                                                    <h5 class="pro-title"><a href="javascript:void()"><?= $getbrand ?></a></h5>
                                                    <h5 class="pro-title"><a href="singleproduct.php?productid=<?= $row['pm_productid'] ?>"><?= $row['pm_productname'] ?></a></h5>
                                                    <h5 class="pro-title"><?= ($row['pm_type'] == 'M' ? 'Male' : 'Female') ?> / <span>&nbsp; &#X20B9;<?= $row['pm_price'] ?></span></h5>
                                                </div>

                                                <div class="icon-wrapper">
                                                    <?php if ($wishlistrowcount < 0 || $wishlistrowcount == '') { ?>
                                                        <div class="add-to-cart">
                                                            <input type="hidden" name="" id="flagfield" value="">
                                                            <?php if ($customerid != '') { ?>
                                                                <a class="add-to-wishlist<?= $p_id ?>" onclick="addtowishlist(<?= $p_id ?>,<?= $customerid ?>)" href="javascript:void()"><i class="flaticon-valentines-heart"></i> Add to Wishlist</a>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } else if ($wishlistrowcount > 0) { ?>
                                                        <div class="add-to-cart">
                                                            <a href="javascript:void()" class="acustom"><i class="flaticon-valentines-heart"></i> Added to Wishlist</a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Row End -->
            </div>

            <!-- Container -->
        </section>
        <!-- main-product -->

        <!--=========================-->
        <!--=   Subscribe area      =-->
        <!--=========================-->

        <section class="subscribe-area style-two">
            <div class="container container-two">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="subscribe-text">
                            <h6>Join our newsletter</h6>
                        </div>
                    </div>
                    <!-- col-xl-6 -->

                    <div class="col-lg-7">
                        <div class="subscribe-wrapper">
                            <input placeholder="Enter Keyword" type="text">
                            <button type="submit">SUBSCRIBE</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-two -->
        </section>
        <!-- subscribe-area -->


        <!-- footer -->
        <?php include("mainincludes/footer.php"); ?>


        <!-- Back to top-->

        <?php include("mainincludes/backtotop.php"); ?>


        <!-- Popup -->

        <?php // include("mainincludes/popup.php"); 
        ?>


    </div>
    <!-- /#site -->
    <script src="assets/js/btnloadmore.js"></script>

    <script>
        $(document).ready(function() {
            $('.loadmorediv').btnLoadmore({
                showItem: 6,
                whenClickBtn: 6,
                textBtn: 'Load more',
                classBtn: 'btn-two'
            });
        })
        

        function addtowishlist(pid, cid) {
            if (pid != '' && cid != '') {
                $.ajax({
                    url: "wishlistinsert.php",
                    data: {
                        customerid: cid,
                        productid: pid,
                        mode: 'insert'
                    },
                    type: 'POST',
                    success: function(response) {
                        if (response == 'success') {
                            $('.add-to-wishlist' + pid).html('<i class="flaticon-valentines-heart"></i>' + 'Added to Wishlist');
                            $('.add-to-wishlist' + pid).toggleClass('acustom');
                        }
                    }
                });
            }
        }
    </script>

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
    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>

</body>



</html>