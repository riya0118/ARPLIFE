<?php
require("config/dbconnect.php");
session_start();
$customerid = ((isset($_GET['customerid'])) ? $_GET['customerid'] : '');
if ($customerid == '') {
    header("location:index.php");
}

//GET CUSTOMER EMAIL
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
        height: 50px;
        width: 50px;
        font-size: 29px;
        color: #fff;
        background-color: #000;
        border-radius: 50%;
    }

    .go-button:hover {
        background-color: peru;
        cursor: pointer;
        border: 1px solid black;
    }
</style>

<body id="home-version-1" class="home-version-1" data-style="default">
    <?php
    if (isset($_SESSION['passwordmismatch']) && $_SESSION['passwordmismatch'] == 1) { ?>
        <div style="margin-bottom:0px; text-align:center; font-size: large; " id="danger-alert" class="alert alert-danger"><b> Invalid Credentials !</b> Please enter correct Email or Password .</div>
    <?php } unset($_SESSION['passwordmismatch']);
    ?>
    <div class="site-content">
        <div class="section-heading pb-30" style="padding-top:50px ;">
            <h3>Sign <span>in</span></h3>
        </div>

        <section class="contact-area" style="padding-top: 0px;">
            <div class="container-fluid custom-container">
                <div class="container vh-100 d-flex justify-content-center align-items-center">
                    <div class="card py-4 px-4">
                        <div class="text-center">
                            <img src="media/images/icon/login-icon.png" width="60">
                        </div>
                        <form action="functions/authenticatecustomer.php" method="POST">
                            <div class="text-center mt-3">
                                <h1><?= strtoupper($fname) . " " . strtoupper($lname) ?></h1>
                            </div>
                            <div class="position-relative mt-3 form-input">
                                <input type="email" value="<?= $email ?>" name="email" placeholder="Enter your email" class="form-control" required>
                                <i class='far fa-envelope'></i>
                            </div>
                            <div class="position-relative mt-3 form-input">
                                <input type="password" name="pass" placeholder="Enter your Password" class="form-control" required>
                                <i class='fa fa-key'></i>
                            </div>


                            <div class=" mt-5 d-flex justify-content-between align-items-center">
                                <span><a href="forgotpassword.php?customerid=<?= $customerid ?>">Forgot Password ?</a></span>
                                <!-- HIDDEN FIELD -->
                                <input type="hidden" name="customerid" value="<?= $customerid ?>">
                                <button type="submit" name="passwordcheckbtn" class="go-button"><i class='fa fa-arrow-right'></i></button>
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
    </script>
</body>

</html>