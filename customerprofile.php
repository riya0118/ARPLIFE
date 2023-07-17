<?php
require("config/dbconnect.php");
session_start();
$customerid = '';
$customerid = ((isset($_SESSION['customerid'])) ? $_SESSION['customerid'] : '');
if (isset($_SESSION['profileview']) && $_SESSION['profileview'] == 0) {
    header("location:index.php");
}else{
    session_abort();
}

?>
<!doctype html>
<html>

<!-- head-tag -->
<?php include("mainincludes/csslinks.php"); ?>

<body id="home-version-1" class="home-version-1" data-style="default">
    <div class="site-content">


        <!-- header -->
        <?php include("mainincludes/header.php") ?>


        <section class="breadcrumb-area" style="padding: 130px 0 10px;">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bc-inner">
                            <p><a href="index.php">Home |</a> YOUR PROFILE</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-area">
            <div class="container-fluid custom-container">
                <div class="section-heading pb-30">
                    <h3>Your <span> Account</span></h3>
                </div>
                <div class="row justify-content-center">
                    <!-- YOUR ACCOUNT CONTENT -->
                    <div class="col-md-8 col-lg-8 col-xl-3" style="margin-right: 10px ;border: 1px solid gray; padding: 30px; border-radius:10px ; ">
                        <div data-card-identifier="YourOrders" class="a-box ya-card--rich">
                            <div class="a-box-inner">
                                <div class="a-row">
                                    <div class="a-column a-span3">
                                        <a href="custorder.php"><img alt="Your Orders" src="order.jpeg">
                                    </div>
                                    <div class="a-column a-span9 a-span-last">
                                        <h2 class="a-spacing-none ya-card__heading--rich a-text-normal">
                                            Your Orders
                                        </h2>
                                        <div><span class="a-color-secondary">Track, return, or buy things again</span></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- YOUR ACCOUNT CONTENT END -->

                    <!-- YOUR ACCOUNT CONTENT -->
                    <div class="col-md-8 col-lg-8 col-xl-3" style="margin-right: 10px ;border: 1px solid gray; padding: 30px; border-radius:10px ; ">
                        <div data-card-identifier="YourOrders" class="a-box ya-card--rich">
                            <div class="a-box-inner">
                                <div class="a-row">
                                    <div class="a-column a-span3">
                                        <a href="signinpage.php?customerid=<?= $customerid ?>"><img alt="Login &amp; security" src="login.jpeg">
                                    </div>
                                    <div class="a-column a-span9 a-span-last">
                                        <h2 class="a-spacing-none ya-card__heading--rich a-text-normal">
                                            Login and Security
                                        </h2>
                                        <div><span class="a-color-secondary">Edit name,mobile,password,e-mail</span></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- YOUR ACCOUNT CONTENT END -->

                    <!-- YOUR ACCOUNT CONTENT -->
                    <div class="col-md-8 col-lg-8 col-xl-3" style="margin-right: 10px ;border: 1px solid gray ; padding: 30px; border-radius:10px ; ">
                        <div data-card-identifier="Youraddresses" class="a-box ya-card--rich">
                            <div class="a-box-inner">
                                <div class="a-row">
                                    <div class="a-column a-span3">
                                        <a href="address.php?customerid=<?= $customerid ?>"><img alt="Your addresses" src="addr.jfif">
                                    </div>
                                    <div class="a-column a-span9 a-span-last">
                                        <h2 class="a-spacing-none ya-card__heading--rich a-text-normal">
                                            Your Addresses
                                        </h2>
                                        <div><span class="a-color-secondary">Edit addresses for orders and gifts</span></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- YOUR ACCOUNT CONTENT END -->

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
    <script src="dependencies/jquery-ui/js/jquery-ui.min.js"></script>
    <!--Google map api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsBrMPsyNtpwKXPPpG54XwJXnyobfMAIc"></script>


    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>


</body>



</html>