<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require("../config/dbconnect.php");
session_start();
function get_Safe_value($con, $str)
{
	if ($str != '') {
		return mysqli_real_escape_string($con, $str);
	}
}
if (isset($_POST['btnsubmit'])) {

	$fname = get_Safe_value($conn, $_POST['fname']);
	$lname = get_Safe_value($conn, $_POST['lname']);
	$email = get_Safe_value($conn, $_POST['email']);
	$title = get_Safe_value($conn, $_POST['title']);
	$message = get_Safe_value($conn, $_POST['message']);

	$getcustidqry = "select * from customer_master where cm_email='$email'";
	$custres = mysqli_query($conn, $getcustidqry);
	if (mysqli_num_rows($custres) > 0) {
		$getcustrow = mysqli_fetch_array($custres);
		$getcustid = $getcustrow['cm_customerid'];
		$_SESSION['emailfound'] = 1;
		$qry = "insert into al_customerinquiry(ci_customerid , ci_inquirytitle , ci_description) values($getcustid , '$title' , '$message')";
		$res = mysqli_query($conn, $qry);
		if ($res) {
			require_once("../PHPMailer/PHPMailer.php");
			require_once("../PHPMailer/SMTP.php");
			require_once("../PHPMailer/Exception.php");

			//SMTP SETTINGS
			$mail = new PHPMailer();
			$mail->SMTPDebug=2;
			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->Username = "arplife.customercare@gmail.com";
			$mail->Password = "wiinussjmxdhwkpn";
			$mail->Port = 587;
			$mail->SMTPSecure = "tls";

			//EMAIL SETTINGS
			$mail->isHTML(true);
			$mail->setFrom($email, $fname);
			$mail->addAddress("arplife.customercare@gmail.com");
			$mail->Subject = ("$email" . " " . "($title) ");
			$mail->Body = $message;
			if ($mail->send()) {
				header("location:../contactus.php");
			} 
		}
	} else {
		$_SESSION['emailfound'] = 2;
		header("location:../contactus.php");
	}
}
