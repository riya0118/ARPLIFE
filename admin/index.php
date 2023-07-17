<?php
require("../config/dbconnect.php");
// ORDER COUNT BEGINS
$forordercountquery = "SELECT count(co_orderid) as ordercount from al_customerorder ";
$ordercountresult = mysqli_query($conn, $forordercountquery);
$getordercount = mysqli_fetch_array($ordercountresult);
$ordercount = $getordercount['ordercount'];
// ORDER COUNT ENDS

// SALES SUM BEGINS 
$forsalessumquery = "SELECT sum(ts_totalamtpaid) as salessum from al_totalsales";
$salessumresult = mysqli_query($conn, $forsalessumquery);
$getsalessum = mysqli_fetch_array($salessumresult);
$salessum = intval($getsalessum['salessum']);
// SALES SUM ENDS

// CUSTOMER COUNT BEGINS
$forcustcountuery = "SELECT count(cm_customerid) as custcount from customer_master ";
$custcountresult = mysqli_query($conn, $forcustcountuery);
$getcustcount = mysqli_fetch_array($custcountresult);
$custcount = $getcustcount['custcount'];
// CUSTOMER COUNT BEGINS

//GRAPH QUERY BEGINS
$query = "SELECT catm_categoryid ,sum(co_productamount) as totalsales,catm_categoryname from category_master,product_master,al_customerorder where catm_categoryid=pm_categoryid AND co_productid=pm_productid GROUP by pm_categoryid ORDER by totalsales desc";
$result = mysqli_query($conn, $query);
$chart_data = '';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $chart_data .= "{catm_categoryname:'" . $row["catm_categoryname"] . "', totalsales:" . $row["totalsales"] . "}, ";
    }
}
$chart_data = substr($chart_data, 0, -2);
//GRAPH QUERY ENDS
$cid = '';
?>



<!DOCTYPE html>
<html lang="en">
<?php require_once("../admin/includes/constants.php"); ?>
<?php include(INCLUDESCOMP_DIR . "csslinks.php"); ?>

<body>
    <style>
        .chart-wrapper {
            background-color: white;
        }
    </style>

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
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important ">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">TOTAL ORDERS</h3>
                                <div class="d-inline-block">

                                    <h2 class="text-white"><?= $ordercount ?></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">TOTAL SALES</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?= " ₹ " . $salessum ?></h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">CUSTOMERS</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?= $custcount ?></h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-wrapper">
                        <div id="morris-bar-chart"></div>
                    </div>
                    <canvas id="chart_widget_2"></canvas>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="active-member">
                                    <div class="table-responsive">
                                        <table class="table table-xs mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Customers</th>
                                                    <th>Product</th>
                                                    <th>Country</th>
                                                    <th> Order Status</th>
                                                    <th>Activity</th>
                                                </tr>
                                            </thead>
                                            <tbody><?php
                                                    //customers
                                                    $query = "SELECT  pm_image,cm_firstname,cm_lastname,pm_productname,pm_productid,co_customerid,co_productid,cm_customerid,co_orderid from al_customerorder,product_master,customer_master where co_productid=pm_productid AND co_customerid=cm_customerid ";
                                                    $res = mysqli_query($conn, $query);
                                                    if (mysqli_num_rows($res) > 0) {
                                                        while ($getrow = mysqli_fetch_array($res)) {
                                                            $cid = $getrow['cm_customerid'];
                                                            $pimage = $getrow['pm_image'];
                                                            $orderid = $getrow['co_orderid'];


                                                            //PRODUCT 
                                                    ?>
                                                        <tr>
                                                            <td><?= $getrow['cm_firstname'];
                                                                echo " " . $getrow['cm_lastname'] ?></td>
                                                            <td><img src="../admin/images/uploads/<?= $getrow['pm_image'] ?>">&nbsp;<?= $getrow['pm_productname'] ?></td>

                                                            <?php
                                                            //COUNTRY
                                                            $countryqry = "SELECT addr_countryid,cntry_countryname from al_addresses,country_master where addr_customerid=$cid AND addr_countryid=cntry_countryid group by addr_customerid";
                                                            $countryres = mysqli_query($conn, $countryqry);
                                                            if (mysqli_num_rows($countryres) > 0) {
                                                                while ($getcountry = mysqli_fetch_array($countryres)) {
                                                            ?>
                                                                    <td><?= $getcountry['cntry_countryname'] ?></td>

                                                                    <?php
                                                                    //ORDER STATUS
                                                                    $statusqry = "SELECT co_orderstatusid from al_customerorder,product_master where co_customerid=$cid  AND co_orderid=$orderid group by co_customerid";
                                                                    $statusres = mysqli_query($conn, $statusqry);
                                                                    if (mysqli_num_rows($statusres) > 0) {
                                                                        while ($getstatus = mysqli_fetch_array($statusres)) {
                                                                            if ($getstatus['co_orderstatusid'] == 2) {
                                                                    ?>
                                                                                <td>
                                                                                    <div>
                                                                                        <div class="progress" style="height: 6px">
                                                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                                                        </div>
                                                                                        Fulfilled
                                                                                    </div>
                                                                                </td>
                                                                            <?php } else { ?>
                                                                                <td>
                                                                                    <div>
                                                                                        <div class="progress" style="height: 6px">
                                                                                            <div class="progress-bar bg-success" style="width: 50%"></div>
                                                                                        </div>
                                                                                        Pending
                                                                                    </div>
                                                                                </td>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                            <td>
                                                                                <?php
                                                                                $loginqry = "SELECT cl_loggedin from al_customerlog where cl_customerid=$cid group by cl_customerid";
                                                                                $loginres = mysqli_query($conn, $loginqry);
                                                                                if (mysqli_num_rows($loginres) > 0) {
                                                                                    while ($getlogin = mysqli_fetch_array($loginres)) {
                                                                                ?>

                                                                            <td>
                                                                                <b><span>Last Login :</span></b>
                                                                                <span class="m-0 pl-3"><?= $getlogin['cl_loggedin'] ?>
                                                                        <?php }
                                                                                }
                                                                            } ?>
                                                                            </td>

                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }


                                                        ?>
                                                        </span>
                                                        </td>
                                                        </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="active-member">
                                    <div class="table-responsive">
                                        <table class="table table-xs mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Product name</th>
                                                    <th>Available Stock</th>
                                                    <th>Refill</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $stockqry = "SELECT pm_productname,pm_stock,pm_image FROM product_master where pm_stock < 50 group by pm_productid ";
                                                $stockres = mysqli_query($conn, $stockqry);
                                                if (mysqli_num_rows($stockres) > 0) {
                                                    while ($getstockrow = mysqli_fetch_array($stockres)) {
                                                        $pstock = $getstockrow['pm_stock'];
                                                        $pname = $getstockrow['pm_productname'];
                                                        $pimage = $getstockrow['pm_image'];
                                                ?>

                                                        <tr>
                                                            <td><img src="../admin/images/uploads/<?= $pimage ?>">&nbsp; <?= $getstockrow['pm_productname'] ?></td>
                                                            <td><?= $pstock ?></td>

                                                            <td style="color: red;"><img src="../admin/images/uploads/refill.png"><b> Refill required</td></b>
                                                        </tr>

                                                <?php }
                                                } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

        </div>

        <?php




        ?>
        <div id="morris-bar-chart"></div>
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


    <!-- Chartjs -->
    <script src="./plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="./plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="./plugins/d3v3/index.js"></script>
    <script src="./plugins/topojson/topojson.min.js"></script>
    <script src="./plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="./plugins/raphael/raphael.min.js"></script>
    <script src="./plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="./plugins/moment/moment.min.js"></script>
    <script src="./plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="./plugins/chartist/js/chartist.min.js"></script>
    <script src="./plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script>
        Morris.Bar({
            element: 'morris-bar-chart',
            data: [<?= $chart_data; ?>],
            xkey: 'catm_categoryname',
            ykeys: ['totalsales'],
            labels: ['totalsales(MRP)'],



            hideHover: 'auto',

        });
    </script>


</body>

</html>