<?php

include_once("../admin/include/include.inc.php");



##############################################Adding Category############################################################
if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Add") {
	$cbopage 	            = $_POST['cbopage'];
	$mti_desc 	            = prepearString(trim($_POST['mti_desc']));
	$mti_keyword  			= prepearString(trim($_POST['mti_keyword']));
	$mti_others  			= prepearString(trim($_POST['mti_others']));
	$mti_title  			= prepearString(trim($_POST['mti_title']));
	$mti_google  			= prepearString(trim($_POST['mti_google']));
	
	$alreadyExistSql = $objQryBuilder->selectQry("*","tbl_meta_info"," mtp_id = $cbopage ");
	$alreadyExistResult = $objConMgr->DML_executeQry($alreadyExistSql);	

	if( mysql_num_rows($alreadyExistResult) == 0){
	
		$fieldsNames 	= "mtp_id, mti_description, mti_keywords,mti_others,mti_title, mti_google";
		$values 	 	= "$cbopage, $mti_desc, $mti_keyword,$mti_others,$mti_title, $mti_google";
				
		$insertQuery = $objQryBuilder->insertQry("tbl_meta_info",$fieldsNames,$values);
		$insertResult = $objConMgr->DDL_executeQry($insertQuery);
		
	}		
	else{
		$displayMessage = "Meta Tag Information already exists for this page.";
		header("Location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&message=$displayMessage");
	}
	
	switch ($insertResult){
		case 1:
			$displayMessage =  ADDMESSAGE;
			header("Location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&message=$displayMessage");
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

#####################################################Editing Category##########################################################
if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Edit" && $_REQUEST['id'] != "") {
	
	$cbopage 	            = $_POST['cbopage'];
	$mti_desc 	            = prepearString(trim($_POST['mti_desc']));
	$mti_keyword  			= prepearString(trim($_POST['mti_keyword']));
	$mti_others  			= prepearString(trim($_POST['mti_others']));
	$mti_title  			= prepearString(trim($_POST['mti_title']));
	$mti_google  			= prepearString(trim($_POST['mti_google']));
	
	$whereCondition			= "mtp_id = ".$_POST['id'];
	
	$values 				= "mti_description   = $mti_desc
							  ,mti_keywords 	 = $mti_keyword
							  ,mti_others		 = $mti_others
							  ,mti_title		 = $mti_title
							  ,mti_google		 = $mti_google";
	
	$updateQuery = $objQryBuilder->updateQry("tbl_meta_info",$values,$whereCondition);
	$updateQueryResult = $objConMgr->DDL_executeQry($updateQuery);
		
	switch ($updateQueryResult) {
		case 1:
			$displayMessage =  UPDATEMESSAGE;
			header("Location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&message=$displayMessage");
			break;
		case -1:
			$displayMessage =  CONNECTIONERROR; 
			break;
		case -2:
			$displayMessage =  DBSELECTIONERROR; 
			break;
		case -3:
			$displayMessage =  mysql_error(); 
			break;
	}
		
}
	
####################################  Delete User Detail #########################################################		
if(isset($_GET['DetailMode'])&& $_GET['DetailMode'] == "Delete" && $_GET['id']  != "") {

		
		$whereCondition = "mtp_id = ".$_GET['id'];
		$deleteQuery = $objQryBuilder->deleteQry("tbl_meta_info",$whereCondition);
		$deleteResult = $objConMgr->DDL_executeQry($deleteQuery);
	
		switch ($deleteResult) {
			case 1:
				$displayMessage =  DELETEMESSAGE;
				header("Location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&message=$displayMessage");
				break;
			case -1:
				$displayMessage =  CONNECTIONERROR; 
				break;
			case -2:
				$displayMessage =  DBSELECTIONERROR; 
				break;
			case -3:
				$displayMessage =  mysql_error(); 
				break;
		}
	}

if( isset($_REQUEST['message']) && $_REQUEST['message'] !="") {
	$displayMessage = $_REQUEST['message'];
}
?>
<script src="../administrator/jvs/functions.js"></script>
<script>
	function BrowseFile(fieldId){
		var a=document.getElementById('ctg_image').value;
		document.getElementById('browse').value = a;
	}

function deleteRecordsChk() {
	if(confirm("Are you sure that you want to delete this record?")){
		return true;
	} else {
		return false;
	}
}

function submitPaging(frm,page)
	{
		
		document.frmPaging.pageNo.value = page;
		document.frmPaging.submit();
	}

function TrimString(fieldId)
    {
        var txtObj = document.getElementById(fieldId);
		txtObj.value = txtObj.value.replace(/^\s+/,""); //Left trim        
        txtObj.value = txtObj.value.replace(/\s+$/,""); //Right trim
    }

/*function textLimit(field, maxlen) {
	alert(field);
		if (field.value.length > maxlen + 0)
		//alert('your input has been truncated!');
		if (field.value.length > maxlen)
		field.value = field.value.substring(0, maxlen);
	}*/
	
function FrmValidation(mode)
	{
		if(document.getElementById('cbopage').value == ""){
			 document.getElementById('tdcbopage').innerHTML = "Please select Page.";
			 document.getElementById('cbopage').focus;
			 return false;
		}
		else{
			 document.getElementById('tdcbopage').innerHTML = "";
		}
		
		if(document.getElementById('mti_title').value == ""){
			 document.getElementById('tdtitle').innerHTML = "Please enter Title.";
			 document.getElementById('mti_title').focus;
			 return false;
		}
		else{
			 document.getElementById('tdtitle').innerHTML = "";
		}
		
		if(document.getElementById('mti_desc').value == ""){
			 document.getElementById('tddesc').innerHTML = "Please enter Description.";
			 document.getElementById('mti_desc').focus;
			 return false;
		}
		else{
			 document.getElementById('tddesc').innerHTML = "";
		}
		
		if(document.getElementById("mti_keyword").value =="" ) {
			document.getElementById('tdkeyword').innerHTML = "Please enter Keywords.";
			document.getElementById("mti_keyword").focus();
			return false;
		}
		else{
			 document.getElementById('tdkeyword').innerHTML = "";
		}
	/*	
		if(document.getElementById("mti_google").value =="" ) {
			document.getElementById('tdgoogle').innerHTML = "Please enter Google Analytics.";
			document.getElementById("mti_google").focus();
			return false;
		}
		else{
			 document.getElementById('tdgoogle').innerHTML = "";
		}
		*/
	/*	if(document.getElementById("mti_others").value =="" ) {
			document.getElementById('tdothers').innerHTML = "Please enter Keywords.";
			document.getElementById("mti_others").focus();
			return false;
		}
		else{
			 document.getElementById('tdothers').innerHTML = "";
		}*/
		return true;
			
	}

</script>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="page_table">
  <tr>
  <td > 	
	<div class="cptxt1"><strong>Note:</strong> Search Engine Optimization service is absolutely free for Homepage. Please make contact with <a href="http://www.sabritech.com" target="_blank" style="text-decoration:none; "><b>Sabritech</b></a> administrator if you would like to avail our full website optimization service.</div>
</td>
  </tr>
   <tr>
  <td height="10"> 	
	</td>
  </tr>
	<?
################################################# Add product code #########################################################
	if(!isset($_REQUEST['id']))
	 {
		
	?>	
	<tr>
    <td colspan="4" class="cptxt" valign="top" align="center">
	<table width="95%" border="0" cellspacing="0" cellpadding="2">
	<form name="frmUserDetail" id="frmUserDetail" action="control-panel.php?DetailMode=Add&amp;menuId=4&amp;module=<?= $module?>&amp;fname=<?= $fname?>" method="post" enctype="multipart/form-data" onSubmit="javascript: return FrmValidation('add');">
	<input name="module" id="module" type="hidden" value="<? if(isset($_REQUEST['module']) && $_REQUEST['module'] != "") echo $_REQUEST['module'];?>" />
    <input name="fname" id="fname" type="hidden" value="<? if(isset($_REQUEST['fname']) && $_REQUEST['fname'] != "") echo $_REQUEST['fname'];?>" />
 
	<tr>
	  <td colspan="4" align="Left" class="tblHeading" height="25">ADD META TAG INFORMATION</td> 
	  <td align="center" class="tblHeading">&nbsp;</td>
	</tr>

	<tr>
        <td width="2%" class="cptxt">&nbsp;</td>
        <td width="14%" class="cptxt">&nbsp;</td>
        <td colspan="3" align="Left" class="cptxt" height="25"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif"><?=$displayMessage?></font></td>
    </tr>
    
    <tr>
      <td class="cptxt">&nbsp;</td>
      <td align="left" valign="top" class="cptxt">Page:</td>
      <td align="left" valign="top"><select name="cbopage" id="cbopage" class="textfields" >
        <option value="">Please select page</option>
        <?= LoadMetaPages(0) ?>
      </select>
      <span class="manidatory" style="vertical-align:top"> *</span></td>
      <td align="left" valign="top" class="manidatory" id="tdcbopage">&nbsp;</td>
      <td height="25" align="left" class="cptxt">&nbsp;</td>
    </tr>
    <tr>
      <td class="cptxt">&nbsp;</td>
      <td align="left" valign="top" class="cptxt">Title:</td>
      <td align="left" valign="top"><input type="text" name="mti_title" id="mti_title" class="textfields" value="" size="32" maxlength="50" style="width:245px;" />
        <span class="manidatory">*</span></td>
      <td align="left" valign="top" class="manidatory" id="tdtitle">&nbsp;</td>
      <td height="25" align="left" class="cptxt">&nbsp;</td>
    </tr>
    <tr>
      <td class="cptxt">&nbsp;</td>
      <td align="left" valign="top" class="cptxt">Description:</td>
      <td width="47%" align="left" valign="top"><textarea onBlur="TrimString('mti_desc');" name="mti_desc" rows="4" class="textfields" id="mti_desc"></textarea>
      <span class="manidatory" style="vertical-align:top"> *</span></td>
      <td width="33%" align="left" valign="top" class="manidatory" id="tddesc">&nbsp;</td>
      <td height="25" align="left" class="cptxt">&nbsp;</td>
    </tr>
    <tr>
      <td class="cptxt">&nbsp;</td>
      <td align="left" valign="top" class="cptxt">Keywords:</td>
      <td align="left"><textarea onblur="TrimString('mti_keyword');" name="mti_keyword" rows="4" class="textfields" id="mti_keyword"></textarea>    <span class="manidatory" style="vertical-align:top ">*</span> </td>
      <td height="25" align="left" valign="middle" class="manidatory" id="tdkeyword">&nbsp;</td>
      <td width="4%" height="25" align="left" class="cptxt">&nbsp;</td>
    </tr>
    
    <tr>
      <td class="cptxt">&nbsp;</td>
      <td align="left" valign="top" class="cptxt">Others:</td>
      <td align="left"><textarea onblur="TrimString('mti_others');" name="mti_others" rows="4" class="textfields" id="mti_others"></textarea></td>
      <td height="25" align="left" valign="middle" class="manidatory" id="tdothers">&nbsp;</td>
      <td height="25" align="left" class="cptxt">&nbsp;</td>
    </tr>
    <tr>
      <td class="cptxt">&nbsp;</td>
      <td align="left" valign="top" class="cptxt">Google Analytics:</td>
      <td align="left"><textarea onblur="TrimString('mti_google');" name="mti_google" rows="4" class="textfields" id="mti_google"></textarea></td>
      <td height="25" align="left" valign="middle" class="manidatory" id="tdgoogle">&nbsp;</td>
      <td width="4%" height="25" align="left" class="cptxt">&nbsp;</td>
    </tr>
    <tr>
      <td class="cptxt">&nbsp;</td>
      <td class="cptxt" valign="top" align="left">&nbsp;</td>
      <td colspan="2" align="left" style="padding-top:10px;"><input type="image" src="images/cmdSave.gif" title="Save Record">&nbsp;<a href="javascript:document.getElementById('frmUserDetail').reset()"><img src="images/cmdReset.gif" border="0" title="Cancel"/></a></td>
      <td height="26" align="left" class="cptxt">&nbsp;</td>
    </tr>
	 <tr>
	  <td height="25" colspan="5" align="Left" class="cptxt">&nbsp;</td>
	  </tr>
    </form>
	</table></td>
</tr>
<? 
} 
  	############################ Edit block of code in case edit record ################################
	if(isset($_REQUEST['id']) && $_REQUEST['id'] != "") {
		$whereCondition = "mtp_id =".$_REQUEST['id'];
		$selectUserDetailSql = $objQryBuilder->selectQry('*','tbl_meta_info',$whereCondition);

		$selectUserDetailResult = $objConMgr->DML_executeQry($selectUserDetailSql);
		$userDetailRS = mysql_fetch_object($selectUserDetailResult);
  ?>
	<tr>
	    <td colspan="4" class="cptxt" valign="top" align="center">
		<table width="95%" border="0" cellspacing="0" cellpadding="2">
		<form name="frmUserDetail" id="frmUserDetail" action="control-panel.php?DetailMode=Edit&amp;menuId=4&amp;module=<?= $module?>&amp;fname=<?= $fname?>" method="post" enctype="multipart/form-data" onSubmit="javascript: return FrmValidation('Edit');">
		<input name="module" id="module" type="hidden" value="<? if(isset($_REQUEST['module']) && $_REQUEST['module'] != "") echo $_REQUEST['module'];?>" />
  		<input name="fname" id="fname" type="hidden" value="<? if(isset($_REQUEST['fname']) && $_REQUEST['fname'] != "") echo $_REQUEST['fname'];?>" />
  	<tr>
	  <td colspan="4" align="Left" class="tblHeading">EDIT META TAG INFORMATION[ <a href="control-panel.php?menuId=4&amp;module=<?= $module?>&amp;fname=<?= $fname?>&amp;PrtId=<?=$PrtId?>&amp;Type=<?=urlencode($Type)?> " style="text-decoration:none;">ADD META TAG INFORMATION</a> ]</td> 
	  <td align="center" class="tblHeading">&nbsp;</td>
	</tr>
    <tr>
        <td width="2%" class="cptxt">&nbsp;</td>
        <td width="14%" class="cptxt">&nbsp;</td>
        <td colspan="3" align="Left" class="cptxt" height="25"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif"><?=$displayMessage?></font></td>
    </tr>
    <tr>
        <td width="2%" class="cptxt">&nbsp;</td>
        <td align="left" valign="top" class="cptxt">Page:</td>
        <td width="47%" align="left" valign="top"><select name="cbopage" id="cbopage" class="textfields" >
          <option value="">Please select page</option>
          <?= LoadMetaPages($userDetailRS->mtp_id) ?>
          </select>
        <span class="manidatory" style="vertical-align:top"> *</span></td>
        <td width="33%" align="left" valign="middle" class="manidatory" id="tdcbopage">&nbsp;</td>
        <td width="4%" height="25" align="left" class="cptxt">&nbsp;</td>
    </tr>
    <tr>
      <td class="cptxt">&nbsp;</td>
      <td align="left" valign="top" class="cptxt">Title:</td>
      <td align="left" valign="top"><input type="text" name="mti_title" id="mti_title" class="textfields" value="<?=$userDetailRS->mti_title ?>" size="25" maxlength="50" style="width:245px;" />
        <span class="manidatory">*</span></td>
      <td align="left" valign="top" class="manidatory" id="tdtitle">&nbsp;</td>
      <td height="25" align="left" class="cptxt">&nbsp;</td>
    </tr>
    <tr>
        <td class="cptxt">&nbsp;</td>
        <td align="left" valign="top" class="cptxt">Description:</td>
        <td align="left" valign="top"><textarea onBlur="TrimString('mti_desc');" name="mti_desc" rows="4" class="textfields" id="mti_desc"><?=$userDetailRS->mti_description ?></textarea>
        <span class="manidatory" style="vertical-align:top"> *</span></td>
        <td align="left" valign="top" class="manidatory" id="tddesc">&nbsp;</td>
        <td height="25" align="left" class="cptxt">&nbsp;</td>
    </tr>
    <tr>
      <td class="cptxt">&nbsp;</td>
      <td align="left" valign="top" class="cptxt">Keywords:</td>
      <td align="left"><textarea onblur="TrimString('mti_keyword');" name="mti_keyword" rows="4" class="textfields" id="mti_keyword"><?=$userDetailRS->mti_keywords ?></textarea>
        <span class="manidatory" style="vertical-align:top ">*</span></td>
      <td height="25" align="left" valign="top" class="manidatory" id="tdkeyword">&nbsp;</td>
    </tr>
    
    <tr>
      <td class="cptxt">&nbsp;</td>
      <td align="left" valign="top" class="cptxt">Others:</td>
      <td align="left"><textarea onblur="TrimString('mti_others');" name="mti_others" rows="4" class="textfields" id="mti_others"><?=stripslashes($userDetailRS->mti_others) ?></textarea></td>
      <td height="25" align="left" valign="middle" class="manidatory" id="tdothers">&nbsp;</td>
      <td height="25" align="left" class="cptxt">&nbsp;</td>
    </tr>
    <tr>
      <td class="cptxt">&nbsp;</td>
      <td align="left" valign="top" class="cptxt">Google Analytics:</td>
      <td align="left"><textarea onblur="TrimString('mti_google');" name="mti_google" rows="4" class="textfields" id="mti_google"><?=$userDetailRS->mti_google ?></textarea></td>
      <td height="25" align="left" valign="middle" class="manidatory" id="tdgoogle">&nbsp;</td>
      <td width="4%" height="25" align="left" class="cptxt">&nbsp;</td>
    </tr>
    <tr>
      <td class="cptxt">&nbsp;</td>
      <td class="cptxt" valign="top" align="left">&nbsp;</td>
      <td colspan="2" align="left" style="padding-top:10px;"><input type="image" src="images/cmdUpdate.gif" title="Update Record">&nbsp;<a href="javascript:document.getElementById('frmUserDetail').reset()"><img src="images/cmdReset.gif" border="0" title="Cancel"/></a></td>
      <td height="26" align="left" class="cptxt"><input name="id" id="id" type="hidden" value="<?=$userDetailRS->mtp_id?>"/></td>
    </tr>
	 <tr>
	  <td height="25" colspan="5" align="Left" class="cptxt">&nbsp;</td>
	  </tr>
    </form>
	</table>	
  
</tr>
<? }  // edit if statment ?>

<? 
############################# Display User Information################################

	$sqlMPI = "SELECT mti.*, mtp.* FROM tbl_meta_info mti INNER JOIN tbl_meta_pages mtp ON mtp.mtp_id = mti.mtp_id ORDER BY mtp_page ";
	$paging_results = new MySQLPagedResults($sqlMPI,"pageNo","",20,"100","<<","Previous","Next",">>"," | ");
    $first_nav 		= $paging_results->getFirstNav();
	$prev_nav 		= $paging_results->getPrevNav();
	$next_nav 		= $paging_results->getNextNav();
	$last_nav 		= $paging_results->getLastNav();
	$pages_nav 		= $paging_results->getPagesNav();
	$offset 		= $paging_results->currentOffset();
	
	$results_per_page = $paging_results->results_per_page; 
	$limit = " LIMIT $offset , $results_per_page"; // Limit variable for paging display

    $sqlMPI .= $limit;
   $CategoriesResult = $objConMgr->DML_executeQry($sqlMPI);

if(mysql_num_rows($CategoriesResult) > 0) { ?>
<tr>
	<td colspan="4" class="cptxt" valign="top" align="center">
	<table width="95%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">
	<tr class="tblHeading">          
          <td width="15%" height="25" align="left"><strong>Page</strong></td>
          <td width="18%" align="left"><strong>Title</strong></td>
          <td width="19%" height="25" align="left"><strong>Description</strong></td>
          <td width="15%" align="left"><strong>Keywords</strong></td>
          <td width="8%" align="center"><strong>Edit</strong></td>
          <td width="8%" align="center"><strong>Delete</strong></td>
        </tr>
<?
$bg = "#f0f0f0";
$counter = 0;
while($userDetailRS = mysql_fetch_object($CategoriesResult)) {
?>
<tr bgcolor="<?= ($counter%2 != 0 ? $bg : "#f6f6f6") ?>">
	
	<td  align="left" valign="top" class="cptxt"><?=$userDetailRS->mtp_page?></td>
	<td  align="left" valign="top" class="cptxt"><?=substr($userDetailRS->mti_title,0,50)?>...</td>
    <td  align="left" valign="top" class="cptxt"><?=substr($userDetailRS->mti_description,0,50)?>...</td>
	<td class="cptxt"><?=substr($userDetailRS->mti_keywords,0,50)?>...</td>
    <td height="25" align="center" valign="top" class="cptxt"><a href="control-panel.php?menuId=4&id=<?=$userDetailRS->mtp_id?>&module=<? if(isset($_REQUEST['module']) && $_REQUEST['module'] != "") echo $_REQUEST['module'];?>&fname=<? if(isset($_REQUEST['fname']) && $_REQUEST['fname'] != "") echo $_REQUEST['fname'];?>" title="Edit Record"><img src="images/edit.gif" border="0"/></a></td>
	<td align="center" valign="top" class="cptxt"><a href="control-panel.php?menuId=4&id=<?=$userDetailRS->mtp_id?>&module=<? if(isset($_REQUEST['module']) && $_REQUEST['module'] != "") echo $_REQUEST['module'];?>&fname=<? if(isset($_REQUEST['fname']) && $_REQUEST['fname'] != "") echo $_REQUEST['fname'];?>&DetailMode=Delete" title="Delete Record" onClick="javascript: return deleteRecordsChk();"><img src="images/delete.gif" border="0"/></a></td>
</tr>
<? $counter++; }?>
</table>

<table style="padding:5px;" cellpadding="1" width="100%" align="right"  border=0 cellspacing=10>
<form method="post" name="frmPaging" enctype="multipart/form-data">
	<input name="pageNo" type="hidden" value="1" id="pageNo">
    <input name="PrtId" type="hidden" value="<?=$PrtId?>" id="PrtId">
    <input name="Type" type="hidden" value="<?=$Type?>" id="Type">
</form>
				<tr>
					<a><td align="right" style="padding-right:10px " class="cptxt">
						  <?
                              if($paging_results->totalPages() > 1) {
                                  echo "$first_nav $prev_nav $pages_nav $next_nav $last_nav"; 
                              }
                          ?>	
		          </td></a>
              </tr>
	  </table></td>
</tr>
<? } else{?>
<tr>
	<td colspan="4" class="cptxt" valign="top" align="center"><b>No Record Found</b></td>    
</tr>
<? } ?>
</table>