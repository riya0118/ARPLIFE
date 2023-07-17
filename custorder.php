<?php
require("config/dbconnect.php");
session_start();
if (isset($_SESSION['profileview']) && $_SESSION['profileview'] == 0) {
    header("location:index.php");
}else{
    session_abort();
}
$customerid = $orderid = $paymentid = $date = '';
?>

<!doctype html>
<html>
<style>
    #customcolor {
        height: 50%;
        width: 60%;
        padding: 10px;
    }

    #customcolor:hover {
        background: black;
        border-radius: 6px;
        color: white;
        height: 50%;
        width: 60%;
        padding: 10px;
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
                            <p><a href="index.php">Home |</a> ORDER HISTORY</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="col-xl-12">
            <div class="account-table">
                <div class="container-fluid custom-container">
                    <div class="section-heading pb-30">
                        <h3>Order <span>History</span></h3>
                    </div>
                    <table class="tables">
                        <thead>
                            <tr>
                                <th>OrderID</th>
                                <th>Image</th>
                                <th>Product name </th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Order Status</th>
                                <th>Quick view</th>
                            </tr>
                        </thead>
                        <?php
                        $customerid = ((isset($_SESSION['customerid'])) ? $_SESSION['customerid'] : '');
                        $custquery = "select * from al_customerorder where co_customerid=$customerid";
                        $res = mysqli_query($conn, $custquery);
                        if (mysqli_num_rows($res) > 0) {
                            while ($getrow = mysqli_fetch_array($res)) {
                                $orderid = $getrow['co_orderid'];
                                $date = $getrow['co_orderdate'];
                                $pid = $getrow['co_productid'];
                                $status = $getrow['co_paymentstatus'];
                                $price = $getrow['co_amountpaid']

                        ?>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="#"><?= $orderid ?></a>
                                        </td>
                                        <?php
                                        $productqry = "select * from product_master where pm_productid=$pid";
                                        $pres = mysqli_query($conn, $productqry);
                                        if (mysqli_num_rows($pres) > 0) {
                                            while ($prow = mysqli_fetch_array($pres)) {
                                        ?>
                                                <td>
                                                    <a href="singleproduct.php?productid=<?= $prow['pm_productid'] ?>"><img src="admin/images/uploads/<?= $prow['pm_image'] ?>" id="single" height="200rem"></a>
                                                </td>

                                                <td>
                                                    <a id="customtext" href="singleproduct.php?productid=<?= $prow['pm_productid'] ?>"><?= $prow['pm_productname'] ?></a>
                                                </td>

                                                <td>
                                                    &#X20B9; <?= $price; ?>
                                                </td>
                                                <td>
                                                    <?= $date ?>
                                                </td>
                                                <td>
                                                <?= $status ?>
                                                </td>
                                                <td>
                                                    <a href="ordersummary.php?productid=<?= $prow['pm_productid'] ?>&orderid=<?= $orderid ?>" id="customcolor">view order</a>
                                                </td>
                                        <?php  }
                                        }
                                        ?>
                                        <!-- /.single product  -->
                                </tbody>
                        <?php
                            }
                        }
                        ?>
                        </tr>
                    </table>

                </div>
                <!-- /.cart-table -->
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