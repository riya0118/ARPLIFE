<?php
require("config/dbconnect.php");
session_start();
$customerid = ((isset($_GET['customerid'])) ? $_GET['customerid'] : '');
if ($customerid == '') {
    header("location:index.php");
}

//GET CUSTOMER EMAIL
$fname = $lname = $email = '' ;
$getcustomerrowcount = 0;
$getemailquery = "SELECT * from customer_master WHERE cm_customerid=$customerid";
$getcustomerresult = mysqli_query($conn, $getemailquery);
if ($getcustomerresult) {
    $getcustomerrowcount = mysqli_num_rows($getcustomerresult);
    if ($getcustomerrowcount > 0) {
        $customerdata = mysqli_fetch_array($getcustomerresult);
        $email = $customerdata['cm_email'];
        $fname = $customerdata['cm_firstname'];
        $lname = $customerdata['cm_lastname'];
    }
}

if (!isset($_SESSION['waitforredirect'])) {
    $_SESSION['waitforredirect'] = 0;
}

?>


<!DOCTYPE html>
<html lang="en">

<!-- Head Tag -->
<?php include("mainincludes/csslinks.php"); ?>

<style>
    body {
        background-color: whitesmoke;
    }

    .card {
        width: 350px;
        padding: 10px;
        border: none;
        border-radius: 20px;
    }

    .form-input input {
        height: 45px;
        padding-right: 35px;
        border: 2px solid #eee;
        transition: all 0.5s;
    }

    .form-input input:focus {
        box-shadow: none;
        border: 2px solid #000;
    }

    .info-text {
        font-size: 14px;
    }

    .form-input i {
        position: absolute;
        top: 14px;
        right: 10px;
    }



    .go-button {
        border: none;
        height: 60px;
        width: 20%;
        font-size: 29px;
        color: #fff;
        background-color: #000;
        border-radius: 50%;
    }

    .go-button:hover {
        background-color: peru;
        cursor: pointer;
    }
</style>

<body id="home-version-1" class="home-version-1" data-style="default">
    <?php
    if (isset($_SESSION['emailmismatch']) && $_SESSION['emailmismatch'] == 1) { ?>
        <div style="margin-bottom:0px; text-align:center; font-size: large; " id="danger-alert" class="alert alert-danger"><b> Invalid Email !</b> Please enter correct Email .</div>
    <?php }
    unset($_SESSION['emailmismatch']);
    if (isset($_SESSION['waitforredirect']) && $_SESSION['waitforredirect'] == 1) { ?>
        <div style="margin-bottom:0px; text-align:center; font-size: large; " id="warning-alert" class="alert alert-warning"><b>Link Send !</b> Please check your email for reset password link .</div>
    <?php } unset($_SESSION['waitforredirect']);
    ?>
    <div class="site-content">
        <div class="section-heading pb-30" style="padding-top:50px ;">
            <h3>Forgot <span>Password</span></h3>
        </div>

        <section class="contact-area" style="padding-top: 0px;">
            <div class="container-fluid custom-container">
                <div class="container vh-100 d-flex justify-content-center align-items-center">
                    <div class="card py-5 px-2">
                        <div class="text-center">
                            <img src="media/images/icon/profileicon.png" width="60">
                        </div>
                        <form action="functions/authenticatecustomer.php" method="POST">
                            <div class="text-center mt-3">
                                <h1><?= strtoupper($fname) . " " . strtoupper($lname) ?></h1>
                            </div>

                            <div class="col-auto">
                                <label class="sr-only">Username</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class='far fa-envelope'></i></div>
                                    </div>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $email ?>">
                                </div>
                            </div>


                            <div class=" mt-4 d-flex justify-content-center">
                                <span></span>
                                <!-- HIDDEN FIELD -->
                                <input type="hidden" name="customerid" value="<?= $customerid ?>">
                                <input type="hidden" name="customername" value="<?= $fname . $lname ?>">
                                <button type="submit" title="Send Mail" name="sendmail" class="go-button"><i class='far fa-envelope'></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Dependency Scripts -->
    <script src="dependencies/jquery/jquery.min.js"></script>
    <script src="dependencies/popper.js/popper.min.js"></script>
    <script src="dependencies/bootstrap/js/bootstrap.min.js"></script>
    <script src="dependencies/jquery-ui/js/jquery-ui.min.js"></script>
    <script src="admin/plugins/validation/jquery.validate.min.js"></script>
    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>
    <script>
        $("#danger-alert").fadeTo(5000, 500).slideUp(500, function() {
            $("#danger-alert").slideUp(500);
        });

        $("#warning-alert").fadeTo(3000, 500).slideUp(500, function() {
            $("#warning-alert").slideUp(500);
        });
    </script>
</body>

</html>