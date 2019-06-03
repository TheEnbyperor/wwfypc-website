<?php
    include_once ("includes/includes.inc.php");
    include_once("crud.php");

    $make       = $_POST['make'];
    $model      = $_POST['model'];
    $network    = $_POST['network'];

    $data = mysqli_query($db, "SELECT `tbl_unlock_price`.*, `tbl_unlock_make`.`name` as `make`, `tbl_unlock_model`.`name` as `model`, `tbl_unlock_network`.`name` as `network` FROM `tbl_unlock_price` JOIN `tbl_unlock_make` ON `tbl_unlock_make`.`id` = `tbl_unlock_price`.`make` JOIN `tbl_unlock_model` ON `tbl_unlock_model`.`id` = `tbl_unlock_price`.`model` JOIN `tbl_unlock_network` ON `tbl_unlock_network`.`id` = `tbl_unlock_price`.`network` WHERE `tbl_unlock_price`.`make` = $make AND `tbl_unlock_price`.`model` = $model AND `tbl_unlock_price`.`network` = $network  LIMIT 0,1");

    $price = mysqli_fetch_object($data);
    if (!isset($price->id)) {
        echo json_encode(['type' => 0]);
    } else {
        echo json_encode(['type' => 1, 'data' => $price]);
    }
?>