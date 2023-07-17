<?php
require("config/dbconnect.php");
if (isset($_POST['mode']) && $_POST['mode'] == 'check') {
    $couponcode = ((isset($_POST['couponcode'])) ? strtolower($_POST['couponcode']) : '');
    $subtotal = ((isset($_POST['subtotal'])) ? floatval($_POST['subtotal']) : 0);
    $gst = ((isset($_POST['gstamt'])) ? floatval($_POST['gstamt']) : 0);

    $rowcount = $minamt = $maxamt = $disc = $temp = $total = 0;
    $checkcouponquery = "SELECT * from coupons_master where cpn_couponcode='$couponcode'";
    $result = mysqli_query($conn, $checkcouponquery);
    if ($result) {
        $rowcount = mysqli_num_rows($result);
    }
    if ($rowcount > 0) {
        $_SESSION['coupondiscount']=0;
        $_SESSION['totalamt'] = 0;
        $getrow = mysqli_fetch_array($result);
        $minamt = $getrow['cpn_minamount'];
        if ($subtotal > $minamt) {
            $maxamt = $getrow['cpn_maxamount'];
            $disc = $getrow['cpn_allotteddiscount'];
            $temp = $subtotal * ($disc / 100);
            if ($temp < $maxamt) {
                $total = ($subtotal + $gst) - $temp;
                echo $temp . "," . $total;
            } else {
                $total = ($subtotal + $gst) - $maxamt;
                echo $maxamt . "," . $total;
            }
        } else {
            echo "ineligible";
        }
    } else {
        echo "failed";
    }
}
