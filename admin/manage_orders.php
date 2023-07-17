<?php
require("../config/dbconnect.php");
$orderid = ((isset($_GET['orderid'])) ? $_GET['orderid'] : '');
if ($orderid != '') {
    $getorderquery = "SELECT * from al_customerorder where co_orderid=$orderid ";
    $res = mysqli_query($conn, $getorderquery);
    if (mysqli_num_rows($res) > 0) {
        $getrow = mysqli_fetch_array($res);
        $orderstatusid = $getrow['co_orderstatusid'];
    }
}
?>

<style>
    .error {
        color: #F00;
        background-color: #FFF;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<?php require_once("../admin/includes/constants.php"); ?>
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
            <div class="row page-titles mx-0" style="background-color:lavender;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo BASE_DIR . 'index.php' ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="">Manage Orders</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important; height: 830px ;">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-validation">
                                    <form method="POST" action="orders_operation.php">

                                        <!-- HIDDEN FIELD FOR ATTRIBUTEID -->
                                        <input type="hidden" name="orderid" value="<?php echo $orderid ?>">

                                        <div class="form-row">
                                            <label class="col-lg-4 col-form-label" for="status">Order Status
                                            </label>
                                            <div class="form-group col-md-4">
                                                <select id="" name="orderstatus" class="form-control">
                                                    <option disabled value="">Order Status</option>
                                                    <?php
                                                    $statusmaster = "SELECT * from orderstatus_master";
                                                    $getres = mysqli_query($conn, $statusmaster);
                                                    if (mysqli_num_rows($getres) > 0) {
                                                        while ($getstatusrow = mysqli_fetch_array($getres)) {
                                                            if ($getstatusrow['os_orderstatusid'] == $orderstatusid) { ?>
                                                                <option selected value="<?= $getstatusrow['os_orderstatusid'] ?>"><?= $getstatusrow['os_orderstatus'] ?></option>
                                                    <?php }else{ ?>
                                                        <option  value="<?= $getstatusrow['os_orderstatusid'] ?>"><?= $getstatusrow['os_orderstatus'] ?></option>
                                                   <?php }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" name="orders_editbtn" class="btn btn-dark">Edit</button>
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
</body>

</html>