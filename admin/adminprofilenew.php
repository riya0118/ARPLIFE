<?php
require("../config/dbconnect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARP LIFE</title>
    <?php require_once("../admin/includes/constants.php"); ?>
    <?php include(INCLUDESCOMP_DIR . "csslinks.php");   ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <style>
        .profile-container {
            display: flex;
            flex-direction: column;
            height: auto;
            justify-content: flex-start;
            flex-wrap: wrap;
            width: auto;

        }

        .profile-body {
            margin: 10px;
            flex-wrap: wrap;
        }

        #user {
            text-align: center;
            padding-bottom: 40px;
        }

        .profile-items {
            padding: 4px;

        }

        #aboutme {
            padding-bottom: 40px;
        }

        h3 {
            text-align: center;
            padding-bottom: 10px;
        }

        .editbtncontainer {
            display: flex;
            width: 100%;
            justify-content: flex-end;

        }
    </style>
</head>

<body>
    <?php include(INCLUDESCOMP_DIR . "preloader.php"); ?>
    <div id="main-wrapper">
        <?php include(INCLUDESCOMP_DIR . "logo.php"); ?>
        <?php include(INCLUDESCOMP_DIR . "header.php"); ?>
        <?php include(INCLUDESCOMP_DIR . "sidebar.php"); ?>
        <div class="content-body">
            <div class="row page-titles mx-0" style="background-color:lavender;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo BASE_DIR . 'index.php' ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">AdminProfile</a></li>
                </ol>
            </div>

            <?php
            $getemail = $_SESSION['admin_email'];
            $qry = "select * from admin_master where am_email='$getemail' or am_username='$getemail'";
            $res = mysqli_query($conn, $qry);
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_array($res)) {
                    $profile_img = (isset($row['am_profileimage']) ? $row['am_profileimage'] : '');
                    $aid = (isset($row['am_adminid']) ? $row['am_adminid'] : '');
                    $_SESSION['admin_id'] = $aid;
                    $name = (isset($row['am_adminname']) ? $row['am_adminname'] : '');
                    $mobile = (isset($row['am_mobile']) ? $row['am_mobile'] : '');
                    $address = (isset($row['am_address']) ? $row['am_address'] : '');
                    $city = (isset($row['am_cityid']) ? $row['am_cityid'] : '');
                    $state = (isset($row['am_stateid']) ? $row['am_stateid'] : '');
                    $country = (isset($row['am_countryid']) ? $row['am_countryid'] : '');
                    $pincode = (isset($row['am_pincode']) ? $row['am_pincode'] : '');
                    $dob = (isset($row['am_dob']) ? $row['am_dob'] : '');
                    $description = (isset($row['am_description']) ? $row['am_description'] : '');
                    $email = (isset($row['am_email']) ? $row['am_email'] : '');
                    $uname = (isset($row['am_username']) ? $row['am_username'] : '');
                }
            }
            ?>

            <div class="container-fluid mt-3" style=" display: flex; justify-content:center; background-color:lavender ; margin-top:0px !important ;">
                <div class="col-lg-4 col-xl-7">
                    <div class="card">
                        <div class="card-body">

                            <ul class="profile-container">
                                <div class="editbtncontainer">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#editprofilemodal" data-whatever="@getbootstrap" style="background-image: url('images/icons/editicon.svg'); background-repeat: no-repeat; "></button>
                                    <?php include(INCLUDESCOMP_DIR . "editprofilemodal.php"); ?>
                                </div>

                                <ul class="profile-body" id="user">
                                    <li class="profile-items">
                                        <img class="mr-3" src="images/user/<?= $profile_img ?>" width="140" height="140">
                                    </li>
                                    <li class="profile-items">
                                        <h3 class="mb-0"><?php echo $name; ?></h3>
                                </ul>

                                <div class="editbtncontainer">
                                    <button type="button" class="btn btn-app " data-toggle="modal" data-target="#editprofileaboutmemodal" data-whatever="@getbootstrap" style="background-image: url('images/icons/editicon.svg'); background-repeat: no-repeat; "></button>
                                    <?php include(INCLUDESCOMP_DIR . "editprofileaboutmemodal.php"); ?>
                                </div>

                                <ul class="profile-body" id="aboutme">
                                    <li class="profile-items">
                                        <h3>About Me</h3>
                                    </li>
                                    <li class="profile-items">
                                        <strong>Description</strong>
                                        <p class="text-muted"><?php echo $description; ?></p>
                                    </li>
                                    <li class="profile-items">
                                        <strong class="text-dark mr-4">Mobile</strong>
                                        <span><?php echo $mobile; ?></span>
                                    </li>
                                    <li class="profile-items">
                                        <strong class="text-dark mr-4">Email</strong>
                                        <span><?php echo $email; ?></span>
                                    </li>
                                    <li class="profile-items">
                                        <strong class="text-dark mr-4">Date of Birth</strong>
                                        <span><?php echo $dob; ?></span>
                                    </li>
                                </ul>

                                <div class="editbtncontainer">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#editprofileaddressmodal" data-whatever="@getbootstrap" style="background-image: url('images/icons/editicon.svg'); background-repeat: no-repeat; "></button>
                                    <?php include(INCLUDESCOMP_DIR . "editprofileaddressmodal.php"); ?>
                                </div>

                                <ul class="profile-body">
                                    <li class="profile-items">

                                        <h3>My Address</h2>
                                    </li>
                                    <li class="profile-items">
                                        <strong>FLAT/HOUSE/STREET</strong>
                                        <p class="text-muted"><?php echo $address; ?></p>
                                    </li>
                                    <li class="profile-items">
                                        <strong>Pincode</strong>
                                        <span><?php echo $pincode; ?></span>
                                    </li>

                                    <?php
                                    $cityqry = "select * from city_master where cty_cityid = $city";
                                    $cityres = mysqli_query($conn, $cityqry);
                                    while ($cityrow = mysqli_fetch_array($cityres)) {
                                        $cityname = $cityrow['cty_cityname'];
                                    }
                                    ?>

                                    <li class="profile-items">
                                        <strong>City</strong>
                                        <span><?php echo $cityname; ?></span>
                                    </li>

                                    <?php
                                    $stateqry = "select * from state_master where sm_stateid = $state";
                                    $stateres = mysqli_query($conn, $stateqry);
                                    while ($staterow = mysqli_fetch_array($stateres)) {
                                        $statename = $staterow['sm_statename'];
                                    }
                                    ?>

                                    <li class="profile-items">
                                        <strong>State</strong>
                                        <span><?php echo $statename; ?></span>
                                    </li>

                                    <?php
                                    $countryqry = "select * from country_master where cntry_countryid = $country";
                                    $countryres = mysqli_query($conn, $countryqry);
                                    while ($countryrow = mysqli_fetch_array($countryres)) {
                                        $countryname = $countryrow['cntry_countryname'];
                                    }
                                    ?>

                                    <li class="profile-items">
                                        <strong>Country</strong>
                                        <span><?php echo $countryname; ?></span>
                                    </li>
                                </ul>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include(INCLUDESCOMP_DIR . "footer.php"); ?>
    </div>

    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="./plugins/moment/moment.js"></script>
    <script src="./plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="./js/plugins-init/form-pickers-init.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('select').selectize({
                sortField: 'text'
            });
        });
    </script>
</body>

</html>