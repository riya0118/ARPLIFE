<?php
require("../config/dbconnect.php");
$catid = (isset($_GET["categoryid"]) ? intval($_GET["categoryid"]) : '');
$category_method = (isset($_GET["categoryid"]) ? 'edit' : 'add');
$setcatname = $setdesc =  $setstatus = '';
if ($catid != '') {
    $getcategory = "select * from category_master where catm_categoryid=$catid ";
    $res = mysqli_query($conn, $getcategory);
    if (mysqli_num_rows($res) > 0) {
        $getrow = mysqli_fetch_array($res);
        $setcatname = $getrow['catm_categoryname'];
        $setdesc = $getrow['catm_description'];
        $setstatus = $getrow['catm_isactive'];
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
                    <li class="breadcrumb-item active"><a href="">Manage Category</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important; height: 830px ;">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-validation">
                                    <form class="frm_managecat" method="POST" action="categories_operation.php">

                                        <!-- HIDDEN FIELD FOR CATEGORYID -->
                                        <input type="hidden" name="categoryid" value="<?php echo $catid ?>">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Category Name</label>
                                                <input type="text" name="categoryname" value="<?php echo $setcatname ?>" id="categoryname" class="customtext">
                                                <p class="error"></p>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <label>Description:</label>
                                                    <textarea class="customtext h-150px" rows="6" cols="50" name="category_description" id="desc"><?php echo $setdesc ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Status</label>
                                                <select id="inputstatus" name="status" class="form-control">
                                                    <?php
                                                    if ($setstatus == null) { ?>
                                                        <option value="" selected disabled>Choose...</option>
                                                        <option value="1">Enabled</option>
                                                        <option value="0">Disabled</option>
                                                    <?php } else if ($setstatus == 1) { ?>
                                                        <option value="" disabled>Choose...</option>
                                                        <option selected value="1">Enabled</option>
                                                        <option value="0">Disabled</option>
                                                    <?php } else if ($setstatus == 0) { ?>
                                                        <option value="" disabled>Choose...</option>
                                                        <option value="1">Enabled</option>
                                                        <option selected value="0">Disabled</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if ($category_method == 'add') { ?>
                                            <button type="submit" id="addcategorybtn" name="addcategoriesbtn" class="btn btn-dark">Add</button>
                                        <?php } else if ($category_method == 'edit') { ?>
                                            <button type="submit" id="editcategoriesbtn" name="editcategoriesbtn" class="btn btn-dark">Edit</button>
                                        <?php } ?>
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
    <script src="<?php echo PLUGINS_DIR ?>validation/jquery.validate.min.js"></script>
    <script>
        //jquery add validation
        $(document).ready(function() {
            $("#addcategorybtn").click(function() {
                // e.preventDefault();
                jQuery(".frm_managecat").validate({
                    rules: {
                        categoryname: 'required',
                        status: 'required'
                    },
                    messages: {
                        categoryname: 'Category Name is required',
                        status: 'Status is required'
                    },
                    highlight: function(element) {
                        $(element).last().addClass('error')
                    },
                    unhighlight: function(element) {
                        $(element).last().removeClass('error')
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            });
        });

        //jquery edit validation
        $(document).ready(function() {
            $("#editcategoriesbtn").click(function() {
                // e.preventDefault();
                jQuery(".frm_managecat").validate({
                    rules: {
                        categoryname: 'required',
                        status: 'required'
                    },
                    messages: {
                        categoryname: 'Category Name is required',
                        status: 'Status is required'
                    },
                    highlight: function(element) {
                        $(element).last().addClass('error')
                    },
                    unhighlight: function(element) {
                        $(element).last().removeClass('error')
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>