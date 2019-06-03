<?php 
include_once ("includes/includes.inc.php");
include_once("includes/header_unlock.php");
include_once("crud.php");

$make       = read('all', 'tbl_unlock_make', 'status = 1', 'id ASC');
$model      = read('all', 'tbl_unlock_model', 'status = 1', 'id ASC');
$network    = read('all', 'tbl_unlock_network', 'status = 1', 'id ASC');

?>

<div class="row text-center">
    <div class="col-md-12 text-center">
        <h1 style="color: #0088cc; font-weight: bold; margin: 40px 0px;">Order Successful!</h1>
    </div>

    <div class="col-md-12">
        <?php
            echo '<h5 style="color: green;">We will contact you at <b>'.$_SESSION['email'].'</b> in <b>'.$_SESSION['days'].' days</b> to confirm your phone is now unlocked.</h5><br><h6 style="color: green;">Thank You for your order.</h6>';
            $_SESSION['email']  = '';
            $_SESSION['days']   = '';
        ?>
    </div>
</div>

<div style="height: 100px;"></div>

<?php include_once("includes/footer.php");?>