<?php
require("../config/dbconnect.php");
$discountid = (isset($_GET["discountid"]) ? intval($_GET["discountid"]) : '');
$discount_method = (isset($_GET["discountid"]) ? 'edit' : 'add');
$setdiscountname = $setstatus = $setdiscountpercent = '';
if ($discountid != '') {
    $getdiscount = "select * from discount_master where dm_discountid= $discountid ";
    $res = mysqli_query($conn, $getdiscount);
    if (mysqli_num_rows($res) > 0) {
        $getrow = mysqli_fetch_array($res);
        $setdiscountname = $getrow['dm_discountname'];
        $setdiscountpercent = $getrow['dm_discountpercent'];
        $setstatus = $getrow['dm_isactive'];
        
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
                    <li class="breadcrumb-item active"><a href="">Manage Discount</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important; height: 830px ;">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-validation">
                                    <form class="managediscount_frm" method="POST" action="discounts_operation.php">

                                        <!-- HIDDEN FIELD FOR DISCOUNTID -->
                                        <input type="hidden" name="discountid" value="<?php echo $discountid ?>">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Discount Name</label>
                                                <input type="text" name="discountname" value="<?php echo $setdiscountname ?>" id="discountname" class="customtext">
                                                <p class="error"></p>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Discount Percentage</label>
                                                <input type="text" name="discountpercentage" value="<?php echo $setdiscountpercent ?>" id="discountpercent" class="customtext">
                                                <p class="error"></p>
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
                                        <?php if ($discount_method == 'add') { ?>
                                            <button type="submit" id="discount_addbtn" name="discount_addbtn" class="btn btn-dark">Add</button>
                                        <?php } else if ($discount_method == 'edit') { ?>
                                            <button type="submit" id="discount_editbtn" name="discount_editbtn" class="btn btn-dark">Edit</button>
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
            $("#discount_addbtn").click(function() {
                // e.preventDefault();
                jQuery(".managediscount_frm").validate({
                    rules: {
                        discountname: 'required',
                        discountpercentage: 'required',
                        status: 'required'
                    },
                    messages: {
                        discountname: 'Discount Name is required',
                        discountpercentage: 'Discount percentage is required',
                        status: 'Status is required'
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
            $("#discount_editbtn").click(function() {
                // e.preventDefault();
                jQuery(".managediscount_frm").validate({
                    rules: {
                        discountname: 'required',
                        discountpercentage: 'required',
                        status: 'required'
                    },
                    messages: {
                        discountname: 'Discount Name is required',
                        discountpercentage: 'Discount percentage is required',
                        status: 'Status is required'
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