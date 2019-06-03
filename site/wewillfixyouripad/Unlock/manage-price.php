<?php
    include_once("../admin/include/include.inc_2.php");
    include_once("../crud.php");
    $displayMessage = '';

    if(isset($_REQUEST['DetailMode']) && $_REQUEST['DetailMode'] == "Add") {
        $data['make']       = $_POST['make'];
        $data['model']      = $_POST['model'];
        $data['network']    = $_POST['network'];
        $data['price']      = $_POST['price'];
        $data['days']       = $_POST['days'];

        if(isset($_POST['id']) && $_POST['id'] != '') {
            $id                 = $_POST['id'];
            $displayMessage     = UPDATEMESSAGE;

            $data['status']     = 1;
            $data['modified_on'] = date('Y-m-d H:m:s');
            $update             = update('tbl_unlock_price', $data, "id = $id");
        } else {
            $displayMessage     = ADDMESSAGE;
            $data['created_on'] = date('Y-m-d H:m:s');
            $save = save('tbl_unlock_price', $data);
        }

        header("Location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&message=$displayMessage");
    }

    if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Edit") {
        $id = $_REQUEST['id'];
        $value = read('one', 'tbl_unlock_price', "id = $id", 'id DESC');
    }

    if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Delete") {
        $id                 = $_REQUEST['id'];
        $displayMessage     = DELETEMESSAGE;
        $delete             = delete('tbl_unlock_price', "id = $id");

        header("Location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&message=$displayMessage");
    }

    $data = read('all', 'tbl_unlock_price', 'status = 1', 'id DESC');

    $make       = read('all', 'tbl_unlock_make', 'status = 1', 'id ASC');
    $model      = read('all', 'tbl_unlock_model', 'status = 1', 'id ASC');
    $network    = read('all', 'tbl_unlock_network', 'status = 1', 'id ASC');
?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="page_table">
    <tbody>
        <tr>
            <td height="10"></td>
        </tr>

        <tr>
            <td colspan="4" class="cptxt" valign="top" align="center">
                <form name="frmUserDetail" id="frmUserDetail" action="control-panel.php?menuId=unlock&module=Unlock&fname=manage-price.php&DetailMode=Add" method="post" enctype="multipart/form-data">
                    <table width="95%" border="0" cellspacing="0" cellpadding="2">
                        <input name="module" id="module" type="hidden" value="Unlock">
                        <input name="fname" id="fname" type="hidden" value="manage-price.php">

                        <tbody>
                            <tr>
                                <td colspan="4" align="Left" class="tblHeading" height="25">ADD Price</td>
                                <td align="center" class="tblHeading">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="cptxt">&nbsp;</td>
                                <td class="cptxt">&nbsp;</td>
                                <td>
                                    <font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">
                                        <?php echo (isset($_GET['message']) ? $_GET['message'] : ''); ?>        
                                    </font>
                                </td>
                            </tr>

                            <tr>
                                <td width="2%" class="cptxt">&nbsp;</td>
                                <td width="14%" class="cptxt">&nbsp;</td>
                                <td colspan="3" align="Left" class="cptxt" height="25"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif"></font></td>

                            </tr>

                            <tr>
                                <td class="cptxt">&nbsp;</td>
                                <td align="left" valign="top" class="cptxt">Make:</td>
                                <td align="left" valign="top">
                                    <select class="textFields" name="make" id="make" style="width: 245px;" required>
                                        <?php foreach ($make as $key => $v) { ?>
                                            <option value="<?php echo $v->id; ?>" <?php echo (isset($value) && $value->make == $v->id) ? 'selected' : '' ?> ><?php echo $v->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="manidatory">*</span>
                                </td>
                                <td align="left" valign="top" class="manidatory" id="tdtitle">&nbsp;</td>
                                <td height="25" align="left" class="cptxt">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="cptxt">&nbsp;</td>
                                <td align="left" valign="top" class="cptxt">Model:</td>
                                <td align="left" valign="top">
                                    <select class="textFields" name="model" id="model" style="width: 245px;" required>
                                        <?php foreach ($model as $key => $v) { ?>
                                            <option class="hide_model m<?php echo $v->make; ?>" value="<?php echo $v->id; ?>" <?php echo (isset($value) && $value->model == $v->id) ? 'selected' : '' ?> ><?php echo $v->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="manidatory">*</span>
                                </td>
                                <td align="left" valign="top" class="manidatory" id="tdtitle">&nbsp;</td>
                                <td height="25" align="left" class="cptxt">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="cptxt">&nbsp;</td>
                                <td align="left" valign="top" class="cptxt">Network:</td>
                                <td align="left" valign="top">
                                    <select class="textFields" name="network" id="network" style="width: 245px;" required>
                                        <?php foreach ($network as $key => $v) { ?>
                                            <option value="<?php echo $v->id; ?>" <?php echo (isset($value) && $value->network == $v->id) ? 'selected' : '' ?> ><?php echo $v->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="manidatory">*</span>
                                </td>
                                <td align="left" valign="top" class="manidatory" id="tdtitle">&nbsp;</td>
                                <td height="25" align="left" class="cptxt">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="cptxt">&nbsp;</td>
                                <td align="left" valign="top" class="cptxt">Price (GBP):</td>
                                <td align="left" valign="top">
                                    <input type="number" min="1" name="price" id="price" class="textfields" style="width:245px;" value="<?php echo (isset($value)) ? $value->price : ''; ?>" required>
                                    <span class="manidatory">*</span>
                                </td>
                                <td align="left" valign="top" class="manidatory" id="tdtitle">&nbsp;</td>
                                <td height="25" align="left" class="cptxt">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="cptxt">&nbsp;</td>
                                <td align="left" valign="top" class="cptxt">Days:</td>
                                <td align="left" valign="top">
                                    <input type="number" min="1" name="days" id="days" class="textfields" style="width:245px;" value="<?php echo (isset($value)) ? $value->days : ''; ?>" required>
                                    <input type="hidden" name="id" value="<?php echo (isset($value)) ? $value->id : ''; ?>">
                                    <span class="manidatory">*</span>
                                </td>
                                <td align="left" valign="top" class="manidatory" id="tdtitle">&nbsp;</td>
                                <td height="25" align="left" class="cptxt">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="cptxt">&nbsp;</td>
                                <td class="cptxt" valign="top" align="left">&nbsp;</td>
                                <td colspan="2" align="left" style="padding-top:10px;">
                                    <?php if(!isset($value)) { ?>
                                        <input type="image" src="images/cmdSave.gif" title="Save Record">&nbsp;
                                    <?php } else { ?>
                                        <input type="image" src="images/cmdUpdate.gif" title="Update Record">&nbsp;
                                    <?php } ?>
                                    <a href="javascript:document.getElementById('frmUserDetail').reset()"><img src="images/cmdReset.gif" border="0" title="Cancel"></a>
                                </td>

                                <td height="26" align="left" class="cptxt">&nbsp;</td>
                            </tr>
                            <tr>
                                <td height="25" colspan="5" align="Left" class="cptxt">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </td>
        </tr>

        <tr>
            <td colspan="4" class="cptxt" valign="top" align="center">
                <table width="95%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">
                    <tbody>
                        <tr class="tblHeading">
                            <td width="15%" height="25" align="left"><strong>Make</strong></td>
                            <td width="15%" height="25" align="left"><strong>Model</strong></td>
                            <td width="15%" height="25" align="left"><strong>Network</strong></td>
                            <td width="15%" height="25" align="left"><strong>Price</strong></td>
                            <td width="15%" height="25" align="left"><strong>Days</strong></td>
                            <td width="8%" align="center"><strong>Edit</strong></td>
                            <td width="8%" align="center"><strong>Delete</strong></td>
                        </tr>

                        <?php
                            foreach ($data as $key => $v) {
                                $one_make       = read('one', 'tbl_unlock_make', "id = $v->make", 'id ASC');
                                $one_model      = read('one', 'tbl_unlock_model', "id = $v->model", 'id ASC');
                                $one_network    = read('one', 'tbl_unlock_network', "id = $v->network", 'id ASC');
                        ?>
                            <tr bgcolor="#f6f6f6">
                                <td align="left" valign="top" class="cptxt"><?php echo $one_make->name; ?></td>
                                <td align="left" valign="top" class="cptxt"><?php echo $one_model->name; ?></td>
                                <td align="left" valign="top" class="cptxt"><?php echo $one_network->name; ?></td>
                                <td align="left" valign="top" class="cptxt"><?php echo $v->price; ?> GBP</td>
                                <td align="left" valign="top" class="cptxt"><?php echo $v->days; ?></td>
                                <td height="25" align="center" valign="top" class="cptxt">
                                    <a href="control-panel.php?menuId=unlock&id=<?php echo $v->id; ?>&module=Unlock&fname=manage-price.php&DetailMode=Edit" title="Edit Record"><img src="images/edit.gif" border="0"></a>
                                </td>

                                <td align="center" valign="top" class="cptxt">
                                    <a href="control-panel.php?menuId=unlock&id=<?php echo $v->id; ?>&module=Unlock&fname=manage-price.php&DetailMode=Delete" title="Delete Record" onclick="javascript: return deleteRecordsChk();"><img src="images/delete.gif" border="0"></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<script type="text/javascript">
    $('#make').on('change', function() {
       var make    = $('#make').val();
       $('#model').val('');
        $('.hide_model').hide();
        $('.m'+make).show(); 
    });

    var make    = $('#make').val();
    $('.hide_model').hide();
    $('.m'+make).show();
</script>