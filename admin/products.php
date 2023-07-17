<?php

require("../config/dbconnect.php");
$query = "select * from product_master ";
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
                    <li class="breadcrumb-item active"><a href="">Products</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important ">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div style="width:100% ; display:flex ;  justify-content: flex-end ; margin-bottom: 20px; ">
                                <a href="manage_products.php" data-toggle="tooltip" title="Add product" style="margin-right:4px ;" type="button" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <?php if ($rowcount > 0) { ?>
                                    <button data-toggle="tooltip" title="Delete product/s" type="button" id="product_deletebtn" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                <?php } ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="" class="checkall"></th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Category Name</th>
                                            <th>subcategory Name</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>IsActive</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($rowcount > 0) {

                                            while ($getrows = mysqli_fetch_array($res)) {
                                                $getcategory = "SELECT catm_categoryname from category_master where catm_categoryid=" . $getrows['pm_categoryid'];
                                                $getsubcategory = "SELECT sc_subcategoryname from al_subcategory where sc_subcategoryid=" . $getrows['pm_subcategoryid'];
                                                $res1 = mysqli_query($conn, $getcategory);
                                                $res2 = mysqli_query($conn, $getsubcategory);
                                                if (mysqli_num_rows($res1) > 0 && mysqli_num_rows($res2) > 0) {
                                                    $getcategory = mysqli_fetch_array($res1);
                                                    $getsubcategory = mysqli_fetch_array($res2);
                                                }
                                        ?>
                                                <tr>
                                                    <td><input type="checkbox" class="productchkbox" value="<?= $getrows['pm_productid'] ?>" id="product_chk<?= $getrows['pm_productid'] ?>"></td>
                                                    <td><img src="images/uploads/<?= $getrows['pm_image'] ?>" width="80%" height="80px"></td>
                                                    <td><?= $getrows['pm_productname'] ?></td>
                                                    <td><?= $getcategory['catm_categoryname'] ?></td>
                                                    <td><?= $getsubcategory['sc_subcategoryname'] ?></td>
                                                    <td><?= $getrows['pm_price'] ?></td>
                                                    <td><?= $getrows['pm_stock'] ?></td>
                                                    <td><?= $getrows['pm_isactive'] ?></td>
                                                    <td>
                                                        <a href="manage_products.php?productid=<?= $getrows['pm_productid'] ?>" data-toggle="tooltip" title="Edit" type="button" class="btn btn-primary">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else { ?>

                                            <tr>
                                                <td colspan="9" align="center">No Record Found</td>
                                            </tr>

                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><input type="checkbox" name="" id="bottomchkall" class="checkall"></th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Category Name</th>
                                            <th>subcategory Name</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>IsActive</th>
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
    <script>
        $(document).ready(function() {
            // ALL-CHECKBOX
            $(".checkall").click(function() {
                $(".productchkbox").attr('checked', this.checked);
                $("#bottomchkall").attr('checked', this.checked);
            });

            // DELETE-BUTTON
            $("#product_deletebtn").click(function() {
                var flag = 0;
                $(".productchkbox").each(function() {
                    if ($(this).is(":checked")) {
                        flag = 1;
                    }
                });
                if (flag == 1) {
                    if (confirm('Are you sure you want to delete?')) {
                        var product_ids = [];

                        $(".productchkbox").each(function() {
                            if ($(this).is(":checked")) {
                                product_ids.push($(this).val())
                            }
                        });

                        if (product_ids.length) {
                            $.ajax({
                                type: "POST",
                                url: "products_operation.php",
                                data: {
                                    productid: product_ids,
                                    action_method: 'delete_product'
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