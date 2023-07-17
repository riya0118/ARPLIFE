<?php
require("config/dbconnect.php");
session_start();
if (isset($_SESSION['profileview']) && $_SESSION['profileview'] == 0) {
    header("location:cart.php");
}else{
    session_abort();
}
$setcouponcode = '';
$setmaxamount = 0;
$setminamount = 0;
$productid = array();
$cartquantity=array();
$total = 0;
$subtotal = ((isset($_GET['subtotal'])) ? $_GET['subtotal'] : 0);
$gst = ((isset($_GET['gst'])) ? $_GET['gst'] : 0);
if($subtotal=='' || $subtotal==0 )
{   $custid=$_SESSION['customerid'];
    header("location:cart.php?customerid=$custid");
}
$setadd = $setaddpin = $setaddtype = $setaddcity = $setaddcountry = $setaddstate = '';
$cpn = 0;
$setallotteddiscount = 0;
    $getcustomerid = ((isset($_GET['customerid'])) ? $_GET['customerid'] : '');
    $addressid=((isset($_GET['addressid'])) ? $_GET['addressid'] : '' );
    if ($getcustomerid != '') {
        $getcartquery = "SELECT * from al_cart where  crt_customerid=$getcustomerid";
        $getcartresult = mysqli_query($conn, $getcartquery);
        if ($getcartresult) {
            $getcartrowcount = mysqli_num_rows($getcartresult);
            if ($getcartrowcount > 0) {
                while ($getcartrows = mysqli_fetch_array($getcartresult)) {
                    array_push($productid, $getcartrows['crt_productid']);
                    array_push($cartquantity,$getcartrows['crt_quantity']);
                }
            }
        }
        $qry = "select * from al_addresses where addr_customerid= $getcustomerid";
        $res = mysqli_query($conn, $qry);
        if (mysqli_num_rows($res) > 0) {
            while ($getrow = mysqli_fetch_array($res)) {
                $setaddid = (($getrow['addr_addressid'] != '') ? $getrow['addr_addressid'] : '');
                $setadd = (($getrow['addr_address'] != '') ? $getrow['addr_address'] : '');
                $setaddpin = (($getrow['addr_pincode'] != '') ? $getrow['addr_pincode'] : '');
                $setaddtype = (($getrow['addr_addresstype'] != '') ? $getrow['addr_addresstype'] : '');
                $setaddstate = (($getrow['addr_stateid'] != '') ? $getrow['addr_stateid'] : '');
                $setaddcity = (($getrow['addr_cityid'] != '') ? $getrow['addr_cityid'] : '');
                $setaddcountry = (($getrow['addr_countryid'] != '') ? $getrow['addr_countryid'] : '');
            }
        }
    }
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

    #paymentbtn {
        font-family: 'Work Sans', sans-serif;
        font-weight: 600;
        color: #fff;
        background: #d19e66;
        height: 50px;
        font-size: 18px;
        text-transform: uppercase;
        text-align: center;
        line-height: 50px;
        padding: 0 20px;
        border: none;
        margin-top: 0px;
    }

    #paymentbtn:hover {
        cursor: pointer;
        background-color: black;
        color: white;
        transition: all 0.25s ease-in-out;

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
        <?php include("mainincludes/header.php") ?>
        <?php
        $_SESSION['productidarray'] = $productid;
        $_SESSION['cartquantity']=$cartquantity;
        ?>

        <section class="breadcrumb-area" style="padding: 130px 0 10px;">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bc-inner">
                            <p><a href="index.php">Home |</a> Checkout</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Checkout area -->
        <div class="container-fluid custom-container">

            <!-- CART  -->
            <div class="col-lg-8 col-xl-12">
                <?php
                if ($getcustomerid != '') {
                    $getcustomer = "SELECT * from customer_master where cm_customerid=$getcustomerid";
                    $getresult = mysqli_query($conn, $getcustomer);
                    if ($getresult) {
                        $getrowcount = mysqli_num_rows($getresult);
                        if ($getrowcount > 0) {
                            $getcustomerdata = mysqli_fetch_array($getresult);
                            $mobilenumber = ((isset($getcustomerdata['cm_mobile'])) ? $getcustomerdata['cm_mobile'] : '');
                            $email = ((isset($getcustomerdata['cm_email'])) ? $getcustomerdata['cm_email'] : '');
                            $firstname = ((isset($getcustomerdata['cm_firstname'])) ? $getcustomerdata['cm_firstname'] : '');
                            $lastname = ((isset($getcustomerdata['cm_lastname'])) ? $getcustomerdata['cm_lastname'] : '');
                        }
                    }
                }
                ?>
                <div class="row justify-content-center">
                    <!-- YOUR DETAIL -->
                    <div class="col-xl-12">
                        <div class="section-heading pb-30" width="250" style="padding-top: 10px;">
                            <h3>Your <span>Details</span> </h3>
                        </div>
                    </div>
                </div>
                <form action="razorpay/pay.php" method="POST">
                    <div class="cart-subtotal" style="margin-bottom: 30px;">
                        <h3>YOUR NAME: <span><?= strtoupper($firstname . " " . $lastname)  ?> </span> </h3>
                        <input type="hidden" name="yourname" value="<?= strtoupper($firstname . " " . $lastname)  ?>">
                        <?php if ($mobilenumber != '') { ?>
                            <h3>YOUR MOBILE: <span><?= strtoupper($mobilenumber)  ?> </span> </h3>
                            <input type="hidden" name="yourmobile" value="<?= strtoupper($mobilenumber)  ?>">
                        <?php } ?>
                        <h3>YOUR EMAIL: <span><?= strtoupper($email)  ?> </span> </h3>
                        <input type="hidden" name="youremail" value="<?= strtolower($email)  ?>">
                        <input type="hidden" name="addressid" value="<?= $addressid ?>">
                        <input type="hidden" name="customerid" value="<?= $getcustomerid ?>">
                    </div>
                    <div class="row">
                        <!-- CART TOTAL -->
                        <div class="col-xl-12">
                            <div class="section-heading pb-30">

                                <h3>Your <span>Cart</span> </h3>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="cart-subtotal">
                                <div class="cart-subtotal">
                                    <p>ORDER DETAILS</p>
                                    <ul>
                                        <li><span>BAG TOTAL: </span>&#X20B9;<label id="subtotal" for="">
                                                <input type="hidden" name="subtotal" value="<?= $subtotal ?>"> <?= $subtotal ?></label>
                                        </li>
                                        <li><span>Coupon Discount :</span>- &#X20B9;<label id="coupondiscount" for="">
                                                <?= $cpn ?></label>
                                            <input type="hidden" id="hiddencoupondiscount" name="coupondiscount" value="<?= $cpn ?>">
                                        </li>
                                        <li><span>GST (+12%):</span>+ &#X20B9;<label id="gst" for="">
                                                <input type="hidden" name="gst" value="<?= $gst ?>"> <?= $gst ?></label>
                                        </li>
                                        <li><span>TOTAL:</span>&#X20B9;<label id="sumtotal" for="">
                                                <?= (($total != 0) ? $total : $subtotal + $gst)  ?></label>
                                            <input type="hidden" id="hiddenamount" name="finalamount" value="<?= (($total != 0) ? $total : $subtotal + $gst)  ?>">
                                        </li>
                                    </ul>
                                </div>
                                <button type="submit" id="paymentbtn">Proceed to payment</button><br><br>

                            </div>
                            <!-- /.cart-subtotal -->
                        </div>
                        <div class="col-xl-6">
                            <div class="cart-subtotal">
                                <div class="cart-subtotal">
                                    <p>COUPONS</p>
                                    <input type="text" placeholder="Coupon Code" readonly value="" id="couponcode">
                                    <a href="javascript:void()" onclick="applycoupon(<?= floatval($subtotal)  ?>)" name="checkout">APPLY</a>
                                    <p id="cpnerr" style="margin:10px; margin-bottom:70px; font-weight:400 ; "></p>
                                    <ul>
                                        <?php
                                        $qry = "select * from coupons_master";
                                        $res = mysqli_query($conn, $qry);
                                        if (mysqli_num_rows($res) > 0) {
                                            while ($getrow = mysqli_fetch_array($res)) {
                                                $setcouponcode = (($getrow['cpn_couponcode'] != '') ? $getrow['cpn_couponcode'] : '');
                                                $setallotteddiscount = (($getrow['cpn_allotteddiscount'] != '') ? $getrow['cpn_allotteddiscount'] : '');
                                                $setminamount = (($getrow['cpn_minamount'] != '') ? $getrow['cpn_minamount'] : '');
                                                $setmaxamount = (($getrow['cpn_maxamount'] != '') ? $getrow['cpn_maxamount'] : '');
                                        ?>
                                                <li style="display:flex; background-color:#d19e66; color:black; margin-top:20px; padding: 20px;  border-radius: 4px ; ">
                                                    <div>
                                                        <span><input type="radio" name="coupons" onchange="couponselected('<?= strtoupper($setcouponcode) ?>')" id=""></span>
                                                    </div>
                                                    <div style="text-align:left; padding-left:15px ; display: flex; flex-direction: column;">
                                                        <label><?= strtoupper($setcouponcode) ?></label>
                                                        <label>Get upto <?= $setallotteddiscount ?>% on &#X20B9;<?= $setminamount ?> and above.</label>
                                                        <label>Maximum Discount : &#X20B9;<?= $setmaxamount ?> </label>
                                                    </div>
                                                </li>
                                        <?php
                                            }
                                        } else {
                                            echo "No Other Coupon Available";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


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

    <script>
        function couponselected(cc) {
            $('#couponcode').val(cc);
            $('#cpnerr').html('');
        }

        function applycoupon(stotal) {
            cpncode = $('#couponcode').val();
            if (cpncode != '' && (stotal != 0 || stotal != '')) {
                stotal = parseFloat(stotal);
                gst = parseFloat($('#gst').html());
                $.ajax({
                    type: "POST",
                    url: "couponcheck.php",
                    data: {
                        couponcode: cpncode,
                        gstamt: gst,
                        mode: 'check',
                        subtotal: stotal
                    },
                    success: function(response) {
                        if (response == "failed") {
                            alert('Process failed');
                        } else if (response == "ineligible") {
                            $("#cpnerr").html('Amount not enough for a coupon discount !');
                        } else {
                            amountsarr = response.split(',');
                            cd = parseFloat(amountsarr[0]);
                            $('#coupondiscount').html(cd);
                            $('#sumtotal').html(amountsarr[1]);
                            $('#hiddenamount').val(amountsarr[1]);
                            $('#hiddencoupondiscount').val(cd);
                        }

                    }
                });
            } else {
                $('#cpnerr').html('CHOOSE COUPON IF AVAILABLE !');
                $('#cpnerr').css('color', "red");
            }

        }
    </script>



    <!-- RAZORPAY SCRIPT -->


</body>



</html>