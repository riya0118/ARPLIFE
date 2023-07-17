<html>
<?php
include("mainincludes/csslinks.php");
require("config/dbconnect.php");
session_start();
if (isset($_SESSION['profileview']) && $_SESSION['profileview'] == 0) {
    header("location:index.php");
}{
    session_abort();
}
?>
<!-- Header -->


<body id="home-version-1" class="home-version-1" data-style="default">
    <style>
        #btnedit {
            left: 90px;
            height: 45px;
        }
    </style>

    <div class="site-content">
        <?php include("mainincludes/header.php"); ?>

        <?php include("sidebar.php"); ?>
        <section class="breadcrumb-area" style="padding: 130px 0 10px;">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bc-inner">
                            <p><a href="index.php">Home |</a> View Profile</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-area">
            <div class="container-fluid custom-container">
                <div class="section-heading pb-30">
                    <h3>Profile <span>Details</span></h3>
                </div>
                <div class="col-xl-12">
                    <?php
                    $customerid = ((isset($_SESSION['customerid'])) ? $_SESSION['customerid'] : '');

                    $custquery = "select * from customer_master where cm_customerid=$customerid";
                    $res = mysqli_query($conn, $custquery);
                    if (mysqli_num_rows($res) > 0) {
                        while ($getrow = mysqli_fetch_array($res)) {
                            $fname = $getrow['cm_firstname'];
                            $lname = $getrow['cm_lastname'];
                            $dob = $getrow['cm_dob'];
                            $gender = $getrow['cm_gender'];
                            if($gender=='M'){
                                $gender='Male';
                            }
                            else{
                                $gender='Female';
                            }
                            $mob = $getrow['cm_mobile'];
                            $email = $getrow['cm_email'];
                            $pass = $getrow['cm_password'];
                    ?>
                </div>


                <table class="profile-infoTable" style="border-collapse: separate; border-spacing:15px ;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ;font-size:x-large;margin:auto;text-align:center;">
                    <tbody>
                        <tr>
                            <td>Name

                            </td>
                            <td><?php echo "$fname " . $lname; ?></td>
                        </tr>
                        <tr>
                            <td>Mobile no :</td>
                            <td><?= $mob ?></td>
                        </tr>
                        <tr>
                            <td>Email ID :</td>
                            <td><?= $email ?></td>
                        </tr>

                        <tr>
                            <td>Gender :</td>
                            <td><?= $gender ?></td>
                        </tr>
                        <tr>
                            <td>DOB :</td>
                            <td><?= $dob ?></td>
                        </tr><br>
                        <tr>
                            <td>
                                <div class="col-xl-12">
                                    <a id="btnedit" class="animated fadeIn btn-two" href="custedit.php?customerid=<?= $customerid ?> "  >Edit</a>
                            </td>
                        </tr>
            </div>
    </div>
    </tbody>
    </table>



    </div>
    </section>



<?php }
                    }


?>

</html>