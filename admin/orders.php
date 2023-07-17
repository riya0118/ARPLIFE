<?php
require("../config/dbconnect.php");
$getordersquery = "SELECT * from al_customerorder , orderstatus_master where co_orderstatusid=os_orderstatusid";
$orderres = mysqli_query($conn, $getordersquery);
?>
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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Order List</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important ">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>OrderID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Order Status</th>
                                            <th>Amount Paid</th>
                                            <th>Order Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($orderres) > 0) {
                                            while ($getorders = mysqli_fetch_array($orderres)) {
                                                $getcust = "SELECT * from customer_master where cm_customerid=" . $getorders['co_customerid'];
                                                $custres = mysqli_query($conn, $getcust);
                                                if ($custres) {
                                                    if (mysqli_num_rows($custres) > 0) {
                                                        $getcustdata = mysqli_fetch_array($custres);
                                                        $firstname = $getcustdata['cm_firstname'];
                                                        $lastname = $getcustdata['cm_lastname'];
                                                    }
                                                } ?>
                                                <tr>
                                                    <td><?= $getorders['co_orderid'] ?></td>
                                                    <td><?= $firstname ?></td>
                                                    <td><?= $lastname ?></td>
                                                    <td><?= $getorders['os_orderstatus'] ?></td>
                                                    <td>&#X20B9; <?= $getorders['co_amountpaid'] ?></td>
                                                    <td><?= $getorders['co_orderdate'] ?></td>
                                                    <td>
                                                        <a href="manage_orders.php?orderid=<?= $getorders['co_orderid'] ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="orderquickview.php?orderid=<?= $getorders['co_orderid'] ?>&productid=<?= $getorders['co_productid']?>" data-toggle="tooltip" title="View Order" class="btn btn-primary">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>OrderID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Order Status</th>
                                            <th>Amount Paid</th>
                                            <th>Order Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
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
    <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
</body>

</html>