<?php
    include_once("../admin/include/include.inc_2.php");
    include_once("../crud.php");
    $displayMessage = '';

    if(isset($_REQUEST['DetailMode']) && $_REQUEST['DetailMode'] == "Approved") {
        if(isset($_GET['id']) && $_GET['id'] != '') {
            $id                 = $_GET['id'];
            $displayMessage     = 'Payment Approve Successfull';

            $data['status']     = 1;
            $data['modified_on'] = date('Y-m-d H:m:s');
            $update             = update('tbl_unlock_payment', $data, "id = $id");
        }

        header("Location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&message=$displayMessage");
    }

    $data = read('all', 'tbl_unlock_payment', '', 'id DESC');
?>

<?php
    if(isset($_REQUEST['DetailMode']) && $_REQUEST['DetailMode'] == "Details") {
    $id = $_GET['id'];
    $payment = read('one', 'tbl_unlock_payment', "id = $id");
?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="page_table">
        <tbody>
            <tr>
                <td height="10"></td>
            </tr>

            <tr>
                <td colspan="4" class="cptxt" valign="top" align="center">
                    <h1 color="#FF0000" face="Arial, Helvetica, sans-serif">
                        Details      
                    </h1>
                    <table width="95%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">
                        <tbody>
                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Order Code</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->orderCode; ?></strong></td>
                            </tr>

                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Token</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->token; ?></strong></td>
                            </tr>

                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Currency Code</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->currencyCode; ?></strong></td>
                            </tr>


                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Make</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->make; ?></strong></td>
                            </tr>

                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Model</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->model; ?></strong></td>
                            </tr>

                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Network</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->network; ?></strong></td>
                            </tr>

                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Name</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->name; ?></strong></td>
                            </tr>

                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Phone</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->phone; ?></strong></td>
                            </tr>

                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Email</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->email; ?></strong></td>
                            </tr>

                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>IMEI</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->imei; ?></strong></td>
                            </tr>

                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Price</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->price; ?> GBP</strong></td>
                            </tr>

                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Days</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->days; ?> Days</strong></td>
                            </tr>

                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Status</strong></td>
                                <td width="80%" height="25" align="left">
                                    <strong>
                                        <?php if($payment->status == 0) echo 'Pending'; ?>
                                        <?php if($payment->status == 1) echo 'Approved'; ?>
                                        <?php if($payment->status == 2) echo 'Cencel'; ?>
                                    </strong>
                                </td>
                            </tr>

                            <tr class="tblHeading">
                                <td width="20%" height="25" align="left"><strong>Created At</strong></td>
                                <td width="80%" height="25" align="left"><strong><?php echo $payment->created_on; ?></strong></td>
                            </tr>

                            <?php if($payment->status == 0) { ?>
                                <tr class="tblHeading">
                                    <td width="20%" height="25" align="left"><strong>Action</strong></td>
                                    <td width="80%" height="25" align="left">
                                        <strong>
                                                <a href="control-panel.php?menuId=unlock&id=<?php echo $payment->id; ?>&module=Unlock&fname=manage-payment.php&DetailMode=Approved" title="Edit Record"><img src="https://images.vexels.com/media/users/3/157890/isolated/lists/4f2c005416b7f48b3d6d09c5c6763d87-check-mark-circle-icon.png" border="0" style="width: 20px; height: 20px;"></a>
                                        </strong>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
<?php } else { ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="page_table">
        <tbody>
            <tr>
                <td height="10"></td>
            </tr>

            <tr>
                <td colspan="4" class="cptxt" valign="top" align="center">
                    <font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">
                        <?php echo (isset($_GET['message']) ? $_GET['message'] : ''); ?>        
                    </font>

                    <table width="95%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">
                        <tbody>
                            <tr class="tblHeading">
                                <td width="40%" height="25" align="left"><strong>Payment Info</strong></td>
                                <td width="40%" height="25" align="left"><strong>User Info</strong></td>
                                <td width="10%" height="25" align="left"><strong>Status</strong></td>
                                <td width="10%" align="center"><strong>Action</strong></td>
                            </tr>

                            <?php foreach ($data as $key => $v) { ?>
                                <tr bgcolor="#f6f6f6">
                                    <td align="left" valign="top" class="cptxt"><br><br>
                                        <b>Make: </b> <?php echo $v->make; ?><br>
                                        <b>Model: </b> <?php echo $v->model; ?><br>
                                        <b>Network: </b> <?php echo $v->network; ?><br>
                                        <b>Order Code: </b> <?php echo $v->orderCode; ?><br>
                                        <b>Token: </b> <?php echo $v->token; ?><br>
                                        <b>Amount: </b> <?php echo $v->price; ?> USD<br>
                                        <b>Days: </b> <?php echo $v->days; ?><br>
                                        <b>Created At: </b> <?php echo date('d M, Y h:m a', strtotime($v->created_on)); ?><br>
                                    </td>
                                    <td align="left" valign="top" class="cptxt"><br><br>
                                        <b>Name: </b> <?php echo $v->name; ?><br>
                                        <b>Phone: </b> <?php echo $v->phone; ?><br>
                                        <b>Email: </b> <?php echo $v->email; ?><br>
                                        <b>Imei: </b> <?php echo $v->imei; ?><br>
                                    </td>
                                    <td align="left" valign="top" class="cptxt"><br><br>
                                        <?php if($v->status == 0) echo 'Pending'; ?>
                                        <?php if($v->status == 1) echo 'Approved'; ?>
                                        <?php if($v->status == 2) echo 'Cencel'; ?>
                                    </td>
                                    <td height="25" align="center" valign="top" class="cptxt"><br><br>
                                        <?php if($v->status == 0) { ?>
                                            <a href="control-panel.php?menuId=unlock&id=<?php echo $v->id; ?>&module=Unlock&fname=manage-payment.php&DetailMode=Approved" title="Edit Record"><img src="https://images.vexels.com/media/users/3/157890/isolated/lists/4f2c005416b7f48b3d6d09c5c6763d87-check-mark-circle-icon.png" border="0" style="width: 20px; height: 20px;"></a>

                                        <?php } ?>
                                        <a href="control-panel.php?menuId=unlock&id=<?php echo $v->id; ?>&module=Unlock&fname=manage-payment.php&DetailMode=Details" title="Edit Record"><img src="https://img.icons8.com/wired/64/000000/visible.png" border="0" style="width: 20px; height: 20px;"></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
</table>
<?php } ?>