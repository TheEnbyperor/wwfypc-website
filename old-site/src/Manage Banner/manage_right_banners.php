<?
include_once("../admin/include/include.inc.php");
###

if(isset($_REQUEST['id']) && $_REQUEST['id'] == 1)
{
$image_width 	= 240;
$image_height 	= 340;
}
else
{
$image_width 	= 240;
$image_height 	= 120;
}
###################### Enable Record ###################
if(isset($_GET['enablestatus']) && $_GET['enablestatus']>0)
{
		$values = "status = 1 ";

		$whereCondition = " id = ".treatGet($_GET['enablestatus']);
		$updateQuery = $objQryBuilder->updateQry("tbl_rightpanel_images",$values,$whereCondition);
		$updateQueryResult = $objConMgr->DDL_executeQry($updateQuery);
		
		switch ($updateQueryResult) 
		{
				case 1:				
					$displayMessage =  "status has been set to enable.";
					header("location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&ctgid=$ctg_id&message=$displayMessage");
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
###################### Disable Record ###################
if(isset($_GET['disablestatus']) && $_GET['disablestatus']>0)
{
		$values = "status = 0 ";

		$whereCondition = "id = ".treatGet($_GET['disablestatus']);
		$updateQuery = $objQryBuilder->updateQry("tbl_rightpanel_images",$values,$whereCondition);
		$updateQueryResult = $objConMgr->DDL_executeQry($updateQuery);
		
		switch ($updateQueryResult) 
		{
				case 1:				
					$displayMessage =  "status has been set to disable.";
					header("location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&ctgid=$ctg_id&message=$displayMessage");
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
########################################################## Add Marketing Package Detail Record ###########################
if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Add")
{
	$txt_description	= prepearString(trim($_POST['txtDescription']));
	$chkstatus   		= (isset($_POST['chkstatus']) ? $_POST['chkstatus'] : 0);

	$whereCondition = " title = $txtTitle"; 
	$serviceExistsql = $objQryBuilder->selectQry('*','tbl_rightpanel_images',$whereCondition); 
	$serviceExistresult = $objConMgr->DML_executeQry($serviceExistsql);

	if (mysql_num_rows($serviceExistresult) == 0)
	{
	// uplaod temp image
	if($_FILES['txtphoto']['name'] != "")
	{
		$imageobj 			= & new Images();
		$tempPath 			= "../upload/images/tempfiles/";
		$targetPath_thumb	= "../upload/images/rightpanel/";
		
		$nfileName = $imageobj->upload('txtphoto',$tempPath);			

		list($width,$height) = getimagesize($tempPath . $nfileName);
			if($width >= $image_width || $height >= $image_height)
			{
			UploadResizedImage($nfileName, $targetPath_thumb, $tempPath, $image_width, $image_height);

		//}
		// remove temp path	
		$tempfile = $tempPath.$nfileName;
		if(file_exists($tempfile))
			@unlink($tempfile);
			
		$txtphoto = $nfileName;
		}
			else
			{
				$displayMessage = "Please upload valid image with dimensions $image_width x $image_height size.";
				header("location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&message=$displayMessage");
				die();
			}
	}	
	
				# - Insert Image into Gallery
				$values 	 = "$txt_description, '$txtphoto',$chkstatus, CURDATE()";
				$fieldsNames = "title, image, status, created_on";
				echo $insertQuery = $objQryBuilder->insertQry("tbl_rightpanel_images", $fieldsNames, $values);
				$insertResult = $objConMgr->DDL_executeQry($insertQuery);
			
	switch ($insertResult) 
	{
	   case 1:
			$displayMessage =  ADDMESSAGE;
			header("location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&ctgid=$ctg_id&message=$displayMessage");
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
			else
				$displayMessage =  "Feedback of same title already exist.";	
} 
#################################### End of Add product Detail Record #########################################################

####################################  Update product Detail Record   ##########################################################		
if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Edit" && $_REQUEST['id'] != "")
{
	$txt_description	= prepearString(trim($_POST['txtDescription']));
	$txtphoto      		= prepearString(trim($_POST['txtphoto']));
	$chkstatus     		= (isset($_POST['chkstatus']) ? $_POST['chkstatus'] : 0);
	$preimage 	   		= $_POST['preimage'];
	$prefile 	   		= $_POST['prefile'];			

	
	$newFileName = "";
	if (isset($_POST['id']) && $_POST['id'] != "")
	{
		// uplaod temp image
		if($_FILES['txtphoto']['name'] != "" && $_FILES['txtphoto']['name'] != $preimage )
		{
			$imageobj 			= & new Images();
			$tempPath 			= "../upload/images/tempfiles/";
			$targetPath_thumb	= "../upload/images/rightpanel/";
			$nfileName 			= $imageobj->upload('txtphoto',$tempPath);
			
			list($width,$height) = getimagesize($tempPath.$nfileName);
			list($width,$height) = getimagesize($tempPath . $nfileName);
			
			if($width >= $image_width || $height >= $image_height)
			{
				UploadResizedImage($nfileName, $targetPath_thumb, $tempPath, $image_width, $image_height);

		//}
			// remove temp path
			$tempfile = $tempPath.$nfileName;
			if(file_exists($tempfile))
				@unlink($tempfile);
			
			// remove previously uploadeded file
			$thumb = $targetPath_thumb.$preimage;
			if (file_exists($thumb)){
				@unlink($thumb);}
			
			$txtphoto = $nfileName;
			}
			else
			{
				$displayMessage = "Please upload valid image with dimensions $image_width x $image_height size.";
				header("location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&message=$displayMessage");
				die();
			}
		}
		else
		$txtphoto = $preimage;
		#$txtphotolarge=$preimage;
		$whereCondition = "id = " .$_REQUEST['id']; 
		$serviceExistsql1 = $objQryBuilder->selectQry('*','tbl_rightpanel_images',$whereCondition); 
		$serviceExistresult1 = $objConMgr->DML_executeQry($serviceExistsql1);
		while($imagesRow2 = mysql_fetch_object($serviceExistresult1))
		{
		if($_POST['chkstatus'] == 0 && $imagesRow2->glr_show_on_homepage == 1)
		{
		$values = "title = $txt_description, image='$txtphoto', created_on = CURDATE()";			
		$whereCondition = "id = ".treatGet($_POST['id']);
		$updateQuery = $objQryBuilder->updateQry("tbl_rightpanel_images",$values,$whereCondition);
		$updateQueryResult = $objConMgr->DDL_executeQry($updateQuery);
		$updateQueryResult = 2;
		}
		else
		{
		$values = "title = $txt_description, image='$txtphoto', created_on = CURDATE()";
		$whereCondition = "id = ".treatGet($_POST['id']);
		$updateQuery = $objQryBuilder->updateQry("tbl_rightpanel_images",$values,$whereCondition); 
		$updateQueryResult = $objConMgr->DDL_executeQry($updateQuery);
		}
		}
		############### Selecting proper message according to return value  		
		switch ($updateQueryResult) 
		{
				case 1:				
					$displayMessage =  UPDATEMESSAGE;
					header("location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&ctgid=$ctg_id&message=$displayMessage");
					break;
			   case 2:
			   $displayMessage = "The status can not be set to disable because record is selected for show on homepage";
				header("location: control-panel.php?menuId=$menuId&module=$module&fname=$fname&ctgid=$ctg_id&message=$displayMessage");
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

}
####################################  End of Update Product Detail Record   #######################################
	
function UploadResizedImage($newImageName, $targetPath, $temptargetPath, $Req_width, $Req_height) {
	$imageobj = & new Images();
	
	list($width,$height) = getimagesize($temptargetPath.$newImageName);
	if($width > $Req_width && $height < $Req_height)
	{
		copy($temptargetPath . $newImageName, $targetPath . $newImageName);
		$imageobj->ResizeImageSimple_New($targetPath.$newImageName, $Req_width, $height);				
	}
	else if($width < $Req_width && $height > $Req_height)
	{
		copy($temptargetPath . $newImageName, $targetPath . $newImageName);
		$imageobj->ResizeImageSimple_New($targetPath.$newImageName, $width, $Req_height);			
	}
	else if($width > $Req_width && $height > $Req_height)
	{ 	
		copy($temptargetPath . $newImageName, $targetPath . $newImageName);
		$imageobj->ResizeImageSimple_New($targetPath.$newImageName, $Req_width, $Req_height);
	}
	else 
	{
		copy($temptargetPath . $newImageName, $targetPath . $newImageName);
	}
}
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
function showimage(im)
{
	window.open ("aboutquadromImage/"+im,"Image","status=1,scrollbars=1,width=510,height=310");
}
///////////////////////////////////////// checking file types ///////////////////////////////////////////////////////
function fileExt(filename)
{	
	var fileTypes=["pdf","PDF","DOC","doc"]; 
	var defaultPic="spacer.gif";
	var source=filename;
	var ext=source.substring(source.lastIndexOf(".")+1,source.length).toLowerCase();
	for (var i=0; i<fileTypes.length; i++) if (fileTypes[i]==ext) break;
	globalPic=new Image();
	if (i<fileTypes.length) globalPic.src=source;
	else 
		return false;
	
	return true;
}

///////////////////////////////////////// checking file types ///////////////////////////////////////////////////
function CompareDates()
{
   var str1  = document.getElementById("txtpublish").value;
   var str2  = document.getElementById("txtexp").value;
  var mon1   = parseInt(str1.substring(0,2),10);
   var dt1  = parseInt(str1.substring(3,5),10);
   var yr1   = parseInt(str1.substring(6,10),10);
   var mon2  = parseInt(str2.substring(0,2),10);
   var dt2  = parseInt(str2.substring(3,5),10);
   var yr2   = parseInt(str2.substring(6,10),10);
   var date1 = new Date(yr1, dt1 , mon1);
   var date2 = new Date(yr2, dt2, mon2);

   if(date2 < date1)
      return false;
 
	  
}
///////////////////////////////////////// checking URL //////////////////////////////////////////
function checkUrl(theUrl){
	//alert(theUrl);
  if(theUrl.value.match(/^(http|ftp)\:\/\/\w+([\.\-]\w+)*\.\w{2,4}(\:\d+)*([\/\.\-\?\&\%\#]\w+)*\/?$/i) ||
     theUrl.value.match(/^mailto\:\w+([\.\-]\w+)*\@\w+([\.\-]\w+)*\.\w{2,4}$/i)){
    return true;
  } else {
    //alert("Wrong address.");
    //theUrl.select();
    theUrl.focus();
    return false;
  }
}
	function textLimit(field, maxlen) {
		if (field.value.length > maxlen + 0)
		document.getElementById('tderror').innerHTML='Only '+maxlen +' characters are allowed.';
		if (field.value.length > maxlen)
		field.value = field.value.substring(0, maxlen);
	}

function FrmValidation(mode)
{	
	if(mode == 'Add')
	{
		if(document.getElementById("txtphoto").value=="")
		{
			document.getElementById('tdphoto').innerHTML = "Please Enter an Image File.";
			document.getElementById("txtphoto").focus();
			return false;
		}
		else
		{
			document.getElementById('tdphoto').innerHTML = "";
		}
	
	}
	
	if(document.getElementById("txtphoto").value!="")
	{
		if(fileTypeCheck(document.getElementById("txtphoto")) == false)
		{
			return false;
		}
		if(document.getElementById("txtphoto").value != "") {
			var iChars = "!@#$%^&*()+=[];,'{}|<>??";
			for (var i = 0; i < document.getElementById("txtphoto").value.length; i++) {
				if (iChars.indexOf(document.getElementById("txtphoto").value.charAt(i)) != -1) {
				document.getElementById('tdphoto').innerHTML ="Special characters are not allowed in file name.";
				document.getElementById("txtphoto").focus();
				return false;
			   }  // inner if statement
			 }  // for loop statement
		}
		
	}
	if(document.getElementById('txtDescription').value == ""){
	   document.getElementById('td_desc').innerHTML = "Please enter Description.";
	   document.getElementById('txtDescription').focus;
	   return false;
		}
	else
	{
	  document.getElementById('td_desc').innerHTML = "";
	}
	
	return true;
}

function checkspecial(fieldId)
{
	var iChars = "!@#$%^&*()+=[];,'{}|<>?£";
	for (var i = 0; i < document.getElementById(fieldId).value.length; i++) {
		if (iChars.indexOf(document.getElementById(fieldId).value.charAt(i)) != -1) {
			document.getElementById('tdphoto').innerHTML = "Special characters are not allowed in image file name. Please remove and try again.";		
			document.getElementById(fieldId).focus();
			return false;
	   }  // inner if statement
	}  // for loop statement
}

function Reset()
{
	document.frmGallery.reset();
}
function Reset1()
{
	document.frmOperator.reset();
}

function fileTypeCheck(filename)
{	
	var fileTypes=["gif","png","jpg","jpeg"]; 
	var defaultPic="spacer.gif";
	var source=filename.value;
	var ext=source.substring(source.lastIndexOf(".")+1,source.length).toLowerCase();
	for (var i=0; i<fileTypes.length; i++) if (fileTypes[i]==ext) break;
	globalPic=new Image();
	
	if (i<fileTypes.length) globalPic.src=source;
	else
	{
		//globalPic.src=defaultPic;
		document.getElementById('tdphoto').innerHTML ="Invalid image. Please upload a file ending with .jpg, .jpeg, .gif or .png";
		//document.getElementById('tdurl').innerHTML ="Invalid image. Please upload a file ending with .jpg, .jpeg, .gif or .png";
		filename.focus();
		return false;
	}
	return true;
}
function DeleteRecordsChk()
{
	 if(confirm("Are you sure to delete this record"))
		return true;
	 else
	 return false;
}
function submitPaging(frm,page)
{	
	document.frmPaging.pageNo.value = page;
	document.frmPaging.submit();
}

function toggleStatus(){
	if($("#chkdefault").attr("checked"))
		$('#chkstatus').attr("checked", "checked");
}

function changepage(ctg)
{
	//var ctg 		= document.getElementById('ctgid').value;
	//alert(ctg);
	window.location	= "control-panel.php?menuId=<?=$menuId?>&module=<?=$module?>&fname=<?=$fname?>&ctgid="+ctg;
}
function Editchangepage(ctg)
{
	//var ctg 		= document.getElementById('ctgid').value;
	window.location	= "control-panel.php?menuId=<?=$menuId?>&module=<?=$module?>&fname=<?=$fname?>&ctgid="+ctg;
}
</script>
<form method="post" name="frmPaging" enctype="multipart/form-data">
  <input name="pageNo" type="hidden" value="" id="pageNo">
  <input name="ctgid" type="hidden" value="<?=$ctg_id?>" />
</form>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="100%" height="19" valign="middle" class="conetntmenutxt">&nbsp;&nbsp;</td>
  </tr>
  <?
############################ Add product code ################################
if(!isset($_REQUEST['id']))
{
?>
  <?php /*?><tr>
    <td class="cptxt" valign="top" align="center"><form name="frmGallery" id="frmGallery" action="control-panel.php?DetailMode=Add" method="post" enctype="multipart/form-data" onsubmit="javascript: return FrmValidation('Add');">
        <input name="module" id="module" type="hidden" value="<?=$module?>" />
        <input name="fname" id="fname" type="hidden" value="<?=$fname?>" />
        <input name="menuId" id="menuId" type="hidden" value="<?=$menuId?>"/>
        <table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">
          <tr>
            <td height="25" colspan="3" align="Left" class="tblHeading">Add Client Feedback</td>
            <td height="25"  align="center" class="tblHeading">&nbsp;</td>
          </tr>
          <tr>
            <td width="2%" class="cptxt">&nbsp;</td>
            <td width="19%" class="cptxt">&nbsp;</td>
            <td colspan="2" align="Left" class="manidatory" id="tdurl" height="25"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">
              <?= $displayMessage = ($displayMessage == "") ? $_REQUEST['message'] : $displayMessage;?>
              </font></td>
          </tr>
          <tr>
            <td class="cptxt">&nbsp;</td>
            <td align="left" valign="top" class="cptxt">Image:</td>
            <td height="33" align="left"><input name="txtphoto" type="file" class="textfields" id="txtphoto" value="" size="32" maxlength="100" style="width:255px" />
              <span class="manidatory">*</span><br  />
              <span class="manidatory">(Recommended <?=$image_width?>px x <?=$image_height?>px)</span></td>
            <td height="33" align="left" id="tdphoto" class="manidatory"></td>
          </tr>
          <tr>
            <td width="2%" class="cptxt">&nbsp;</td>
            <td width="19%" align="left" valign="top" class="cptxt">Detail:</td>
            <td width="43%" align="left" valign="top">
            <textarea name="txtDescription" rows="4" class="textfields" onkeyup="textLimit(contentDetail,180);" id="txtDescription"></textarea>
              <span class="manidatory" style="vertical-align:top">*</span></td>
            <td width="36%" height="28" align="left" class="manidatory" id="td_desc"></td>
          </tr>
          <tr>
            <td width="2%" class="cptxt">&nbsp;</td>
            <td width="19%" align="left" valign="top" class="cptxt">Status:</td>
            <td width="43%" align="left" valign="top"><input name="chkstatus" type="checkbox" class="cptxt" id="chkstatus" value="1" checked="checked" />            </td>
            <td width="36%" height="25" align="left" class="cptxt">&nbsp;</td>
          </tr>
          <tr>
            <td class="cptxt">&nbsp;</td>
            <td class="cptxt" valign="top" align="left">&nbsp;</td>
            <td align="left"><input type="image" src="images/cmdSave.gif">
              &nbsp;<a href="javascript:void(0)" onclick="javascript:Reset()"><img src="images/cmdReset.gif" border="0"/></a></td>
            <td height="26" align="left" class="cptxt">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" colspan="4" align="Left" class="cptxt">&nbsp;</td>
          </tr>
        </table>
      </form></td>
  </tr><?php */?>
  <? 
  	}  	
	
############################ Edit block of code in case edit product record ################################
if(isset($_REQUEST['id']) && $_REQUEST['id'] != "" && $_REQUEST['DetailMode'] == "Edit")
{
	$whereCondition = " id  =".$_REQUEST['id'];
	$gallerySql = $objQryBuilder->selectQry('*','tbl_rightpanel_images',$whereCondition);
	$imagesResult = $objConMgr->DML_executeQry($gallerySql);
	
	$galleryRS = mysql_fetch_object($imagesResult);	
  ?>
  <tr>
    <td class="cptxt" valign="top" align="center"><form name="frmGallery" id="frmGallery" action="control-panel.php?DetailMode=Edit" method="post" enctype="multipart/form-data" onsubmit="javascript: return FrmValidation('Edit');">
        <input name="module" id="module" type="hidden" value="<?=$module?>"/>
        <input name="fname" id="fname" type="hidden" value="<?=$fname?>"/>
        <input name="menuId" id="menuId" type="hidden" value="<?=$menuId?>"/>
        <table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">
          <tr>
            <td height="25" colspan="3" align="Left" class="tblHeading">Edit Banner</td>
            <td height="25"  align="center" class="tblHeading">&nbsp;</td>
          </tr>
          <tr>
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="18%" class="cptxt" >&nbsp;</td>
            <td colspan="2" align="Left" class="manidatory" id="tdurl" height="25"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">
              <?= $displayMessage = ($displayMessage == "") ? $_REQUEST['message'] : $displayMessage;?>
              </font></td>
          </tr>
          <tr>
            <td width="1%" class="cptxt">&nbsp;</td>
            <td align="left" valign="top" class="cptxt">Description:</td>
            <td height="25" align="left" class="cptxt"><strong><?=$galleryRS->page?>&nbsp;-&nbsp;<em><?=$galleryRS->title?></em></strong></td>
            <td height="25" align="left" class="manidatory" id="tdphoto">&nbsp;</td>
          </tr>
          <tr>
            <td width="1%" class="cptxt">&nbsp;</td>
            <td align="left" valign="top" class="cptxt">Image:</td>
            <td height="25" align="left"><input name="txtphoto" type="file" class="textfields" id="txtphoto" value="" size="32" maxlength="100" style="width:255px" />
              <span class="manidatory">&nbsp;&nbsp;</span><br  />
              <span class="manidatory">(Recommended <?=$image_width?>px x <?=$image_height?>px)</span></td>
            <td height="25" align="left" class="manidatory" id="tdphoto">&nbsp;</td>
          </tr>
          <tr style="display:none">
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="18%" align="left" valign="top" class="cptxt">Detail:</td>
            <td width="49%" align="left" valign="top">
            <textarea name="txtDescription" rows="4" class="textfields" onkeyup="textLimit(contentDetail,180);" id="txtDescription"><?=($galleryRS->title)?></textarea>
              <span class="manidatory" style="vertical-align:top">*</span></td>
            <td width="32%" height="28" align="left" class="manidatory" id="td_desc"></td>
          </tr>
          <tr>
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="18%" align="left" valign="top" class="cptxt">Status:</td>
            <td width="49%" align="left" valign="top"><input name="chkstatus" type="checkbox" class="cptxt" id="chkstatus" value="1" <?=($galleryRS->status == 1 ? "checked" : "")?> /></td>
            <td width="32%" height="25" align="left" class="cptxt">&nbsp;</td>
          </tr>
          <tr>
            <td class="cptxt">&nbsp;</td>
            <td class="cptxt" valign="top" align="left">&nbsp;</td>
            <td align="left"><input type="image" src="images/cmdUpdate.gif" />
              &nbsp;<a href="javascript:Reset();"><img src="images/cmdReset.gif" border="0"/></a></td>
            <td height="26" align="left" class="cptxt"><input type="hidden" name="id" id="id" value="<?=$galleryRS->id?>" />
              <input type="hidden" name="preimage" id="preimage" value="<?=$galleryRS->image?>" /></td>
          </tr>
          <tr>
            <td height="25" colspan="4" align="Left" class="cptxt">&nbsp;</td>
          </tr>
        </table>
      </form></td>
  </tr>
  <?
   }  // edit if statment 
  ?>
  <form name="frmOperator" id="frmOperator" action="control-panel.php?DetailMode=Edit" method="post" enctype="multipart/form-data" >
    <input name="module" id="module" type="hidden" value="<?=$module?>"/>
    <input name="fname" id="fname" type="hidden" value="<?=$fname?>"/>
  </form>
  <?
	$where = " 1=1 ";
	
	 //$where .= " AND  ctg_id = ".$ctg_id; 
	//$gallerySql = $objQryBuilder->selectQry('*','tbl_rightpanel_images', $where);
	
	//$gallerySql = "SELECT * FROM tbl_rightpanel_images WHERE ".$where;
	$gallerySql = "SELECT * FROM tbl_rightpanel_images WHERE ".$where." ORDER BY id ASC";
	$paging_results = new MySQLPagedResults($gallerySql,"pageNo","",20,"100","<<","Previous","Next",">>"," | ");
    $first_nav 		= $paging_results->getFirstNav();
	$prev_nav 		= $paging_results->getPrevNav();
	$next_nav 		= $paging_results->getNextNav();
	$last_nav 		= $paging_results->getLastNav();
	$pages_nav 		= $paging_results->getPagesNav();
	$offset 		= $paging_results->currentOffset();
	
	$results_per_page = $paging_results->results_per_page; 
	$limit = " LIMIT $offset , $results_per_page"; // Limit variable for paging display
	
	$gallerySql .= $limit;
	
	
	$imagesResult = $objConMgr->DML_executeQry($gallerySql );
	if(mysql_num_rows($imagesResult) > 0)
	{
  ?>
  <tr>
    <td height="25" colspan="4" align="Left" style="color:#F00" class="cptxt"><?= $displayMessage = ($displayMessage == "") ? $_REQUEST['message'] : $displayMessage;?></td>
  </tr>
  <tr>
    <td height="25" colspan="4" align="Left" class="tblHeading">Banners List</td>
  </tr>
  <!-- <tr>
    <td height="25" align="Left" class="tblHeading">Galleries</td>
  </tr>-->
  <tr>
    <td class="cptxt" valign="top" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">
        <tr class="tblHeading">
          <td align="left"><div align="center"><strong>Status</strong></div></td>
          <td height="30%" align="Left"><strong>Page Title</strong></td>
          <td height="30%" align="Left"><strong>Description</strong></td>
          <td width="18%" height="25" align="left"><strong><div align="center">Image</div></strong></td>
          <td width="9%" align="center"><strong>Edit</strong></td>

        </tr>
        <?
		$bg = "#f0f0f0";
		$counter = 0;
		while($imagesRow = mysql_fetch_object($imagesResult))
		{
			if($imagesRow->status == 1)
			{
				if($imagesRow->glr_show_on_homepage == 0)
				{
				$showStatus ="<a href='control-panel.php?disablestatus=$imagesRow->id&amp;module=$module&amp;fname=$fname&menuId=$menuId' title='Enabled'><img src='../admin/images/enable.gif' title='Enabled' border='0'></a>";
				}
				else
				{
					$showStatus ="<img src='../admin/images/enable.gif' title='Enabled' border='0'>";
				}
			}
			else
				$showStatus = "<a href='control-panel.php?enablestatus=$imagesRow->id&amp;module=$module&amp;fname=$fname&menuId=$menuId' title='Disabled'><img src='../admin/images/disable.gif' title='Disabled' border='0'></a>";
			
			
	?>
        <tr bgcolor="<? if($counter%2 != 0) echo $bg;?>">
          <td width="9%" align="center" class="cptxt"><?=$showStatus?></td>
          <td width="19%" align="left" class="cptxt"><?=$imagesRow->page?></td>
          <td width="45%" align="left" class="cptxt"><?=stripslashes($imagesRow->title)?></td>
          
          <td width="18%" height="25" align="center" class="cptxt"><div align="center"><img src="../upload/images/rightpanel/<?=$imagesRow->image?>" alt="N/A"  border="1" width="90"  /></div></td>
          <td align="center" valign="top" class="cptxt" style="vertical-align:middle;"><a href="control-panel.php?id=<?=$imagesRow->id?>&amp;module=<?=$module?>&amp;fname=<?=$fname?>&menuId=<?=$menuId?>&amp;DetailMode=Edit&ctgid=<?=$ctg_id?>" title="Edit Record" style="text-decoration:none;color:#0099FF;"><img src="images/edit.gif" border="0"/></a> </td>
          
        </tr>
        <?	
	  	$counter++; 
	  }
	  ?>
      </table>
      <table style="padding:5px;" cellpadding="1" width="100%" align="right"  border=0 cellspacing=10>
        <tr> <a>
          <td align="right" style="padding-right:10px " class="cptxt"><?
        if($paging_results->totalPages() > 1) {
        echo "$first_nav $prev_nav $pages_nav $next_nav $last_nav"; 
        }
        ?>
          </td>
          </a> </tr>
      </table></td>
  </tr>
  <? } else{?>
  <tr>
    <td class="manidatory" valign="top" align="center">No Record Found </td>
  </tr>
  <? } ?>
</table>
