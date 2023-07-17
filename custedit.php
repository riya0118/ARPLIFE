<?php
require("config/dbconnect.php");
session_start();
if (isset($_SESSION['profileview']) && $_SESSION['profileview'] == 0) {
    header("location:index.php");
}else{
    session_abort();
}
$customerid = $_GET['customerid'];
?>

<!DOCTYPE html>
<html lang="en">

<!-- Head Tag -->
<?php include("mainincludes/csslinks.php"); ?>

<style>
    .error {
        color: #F00;
        background-color: #FFF;
        text-align: left;
    }

    .contact-form input {
        margin-bottom: 5px !important;
    }

    .contact-form p {
        text-align: left;
        margin-bottom: 30px;
        color: red;
    }

    .customgender {
        width: 100%;
        height: 56px;
        background: #f2f1f1;
        border: none;
        padding-left: 20px;

    }
</style>

<body id="home-version-1" class="home-version-1" data-style="default">

    <div class="site-content">

        <!-- Header -->
        <?php include("mainincludes/header.php");
        $_SESSION['customerid']=$customerid; ?>

        <!-- Breadcrumb -->

        <section class="breadcrumb-area" style="padding: 130px 0 10px;">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bc-inner">
                            <p><a href="index.php">Home |</a> Edit Account</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        $custquery = "select * from customer_master where cm_customerid=$customerid";
        $res = mysqli_query($conn, $custquery);
        if (mysqli_num_rows($res) > 0) {
            while ($getrow = mysqli_fetch_array($res)) {
                $fname = $getrow['cm_firstname'];
                $lname = $getrow['cm_lastname'];
                $dob = $getrow['cm_dob'];
                $gender = $getrow['cm_gender'];
                $mob = $getrow['cm_mobile'];
                $email = $getrow['cm_email'];
                $passcrypt = mysqli_real_escape_string($conn,$getrow['cm_password']);
                $pass=md5($passcrypt);
                $username = $getrow['cm_username'];
        ?>
                <section class="contact-area" style="padding-bottom:50px ;">
                    <div class="container-fluid custom-container">
                        <div class="section-heading pb-30">
                            <h3>Edit <span>Profile</span></h3>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-sm-9 col-md-8 col-lg-6 col-xl-4">
                                <div class="contact-form login-form">
                                    <form class="signupform" method="POST" action="custedit_operation.php">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <input type="text" placeholder="First Name*" value="<?= $fname ?>" name="fname" id="fname">
                                                <p class="Err"></p>
                                            </div>
                                            <div class="col-xl-12">
                                                <input type="text" placeholder="Last Name*" value="<?= $lname ?>" name="lname" id="lname">
                                                <p class="Err"></p>
                                            </div>
                                            <div class="col-xl-12">
                                                <input type="date" value="<?= $dob ?>" name="dob" id="dob">
                                                <p class="Err"></p>
                                            </div>

                                            <div class="col-xl-12">
                                                <select class="customgender" placeholder="gender" name="gender" id="gender">
                                                    <option value="<?= $gender ?>"><?php if ($gender == "M") {
                                                    $g = "Male"; ?>Male</option>
                                                    <option value="F">Female</option>
                                                    <?php } else {
                                                    $g = "Female"; ?>Female</option>
                                                    <?php $g = "Male"; ?>Male</option>

                                                    <option value="M">Male</option>
                                                <?php } ?>
                                                </select>
                    
                                                <p class="Err"></p>
                                            </div>

                                            <div class="col-xl-12">
                                                <input type="text" class="mobile" placeholder="Mobile No" value="<?= $mob ?>" name="mobile" id="mobile">
                                                <p class="Err"></p>
                                            </div>
                                            <div class="col-xl-12">
                                                <input type="email" placeholder="Email*" value="<?= $email ?>" name="email" id="email">
                                                <p class="Err"></p>
                                            </div>
                                            <div class="col-xl-12">
                                                <input type="text" placeholder="Username*" value="<?= $username ?>" name="uname" id="uname">
                                                <p class="Err"></p>
                                            </div>
                                        
                                                <div class="col-xl-12">
                                                <button type="submit" id="editbtn" name="editbtn" class="btn btn-dark">Edit</button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

        <?php
            }
        }
        ?>

        <!-- Footer -->
        <?php include("mainincludes/footer.php"); ?>

        <!-- Back To top -->
        <?php include("mainincludes/backtotop.php"); ?>

    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    </script>
    <!-- Dependency Scripts -->
    <script src="dependencies/jquery/jquery.min.js"></script>
    <script src="dependencies/popper.js/popper.min.js"></script>
    <script src="dependencies/bootstrap/js/bootstrap.min.js"></script>
    <script src="dependencies/owl.carousel/js/owl.carousel.min.js"></script>
    <script src="dependencies/wow/js/wow.min.js"></script>
    <script src="dependencies/imagesloaded/js/imagesloaded.pkgd.min.js"></script>
    <script src="dependencies/slick-carousel/js/slick.js"></script>
    <script src="dependencies/jquery-ui/js/jquery-ui.min.js"></script>
    <script src="admin/plugins/validation/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {

            //mobile check
            $('#mobile').keyup(function() {
                var regExp = /^\d+$/;
                var getnumber = $('#mobile').val();
                if (!regExp.test(getnumber)) {
                    return $(this).val($.trim($(this).val()).slice(0, -1));
                }
            })

            //form validate
            $('#editbtn ').click(function() {
                jQuery(".signupform").validate({
                    // in 'rules' user have to specify all the constraints for respective fields
                    rules: {
                        fname: "required",
                        lname: "required",
                        uname: {
                            required: true,
                            minlength: 5
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        gender: 'required',
                        mobile: {
                            required: true,
                            maxlength: 10
                        },
                    },
                    messages: {
                        fname: "Please enter your Firstname",
                        lname: "Please enter your Lastname",
                        uname: {
                            required: "Please enter a Username",
                            minlength: "Your username must consist of at least 5 characters"
                        },
                        email: 'Please enter your Email',
                        gender: 'please select a gender',
                        mobile: {
                            required: 'Please enter your mobile number',
                            maxlength: 'Only 10 digits allowed'
                        }
                    },
                    highlight: function(element) {
                        $('.Err').last().addClass('error')
                    },
                    unhighlight: function(element) {
                        $('.Err').removeClass('error')
                    }
                });
            })
        })
    </script>

    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>
</body>

</html>