<?php
require("config/dbconnect.php");
session_start();
$token = ((isset($_GET['token'])) ? $_GET['token'] : '');
if ($token == '') {
    header("location:index.php");
}

//GET CUSTOMER EMAIL
$getcustomerrowcount = 0;
$getemailquery = "SELECT * from customer_master WHERE cm_token='$token'";
$getcustomerresult = mysqli_query($conn, $getemailquery);
if ($getcustomerresult) {
    $getcustomerrowcount = mysqli_num_rows($getcustomerresult);
    if ($getcustomerrowcount > 0) {
        $customerdata = mysqli_fetch_array($getcustomerresult);
        $customerid=$customerdata['cm_customerid'];
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

    .position-relative i:hover {
        cursor: pointer;
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

    .error {
        color: #F00;
        background-color: #FFF;
        text-align: left;
    }


    .go-button {
        border: none;
        height: 50px;
        width: 50%;
        font-size: 29px;
        color: #fff;
        background-color: #000;
        border-radius: 1%;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .go-button:hover {
        background-color: peru;
        cursor: pointer;
        border: 1px solid black;
    }
</style>

<body id="home-version-1" class="home-version-1" data-style="default">
    <div class="site-content">
        <div class="section-heading pb-30" style="padding-top:50px ;">
            <h3>New <span>Password</span></h3>
        </div>

        <section class="contact-area" style="padding-top: 0px;">
            <div class="container-fluid custom-container">
                <div class="container vh-100 d-flex justify-content-center align-items-center">
                    <div class="card py-4 px-4">
                        <div class="text-center">
                            <img src="media/images/icon/login-icon.png" width="60">
                        </div>
                        <form class="changepasswordfrm" action="functions/authenticatecustomer.php" method="POST">
                            <div class="position-relative mt-4 form-input">
                                <input type="password" name="pass" id="pass" placeholder="New Password" class="form-control" required>
                                <i id="icon" class='fa fa-eye-slash'></i>
                            </div>

                            <div class="position-relative mt-3 form-input">
                                <input type="password" name="confpass" id="confirmpass" placeholder="Confirm Password" class="form-control" required>
                                <i id="confirmicon" class='fa fa-eye-slash'></i>
                            </div>


                            <div class=" mt-5 d-flex justify-content-center align-items-center">
                                <!-- HIDDEN FIELD -->
                                <input type="hidden" name="customerid" value="<?= $customerid ?>">
                                <input type="hidden" name="token" value="<?= $token ?>"> 
                                <button type="submit" name="newpasswordbtn" id="newpasswordbtn" class="go-button">CONFIRM</button>
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
        $(document).ready(function() {

            $("#danger-alert").fadeTo(5000, 500).slideUp(500, function() {
                $("#danger-alert").slideUp(500);
            });


            $("#icon").click(function() {

                var className = $("#icon").attr('class');
                className = className.indexOf('slash') !== -1 ? 'fa fa-eye' : 'fa fa-eye-slash';

                $("#icon").attr('class', className);
                var input = $("#pass");

                if (input.attr("type") == "text") {
                    input.attr("type", "password");
                } else {
                    input.attr("type", "text");
                }
            });


            $("#confirmicon").click(function() {

                var className = $("#confirmicon").attr('class');
                className = className.indexOf('slash') !== -1 ? 'fa fa-eye' : 'fa fa-eye-slash';

                $("#confirmicon").attr('class', className);
                var input = $("#confirmpass");

                if (input.attr("type") == "text") {
                    input.attr("type", "password");
                } else {
                    input.attr("type", "text");
                }
            });

            $('#newpasswordbtn').click(function() {
                jQuery(".changepasswordfrm").validate({
                    // in 'rules' user have to specify all the constraints for respective fields
                    rules: {
                        pass: {
                            required: true,
                            minlength: 5
                        },
                        confpass: {
                            required: true,
                            minlength: 5,
                            equalTo: '#pass'
                        }
                    },
                    messages: {
                        pass: {
                            required: "Please enter a password",
                            minlength: "Your password must be consist of at least 5 characters"
                        },
                        confpass: {
                            required: "Please enter a password",
                            minlength: "Your password must be consist of at least 5 characters",
                            equalTo: "Please enter the same password as above"
                        }
                    },
                    highlight: function(element) {
                        $(element).last().last().addClass('error');
                    },
                    unhighlight: function(element) {
                        $(element).last().removeClass('error');
                    }
                });
            })

        });
    </script>
</body>

</html>