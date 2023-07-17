<?php
require("../config/dbconnect.php");
$orderid = ((isset($_GET['orderid'])) ? $_GET['orderid'] : '');
$productid = ((isset($_GET['productid'])) ? $_GET['productid'] : '');
// echo $orderid;
?>

<style>
    .container {
        box-shadow: 3px 3px 8px darkgrey;
        background-color: whitesmoke;
        padding-bottom: 25px;
        display: flex;
        flex-direction: row;
        justify-content: start;
        height: 360px;
    }

    #single {
        padding-top: 40px;
    }

    .items {
        display: flex;
        flex-direction: column;
        padding-left: 50px;
        justify-content: space-between;
    }

    .items span {
        font-size: larger;
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

    .section-heading {
        text-align: center;
    }

    .section-heading h3 {
        font-size: 26px;
        font-family: 'Work Sans', sans-serif;
        font-weight: 700;
        color: #d19e66;
        text-transform: uppercase;
        padding-bottom: 50px;
        position: relative;
        line-height: 26px;
    }

    .section-heading h3 span {
        color: #3f3f3f;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<?php require_once("includes/constants.php"); ?>
<?php include(INCLUDESCOMP_DIR . "csslinks.php"); ?>

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

        <?php include(INCLUDESCOMP_DIR . "header.php"); ?>
        <?php include(INCLUDESCOMP_DIR . "logo.php"); ?>
        <?php include(INCLUDESCOMP_DIR . "sidebar.php"); ?>

        <div class="content-body">
            <div class="row page-titles mx-0" style="background-color:lavender;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo BASE_DIR . 'index.php' ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Order Quickview</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important ">
                <div class="section-heading pb-30">
                    <h3>Order <span>Details</span></h3>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="account-table">
                                <?php
                                $custquery = "SELECT * from al_customerorder, product_master where co_productid=pm_productid and pm_productid=$productid and co_orderid=$orderid";
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

                                        // $productqry = "SELECT * from product_master, al_customerorder where co_productid=pm_productid and pm_productid=$productid";
                                        // $pres = mysqli_query($conn, $productqry);

                                        // if (mysqli_num_rows($pres) > 0) {
                                        //     while ($prow = mysqli_fetch_array($pres)) {

                                ?>
                                        <div class="container">
                                            <div class="imageitem">
                                                <img src="images/uploads/<?= $getrow['pm_image'] ?>" id="single" height="300rem">

                                            </div>
                                            <div class="items">
                                                <div>
                                                    <a href="javascript:void()">
                                                        <span>PRODUCT:</span><label><?= $getrow['pm_productname'] ?></label>
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
    <?php include(INCLUDESCOMP_DIR . "footer.php"); ?>
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
    <script src="js/styleSwitcher.js"></script>
    <!-- Circle progress -->
    <script src="./plugins/circle-progress/circle-progress.min.js"></script>
    <script src="./js/dashboard/dashboard-1.js"></script>

</body>

</html>