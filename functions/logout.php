<?php
session_start();
if(isset ($_SESSION['loggedin']) || $_SESSION['loggedin'] == 'yes')
{
    session_unset();
    unset($_SESSION['customerid']);
    session_destroy();
    header("location:../index.php");
}
?>