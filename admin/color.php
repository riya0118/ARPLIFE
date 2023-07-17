<?php

require("../config/dbconnect.php");
$query = "select * from al_productcolor , product_master where pm_productid=pc_productid";
$res = mysqli_query($conn, $query);
$rowcount = mysqli_num_rows($res);

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("../admin/includes/constants.php"); ?>
<?php include(INCLUDESCOMP_DIR."csslinks.php"); ?>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <?php include(INCLUDESCOMP_DIR."preloader.php"); ?>
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
        <?php include(INCLUDESCOMP_DIR."logo.php"); ?>
        <!--**********************************
            Logo end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
        <?php include(INCLUDESCOMP_DIR."header.php"); ?>
        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include(INCLUDESCOMP_DIR."sidebar.php"); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
         <div class="content-body" >
         <div class="row page-titles mx-0" style="background-color:lavender;" >
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_DIR.'index.php' ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Color</a></li>
                    </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3"   style="background-color:lavender ; margin-top:0px !important ">
            <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">IsActive</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    if ($rowcount > 0) {
                                        while ($getrows = mysqli_fetch_array($res)) { ?>
                                            <tr>
                                                <td><?= $getrows['pm_productname'] ?></td>
                                                <td><?= $getrows['pc_colorname'] ?></td>
                                                <td><?= $getrows['pc_isactive'] ?></td>
                                            </tr>
                                        <?php
                                        }
                                    } else { ?>

                                        <tr>
                                            <td colspan="5" align="center">No Record Found</td>
                                        </tr>
                                    
                                    <?php
                                    }
                                    ?>

</tbody>
                                    </tbody>
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
        <?php include(INCLUDESCOMP_DIR."footer.php"); ?>
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
        <script src="./js/plugins-init/form-pickers-init.js"></script>
</body>

</html>