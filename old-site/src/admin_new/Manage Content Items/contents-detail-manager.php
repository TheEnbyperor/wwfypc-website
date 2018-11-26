<?php
ob_start();
include_once ("require/webconfig.inc.php");
include_once ("require/sessions.inc.php");
include_once ("fckeditor/fckeditor.php");

include_once ("lib/connection-manager-mysql.class.php");

include_once ("lib/query-builder-mysql.class.php");

include_once ("lib/images.class.php");



$objQryBuilder = new QueryBuilder();

$objConMgr = new ConnectionMgr();

$displayMessage = "";



if (isset($_REQUEST['DetailMode']) && $_REQUEST['DetailMode'] == "Edit")

{

    $pageContent = addslashes(trim($_POST['contentDetail']));

    $whereCondition = "pageId = " . $_POST['contentId'];

    $values = "pageText='$pageContent'";



    $updateQuery = $objQryBuilder->updateQry("tbl_pages", $values, $whereCondition);

    $updateQueryResult = $objConMgr->DDL_executeQry($updateQuery);



    switch ($updateQueryResult)

    {

        case 1:

            $displayMessage = UPDATEMESSAGE;

            break;

        case - 1:

            $displayMessage = CONNECTIONERROR;

            break;

        case - 2:

            $displayMessage = DBSELECTIONERROR;

            break;

        case - 3:

            $displayMessage = QUERYERROR;

            break;

    }

}

####################################  End of Update Contents Record   #######################################

?>

<style type="text/css">

.btn {

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-size: 9px;

	border: 1px solid #383a3c;

	height: 20px;

	width: 110px;

	color: #000000;

}

</style>

<script src="jvs/functions.js"></script>

<script language="javascript" type="text/javascript">

function Reset()

{

document.getElementById('frmContentsDetail').reset();

FCKeditorAPI.GetInstance('contentDetail').EditorWindow.parent.FCK.SetHTML('');

}

</script>

<script>

	function TrimString()

    {

        var txtObj = document.getElementById("txtPageTitle");

		txtObj.value = txtObj.value.replace(/^\s+/,""); //Left trim        

        txtObj.value = txtObj.value.replace(/\s+$/,""); //Right trim

    }

</script>

<script>

	function textLimit(field, maxlen) {

		if (field.value.length > maxlen + 0)

		document.getElementById('tderror').innerHTML='Only '+maxlen +' characters are allowed.';

		if (field.value.length > maxlen)

		field.value = field.value.substring(0, maxlen);

	}

</script>

<link href="../admin/css/style.css" rel="stylesheet" type="text/css">

</head><table width="100%" border="0" cellspacing="0" cellpadding="2">

  <tr>

    <td height="19" colspan="4" class="conetntmenutxt" valign="middle">&nbsp;&nbsp;</td>

  </tr>

  <?php if (isset($_REQUEST['contentId']) && $_REQUEST['contentId'] != "")

{

    $whereCondition = "pageId   =" . $_REQUEST['contentId'];

    $selectContentDetailSql = $objQryBuilder->selectQry('*', ' tbl_pages', $whereCondition);

    $selectContentDetailResult = $objConMgr->DML_executeQry($selectContentDetailSql);

    $contentDetailRS = mysql_fetch_object($selectContentDetailResult);



?>

  <tr>

    <td colspan="4" class="cptxt" valign="top" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">

        <form name="frmContentsDetail" id="frmContentsDetail" action="control-panel.php?DetailMode=Edit&menuId=1&module=Manage%20Content%20Items&fname=contents-detail-manager.php" method="post" enctype="multipart/form-data">

          <input name="module" id="module" type="hidden" value="<?php if (isset($_REQUEST['module']) && $_REQUEST['module'] != "")

        echo $_REQUEST['module']; ?>"/>

          <input name="fname" id="fname" type="hidden" value="<?php if (isset($_REQUEST['fname']) && $_REQUEST['fname'] != "")

        echo $_REQUEST['fname']; ?>"/>

          <tr>

            <td height="25" colspan="3" align="Left" class="tblHeading">Edit Content</td>

            <td height="25"  align="center" class="tblHeading">&nbsp;</td>

            <td  align="center" class="tblHeading">&nbsp;</td>

          </tr>

          <tr>

            <td width="1%" class="cptxt">&nbsp;</td>

            <td width="32%" class="cptxt">&nbsp;</td>

            <td colspan="3" align="Left" class="cptxt" height="25"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">

              <?php echo $displayMessage; ?>

              </font></td>

          </tr>

          <tr>

            <td width="1%" class="cptxt">&nbsp;</td>

            <td align="left" valign="top" class="cptxt" colspan="2">Page Title:&nbsp;&nbsp;&nbsp;<b>

              <?php echo stripslashes($contentDetailRS->pageTitle); ?>

              </b></td>

            <td width="24%" height="25" align="left" class="cptxt" style="color:#F00" id="tderror" valign="top">&nbsp;</td>

            <td width="19%" align="left" class="cptxt" style="color:#F00" id="tderror">&nbsp;</td>

          </tr>

          <?php
		   if ($contentDetailRS->pageId == 2 || $contentDetailRS->pageId == 3 || $contentDetailRS->pageId == 4 || $contentDetailRS->pageId == 5) { ?>

          <tr>

            <td width="1%" class="cptxt">&nbsp;</td>

            <td height="25" colspan="4" align="left" valign="top" class="cptxt">&nbsp;&nbsp;&nbsp;

              <!--<textarea rows="" cols="" name="contentDetail" id="contentDetail" style="width:600px; height:150px;" onkeyup="textLimit(contentDetail,106);" ><?php //echo $contentDetailRS->pageText;?></textarea>-->
              
              <textarea class="ckeditor" id="editor1" name="contentDetail" style="width:600px; height:150px;" onkeyup="textLimit(contentDetail,106);"><?php echo  $contentDetailRS->pageText;?></textarea>

            </td>

          </tr>

          <?php } else { ?>

          <tr>

            <td width="1%" class="cptxt">&nbsp;</td>

            <td height="25" colspan="4" align="left" valign="top" class="cptxt">
            
              <textarea class="ckeditor" id="editor1" name="contentDetail" style="width:600px; height:150px;" onkeyup="textLimit(contentDetail,106);"><?php echo @$contentDetailRS->pageText;?></textarea>            			

			<?php

			/*$content = stripslashes($contentDetailRS->pageText);	

			//$_GET['Skin'] = "office2003";

			$sBasePath = $_SERVER['PHP_SELF'];

			$sBasePath = substr($sBasePath, 0, strpos($sBasePath, "contents-detail-manager.php"));

			$sBasePath = FCKEDITOR;

			$oFCKeditor = new FCKeditor('contentDetail');

			$oFCKeditor->BasePath = $sBasePath;

			//if (isset($_GET['Skin']))

				//$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/' . htmlspecialchars($_GET['Skin']) . '/';

			$oFCKeditor->Value = $content;

			$oFCKeditor->Create();*/

			?></td>

          </tr>

          <?php } ?>

          <tr>

            <td class="cptxt">&nbsp;</td>

            <td align="left" valign="top" class="cptxt">&nbsp;</td>

            <td width="24%" align="left">&nbsp;</td>

            <td height="25" align="left" class="cptxt">&nbsp;</td>

            <td align="left" class="cptxt">&nbsp;</td>

          </tr>

          <tr>

            <td class="cptxt">&nbsp;</td>

            <td class="cptxt" valign="top" align="left"><input name="Mode" id="Mode" type="hidden" value="<?php if (isset($_REQUEST['Mode']) && $_REQUEST['Mode'] != "") echo $_REQUEST['Mode']; ?>" /></td>

            <td height="26" colspan="2" align="left"><input type="image" src="images/cmdUpdate.gif" title="Update Record" tabindex="3" />&nbsp;<a href="control-panel.php?menuId=1&module=Manage Content Items&fname=contents-detail-manager.php&contentId=(<?= $contentDetailRS->pageId ?>)"><img src="images/cmdReset.gif" title="Reset" border="0"/></a> &nbsp;

              <input type="hidden" name="contentId" id="contentId" value="<?php echo $contentDetailRS->pageId;?>" /></td>

            <td align="left" class="cptxt">&nbsp;</td>

          </tr>

          <tr>

            <td height="25" colspan="5" align="Left" class="cptxt">&nbsp;</td>

          </tr>

        </form>

      </table></td>

  </tr>

  <?php } ?>

  <tr>

    <td colspan="4" class="manidatory" valign="top" align="center">&nbsp;</td>

  </tr>

</table>
<script src="ckeditor/ckeditor.js"></script>