<?php
    include_once("../admin/include/include.inc_2.php");
    include_once("../crud.php");
    $displayMessage = '';

    if(isset($_REQUEST['DetailMode']) && $_REQUEST['DetailMode'] == "Add") {
        $data['name'] = $_POST['name'];

        if(isset($_POST['id']) && $_POST['id'] != '') {
            $id                 = $_POST['id'];
            $displayMessage     = UPDATEMESSAGE;

            $data['status']     = 1;
            $data['modified_on'] = date('Y-m-d H:m:s');
            $update             = update('tbl_unlock_make', $data, "id = $id");
        } else {
            $displayMessage     = ADDMESSAGE;
            $data['created_on'] = date('Y-m-d H:m:s');
            $save = save('tbl_unlock_make', $data);
        }

        header("Location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&message=$displayMessage");
    }

    if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Edit") {
        $id = $_REQUEST['id'];
        $value = read('one', 'tbl_unlock_make', "id = $id", 'id DESC');
    }

    if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Delete") {
        $id                 = $_REQUEST['id'];
        $displayMessage     = DELETEMESSAGE;
        $delete             = delete('tbl_unlock_make', "id = $id");

        header("Location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&message=$displayMessage");
    }

    $data = read('all', 'tbl_unlock_make', 'status = 1', 'id DESC');
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="page_table">
    <tbody>
        <tr>
            <td height="10"></td>
        </tr>

        <tr>
            <td colspan="4" class="cptxt" valign="top" align="center">
                <form name="frmUserDetail" id="frmUserDetail" action="control-panel.php?menuId=unlock&module=Unlock&fname=manage-make.php&DetailMode=Add" method="post" enctype="multipart/form-data">
                    <table width="95%" border="0" cellspacing="0" cellpadding="2">
                        <input name="module" id="module" type="hidden" value="Unlock">
                        <input name="fname" id="fname" type="hidden" value="manage-make.php">

                        <tbody>
                            <tr>
                                <td colspan="4" align="Left" class="tblHeading" height="25">ADD Make</td>
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
                                <td align="left" valign="top" class="cptxt">Name:</td>
                                <td align="left" valign="top">
                                    <input type="text" name="name" id="name" class="textfields" style="width:245px;" value="<?php echo (isset($value)) ? $value->name : ''; ?>" required>
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
                            <td width="84%" height="25" align="left"><strong>Name</strong></td>
                            <td width="8%" align="center"><strong>Edit</strong></td>
                            <td width="8%" align="center"><strong>Delete</strong></td>
                        </tr>

                        <?php foreach ($data as $key => $v) { ?>
                            <tr bgcolor="#f6f6f6">
                                <td align="left" valign="top" class="cptxt"><?php echo $v->name; ?></td>
                                <td height="25" align="center" valign="top" class="cptxt">
                                    <a href="control-panel.php?menuId=unlock&id=<?php echo $v->id; ?>&module=Unlock&fname=manage-make.php&DetailMode=Edit" title="Edit Record"><img src="images/edit.gif" border="0"></a>
                                </td>

                                <td align="center" valign="top" class="cptxt">
                                    <a href="control-panel.php?menuId=unlock&id=<?php echo $v->id; ?>&module=Unlock&fname=manage-make.php&DetailMode=Delete" title="Delete Record" onclick="javascript: return deleteRecordsChk();"><img src="images/delete.gif" border="0"></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>