<!DOCTYPE html>
<html lang="en">

<!-- Head Tag -->
<?php include("mainincludes/csslinks.php"); ?>
<style>
    .container {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        height: 370px;
        width: 550px;
        background-color: whitesmoke;
        align-items: center;
        box-shadow: 2px 5px 6px darkgray;
    }

    .tick {
        height: 25%;
        padding: 25px;
        width: 20%;
        background-color: #d19e66;
        border-radius: 50%;
    }

    .tick i {
        font-size: 40px;
        color: black;
    }

    .orderplaced {
        font-size: x-large;
        margin-bottom: 30px;
    }

    .message {
        font-size: 17px;
        font-weight: 500;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    #contact {
        text-decoration: underline;
        color: #d19e66;
    }

    #contact:hover {
        color: dodgerblue;
    }
</style>

<body id="home-version-1" class="home-version-1" data-style="default">

    <div class="site-content">

        <!-- Header -->
        <?php include("mainincludes/header.php"); ?>
        <?php
        require("config/dbconnect.php");

        $customerid =((isset($_SESSION['tempcustomerid'])) ? $_SESSION['tempcustomerid'] : '' ) ;
        $email =((isset($_SESSION['tempemail'])) ? strtolower($_SESSION['tempemail'])  : '' )  ;
        $finalamount = ((isset($_SESSION['tempfinalamount'])) ? $_SESSION['tempfinalamount'] : '' ) ;
        $discount = ((isset($_SESSION['tempdiscountamount'])) ? $_SESSION['tempdiscountamount'] : '' ) ;

        if ($customerid != '') {
            $createinvoice = "INSERT into al_invoice(i_customerid,i_discountreceived,i_amountpaid) values($customerid,$discount,$finalamount)";
            $getresult = mysqli_query($conn, $createinvoice);
            unset($_SESSION['tempcustomerid']);
            unset($_SESSION['tempfinalamount']);
            unset($_SESSION['tempdiscountamount']);
            unset($_SESSION['productidarray']);
            unset($_SESSION['tempemail']);
            unset($_SESSION['addressid']);
        }


        ?>

        <!-- Breadcrumb -->

        <section class="breadcrumb-area" style="padding: 130px 0 10px;">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bc-inner">
                            <p><a href="index.php">Home |</a> Contact</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Area -->

        <section class="contact-area">
            <div class="container-fluid custom-container">
                <div class="section-heading pb-30">
                    <h3>Thank <span>You</span></h3>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-8 col-xl-6">
                        <div class="contact-form">
                            <div class="row">
                                <div class="container">
                                    <div class="tick">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="orderplaced">
                                        <span>Order placed successfully !</span>
                                    </div>
                                    <div class="message">
                                        <p>you have completed your payment successfully.</p>
                                        <p>You will receive a summary of your order information via email.</p>
                                        <p>If you have any questions about your order please <a id="contact" href="contactus.php">contact us</a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Subscribe Area -->
        <?php // include("mainincludes/subscribe.php"); 
        ?>

        <!-- Footer -->
        <?php include("mainincludes/footer.php"); ?>

        <!-- Back To Top -->
        <?php include("mainincludes/backtotop.php"); ?>

    </div>
    <!-- Dependency Scripts -->
    <script src="dependencies/jquery/jquery.min.js"></script>
    <script src="dependencies/popper.js/popper.min.js"></script>
    <script src="dependencies/bootstrap/js/bootstrap.min.js"></script>
    <script src="dependencies/owl.carousel/js/owl.carousel.min.js"></script>
    <script src="dependencies/wow/js/wow.min.js"></script>
    <script src="dependencies/isotope-layout/js/isotope.pkgd.min.js"></script>
    <script src="dependencies/imagesloaded/js/imagesloaded.pkgd.min.js"></script>
    <script src="dependencies/jquery.countdown/js/jquery.countdown.min.js"></script>
    <script src="dependencies/venobox/js/venobox.min.js"></script>
    <script src="dependencies/slick-carousel/js/slick.js"></script>
    <script src="dependencies/headroom/js/headroom.js"></script>
    <script src="dependencies/jquery-ui/js/jquery-ui.min.js"></script>
    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>
</body>

</html>