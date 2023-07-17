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

	.contact-form textarea {
		margin-bottom: 5px !important;
	}

	.contact-form p {
		text-align: left;
		margin-bottom: 30px;
	}
</style>

<body id="home-version-1" class="home-version-1" data-style="default">

	<div class="site-content">
		<div class="top-bar">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-lg-6">
						<div class="top-bar-left">
							<p><i class="far fa-flag"></i><a href="contact.html">Our Location</a></p>

							<p><i class="far fa-envelope"></i><a href="mailto:arplife.customercare@gmail.com">arplife.customercare@gmail.com</a></p>
						</div>
					</div>
					<!-- Col -->
					<div class="col-lg-6">
						<div class="top-bar-right">
							<div class="social">
								<ul>
									<li><a href="#"><i class="fab fa-instagram"></i></a></li>
								</ul>
							</div>
							<a href="#" class="my-account">My Account</a>
						</div>
						<!--top-bar-right end-->
					</div>
					<!-- Col end-->
				</div>
				<!--Row end-->
			</div>
			<!--container end-->
		</div>

		<!-- Header -->
		<?php include("mainincludes/header.php"); ?>

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
		<?php
		if (!isset($_SESSION['emailfound'])) {
			$_SESSION['emailfound'] = 0;
		} else if (isset($_SESSION['emailfound']) && $_SESSION['emailfound'] == 2) { ?>
			<div style="margin-bottom:0px; text-align:center; font-size: large; " id="danger-alert" class="alert alert-danger"><b> Opps !</b> Please register first to the website using your email - <a href="create_account.php" style="text-decoration:underline ;">Click Here</a> .</div>
		<?php $_SESSION['emailfound'] = 0;
		} else if (isset($_SESSION['emailfound']) && $_SESSION['emailfound'] == 1) { ?>
			<div style="margin-bottom:0px; text-align:center; font-size: large; " id="success-alert" class="alert alert-success"><b> Your inquiry is submitted !</b> We will revert back to you shortly .</div>
		<?php $_SESSION['emailfound'] = 0;
		}
		?>
		<!-- Contact Area -->

		<section class="contact-area">
			<div class="container-fluid custom-container">
				<div class="section-heading pb-30">
					<h3>join with <span>us</span></h3>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-8 col-xl-6">
						<div class="contact-form">
							<form method="post" class="contactusform" action="functions/submitinquiry.php">
								<div class="row">
									<div class="col-xl-6">
										<input type="text" placeholder="First Name*" name="fname" id="fname" required>
										<p></p>
									</div>
									<div class="col-xl-6">
										<input type="text" placeholder="Last Name*" name="lname" id="lname">
										<p style=" color: red"></p>
									</div>
									<div class="col-xl-12">
										<input type="email" placeholder="Email*" name="email" id="email">
										<p class="Err"></p>
									</div>
									<div class="col-xl-12">
										<input type="text" placeholder="Title*" name="title" id="title">
										<p></p>
									</div>
									<div class="col-xl-12">
										<textarea name="message" placeholder="Message*" id="message"></textarea>
										<p></p>
									</div>
									<div class="col-xl-12">
										<input type="submit" id="btnsubmit" name="btnsubmit" value="SUBMIT">
									</div>
								</div>
							</form>
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
	<script src="admin/plugins/validation/jquery.validate.min.js"></script>
	<script>
		$(document).ready(function() {

			$("#success-alert").fadeTo(3000, 500).slideUp(500, function() {
				$("#success-alert").slideUp(500);
			});

			$("#danger-alert").fadeTo(5000, 500).slideUp(500, function() {
				$("#danger-alert").slideUp(500);
			});


			var mail;

			$('#email').keyup(function() {
				mail = $("#email").val();

			})
			$('#email').focusout(function() {
				var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!regex.test(mail)) {
					$("#email").focus();
				}
			})

			$('#fname').keyup(function() {
				var regExp = /^[a-zA-Z]+$/;
				var getfname = $('#fname').val();
				if (!regExp.test(getfname)) {
					return $(this).val($.trim($(this).val()).slice(0, -1));
				}
			})

			$('#lname').keyup(function() {
				var regExp = /^[a-zA-Z]+$/;
				var getlname = $('#lname').val();
				if (!regExp.test(getlname)) {
					return $(this).val($.trim($(this).val()).slice(0, -1));
				}
			})

			//form validate
			$('#btnsubmit').click(function() {

				jQuery(".contactusform").validate({
					// in 'rules' user have to specify all the constraints for respective fields
					rules: {
						fname: "required",
						lname: "required",
						email: {
							required: true,
							email: true
						},
						title: "required",
						message: "required"
					},
					messages: {
						fname: "Please enter your Firstname",
						lname: "Please enter your Lastname",
						email: 'Please enter a valid Email',
						title: "please give the title ",
						message: "please write an elaborated message"
					},
					highlight: function(element) {
						$(element).last().addClass('error')
					},
					unhighlight: function(element) {
						$(element).last().removeClass('error')
					}
				});
			})
		})
	</script>

	<!-- Site Scripts -->
	<script src="assets/js/app.js"></script>
</body>

</html>