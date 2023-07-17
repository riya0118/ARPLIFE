<?php
require("../config/dbconnect.php");
$subcatid = (isset($_GET["subcategoryid"]) ? intval($_GET["subcategoryid"]) : '');
$subcategory_method = (isset($_GET["subcategoryid"]) ? 'edit' : 'add');
$setcategory = $setsubcatname = $setdesc = $setgender =  $setstatus = '';
if ($subcategory_method == 'edit' && $subcatid != '') {
    $getsubcategory = "select * from al_subcategory where sc_subcategoryid=$subcatid ";
    $res = mysqli_query($conn, $getsubcategory);
    if (mysqli_num_rows($res) > 0) {
        $getrow = mysqli_fetch_array($res);
        $getcatid = $getrow['sc_categoryid'];
        $setsubcatname = $getrow['sc_subcategoryname'];
        $setgender = $getrow['sc_gender'];
        $setdesc = $getrow['sc_description'];
        $setstatus = $getrow['sc_isactive'];
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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage SubCategory</a></li>
                </ol>
            </div>
            <!--Container start-->
            <div class="container-fluid mt-3" style="background-color:lavender ; margin-top:0px !important; height: 830px ;">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <form class="frm_managesubcat" method="POST" action="subcategories_operation.php">

                                    <!-- HIDDEN FIELD FOR SUBCATEGORYID -->
                                    <input type="hidden" name="subcategoryid" value="<?php echo $subcatid ?>">

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Category</label>
                                            <select id="categories" name="categories" class="form-control">
                                                <option selected disabled>Choose...</option>
                                                <?php
                                                if ($subcategory_method != '') {
                                                    $query = "SELECT * FROM  category_master ";
                                                    $result = mysqli_query($conn, $query);
                                                    $rowcount = mysqli_num_rows($result);
                                                }
                                                while ($getcat = mysqli_fetch_array($result)) {
                                                    if ($subcategory_method == 'edit' && $getcatid == $getcat['catm_categoryid']) {
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
                                            <label>SubCategory Name</label>
                                            <input type="text" name="subcategoryname" value="<?= $setsubcatname ?>" class="customtext">
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Gender</label>
                                            <select id="" name="gender" class="form-control">
                                                <?php
                                                if ($setgender == null) { ?>
                                                    <option value="" selected disabled>Choose...</option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                    <option value="B">Both</option>
                                                <?php } else if ($setgender == 'M') { ?>
                                                    <option value="M" selected>Male</option>
                                                    <option value="F">Female</option>
                                                    <option value="B">Both</option>
                                                <?php } else if ($setgender == 'F') { ?>
                                                    
                                                    <option value="M">Male</option>
                                                    <option value="F" selected>Female</option>
                                                    <option value="B">Both</option>
                                                <?php } else if ($setgender == 'B') { ?>
                                                    
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                    <option value="B" selected>Both</option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="basic-form">
                                            <div class="form-group">
                                                <label>Description:</label>
                                                <textarea class="customtext h-150px" rows="6" name="subcat_description" cols="50" id="comment"><?= $setdesc ?></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Status</label>
                                            <select id="" name="status" class="form-control">
                                                <?php
                                                if ($setstatus == null) { ?>
                                                    <option value="" selected disabled>Choose...</option>
                                                    <option value="1">Enabled</option>
                                                    <option value="0">Disabled</option>
                                                <?php } else if ($setstatus == 1) { ?>
                                                    <option value="1" selected>Enabled</option>
                                                    <option value="0">Disabled</option>
                                                <?php } else if ($setstatus == 0) { ?>
                                                    <option value="1">Enabled</option>
                                                    <option value="0" selected>Disabled</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if ($subcategory_method == 'add') { ?>
                                        <button type="submit" id="subcategoryaddbtn" name="subcategoryaddbtn" class="btn btn-dark">Add</button>
                                    <?php } else if ($subcategory_method == 'edit') { ?>
                                        <button type="submit" id="subcategoryeditbtn" name="subcategoryeditbtn" class="btn btn-dark">Edit</button>
                                    <?php } ?>
                                </form>
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
            $("#subcategoryaddbtn").click(function() {
                // e.preventDefault();
                jQuery(".frm_managesubcat").validate({
                    rules: {
                        categories: 'required',
                        subcategoryname: 'required',
                        status: 'required',
                        gender: 'required'
                    },
                    messages: {
                        categories: 'Select a Category',
                        subcategoryname: 'Subcategory is required',
                        status: 'Choose the Status',
                        gender: 'Choose a gender'
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
            $("#subcategoryeditbtn").click(function() {
                // e.preventDefault();
                jQuery(".frm_managesubcat").validate({
                    rules: {
                        categories: 'required',
                        subcategoryname: 'required',
                        status: 'required',
                        gender: 'required'
                    },
                    messages: {
                        categories: 'Select a Category',
                        subcategoryname: 'Subcategory is required',
                        status: 'Choose the Status',
                        gender: 'Choose a gender'
                    },
                    highlight: function(element) {
                        $(element).last().addClass('error')
                    },
                    unhighlight: function(element) {
                        $(element).last().removeClass('error')
                    }
                });
            });
        });
    </script>
</body>

</html>