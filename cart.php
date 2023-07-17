<?php
require("config/dbconnect.php");
$getcustomerid  = $addressid = '';

$getcartrowcount = 0;
$iscustomer = (isset($_REQUEST['customerid']) && $_REQUEST['customerid'] != '' ? 1 : 0);
$subtotal = 0;
$gst = 0;
$getaddressrowcount = 0;

$getcustomerid = ((isset($_REQUEST['customerid'])) ? $_REQUEST['customerid'] : '');

if ($getcustomerid != '') {
    $displaycartquery = "SELECT * from al_cart where crt_customerid=$getcustomerid ";
    $getcartresult = mysqli_query($conn, $displaycartquery);
    if ($getcartresult) {
        $getcartrowcount = mysqli_num_rows($getcartresult);
    }
}

if ($getcustomerid != '') {
    $getaddressquery = "SELECT * FROM al_addresses where addr_customerid=$getcustomerid AND addr_inuse=1 ";
    $getaddressresult = mysqli_query($conn, $getaddressquery);
    if ($getaddressresult) {
        $getaddressrowcount = mysqli_num_rows($getaddressresult);
    }
}

?>

<!doctype html>
<html>
<style>
    .defaultaddress {
        text-align: center;
        font-size: large;
        font-weight: bolder;
    }
</style>
<!-- head-tag -->
<?php include("mainincludes/csslinks.php"); ?>


<body id="home-version-1" class="home-version-1" data-style="default">
    <div class="site-content">

        <!-- header -->
        <?php include("mainincludes/header.php") ?>


        <!-- Breadcrumb -->
        <section class="breadcrumb-area" style="padding: 130px 0 10px;">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bc-inner">
                            <p><a href="index.php">Home |</a> Cart</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cart Area -->
        <section class="cart-area">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="cart-table">
                            <table class="tables">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>unit price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!isset($_REQUEST['customerid']) || $_REQUEST['customerid'] == '') {
                                        $getcustomerid = session_id();
                                        if ($getcustomerid != '') {
                                            $displaycartquery = "SELECT * from al_visitorcart where vc_visitorid='$getcustomerid'";
                                            $getcartresult = mysqli_query($conn, $displaycartquery);
                                            if ($getcartresult) {
                                                $getcartrowcount = mysqli_num_rows($getcartresult);
                                            }
                                        }
                                    }
                                    if ($getcartrowcount > 0) {
                                        while ($getcartrows = mysqli_fetch_array($getcartresult)) {
                                            $getproductdataquery = "SELECT * from product_master where pm_productid=" . (($iscustomer == 1) ? $getcartrows['crt_productid'] : $getcartrows['vc_productid']);
                                            $getproductdataresult = mysqli_query($conn, $getproductdataquery);
                                            if ($getproductdataresult) {
                                                if (mysqli_num_rows($getproductdataresult) > 0) {
                                                    $getproductdata = mysqli_fetch_array($getproductdataresult);
                                                    $getproductimage = $getproductdata['pm_image'];
                                                    $getproductid = $getproductdata['pm_productid'];
                                                    $getproductname = $getproductdata['pm_productname'];
                                                    $getproductprice = $getproductdata['pm_price'];
                                                    $getstock = $getproductdata['pm_stock'];
                                                    $totalprice = floatval($getproductprice *  (($iscustomer == 1) ? $getcartrows['crt_quantity'] : $getcartrows['vc_quantity']));
                                                    $subtotal += $totalprice;
                                                }
                                            } ?>
                                            <tr>
                                                <td>
                                                    <a href="javascript:void()" onclick="deletefromcart(<?= (($iscustomer == 1) ? $getcartrows['crt_cartid'] : $getcartrows['vc_cartid']) ?>,'<?= $getproductname ?>' )">X</a>
                                                </td>
                                                <td>
                                                    <a href="singleproduct.php?productid=<?= $getproductid ?>">
                                                        <div class="product-image">
                                                            <img alt="<?= $getproductimage ?>" height="200rem" src="admin/images/uploads/<?= $getproductimage ?>">
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="product-title">
                                                        <a href="singleproduct.php?productid=<?= $getproductid ?>"><?= $getproductname ?></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="quantity">
                                                        <input type="number" style="width:60% ;" onchange="calcprice(this,<?= $getproductprice ?>,<?= (($iscustomer == 1) ? $getcartrows['crt_cartid'] : $getcartrows['vc_cartid']) ?>)" min="1" max="<?= (($getstock < 50) ? $getstock : '50') ?>" value="<?= (($iscustomer == 1) ? $getcartrows['crt_quantity'] : $getcartrows['vc_quantity']) ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <div class="price-box">
                                                                <span class="price"><?= $getproductprice ?></span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="total-price-box">
                                                        <span class="price" id="cart<?= (($iscustomer == 1) ? $getcartrows['crt_cartid'] : $getcartrows['vc_cartid']) ?>price">&#X20B9; <?= $totalprice ?> </span>
                                                    </div>
                                                </td>

                                            </tr>

                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="6"><span style="font-weight:500; font-size:15pt ; ">Cart is Empty</span></td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                        <!-- /.cart-table -->
                        <!-- /.row -->
                    </div>


                    <div class="col-xl-4">

                        <!-- ADDRESS -->
                        <div class="cart-subtotal" style="margin-bottom: 30px;">
                            <p>YOUR ADDRESS</p>
                            <?php if ($getaddressrowcount > 0) {
                                $getaddress = mysqli_fetch_array($getaddressresult);
                                $addressid = $getaddress['addr_addressid'];
                                $street = $getaddress['addr_address'];
                                $pincode = $getaddress['addr_pincode'];
                                $addresstype = $getaddress['addr_addresstype'];

                                //CITY
                                $cityid = $getaddress['addr_cityid'];
                                $cityquery = "SELECT * from city_master where cty_cityid=$cityid";
                                $cityres = mysqli_query($conn, $cityquery);
                                if ($cityres) {
                                    if (mysqli_num_rows($res) > 0) {
                                        $getcitydata = mysqli_fetch_array($cityres);
                                        $city = $getcitydata['cty_cityname'];
                                    }
                                }

                                //STATE
                                $stateid = $getaddress['addr_stateid'];
                                $statequery = "SELECT * from state_master where sm_stateid=$stateid";
                                $stateres = mysqli_query($conn, $statequery);
                                if ($stateres) {
                                    if (mysqli_num_rows($stateres) > 0) {
                                        $getstatedata = mysqli_fetch_array($stateres);
                                        $state = $getstatedata['sm_statename'];
                                    }
                                }

                                //COUNTRY
                                $countryid = $getaddress['addr_countryid'];
                                $custquery = "SELECT * from country_master where cntry_countryid=$countryid";
                                $countryres = mysqli_query($conn, $custquery);
                                if ($countryres) {
                                    if (mysqli_num_rows($countryres) > 0) {
                                        $getcountrydata = mysqli_fetch_array($countryres);
                                        $country = $getcountrydata['cntry_countryname'];
                                    }
                                }

                            ?>
                                <div class="defaultaddress">
                                    <h3><?= strtoupper($street) ?>,</h3>
                                    <h3><?= $addresstype ?></h3>
                                    <h3><?= strtoupper($city) ?>-<?= $pincode ?>,</h3>
                                    <h3><?= $state ?> , <?= $country ?></h3>
                                    <a href="address.php?customerid=<?= $getcustomerid ?>">Change Address</a>
                                </div>
                            <?php } else { ?>
                                <a href="address.php?customerid=<?= $getcustomerid ?>">ADD/SELECT AN ADDRESS</a>
                            <?php } ?>
                        </div>
                        <!-- ADDRESS END -->

                        <br>
                        <!-- /ORDER DETAILS -->
                        <div class="cart-subtotal">
                            <p>ORDER DETAILS</p>
                            <ul>
                                <li><span>BAG TOTAL:</span>
                                    <h1 id="subtotal">&#X20B9;<?= " " . $subtotal ?></h1>
                                </li>

                                <?php
                                $gst = $subtotal * 12 / 100;
                                ?>
                                <li><span>GST (+12%):</span>
                                    <h1 id="gst"> &#X20B9;<?= " " . $gst ?></h1>
                                </li>
                                <li><span>TOTAL:</span>
                                    <h1 id="total">&#X20B9;<?= " " . $total = $gst + $subtotal ?></h1>
                                </li>
                            </ul>
                            <?php
                            if (($subtotal != 0 || $subtotal != '') && $getaddressrowcount > 0) { ?>
                                <a id="checkout" href="checkout.php?subtotal=<?= $subtotal ?>&gst=<?= $gst ?>&customerid=<?= $getcustomerid ?>&addressid=<?= $addressid ?>" name="checkout">Proceed To Checkout</a>
                                <?php } else {
                                if ($subtotal == 0 || $subtotal == '') { ?>
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button> <strong>Cannot proceed further !</strong> Please add some products to the cart.
                                    </div> <?php } else if ($getaddressrowcount <= 0) { ?>
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button> <strong>Cannot Proceed further!</strong> Please provide your current Address.
                                    </div>
                            <?php }
                                    }
                            ?>
                        </div><br>
                        <!-- /.cart-subtotal -->
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

    <script>
        function calcprice(element, unitprice, cid) {
            var iscustomer = <?= $iscustomer ?>;
            if (iscustomer == 0) {
                posturl = "visitorcartinsertion.php";
            } else {
                posturl = "cartinsertion.php";
            }
            var quantity = $(element).val();
            var total = quantity * unitprice;
            prevtotal = $('#cart' + cid + 'price').html().slice(1);
            $('#cart' + cid + 'price').html('&#X20B9;' + total);
            subtotal = $('#subtotal').text().slice(1);
            temptotal = subtotal - prevtotal;
            finaltotal = temptotal + total;
            gst = finaltotal * 12 / 100;
            finalsubtotal = gst + finaltotal;
            $('#gst').html('&#X20B9; ' + gst);
            $('#subtotal').html('&#X20B9; ' + finaltotal);
            $('#total').html('&#X20B9; ' + finalsubtotal);
            $('#checkout').attr('href', "functions/checkoutauthenticate.php?subtotal=" + finaltotal + "&gst=" + gst + "");
            $.ajax({
                type: "POST",
                url: posturl,
                data: {
                    cartid: cid,
                    mode: 'updatequantity',
                    productquantity: quantity
                },
                success: function(response) {}
            });
        }

        function deletefromcart(cid, pname) {
            if (cid != '') {
                var iscustomer = <?= $iscustomer ?>;
                if (iscustomer == 0) {
                    posturl = "visitorcartinsertion.php";
                } else {
                    posturl = "cartinsertion.php";
                }
                $.ajax({
                    type: "POST",
                    url: posturl,
                    data: {
                        cartid: cid,
                        mode: 'delete'
                    },
                    success: function(response) {

                        if (response == 'success') {
                            alert(pname + " removed from cart .");
                            location.reload();
                        } else {
                            alert("Delete Operation Failed");
                        }
                    }
                });

            }
        }
    </script>

</body>



</html>