<?php
require("../config/dbconnect.php");
$couponid = (isset($_GET["couponid"]) ? intval($_GET["couponid"]) : '');
$coupons_method = (isset($_GET["couponid"]) ? 'edit' : 'add');
$setcouponcode = $setstatus = $setdiscount = $minamount = $maxamount = $startsat = $endsat = '';
if ($couponid != '') {
    $getcoupon = "select * from coupons_master where cpn_couponid=$couponid ";
    $res = mysqli_query($conn, $getcoupon);
    if (mysqli_num_rows($res) > 0) {
        $getrow = mysqli_fetch_array($res);
        $setcouponcode = $getrow['cpn_couponcode'];
        $setdiscount = $getrow['cpn_allotteddiscount'];
        $minamount= $getrow['cpn_minamount'];
        $maxamount= $getrow['cpn_maxamount'];
        $startsat= $getrow['starts_at'];
        $endsat= $getrow['ends_at'];

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
                    <li class="breadcrumb-item active"><a href="">Manage Coupons</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important; height: 830px ;">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-validation">
                                    <form class="managecoupon_frm" method="POST" action="coupons_operation.php">

                                        <!-- HIDDEN FIELD FOR BRANDID -->
                                        <input type="hidden" name="couponid" value="<?php echo $couponid ?>">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Coupon code</label>
                                                <input type="text" name="couponcode" value="<?php echo $setcouponcode ?>" id="couponcode" class="customtext">
                                                <p class="error"></p>
                                            </div>
                                        </div>
                                    

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Discount</label>
                                                <input type="text" name="discount" value="<?php echo $setdiscount ?>" id="discount" class="customtext">
                                                <p class="error"></p>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Minimum amount</label>
                                                <input type="text" name="minamount" value="<?php echo $minamount ?>" id="minamount" class="customtext">
                                                <p class="error"></p>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Maximum amount</label>
                                                <input type="text" name="maxamount" value="<?php echo $maxamount ?>" id="maxamount" class="customtext">
                                                <p class="error"></p>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Starts At</label>
                                                <input type="datetime-local" class="customtext" name="startsat" value="<?php echo $startsat ?>" placeholder="2017-06-04" id="mdate">

                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Ends At</label>
                                                <input type="datetime-local" name="endsat" value="<?php echo $endsat ?>" id="endsat" class="customtext">
                                                <p class="error"></p>
                                            </div>
                                        </div>

                                        
                                        <?php if ($coupons_method == 'add') { ?>
                                            <button type="submit" id="coupon_addbtn" name="coupon_addbtn" class="btn btn-dark">Add</button>
                                        <?php } else if ($coupons_method == 'edit') { ?>
                                            <button type="submit" id="coupon_editbtn" name="coupon_editbtn" class="btn btn-dark">Edit</button>
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
            $("#coupon_addbtn").click(function() {
                // e.preventDefault();
                jQuery(".managecoupon_frm").validate({
                    rules: {
                        couponcode: 'required',
                        discount: 'required',
                        minamount: 'required',
                        maxamount: 'required',
                        startsat: 'required',
                        endsat: 'required'


                    },
                    messages: {
                        couponcode: 'coupon code is required',
                        discount: 'Discount is required',
                        minamount: 'minimum amount is required',
                        minamount: 'minimum amount is required',
                        starts_at: 'start at is required',
                        ends_at: 'end at is required'
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
            $("#coupon_editbtn").click(function() {
                // e.preventDefault();
                jQuery(".managecoupon_frm").validate({
                    rules: {
                        couponcode: 'required',
                        discount: 'required',
                        minamount: 'required',
                        maxamount: 'required',
                        startsat: 'required',
                        endsat: 'required'
                    },
                    messages: {
                        couponcode: 'coupon code is required',
                        discount: 'Discount is required',
                        minamount: 'minimum amount is required',
                        minamount: 'minimum amount is required',
                        starts_at: 'start at is required',
                        ends_at: 'end at is required'
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