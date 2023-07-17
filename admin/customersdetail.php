<?php
require("../config/dbconnect.php");
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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Customers</a></li>
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
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Gender</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $getcustomersquery = "SELECT * from customer_master";
                                        $getresult = mysqli_query($conn, $getcustomersquery);
                                        if ($getresult) {
                                            if (mysqli_num_rows($getresult) > 0) {
                                                while ($getcustomers = mysqli_fetch_array($getresult)) {
                                                    $mobile = ((isset($getcustomers['cm_mobile'])) ? $getcustomers['cm_mobile'] : '');
                                                    $gender = ((isset($getcustomers['cm_gender'])) ? $getcustomers['cm_gender'] : '');
                                                    if($gender=='M'){
                                                        $gender='Male';
                                                    }else{
                                                        $gender='Female';
                                                    }
                                        ?>
                                                    <tr>
                                                        <td><?= $getcustomers['cm_firstname'] ?></td>
                                                        <td><?= $getcustomers['cm_lastname'] ?></td>
                                                        <td><?= $getcustomers['cm_email'] ?></td>
                                                        <?php if($mobile!=''){ ?>
                                                            <td><?= $mobile ?></td>
                                                       <?php }else{ ?>
                                                        <td>--</td>
                                                      <?php } ?>
                                                        <td><?= $gender ?></td>
                                                    </tr>
                                        <?php }
                                            }
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Gender</th>
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