<?php
require("config/dbconnect.php");
session_start();
if (isset($_SESSION['profileview']) && $_SESSION['profileview'] == 0) {
    header("location:index.php");
}else{
    session_abort();
}
$customerid = $orderid = $orderstatus = $paymentid = $date = '';
$orderid=((isset($_GET['orderid'])) ? $_GET['orderid'] : '');
?>

<!doctype html>
<html>
<style>
    .container {
        box-shadow: 3px 3px 8px darkgrey;
        background-color: whitesmoke;
        padding: 30px;
        display: flex;
        flex-direction: row;
        justify-content: start;
        height: 360px;
    }

    .items {
        display: flex;
        flex-direction: column;
        padding-left: 70px;
        justify-content: space-between;
    }

    .items span {
        font-size: larger;
        padding-right: 15px;
    }

    .items label {
        font-size: large;
    }

    .items a {
        color: black;
    }

    #customorder {
        top: 30px;
        color: black;
        left: 300px;
        position: absolute;
        font-size: 20px;

    }

    #customorder1 {
        top: 65px;
        color: black;
        left: 300px;
        position: absolute;
        font-size: 20px;

    }

    #customtext:hover {
        font-style: oblique;
        text-decoration: underline;
        color: darkslateblue;
    }
</style>
<!-- head-tag -->
<?php include("mainincludes/csslinks.php"); ?>

<!-- header -->


<body id="home-version-1" class="home-version-1" data-style="default">


    <div class="site-content">
        <?php include("mainincludes/header.php"); ?>


        <section class="breadcrumb-area" style="padding: 130px 0 10px;">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bc-inner">
                            <p><a href="index.php">Home |</a> Order History</p>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <div class="container-fluid custom-container">
            <div class="section-heading pb-30">
                <h3>Order <span>Details</span></h3>
            </div>
            <div class="col-xl-12">
                <div class="account-table">
                    <?php
                    $customerid = ((isset($_SESSION['customerid'])) ? $_SESSION['customerid'] : '');
                    $custquery = "SELECT * from al_customerorder where co_orderid=$orderid ";
                    $res = mysqli_query($conn, $custquery);
                    if (mysqli_num_rows($res) > 0) {
                        while ($getrow = mysqli_fetch_array($res)) {
                            $date = $getrow['co_orderdate'];
                            $price = $getrow['co_productamount'];
                            $status = $getrow['co_orderstatusid'];
                            $disc = $getrow['co_discountamount'];
                            $paid = $getrow['co_amountpaid'];
                            if ($status == 1) {
                                $orderstatus = 'Pending';
                            } else if ($status == 2) {
                                $orderstatus = 'Fulfilled';
                            }
                        }
                    }

                    ?>

                </div>
                <!-- /.cart-table -->
            </div>
            <div class="col-xl-12">
                <?php
                $productid = ((isset($_GET['productid'])) ? $_GET['productid']  : '');
                $productqry = "SELECT * from product_master where pm_productid=$productid";
                $pres = mysqli_query($conn, $productqry);

                if (mysqli_num_rows($pres) > 0) {
                    while ($prow = mysqli_fetch_array($pres)) {

                ?>
                        <div class="container">
                            <div class="imageitem">
                                <a href="singleproduct.php?productid=<?= $prow['pm_productid'] ?>"><img src="admin/images/uploads/<?= $prow['pm_image'] ?>" id="single" height="300rem"></a>
                            </div>
                            <div class="items">
                                <div>
                                    <a href="javascript:void()">
                                        <span>PRODUCT:</span><label><?= $prow['pm_productname'] ?></label>
                                    </a>
                                </div>
                                <div>
                                    <a href="javascript:void()">
                                        <span>ORDER STATUS:</span><label><?= $orderstatus ?></label>
                                    </a>

                                </div>
                                <div>
                                    <a href="javascript:void()">
                                        <span>PRICE:</span>&#X20B9; <label><?= $price ?></label>
                                    </a>

                                </div>
                                <div>

                                    <a href="javascript:void()">
                                        <span>DISCOUNT RECEIVED:</span>&#X20B9; <label><?= $disc ?></label>
                                    </a>
                                </div>
                                <div>
                                    <a href="javascript:void()">
                                        <span>AMOUNT PAID:</span>&#X20B9; <label><?= $paid ?></label>
                                    </a>
                                </div>
                                <div>
                                    <a href="javascript:void()">
                                        <span>ORDER DATE:</span><label><?= $date ?></label>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php }
                }


                ?>

            </div>

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