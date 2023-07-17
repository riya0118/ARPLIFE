<?php
require("config/dbconnect.php");
session_start();
if (isset($_SESSION['profileview']) && $_SESSION['profileview'] == 0) {
    header("location:index.php");
}else{
    session_abort();
}

$customerid=((isset($_GET['customerid'])) ? $_GET['customerid'] : '' );

?>

<!doctype html>
<html>
<style>
    #couponcode {
        width: 70%;
        height: 56px;
        background: #f2f1f1;
        border: none;
        padding: 0px 20px;
    }

    .row {
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;

    }

    .customdropdown {
        width: 100%;
        height: 56px;
        border: none;
        box-shadow: 8px 10px 10px whitesmoke;
        margin-bottom: 30px;
        padding: 0px 20px;
        -moz-appearance: none;
        -webkit-appearance: none;
        -o-appearance: none;
        appearance: none;
        background: transparent url(media/images/icon/arrow.png) no-repeat scroll 94% 47%;
        color: #7b7b7b;
        overflow: hidden;
        -o-text-overflow: ellipsis;
        text-overflow: ellipsis;
        white-space: nowrap;
        padding-right: 25px;
    }
</style>

<!-- head-tag -->
<?php include("mainincludes/csslinks.php"); ?>


<body id="home-version-1" class="home-version-1" data-style="default">
    <div class="site-content">


        <!-- header -->
        <?php include("mainincludes/header.php");
        // if ($customerid != '') {
        //     $qry = "select * from al_addresses where addr_customerid= $customerid AND addr_addressid=$addressid";
        //     $res = mysqli_query($conn, $qry);
        //     if (mysqli_num_rows($res) > 0) {
        //         while ($getrow = mysqli_fetch_array($res)) {

        //             $setaddid = (($getrow['addr_addressid'] != '') ? $getrow['addr_addressid'] : '');
        //             $setadd = (($getrow['addr_address'] != '') ? $getrow['addr_address'] : '');
        //             $setaddpin = (($getrow['addr_pincode'] != '') ? $getrow['addr_pincode'] : '');
        //             $setaddtype = (($getrow['addr_addresstype'] != '') ? $getrow['addr_addresstype'] : '');
        //             $setaddstate = (($getrow['addr_stateid'] != '') ? $getrow['addr_stateid'] : '');
        //             $setaddcity = (($getrow['addr_cityid'] != '') ? $getrow['addr_cityid'] : '');
        //             $setaddcountry = (($getrow['addr_countryid'] != '') ? $getrow['addr_countryid'] : '');
        //         }
        //     }
        // }

        ?>


        <section class="breadcrumb-area" style="padding: 130px 0 10px;">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bc-inner">
                            <p><a href="index.php">Home |</a> ADD ADDRESS</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Checkout area -->
        <section class="contact-area" style="padding-bottom:50px ;">
            <div class="container-fluid custom-container">
                <div class="section-heading pb-30">
                    <h3>Add NEW <span>Address</span></h3>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-9 col-md-8 col-lg-6 col-xl-4">
                        <div class="contact-form login-form">
                            <form class="insertform" method="POST" action="addressadd_insert.php">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <input type="hidden" name="addressid">
                                        <input type="text" placeholder=" Flat/House/Street*" name="addr" id="addr">
                                        <div class="mydiv">
                                            <p class="Err"></p>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <input type="number" placeholder="Pincode*" name="pin" id="pin">
                                        <div class="mydiv">
                                            <p class="Err"></p>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <select name="addtype" id="" class="customdropdown">
                                            <option value="" selected disabled >TYPE</option>
                                            <option value="">Home</option>
                                            <option value="">Office</option>
                                        </select>
                                        <div class="mydiv">
                                            <p class="Err"></p>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <select name="country" id="" class="customdropdown">
                                            <option selected disabled value="">country</option>
                                            <?php
                                            $getcountryqry = "select * from country_master";
                                            $countryresult = mysqli_query($conn, $getcountryqry);
                                            while ($getcountry = mysqli_fetch_array($countryresult)) {
                                                $country = $getcountry['cntry_countryname'];
                                                $countryid = $getcountry['cntry_countryid'];
                                                if ($countryid == $setaddcountry) { ?>
                                                    <option selected value="<?= $countryid ?>"><?= $country ?></option>
                                                <?php  } else { ?>
                                                    <option value="<?= $countryid ?>"><?= $country ?></option>
                                                <?php }
                                                ?>
                                            <?php }
                                            ?>
                                        </select>
                                        <div class="mydiv">
                                            <p class="Err"></p>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <select name="state" id="" class="customdropdown">
                                            <option selected disabled value="">states</option>
                                            <?php
                                            $getstateqry = "SELECT * from state_master order by sm_statename";
                                            $stateresult = mysqli_query($conn, $getstateqry);
                                            while ($getstate = mysqli_fetch_array($stateresult)) {
                                                $state = $getstate['sm_statename'];
                                                $stateid = $getstate['sm_stateid'];
                                                if ($stateid == $setaddstate) { ?>
                                                    <option selected value="<?= $stateid ?>"><?= $state ?></option>
                                                <?php  } else { ?>
                                                    <option value="<?= $stateid ?>"><?= $state ?></option>
                                                <?php }
                                                ?>
                                            <?php }
                                            ?>
                                        </select>
                                        <div class="mydiv">
                                            <p class="Err"></p>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <select name="city" id="" class="customdropdown">
                                            <option selected disabled value="">Cities</option>
                                            <?php
                                            $getcityqry = "SELECT * from city_master order by cty_cityname";
                                            $cityresult = mysqli_query($conn, $getcityqry);
                                            while ($getcity = mysqli_fetch_array($cityresult)) {
                                                $city = $getcity['cty_cityname'];
                                                $cityid = $getcity['cty_cityid'];
                                                if ($cityid == $setaddcity) { ?>
                                                    <option selected value="<?= $cityid ?>"><?= $city ?></option>
                                                <?php  } else { ?>
                                                    <option value="<?= $cityid ?>"><?= $city ?></option>
                                                <?php }
                                                ?>
                                            <?php }
                                            ?>
                                        </select>
                                        <div class="mydiv">
                                            <p class="Err"></p>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <input type="hidden" name="customerid" value="<?= $customerid ?>" >
                                        <button type="submit" id="addbtn" name="addbtn" class="btn btn-dark">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- footer -->
        <?php include("mainincludes/footer.php"); ?>


        <!-- Back to top-->

        <?php include("mainincludes/backtotop.php"); ?>


        <!-- Popup -->

        <?php // include("mainincludes/popup.php"); 
        ?>


    </div>
    <!-- /#site -->

    <!-- Dependency Scripts -->
    <script src="dependencies/jquery/jquery.min.js"></script>
    <script src="dependencies/popper.js/popper.min.js"></script>
    <script src="dependencies/bootstrap/js/bootstrap.min.js"></script>
    <script src="dependencies/owl.carousel/js/owl.carousel.min.js"></script>
    <script src="dependencies/wow/js/wow.min.js"></script>
    <script src="dependencies/isotope-layout/js/isotope.pkgd.min.js"></script>
    <script src="dependencies/imagesloaded/js/imagesloaded.pkgd.min.js"></script>
    <script src="dependencies/jquery.countdown/js/jquery.countdown.min.js"></script>
    <script src="dependencies/gmap3/js/gmap3.min.js"></script>
    <script src="dependencies/venobox/js/venobox.min.js"></script>
    <script src="dependencies/slick-carousel/js/slick.js"></script>
    <script src="dependencies/headroom/js/headroom.js"></script>
    <script src="dependencies/jquery-ui/js/jquery-ui.min.js"></script>
    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>

</body>



</html>