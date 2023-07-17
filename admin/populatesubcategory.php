<?php require("../config/dbconnect.php"); ?>
<?php
if (isset($_POST['c_id'])) {
  $product_method = mysqli_real_escape_string($conn, $_POST['product_method']); 
  $s_id = mysqli_real_escape_string($conn, $_POST['s_id']); 
  $c_id = mysqli_real_escape_string($conn, $_POST['c_id']);
  $sql = "SELECT * from al_subcategory where sc_categoryid=$c_id";
  $res = mysqli_query($conn, $sql);
  if (mysqli_num_rows($res) > 0) { ?>
    <option disabled selected value=''>Choose...</option>
    <?php while ($row = mysqli_fetch_array($res)) { ?>
      <?php if ($product_method=='edit' && $s_id==$row['sc_subcategoryid'] ) { ?>
        <option value="<?= $row['sc_subcategoryid'] ?>" selected><?= $row['sc_subcategoryname'] ?></option>
      <?php } else { ?>
        <option value="<?= $row['sc_subcategoryid'] ?>"><?= $row['sc_subcategoryname'] ?></option>
<?php }
    }
  }
} else {
  header('location:manage_products.php');
}
?>