<style>
    .customhover:hover {
        background-color: black !important;
        color: goldenrod !important;
    }
</style>
<?php
session_start();
if (!isset($_SESSION['reloadheader']) || $_SESSION['reloadheader'] == '') {
    $_SESSION['reloadheader'] = 0;
}
include("constant.php");
require(CONFIG_DIR . "dbconnect.php");

$noidfound = 0;
$customerid = '';

if (isset($_SESSION['customerid']) && $_SESSION['customerid'] != '') {
    $customerid = $_SESSION['customerid'];
}
if ($customerid == '') {
    $noidfound = 1;
}
?>
<header id="header" class="header-area">
    <div class="container-fluid custom-container menu-rel-container">
        <div class="row">
            <!-- Logo
					============================================= -->

            <div class="col-lg-12 col-xl-3">
                <div style="padding-top : 10px" class="logo">
                    <a href="index.php">
                        <img src="media/images/cover.png" width="300px" alt="">
                    </a>
                </div>
            </div>

            <!-- Main menu
					============================================= -->

            <div class="col-lg-12 col-xl-5 order-lg-3 order-xl-2 menu-container">
                <div class="mainmenu style-two">
                    <ul id="navigation">
                        <li><a style="font-size: 20px;" href="index.php">home</a>

                        </li>
                        <li class="has-child"><a style="font-size: 20px;" href="shop.php?gender=M">Men</a>
                            <div class="mega-menu">
                                <ul id="navigation">
                                    <label> <b> Shop by :</b></label>
                                    <li id="shopby_men">
                                        <a class="customhover" onclick="loadcategories(this)" id="men_categories" style="padding:20px; background-color:whitesmoke;" href="javascript:void()">Categories
                                            <a>|</a>
                                            <a id="men_brands" onclick="loadbrands(this)" class="customhover" style="padding: 20px; background-color:whitesmoke;" href="javascript:void()"> Brands</a>
                                    </li>
                                </ul>
                                <div class="shopby-mencontainer">
                                    <?php
                                    $sql = "SELECT * from category_master where catm_isactive=1 ";
                                    $res = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_array($res)) {
                                            $cid = $row['catm_categoryid'];
                                            $sql1 = "SELECT * from al_subcategory where sc_categoryid=$cid and sc_isactive=1 and (sc_gender='M' or sc_gender='B' ) ";
                                            $res1 = mysqli_query($conn, $sql1);
                                            if (mysqli_num_rows($res1) > 0) { ?>
                                                <div class="mega-catagory per-20">
                                                    <h4 class="mega-button">
                                                        <a class="font-red" href="shop.php?categoryid=<?= $row['catm_categoryid'] ?>&gender=M"><b><?= $row['catm_categoryname'] ?></b></a>
                                                    </h4>
                                                    <ul class="mega-button">
                                                        <?php
                                                        while ($row1 = mysqli_fetch_array($res1)) { ?>
                                                            <li><a href="shop.php?subcategoryid=<?= $row1['sc_subcategoryid'] ?>&gender=M"><?= $row1['sc_subcategoryname'] ?></a></li>
                                                        <?php }
                                                        ?>
                                                    </ul>
                                                </div>
                                            <?php }
                                            ?>

                                    <?php  }
                                    } ?>
                                </div>

                            </div>
                        </li>


                        <li class="has-child"><a style="font-size: 20px;" href="shop.php?gender=F">Women</a>
                            <div class="mega-menu">
                                <ul id="navigation">
                                    <label><b> Shop by :</b></label>
                                    <li id="shopby_women">
                                        <a class="customhover" onclick="loadwomencategories(this)" id="women_categories" style="padding:20px; background-color:whitesmoke;" href="javascript:void()">Categories
                                            <a>|</a>
                                            <a id="women_brands" onclick="loadwomenbrands(this)" class="customhover" style="padding: 20px; background-color:whitesmoke;" href="javascript:void()"> Brands</a>
                                    </li>
                                </ul>
                                <div class="shopby-womencontainer">
                                    <?php
                                    $sql = "SELECT * from category_master where catm_isactive=1 ";
                                    $res = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_array($res)) {
                                            $cid = $row['catm_categoryid'];
                                            $sql1 = "SELECT * from al_subcategory where sc_categoryid=$cid and sc_isactive=1 and (sc_gender='F' or sc_gender='B' ) ";
                                            $res1 = mysqli_query($conn, $sql1);
                                            if (mysqli_num_rows($res1) > 0) { ?>
                                                <div class="mega-catagory per-20">
                                                    <h4 class="mega-button">
                                                        <a class="font-red" href="shop.php?categoryid=<?= $row['catm_categoryid'] ?>&gender=F"><b><?= $row['catm_categoryname'] ?></b></a>
                                                    </h4>
                                                    <ul class="mega-button">
                                                        <?php
                                                        while ($row1 = mysqli_fetch_array($res1)) { ?>
                                                            <li><a href="shop.php?subcategoryid=<?= $row1['sc_subcategoryid'] ?>&gender=F"><?= $row1['sc_subcategoryname'] ?></a></li>
                                                        <?php }
                                                        ?>
                                                    </ul>
                                                </div>
                                            <?php }
                                            ?>

                                    <?php  }
                                    } ?>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>


            <!--Main menu end-->
            <div class="col-lg-6 col-xl-4 order-lg-2 order-xl-3">
                <div class="header-right-one">
                    <ul>
                        <?php
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'yes' && $noidfound == 0) { ?>
                            <li class="top-cart">
                                <a id="myaccount" href="customerprofile.php?customerid=<?= $customerid ?>">
                                    My Account
                                </a>
                            </li>

                        <?php }
                        ?>
                        <?php
                        $cartrowcount = '';
                        $visitorid = session_id();
                        $customerid = (isset($_SESSION['customerid']) ? $_SESSION['customerid'] : '');
                        if ($customerid != '') {
                            $getcartquery = "SELECT * from al_cart where crt_customerid=$customerid";
                        } else {
                            $getcartquery = "SELECT * from al_visitorcart where vc_visitorid='$visitorid'";
                        }
                        $cartresult = mysqli_query($conn, $getcartquery);
                        if ($cartresult) {
                            $cartrowcount = mysqli_num_rows($cartresult);
                        }
                        ?>
                        <li class="top-cart">
                            <a id="cartcount" href="cart.php?customerid=<?= $customerid ?>"><i title="Cart" class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <?= $cartrowcount; ?>
                            </a>
                        </li>

                        <?php
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'yes' && $noidfound == 0) { 
                            $_SESSION['profileview']=1;
                            ?>
                            <li>
                                <a href="wishlist.php?customerid=<?= $customerid ?>"><i title="Wishlist" class="flaticon-like"></i></a>
                            </li>
                            <li class="user-logout">
                                <a href="../ARPLIFE/functions/logout.php">Sign Out</a>
                            </li>
                            <?php } else {
                            if (!isset($_SESSION['loginredirect']) || $noidfound == 1) {
                                $_SESSION['loginredirect'] = 1; 
                                $_SESSION['profileview']=0;
                                ?>
                                <li class="user-login">
                                    <a href="login.php"><i style="padding-right: 10px ;"></i> Sign in</a>
                                </li>
                            <?php
                            } else { ?>
                                <li class="user-login">
                                    <a href="login.php"><i style="padding-right: 10px ;"></i> Sign in</a>
                                </li>
                            <?php  }
                            ?>

                        <?php }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--Container-Fluid-->
</header>

<script>
    function loadwomenbrands(bw) {
        var html = `<?php
                    $sql = "SELECT * from category_master where catm_isactive=1 ";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_array($res)) {
                            $cid = $row['catm_categoryid'];
                            $sql1 = "SELECT * from brand_master where bm_categoryid=$cid and bm_isactive=1 and (bm_gender='f' OR bm_gender='b' )";
                            $res1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($res1) > 0) { ?>
            <div class="mega-catagory per-20">
                <h4 class="mega-button">
                    <a class="font-red" href=""><b><?= $row['catm_categoryname'] ?></b></a>
                </h4>
                <ul class="mega-button">
                    <?php
                                while ($row1 = mysqli_fetch_array($res1)) { ?>
                        <li><a href="shop.php?brandid=<?= $row1['bm_brandid'] ?> & gender=F"><?= $row1['bm_brandname'] ?></a></li>
                    <?php }
                    ?>
                </ul>
            </div>
        <?php }
        ?>

<?php  }
                    } ?>`;
        $('.shopby-womencontainer').html(html);
        return false;
    }

    function loadwomencategories(cw) {
        var html = `<?php
                    $sql = "SELECT * from category_master where catm_isactive=1 ";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_array($res)) {
                            $cid = $row['catm_categoryid'];
                            $sql1 = "SELECT * from al_subcategory where sc_categoryid=$cid and sc_isactive=1 and (sc_gender='F' or sc_gender='B' ) ";
                            $res1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($res1) > 0) { ?>
                                                <div class="mega-catagory per-20">
                                                    <h4 class="mega-button">
                                                        <a class="font-red" href="shop.php?categoryid=<?= $row['catm_categoryid'] ?> & gender=F"><b><?= $row['catm_categoryname'] ?></b></a>
                                                    </h4>
                                                    <ul class="mega-button">
                                                        <?php
                                                        while ($row1 = mysqli_fetch_array($res1)) { ?>
                                                            <li><a href="shop.php?subcategoryid=<?= $row1['sc_subcategoryid'] ?> & gender=F"><?= $row1['sc_subcategoryname'] ?></a></li>
                                                        <?php }
                                                        ?>
                                                    </ul>
                                                </div>
                                            <?php }
                                            ?>

                                    <?php  }
                            } ?>`;
        $('.shopby-womencontainer').html(html);
        return false;
    }

    function loadcategories(c) {
        var html = `<?php
                    $sql = "SELECT * from category_master where catm_isactive=1 ";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_array($res)) {
                            $cid = $row['catm_categoryid'];
                            $sql1 = "SELECT * from al_subcategory where sc_categoryid=$cid and sc_isactive=1 and (sc_gender='M' or sc_gender='B' ) ";
                            $res1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($res1) > 0) { ?>
                                                <div class="mega-catagory per-20">
                                                    <h4 class="mega-button">
                                                        <a class="font-red" href="shop.php?categoryid=<?= $row['catm_categoryid'] ?> & gender=M"><b><?= $row['catm_categoryname'] ?></b></a>
                                                    </h4>
                                                    <ul class="mega-button">
                                                        <?php
                                                        while ($row1 = mysqli_fetch_array($res1)) { ?>
                                                            <li><a href="shop.php?subcategoryid=<?= $row1['sc_subcategoryid'] ?> & gender=M"><?= $row1['sc_subcategoryname'] ?></a></li>
                                                        <?php }
                                                        ?>
                                                    </ul>
                                                </div>
                                            <?php }
                                            ?>

                                    <?php  }
                            } ?>`;
        $('.shopby-mencontainer').html(html);
        return false;
    }

    function loadbrands(m) {
        var html = `<?php
                    $sql = "SELECT * from category_master where catm_isactive=1 ";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_array($res)) {
                            $cid = $row['catm_categoryid'];
                            $sql1 = "SELECT * from brand_master where bm_categoryid=$cid and bm_isactive=1 and (bm_gender='m' or bm_gender='b' ) ";
                            $res1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($res1) > 0) { ?>
            <div class="mega-catagory per-20">
                <h4 class="mega-button">
                    <a class="font-red" href=""><b><?= $row['catm_categoryname'] ?></b></a>
                </h4>
                <ul class="mega-button">
                    <?php
                                while ($row1 = mysqli_fetch_array($res1)) { ?>
                        <li><a href="shop.php?brandid=<?= $row1['bm_brandid'] ?> & gender=M"><?= $row1['bm_brandname'] ?></a></li>
                    <?php }
                    ?>
                </ul>
            </div>
        <?php }
        ?>

<?php  }
                    } ?>`;
        $('.shopby-mencontainer').html(html);
        return false;
    }
</script>