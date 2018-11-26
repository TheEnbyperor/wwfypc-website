<?php
include_once ("fckeditor/fckeditor.php");
include_once ("lib/connection-manager-mysql.class.php");
include_once ("lib/query-builder-mysql.class.php");

$controller = new Controller();
$objQryBuilder = new QueryBuilder();
$objConMgr = new ConnectionMgr();

function prepearString($value)
{
    $objConMgr = new ConnectionMgr();
    $value = mysql_real_escape_string(trim($value), $objConMgr->createConnection());
    $value = "'" . $value . "'";
    return $value;
}

if (isset($_GET['Mode']) && $_GET['Mode'] == "update")
{
    $displayMessage = "";
    $whereCondition = "	pageID = " . $_POST['pageId'];

    $pageContent = prepearString($_POST['ptext']);
    $values = "pageText=$pageContent";
    $updateQry = $objQryBuilder->updateQry("tbl_pages", $values, $whereCondition);
    $result = $objConMgr->DDL_executeQry($updateQry);

    ############### Selecting proper message according to return value
    switch ($result)
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
            $displayMessage = QUERYERROR . mysql_error();
            break;
    }
}
?>

<table width="100%" border="0" cellpadding="2" cellspacing="0" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">
  <form name="frmEditPages" id="frmEditPages" action="control-panel.php" method="post" onsubmit="">
    <input type="hidden" name="module" id="module" value="<?php if (isset($_REQUEST['module']))
    echo $_REQUEST['module']; ?>">
    <input type="hidden" name="fname" id="fname" value="<?php if (isset($_REQUEST['fname']))
    echo $_REQUEST['fname']; ?>">
    <tr>
      <td width="2%">&nbsp;</td>
      <td width="14%" class="cptxt">&nbsp;</td>
      <td width="74%" class="cptxt">&nbsp;</td>
      <td width="8%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
    </tr>
    <tr class="tblHeadingcase">
      <td height="24">&nbsp;</td>
      <td height="24">Edit Pages:</td>
      <td height="24">
	  <select name="cmbPages" id="cmbPages" style="width:310px!important;width:280px;" class="cptxt">
		<?php
		$SelectedPage = "";
		if (isset($_POST['cmbPages']) && $_POST['cmbPages'] != "")
		{
			$SelectedPage = $_POST['cmbPages'];
		} else
		{
			$SelectedPage = "2";
		}
		
		$query = '';
		$query = $objQryBuilder->selectQry("*", "tbl_pages", "");
		$result = $objConMgr->DML_executeQry($query);
		while ($editPageRecordset = mysql_fetch_object($result))
		{
			if ($SelectedPage == $editPageRecordset->pageID)
			{
				echo "<option class='cptxt' value='$editPageRecordset->pageID' selected>" . ucwords(strtolower(trim($editPageRecordset->pageName))) . "</option>";
			} else
			{
				echo "<option class='cptxt' value='$editPageRecordset->pageID'>" . ucwords(strtolower(trim($editPageRecordset->pageName))) . "</option>";
			}
		}
		?>
        </select>
      </td>
      <td height="24"><input type="image" src="images/CMS_Button_show-Pahe.gif"></td>
      <td ></td>
    </tr>
    <tr class="">
      <td height="24">&nbsp;</td>
      <td height="24">&nbsp;</td>
      <td height="24"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">
        <?php if (isset($displayMessage)) echo $displayMessage; ?>
        </font></td>
      <td height="24"  >&nbsp;</td>
      <td  >&nbsp;</td>
    </tr>
    <tr>
      <td height="24" colspan="5" align="center" class="cptxt">&nbsp;</td>
    </tr>
  </form>
</table>
<?php

$whereCondition = "pageID = '$SelectedPage'";
$sqlQuery = "";
$query = $objQryBuilder->selectQry("*", "tbl_pages", $whereCondition);
$result = $objConMgr->DML_executeQry($query);
$recordsetOfPageContent = mysql_fetch_object($result);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <form name="frmEditPages" id="frmEditPages" action="control-panel.php?Mode=update" method="post" onsubmit="">
    <input type="hidden" name="pageId" id="pageId" value="<?php if ($controller->CheckIsSet($SelectedPage))
    echo $SelectedPage; ?>">
    <input type="hidden" name="module" id="module" value="<?php if (isset($_REQUEST['module']))
    echo $_REQUEST['module']; ?>" >
    <input type="hidden" name="fname" id="fname" value="<?php if (isset($_REQUEST['fname']))
    echo $_REQUEST['fname']; ?>">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <tr>
      <td width="99%" height="24" class="tblHeading">&nbsp;&nbsp; Page content </td>
    </tr>
    <tr>
      <td height="35" align="center">
	  <?php
		$content = stripslashes($recordsetOfPageContent->pageText);
		//$content = stripslashes($content);
		$_GET['Skin'] = "office2003";
		$sBasePath = $_SERVER['PHP_SELF'];
		$sBasePath = substr($sBasePath, 0, strpos($sBasePath, "editpages.php"));
		$sBasePath = FCKEDITOR;
		$oFCKeditor = new FCKeditor('ptext');
		$oFCKeditor->BasePath = $sBasePath;
		//print $oFCKeditor->BasePath;
		
		if (isset($_GET['Skin']))
			$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/' . htmlspecialchars($_GET['Skin']) . '/';
		
		//print_r($oFCKeditor->Config);
		//$oFCKeditor->ToolbarSet	= 'Basic' ;
		$oFCKeditor->Value = $content;
		$oFCKeditor->Create();
		?>
	  </td>
    </tr>
    <tr>
      <td height="35" align="center" class="cptxt"><input type="image" src="images/cmdSave.gif"/></td>
    </tr>
  </form>
</table>