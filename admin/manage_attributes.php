<?php
require("../config/dbconnect.php");
$productattributeid = (isset($_GET["productattributeid"]) ? intval($_GET["productattributeid"]) : '');
$attribute_method = (isset($_GET["productattributeid"]) ? 'edit' : 'add');

$setproductid = $setattributeid = $setvalue = '';
if ($attribute_method == 'edit' && $productattributeid != '') {
    $getattributequery = "SELECT * from al_productattribute where pa_productattributeid=$productattributeid";
    $res = mysqli_query($conn, $getattributequery);
    if (mysqli_num_rows($res) > 0) {
        $getrow = mysqli_fetch_array($res);
        $setproductid = (($getrow['pa_productid'] != '') ? $getrow['pa_productid'] : '');
        $setattributeid = (($getrow['pa_attributeid'] != '') ? $getrow['pa_attributeid'] : '');
        $setvalue = (($getrow['pa_value'] != '') ? $getrow['pa_value'] : '');
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
                    <li class="breadcrumb-item active"><a href="">Manage Attribute</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important; height: 830px ;">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-validation">
                                    <form class="manageattribute_frm" method="POST" action="attributes_operation.php">

                                        <!-- HIDDEN FIELD FOR ATTRIBUTEID -->
                                        <input type="hidden" name="productattributeid" value="<?php echo $productattributeid ?>">

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="productid">Product ID
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="productiddropdown" name="productid">
                                                    <option disabled selected value=''>Choose...</option>
                                                    <?php
                                                    $sql = "SELECT * from product_master";
                                                    $res = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($res) > 0) {
                                                        while ($row = mysqli_fetch_array($res)) { ?>
                                                            <?php if ($attribute_method == 'edit' && $setproductid == $row['pm_productid']) { ?>
                                                                <option value="<?= $row['pm_productid'] ?>" selected><?= $row['pm_productid'] ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?= $row['pm_productid'] ?>"><?= $row['pm_productid'] ?></option>
                                                    <?php  }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="attributename">Attribute Name
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="attributedropdown" name="attributename">
                                                    <option disabled selected value=''>Choose...</option>
                                                    <?php
                                                    $sql = "SELECT * from attributes_master";
                                                    $res = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($res) > 0) {
                                                        while ($row = mysqli_fetch_array($res)) { ?>
                                                            <?php if ($attribute_method == 'edit' && $setattributeid == $row['am_attributename']) { ?>
                                                                <option value="<?= $row['am_attributeid'] ?>" selected><?= $row['am_attributename'] ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?= $row['am_attributeid'] ?>"><?= $row['am_attributename'] ?></option>
                                                    <?php  }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <label class="col-lg-4 col-form-label" for="attributevalue">Attribute Value
                                            </label>
                                            <div class="form-group col-md-6">
                                                <input type="text" name="attributevalue" value="<?php echo $setvalue ?>" id="attributevalue" class="customtext">
                                                <p class="error"></p>

                                                </select>
                                            </div>
                                        </div>

                                        <?php if ($attribute_method == 'add') { ?>
                                            <button type="submit" id="attribute_addbtn" name="attribute_addbtn" class="btn btn-dark">Add</button>
                                        <?php } else if ($attribute_method == 'edit') { ?>
                                            <button type="submit" name="attribute_editbtn" id="attribute_editbtn" class="btn btn-dark">Edit</button>
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
        //jquery validation
        $(document).ready(function() {
            //jquery add validation
            $("#attribute_addbtn").click(function() {
                // e.preventDefault();
                jQuery(".manageattribute_frm").validate({
                    rules: {
                        productid: 'required',
                        attributename: 'required',
                        attributevalue: 'required'
                    },
                    messages: {
                        productid: 'Product ID is required',
                        attributename: 'Attribute Name is required',
                        attributevalue: 'Attribute Value is required'
                    },
                    highlight: function(element) {
                        $(element).last().addClass('error')
                    },
                    unhighlight: function(element) {
                        $(element).last().removeClass('error')
                    },

                });
            });

            //jquery edit validation
            $("#attribute_editbtn").click(function() {
                // e.preventDefault();
                jQuery(".manageattribute_frm").validate({
                    rules: {
                        productid: 'required',
                        attributename: 'required',
                        attributevalue: 'required'
                    },
                    messages: {
                        productid: 'Product ID is required',
                        attributename: 'Attribute Name is required',
                        attributevalue: 'Attribute Value is required'
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