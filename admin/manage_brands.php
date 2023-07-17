<?php
require("../config/dbconnect.php");
$brandid = (isset($_GET["brandid"]) ? intval($_GET["brandid"]) : '');
$brand_method = (isset($_GET["brandid"]) ? 'edit' : 'add');
$setbrandname = $setstatus = $setcategory = $setgender = '';
if ($brandid != '' && $brand_method == 'edit') {
    $query = "SELECT * from brand_master , category_master where bm_categoryid=catm_categoryid and bm_brandid=$brandid ";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        $getrow = mysqli_fetch_array($res);
        $setcategory = $getrow['catm_categoryid'];
        $setbrandname = $getrow['bm_brandname'];
        $setstatus = $getrow['bm_isactive'];
        $setgender= $getrow['bm_gender'];
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
                    <li class="breadcrumb-item active"><a href="">Manage Brand</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important; height: 830px ;">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-validation">
                                    <form class="managebrand_frm" method="POST" action="brands_operation.php">

                                        <!-- HIDDEN FIELD FOR BRANDID -->
                                        <input type="hidden" name="brandid" value="<?php echo $brandid ?>">

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Category</label>
                                                <select id="brandcategory" name="brand_category" class="form-control">
                                                    <option selected disabled>Choose...</option>
                                                    <?php
                                                    if ($brand_method != '') {
                                                        $query = "SELECT * FROM  category_master ";
                                                        $result = mysqli_query($conn, $query);
                                                        $rowcount = mysqli_num_rows($result);
                                                    }
                                                    while ($getcat = mysqli_fetch_array($result)) {
                                                        if ($brand_method == 'edit' && $setcategory == $getcat['catm_categoryid']) {
                                                    ?>
                                                            <option value="<?= $getcat['catm_categoryid'] ?>" selected><?= $getcat['catm_categoryname'] ?></option>
                                                        <?php    } else { ?>
                                                            <option value="<?= $getcat['catm_categoryid'] ?>"><?= $getcat['catm_categoryname'] ?></option>
                                                    <?php   }
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Brand Name</label>
                                                <input type="text" name="brandname" value="<?php echo $setbrandname ?>" id="brandname" class="customtext">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Gender</label>
                                            <select id="" name="gender" class="form-control">
                                                <?php
                                                if ($setgender == '') { ?>
                                                    <option value="" selected disabled>Choose...</option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                    <option value="B">Both</option>
                                                <?php } else if ($setgender == 'm' || $setgender == 'M' ) { ?>
                                                    <option value="M" selected>Male</option>
                                                    <option value="F">Female</option>
                                                    <option value="B">Both</option>
                                                <?php } else if ($setgender == 'f' || $setgender == 'F' ) { ?>
                                                    
                                                    <option value="M">Male</option>
                                                    <option value="F" selected>Female</option>
                                                    <option value="B">Both</option>
                                                <?php } else if ($setgender == 'b' ||$setgender == 'B' ) { ?>
                                                    
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                    <option value="B" selected>Both</option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Status</label>
                                                <select id="brandstatus" name="status" class="form-control">
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
                                        <?php if ($brand_method == 'add') { ?>
                                            <button type="submit" id="brand_addbtn" name="brand_addbtn" class="btn btn-dark">Add</button>
                                        <?php } else if ($brand_method == 'edit') { ?>
                                            <button type="submit" id="brand_editbtn" name="brand_editbtn" class="btn btn-dark">Edit</button>
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
            $("#brand_addbtn").click(function() {

                // e.preventDefault();
                jQuery(".managebrand_frm").validate({
                    rules: {
                        brandname: 'required',
                        gender: 'required',
                        status: 'required',
                        brand_category: 'required'
                    },
                    messages: {
                        brandname: 'Brand Name is required',
                        status: 'Status is required',
                        gender: 'Choose a gender',
                        brand_category:'Choose the category'
                    },
                    highlight: function(element) {
                        $(element).last().addClass('error')
                    },
                    unhighlight: function(element) {
                        $(element).last().removeClass('error')
                    },

                });
            });
        });

        //jquery edit validation
        $(document).ready(function() {
            $("#brand_editbtn").click(function() {
                // e.preventDefault();
                jQuery(".managebrand_frm").validate({
                    rules: {
                        brandname: 'required',
                        status: 'required',
                        gender: 'required',
                        brand_category: 'required'
                    },
                    messages: {
                        brandname: 'Brand Name is required',
                        status: 'Status is required',
                        brand_category:'Choose the category',
                        gender: 'Choose a gender'

                    },
                    highlight: function(element) {
                        $(element).last().addClass('error')
                    },
                    unhighlight: function(element) {
                        $(element).last().removeClass('error')
                    },

                });
            });
        });
    </script>
</body>

</html>