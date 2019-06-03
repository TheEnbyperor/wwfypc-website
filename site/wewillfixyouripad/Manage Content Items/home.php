<?
	ob_start();
	include_once("require/webconfig.inc.php");
	include_once("require/sessions.inc.php");
	include_once("fckeditor/fckeditor.php");
	include_once("lib/connection-manager-mysql.class.php");
	include_once("lib/query-builder-mysql.class.php");
	include_once("lib/images.class.php");
	
	$objQryBuilder = & new QueryBuilder();
	$objConMgr = & new ConnectionMgr();
	$displayMessage = "";
	
	 

if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Edit")
		{
			 //die();
			 //print_r($_POST);
			 //die();
			 //$pageTitle   = prepearString($_POST['txtPageTitle']);
			 $pageContent    = prepearString(trim($_POST['contentDetail']));
			 $whereCondition = "pageId = ".$_POST['contentId'];
			 
			 
			 $values = "pageText=$pageContent";
			 
			 
			 $updateQuery = $objQryBuilder->updateQry("tbl_pages",$values,$whereCondition);
			 $updateQueryResult = $objConMgr->DDL_executeQry($updateQuery);
			 
			############### Selecting proper message according to return value  		
				switch ($updateQueryResult) 
					{
							case 1:
								$displayMessage =  UPDATEMESSAGE;
								break;
						   case -1:
								$displayMessage =  CONNECTIONERROR; 
								break;
						   case -2:
								$displayMessage =  DBSELECTIONERROR; 
								break;
						   case -3:
								$displayMessage =  QUERYERROR; 
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

<link href="../administrator/css/style.css" rel="stylesheet" type="text/css"></head>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td height="19" colspan="4" class="conetntmenutxt" valign="middle">&nbsp;&nbsp;</td>
  </tr>
  
  <?
	if(isset($_REQUEST['contentId']) && $_REQUEST['contentId'] != "")
	{
		$whereCondition = "pageId   =".$_REQUEST['contentId'];
		$selectContentDetailSql = $objQryBuilder->selectQry('*',' tbl_pages',$whereCondition);
		$selectContentDetailResult = $objConMgr->DML_executeQry($selectContentDetailSql);
		$contentDetailRS = mysql_fetch_object($selectContentDetailResult);
		
		
  ?>
   <tr>
    <td colspan="4" class="cptxt" valign="top" align="center">
	<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">
	<form name="frmContentsDetail" id="frmContentsDetail" action="home.php?DetailMode=Edit" method="post" enctype="multipart/form-data" onsubmit="javascript: return FrmValidation();">
	 <input name="module" id="module" type="hidden" value="<? if(isset($_REQUEST['module']) && $_REQUEST['module'] != "") echo $_REQUEST['module'];?>"/>
	<input name="fname" id="fname" type="hidden" value="<? if(isset($_REQUEST['fname']) && $_REQUEST['fname'] != "") echo $_REQUEST['fname'];?>"/>
	<tr>
	  <td height="25" colspan="3" align="Left" class="tblHeading">Edit <? echo (isset($_REQUEST['Mode']) && $_REQUEST['Mode'] == 'Publish')?"Publish ":"Draft ";?>Content</td> 
	   <td height="25"  align="center" class="tblHeading">&nbsp;</td>
	</tr>
	<tr>
	 <td width="1%" class="cptxt">&nbsp;</td>
	 <td width="32%" class="cptxt">&nbsp;</td>
	<td colspan="2" align="Left" class="cptxt" height="25"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif"><?=$displayMessage?></font></td> </tr>
	  

		<tr>
      <td width="1%" class="cptxt">&nbsp;</td>
        <td width="32%" align="left" valign="top" class="cptxt" colspan="2">Page Title:&nbsp;&nbsp;&nbsp;<b><?=stripslashes($contentDetailRS->pageTitle)?></b></td>
        
        <td width="19%" height="25" align="left" class="cptxt">&nbsp;</td>
      </tr>
	   <tr>
	  <td width="1%" class="cptxt">&nbsp;</td>
        <td height="25" colspan="3" align="left" valign="top" class="cptxt">&nbsp;&nbsp;&nbsp;<a tabindex="2"><?php
		/////////////////////////before//////////////////////////////////////				  
				
				$content = stripslashes($contentDetailRS->pageText);
				
				$_GET['Skin'] = "office2003";
				$sBasePath = $_SERVER['PHP_SELF'] ;
				$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "contents-detail-manager.php" ) ) ;
				$sBasePath =  FCKEDITOR;
				$oFCKeditor = new FCKeditor('contentDetail') ;
				$oFCKeditor->BasePath = $sBasePath ;
				if ( isset($_GET['Skin']) )
				$oFCKeditor->Config['SkinPath'] = $sBasePath.'editor/skins/' . htmlspecialchars($_GET['Skin']) . '/' ;
				$oFCKeditor->Value = $content ;
				$oFCKeditor->Create() ;
		/////////////////before ends//////////////////////////////////////
		
?></a></td>
        </tr>

		
		<tr>
		  <td class="cptxt">&nbsp;</td>
		  <td align="left" valign="top" class="cptxt">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  <td height="25" align="left" class="cptxt">&nbsp;</td>
		  </tr>
		<tr>
		
      <tr>
        <td class="cptxt">&nbsp;</td>
        <td class="cptxt" valign="top" align="left"><input name="Mode" id="Mode" type="hidden" value="<? if(isset($_REQUEST['Mode']) && $_REQUEST['Mode'] != "") echo $_REQUEST['Mode'];?>" /></td>
        <td align="left">
			<input type="image" src="../administrator/images/cmdUpdate.gif" title="Update Record" tabindex="3">
			&nbsp;<a href="#" tabindex="4"><img src="../administrator/images/cmdReset.gif" title="Reset" border="0"/></a>
			&nbsp;<a href="#" onclick="window.close()" tabindex="5"><img src="../administrator/images/Back.gif" border="0" title="Back" width="77" height="29" style="cursor:pointer; "/></a>
			</td>
        <td height="26" align="left" class="cptxt"><input type="hidden" name="contentId" id="contentId" value="<?=$contentDetailRS->pageId?>" /></td>
      </tr>
	  
	 <tr>
	  <td height="25" colspan="4" align="Left" class="cptxt">&nbsp;</td>
	  </tr>
    </form></table></td>
  </tr>
  <? } ?>
   <tr>
    <td colspan="4" class="manidatory" valign="top" align="center">&nbsp;</td>
  </tr>
  
  
  
  
  
  
  
  
</table>