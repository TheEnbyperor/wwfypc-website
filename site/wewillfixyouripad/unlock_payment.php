<?php
    namespace Worldpay;
    include_once ("includes/includes.inc.php");
    require_once('worldpay/init.php');
    include_once("crud.php");

    $worldpay = new Worldpay("T_S_970dc045-ecb1-451a-83fc-2437542004a5");
    $worldpay->disableSSLCheck(true);

    $make       = $_POST['make'];
    $model      = $_POST['model'];
    $network    = $_POST['network'];

    $qr = mysqli_query($db, "SELECT `tbl_unlock_price`.*, `tbl_unlock_make`.`name` as `make`, `tbl_unlock_model`.`name` as `model`, `tbl_unlock_network`.`name` as `network` FROM `tbl_unlock_price` JOIN `tbl_unlock_make` ON `tbl_unlock_make`.`id` = `tbl_unlock_price`.`make` JOIN `tbl_unlock_model` ON `tbl_unlock_model`.`id` = `tbl_unlock_price`.`model` JOIN `tbl_unlock_network` ON `tbl_unlock_network`.`id` = `tbl_unlock_price`.`network` WHERE `tbl_unlock_price`.`make` = $make AND `tbl_unlock_price`.`model` = $model AND `tbl_unlock_price`.`network` = $network  LIMIT 0,1");

    $res = mysqli_fetch_object($qr);

    if (!isset($res->id)) {
        header("Location: unlock.php?res=0");
        exit();
    }

    $data['make']       = $res->make;
    $data['model']      = $res->model;
    $data['network']    = $res->network;
    $data['price']      = $res->price;
    $data['days']       = $res->days;
    $data['name']       = $_POST['name'];
    $data['phone']      = $_POST['phone'];
    $data['email']      = $_POST['email'];
    $data['imei']       = $_POST['imei'];

    try {
        $response = $worldpay->createOrder(array(
            'token'             => $_POST['token'],
            'amount'            => $res->price*100,
            'currencyCode'      => 'GBP',
            // 'orderType'         => 'MOTO',
            // 'settlementCurrency'  => 'USD',
            'name'              => $data['name'],
            'orderDescription'  => 'Order description',
            'customerOrderCode' => md5(time())
        ));


        if ($response['paymentStatus'] === 'SUCCESS') {
            $data['orderCode']      = $response['orderCode'];
            $data['token']          = $response['token'];
            $data['currencyCode']   = $response['currencyCode'];
            $data['callback']       = json_encode($response);
            $data['status']         = 0;
            $data['created_on']     = date('Y-m-d H:m:s');

            $save = save('tbl_unlock_payment', $data);
            
            $_SESSION['email']  = $data['email'];
            $_SESSION['days']   = $data['days'];
            send_email_html('wewillfixyourpc@gmail.com', 'New Order', 'New Order - Order Code: '.$data['orderCode']);
            header("Location: unlock_success.php");
        } else {
            throw new WorldpayException(print_r($response, true));
        }
    } catch (WorldpayException $e) {
        echo 'Error code: ' .$e->getCustomCode() .'
        HTTP status code:' . $e->getHttpStatusCode() . '
        Error description: ' . $e->getDescription()  . '
        Error message: ' . $e->getMessage();
    } catch (Exception $e) {
        echo 'Error message: '. $e->getMessage();
    }
?>