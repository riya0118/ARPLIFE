<?php

require("../config/dbconnect.php");
$query = "SELECT * FROM al_subcategory, category_master WHERE sc_categoryid=catm_categoryid";
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
                    <li class="breadcrumb-item active"><a href="">Sub Categories</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important ">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div style="width:100% ; display:flex ;  justify-content: flex-end ; margin-bottom: 20px; ">
                                <a href="managesubcategories.php" data-toggle="tooltip" title="Add SubCategory" style="margin-right:4px ;" type="button" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <?php if ($rowcount > 0) { ?>
                                    <button data-toggle="tooltip" id="subcat_deletebtn" title="Delete SubCategory/ies" type="button" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>

                                    </button>
                                <?php } ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="checkall" id="checkall"></th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Sub Category</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">IsActive</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($rowcount > 0) {
                                            while ($getrows = mysqli_fetch_array($res)) { ?>
                                                <tr>
                                                    <td><input type="checkbox" class="subcatboxes" value="<?= $getrows['sc_subcategoryid'] ?>" id="chk_cat<?= $getrows['sc_subcategoryid'] ?>"></td>
                                                    <td><?= $getrows['catm_categoryname'] ?></td>
                                                    <td><?= $getrows['sc_subcategoryname'] ?></td>
                                                    <td><?= $getrows['sc_gender'] ?></td>
                                                    <td><?= $getrows['sc_isactive'] ?></td>
                                                    <td>
                                                        <a href="managesubcategories.php?subcategoryid=<?= $getrows['sc_subcategoryid'] ?>" data-toggle="tooltip" title="Edit" type="button" class="btn btn-primary">
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
                $(".subcatboxes").attr('checked', this.checked);
            });


            // DELETE-BUTTON
            $("#subcat_deletebtn").click(function() {
                var flag = 0;
                $(".subcatboxes").each(function() {
                    if ($(this).is(":checked")) {
                        flag = 1;
                    }
                });
                if (flag == 1) {
                    if (confirm('Are you sure you want to delete?')) {
                        var subcategory_ids = [];

                        $(".subcatboxes").each(function() {
                            if ($(this).is(":checked")) {
                                subcategory_ids.push($(this).val())
                            }
                        });

                        if (subcategory_ids.length) {
                            $.ajax({
                                type: "POST",
                                url: "subcategories_operation.php",
                                data: {
                                    subcategoryid: subcategory_ids,
                                    action_method: 'delete_subcategory'
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