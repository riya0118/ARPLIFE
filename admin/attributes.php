<?php

require("../config/dbconnect.php");
$query = "SELECT * from attributes_master, al_productattribute, product_master where pa_attributeid=am_attributeid and pm_productid=pa_productid";
$res = mysqli_query($conn, $query);
$rowcount = mysqli_num_rows($res);
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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Attributes</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important ">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- <button data-toggle="tooltip" title="Add Attribute" style="margin-right:4px ;" type="button" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>

                                </button>
                                <button data-toggle="tooltip" title="Delete Attribute/s" type="button" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>

                                </button> -->

                            <div style="width:100% ; display:flex ;  justify-content: flex-end ; margin-bottom: 20px; ">
                                <a href="manage_attributes.php" data-toggle="tooltip" title="Add Attribute" style="margin-right:4px ;" type="button" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <?php if ($rowcount > 0) { ?>
                                    <button data-toggle="tooltip" title="Delete product/s" type="button" id="attribute_deletebtn" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                <?php } ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="checkall" name="" id="checkall"></th>
                                            <th scope="col">Product ID</th>
                                            <th scope="col">Attribute Name</th>
                                            <th scope="col">Value</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if ($rowcount > 0) {
                                            while ($getrows = mysqli_fetch_array($res)) { ?>
                                                <tr>
                                                    <td><input type="checkbox" class="attributeboxes" value="<?= $getrows['pa_productattributeid'] ?>" id="chk_attribute<?= $getrows['pa_productattributeid'] ?>"></td>
                                                    <td><?= $getrows['pm_productid'] ?></td>
                                                    <td><?= $getrows['am_attributename'] ?></td>
                                                    <td><?= $getrows['pa_value'] ?> </td>
                                                    <td>
                                                        <a href="manage_attributes.php?productattributeid=<?= $getrows['pa_productattributeid'] ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
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
    <script>
        $(document).ready(function() {
            // ALL-CHECKBOX
            $("#checkall").click(function() {
                $(".attributeboxes").attr('checked', this.checked);
            });


            // DELETE-BUTTON
            $("#attribute_deletebtn").click(function() {
                var flag = 0;
                $(".attributeboxes").each(function() {
                    if ($(this).is(":checked")) {
                        flag = 1;
                    }
                });
                if (flag == 1) {
                    if (confirm('Are you sure you want to delete?')) {
                        var attribute_ids = [];

                        $(".attributeboxes").each(function() {
                            if ($(this).is(":checked")) {
                                attribute_ids.push($(this).val())
                            }
                        });

                        if (attribute_ids.length) {
                            $.ajax({
                                type: "POST",
                                url: "attributes_operation.php",
                                data: {
                                    attributeid: attribute_ids,
                                    action_method: 'delete_attribute'
                                },
                                success: function(response) {

                                    if (response == 'success') {
                                        alert("record/s deleted successfully");
                                        location.reload();
                                    } else {
                                        alert("Delete Operation Failed");
                                    }
                                }
                            });
                        }
                    }
                } else {
                    alert("Please Select a record !");
                }


            });


        });
    </script>
</body>

</html>