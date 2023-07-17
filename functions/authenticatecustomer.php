<?php
require("../config/dbconnect.php");
session_start();
require_once("../PHPMailer/PHPMailer.php");
require_once("../PHPMailer/SMTP.php");
require_once("../PHPMailer/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function get_Safe_value($con, $str)
{
    if ($str != '') {
        return mysqli_real_escape_string($con, $str);
    }
}

if (isset($_POST['btnlogin'])) {
    $email = get_Safe_value($conn, $_POST['email']);
    $passwordcrypt = get_Safe_value($conn, $_POST['pass']);
    $pass = md5($passwordcrypt);
    $ipaddr = $_POST['ipaddr'];
    $login_query = "select * from customer_master where cm_password='$pass' AND  cm_email='$email'  ";
    $res = mysqli_query($conn, $login_query);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $_SESSION['loggedin'] = 'yes';
        $row = mysqli_fetch_assoc($res);
        $customerid = $row['cm_customerid'];
        $log_query = "insert into al_customerlog(cl_customerid , cl_ipaddress) values($customerid , '$ipaddr')";
        if (mysqli_query($conn, $log_query)) {
            $_SESSION['customerid'] = $customerid;
            $_SESSION['customerip'] = $ipaddr;
            header('location:../index.php');
        }
    } else {
        $_SESSION['customerloginerrorflag'] = 1;
        header('location:../login.php');
    }
} else if (isset($_POST['btncreate'])) {
    $getusernames = array();
    $getemails = array();

    $cust_query = "select * from customer_master";
    $cust_result = mysqli_query($conn, $cust_query);
    if (mysqli_num_rows($cust_result) > 0) {
        while ($getdata = mysqli_fetch_array($cust_result)) {
            array_push($getusernames, $getdata['cm_username']);
            array_push($getemails, $getdata['cm_email']);
        }
    }

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $gender = (isset($_POST['gender']) ? $_POST['gender'] : '');
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $uname = $_POST['uname'];
    $passwordcrypt = get_Safe_value($conn, $_POST['pass']);
    // $pass=password_hash($passwordcrypt,PASSWORD_BCRYPT);
    $pass = md5($passwordcrypt);
    $flag = $customer_id = '';
    foreach ($getusernames as $usernames) {
        if ($usernames == $uname) {
            $_SESSION['msg'] = 'Username already exists';
            $flag = 1;
            header("location:../create_account.php");
        }
    }

    foreach ($getemails as $emails) {
        if ($emails == $email) {
            $_SESSION['msg'] = 'Account with email already exists';
            $flag = 1;
            header("location:../create_account.php");
        }
    }

    $token = bin2hex(random_bytes(15));
    if ($flag == 0 && $mobile != '') {
        $query = "insert into customer_master(cm_firstname , cm_lastname ,cm_dob,cm_gender,cm_mobile, cm_email , cm_username , cm_password,cm_token) values('$fname' , '$lname' ,'$dob' ,'$gender',$mobile,'$email' , '$uname' , '$pass','$token')";
        $res = mysqli_query($conn, $query);
        $customer_id =  $conn->insert_id;
        $_SESSION['registered'] = 1;
    } else if ($flag == 0 && $mobile == '') {
        $query = "insert into customer_master(cm_firstname , cm_lastname ,cm_dob,cm_gender, cm_email , cm_username , cm_password,cm_token) values('$fname' , '$lname' ,'$dob' ,'$gender','$email' , '$uname' , '$pass','$token')";
        $res = mysqli_query($conn, $query);
        $customer_id =  $conn->insert_id;
    }
    if ($customer_id != '') {
        $visitorid = session_id();
        $checkvisitorquery = "SELECT * from al_visitorcart where vc_visitorid='$visitorid'";
        $checkresult = mysqli_query($conn, $checkvisitorquery);
        if (mysqli_num_rows($checkresult) > 0) {
            while ($getcartdata = mysqli_fetch_array($checkresult)) {
                $getproductid = $getcartdata['vc_productid'];
                $getquantity = $getcartdata['vc_quantity'];
                $insertintocart = "INSERT into al_cart(crt_customerid , crt_productid ,crt_quantity) values($customer_id,$getproductid,$getquantity)";
                $cartresult = mysqli_query($conn, $insertintocart);
            }
        }
    }
    header("location:../login.php");
} else if (isset($_POST['passwordcheckbtn'])) {
    $customerid = ((isset($_POST['customerid'])) ? $_POST['customerid'] : '');
    $getpassword = ((isset($_POST['pass'])) ? get_Safe_value($conn, $_POST['pass']) : '');
    $getemail = ((isset($_POST['email'])) ? get_Safe_value($conn, $_POST['email']) : '');
    $getcustomerrowcount = 0;
    if ($customerid != '' && $getpassword != '') {
        $getpassword = md5($getpassword);
        $getemailquery = "SELECT * from customer_master WHERE cm_customerid=$customerid";
        $getcustomerresult = mysqli_query($conn, $getemailquery);
        if ($getcustomerresult) {
            $getcustomerrowcount = mysqli_num_rows($getcustomerresult);
            if ($getcustomerrowcount > 0) {
                $customerdata = mysqli_fetch_array($getcustomerresult);
                $password = get_Safe_value($conn, $customerdata['cm_password']);
                $email = get_Safe_value($conn, $customerdata['cm_email']);
                if ($getpassword == $password && $getemail == $email) {
                    header("location:../editdetails.php?customerid=$customerid");
                } else {
                    $_SESSION['passwordmismatch'] = 1;
                    header("location:../signinpage.php?customerid=$customerid");
                }
            }
        }
    } else {
        echo "Error ! Please go back and try again.";
    }
} else if (isset($_POST['sendmail'])) {


    $customerid = ((isset($_POST['customerid'])) ? $_POST['customerid'] : '');
    $email = ((isset($_POST['email'])) ? get_Safe_value($conn, $_POST['email']) : '');
    $token = '';
    $customername = ((isset($_POST['customername'])) ? get_Safe_value($conn, $_POST['customername']) : '');
    $emailcheckrowcount = 0;
    if ($email != '' && $customerid != '') {
        $checkforemailquery = "SELECT * from customer_master where cm_customerid=$customerid and cm_email='$email' ";
        $emailcheckresult = mysqli_query($conn, $checkforemailquery);
        if ($emailcheckresult) {
            $emailcheckrowcount = mysqli_num_rows($emailcheckresult);
        }
        if ($emailcheckrowcount > 0) {
            $gettoken = mysqli_fetch_array($emailcheckresult);
            $token = $gettoken['cm_token'];
            $title = 'RESET PASSWORD';
            $message = 'Hey' . $customername . '<br> <br><b>Click here to reset/change your password</b>.<br>' . 'http://localhost/ARPLIFE/resetpassword.php?token=' . $token;

            //SMTP SETTINGS
            $mail = new PHPMailer();
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "arplife.customercare@gmail.com";
            $mail->Password = "wiinussjmxdhwkpn";
            $mail->Port = 587;
            $mail->SMTPSecure = "tls";

            //EMAIL SETTINGS
            $mail->isHTML(true);
            $mail->setFrom("arplife.customercare@gmail.com");
            $mail->addAddress($email);
            $mail->Subject = ($title);
            $mail->Body = $message;


            if ($mail->send()) {
                $_SESSION['waitforredirect'] = 1;
                header("location:../forgotpassword.php?customerid=$customerid");
            }
        } else if ($emailcheckrowcount <= 0) {
            $_SESSION['emailmismatch'] = 1;
            header("location:../forgotpassword.php?customerid=$customerid");
        }
    }
} else if (isset($_POST['newpasswordbtn'])) {
    $customerid = ((isset($_POST['customerid'])) ? $_POST['customerid'] : '');
    $token =   ((isset($_POST['token'])) ? $_POST['token'] : '');
    $passwordcrypt=get_Safe_value($conn,$_POST['pass']);
    $password= md5($passwordcrypt);

    $resetpassquery="UPDATE customer_master SET cm_password='$password' where cm_customerid=$customerid and  cm_token='$token'";
    $resetresult=mysqli_query($conn,$resetpassquery);
    if($resetresult){
        header("location:../customerprofile.php?customerid=$customerid");
    }
}
