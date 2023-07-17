<?php
session_start();
$host="localhost";
$username="root";
$password="";
$database="arplifedb";

$conn=mysqli_connect($host,$username,$password,$database);

if(!$conn){
    die("connection failed".mysqli_connect_error());
}

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function get_Safe_value($con,$str){
    if($str!=''){
        return mysqli_real_escape_string($con,$str);
    }
}

if(isset($_POST['loginbtn'])){
    $user=get_Safe_value($conn,$_POST['email_username']);
    $pass=get_Safe_value($conn,$_POST['pass']);
    $ipaddr=getUserIpAddr();
    $login_query="select * from admin_master where am_password='$pass' AND (am_username='$user' || am_email='$user')  ";
    $res=mysqli_query($conn,$login_query);
    $count=mysqli_num_rows($res);
    if($count>0){
        $_SESSION['loggedin']='yes';
        $_SESSION['admin_email']=$user;
        $row=mysqli_fetch_assoc($res);
        $adminid= $row['am_adminid'];
        $log_query="insert into al_adminlog(al_adminid , al_ipaddress) values($adminid , '$ipaddr')";
        if(mysqli_query($conn,$log_query)){
            $_SESSION['adminid']=$adminid;
            $_SESSION['adminip']=$ipaddr;
            header('location:../index.php');
        }
    }
    else{
        $_SESSION['loginerrorflag']=1;
        header('location:../adminlogin.php');
    }
}

?>