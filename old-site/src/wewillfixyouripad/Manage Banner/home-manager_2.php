<?php
include_once("../admin/include/include.inc_2.php");

### Banner Width Height
$banner_width	= 740;	
$banner_height	= 221;	

#################################### Add Marketing Package Detail Record ###########################

if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Add")
{
	$txttitle      		= prepearString($_POST['txttitle']);
	$txtlink			= prepearString($_POST['txtlink']);
	$txtdate       		= prepearString(date("Y-m-d"));
	$txt_modified_on	= prepearString(date("Y-m-d h:i:s"));
	$chkstatus     		= (isset($_POST['chkstatus']) ? $_POST['chkstatus'] : 0);

	$whereCondition = " bnr_title = $txttitle"; 
	$NewsExistsql = $objQryBuilder->selectQry('*','tbl_home_banner',$whereCondition); 
	$NewsExistresult = $objConMgr->DML_executeQry($NewsExistsql);

	if (mysql_num_rows($NewsExistresult) == 0)
	{
		if($_FILES['txtphoto']['name'] != "")
		{
			$imageobj = new Images();
			$tempPath = "../upload/images/tempfiles/";
			$targetPath = "../upload/images/home_banner/";			
			$nfileName = $imageobj->upload('txtphoto',$tempPath);	
			list($width,$height) = getimagesize($tempPath . $nfileName);
			if($width == $banner_width || $height == $banner_height)
			{
			UploadResizedImage($nfileName, "../upload/images/home_banner/", $tempPath, $banner_width, $banner_height);
			$tempfile = $tempPath.$nfileName;
			if(file_exists($tempfile))
				@unlink($tempfile);
			$txtphoto =  prepearString($nfileName);
			$txtphotolarge = $nfileName;
			}
			else
			{
				$displayMessage = "Please upload valid image with dimensions $banner_width x $banner_height size.";
				header("location: control-panel.php?module=$module&fname=$fname&message=$displayMessage");
				die();
			}
		}
		$values = "$txttitle, $txtphoto, $chkstatus, $txtlink";
		$fieldsNames = "bnr_title, bnr_img, bnr_status, bnr_link";
		$insertQuery = $objQryBuilder->insertQry("tbl_home_banner",$fieldsNames,$values); 
	 	$insertResult = $objConMgr->DDL_executeQry($insertQuery); 
		switch ($insertResult) 
		{
		   case 1:	
				$displayMessage =  ADDMESSAGE;										
				header("location: control-panel.php?module=$module&fname=$fname&message=$displayMessage");
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
		$displayMessage =  "Banner of same title already exist.";
}

#################################### End of Add product Detail Record #########################################################


#################################### Update product Detail Record   ##########################################################		
if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Edit" && (isset($_REQUEST['id']) && $_REQUEST['id']!=""))
{
	$txttitle     		= @prepearString($_POST['txttitle']);
	$txtlink			= @prepearString($_POST['txtlink']);
	$chkstatus     		= (isset($_POST['chkstatus']) ? $_POST['chkstatus'] : 0);
	$preimage 	   		= @$_POST['preimage'];
	//$preimagelarge 	   = $_POST['preimagelarge'];
	if (isset($_POST['id']) && $_POST['id'] != "")
	{	
		if($_FILES['txtphoto']['name'] != "" && $_FILES['txtphoto']['name'] != $preimage )
		{
			$imageobj = new Images();
			$tempPath = "../upload/images/tempfiles/";
			$targetPath = "../upload/images/home_banner/";			
			$nfileName = $imageobj->upload('txtphoto',$tempPath);
			list($width,$height) = getimagesize($tempPath . $nfileName);
			if($width == $banner_width || $height == $banner_height)
			{
			UploadResizedImage($nfileName, "../upload/images/home_banner/", $tempPath,  $banner_width, $banner_height);
		//	UploadResizedImage($nfileName, "../upload/large/thumb/", $tempPath, 500, 450);
			// remove temp path
			$tempfile = $tempPath.$nfileName;
			if(file_exists($tempfile))
				@unlink($tempfile);
			// remove previously uploadeded file
			$lastfile = $targetPath.$preimage;
			if (file_exists($lastfile))
				@unlink($lastfile);
			// remove previously uploadeded file
			$lastfile = "../upload/images/home_banner/".$preimage;
			if (file_exists($lastfile))
				@unlink($lastfile);
			$txtphoto = prepearString($nfileName);
			$txtphotolarge = $nfileName;
			}
			else
			{
				$displayMessage = "Please upload valid image with dimensions $banner_width x $banner_height size.";
				header("location: control-panel.php?module=$module&fname=$fname&message=$displayMessage");
				die();
			}
		}
		else
		{
			$txtphoto = prepearString($preimage);
			$txtphotolarge=$preimage;
		}
		$whereCondition = " bnr_title = $txttitle AND bnr_id != ".$_POST['id']; 
		$NewsExistsql = $objQryBuilder->selectQry('*','tbl_home_banner',$whereCondition);
		$NewsExistresult = $objConMgr->DML_executeQry($NewsExistsql);
		if (mysql_num_rows($NewsExistresult) == 0)
		{		
			$values = "bnr_title=$txttitle, bnr_img=$txtphoto, bnr_status=$chkstatus , bnr_link=$txtlink";
			$whereCondition = " bnr_id = ".$_POST['id'];
			 $updateQuery = $objQryBuilder->updateQry("tbl_home_banner",$values,$whereCondition);
			 $updateQueryResult = $objConMgr->DDL_executeQry($updateQuery);
			
			############### Selecting proper message according to return value  		
			switch ($updateQueryResult) 
			{
				case 1:
					$displayMessage =  UPDATEMESSAGE;							
					header("location: control-panel.php?module=$module&fname=$fname&message=$displayMessage");
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
		} else {
			$displayMessage =  "Banner of same title already exist.";
		}
	}
}

#################################### End of Update Product Detail Record   #######################################





####################################  Delete Package Detail #######################################################		

if(isset($_GET['DetailMode'])&& $_GET['DetailMode'] == "Delete")
{
	if(isset($_GET['id']) && $_GET['id'] != "")
	{
		# - Delete Image
		$rsHorseInfo = $db->select("SELECT * FROM tbl_home_banner WHERE bnr_id = " . treatGet($_GET['id']));
		@unlink("../upload/images/large/".$rsHorseInfo[0]["bnr_img"]);
		@unlink("../upload/images/home_banner/".$rsHorseInfo[0]["bnr_img"]);
		# - Delete 
		# - Delete News
		$whereCondition = " bnr_id = ".treatGet($_GET['id']);
		$deleteQuery 	= $objQryBuilder->deleteQry("tbl_home_banner",$whereCondition);
		$deleteResult 	= $objConMgr->DDL_executeQry($deleteQuery);
				
		switch ($deleteResult) 
		{
		   case 1:
				$displayMessage =  DELETEMESSAGE;
				header("location: control-panel.php?module=$module&fname=$fname&message=$displayMessage");
				break;
		   case -1:
				$displayMessage =  CONNECTIONERROR; 
				break;
		   case -2:
				$displayMessage =  DBSELECTIONERROR; 
				break;
		   case -3:
				$displayMessage =   mysql_error();
				break;
		}		 
	}
}	

##################################### End of Delete Package detail ################################	

function UploadResizedImage($newImageName, $targetPath, $temptargetPath, $Req_width, $Req_height) 
{
	$imageobj = new Images();
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
	}}
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

<link type="text/css" rel="stylesheet" href="../admin/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">

</LINK>

<SCRIPT type="text/javascript" src="../admin/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<script language="javascript" type="text/javascript">

function fileTypeCheck(filename)

{	

	var fileTypes=["gif","png","jpg","jpeg"]; 

	var defaultPic="spacer.gif";

	var source=filename.value;

	var ext=source.substring(source.lastIndexOf(".")+1,source.length).toLowerCase();

	for (var i=0; i<fileTypes.length; i++) if (fileTypes[i]==ext) break;

	globalPic = new Image();

	if (i<fileTypes.length) globalPic.src=source;

	else 

	{

		document.getElementById('tdphoto').innerHTML = "Invalid file. Please upload a file ending with jpg, jpeg, gif or png";

		filename.focus();

		return false;

	}

	return true;

}



function FrmValidation(mode)

{

		

	if(document.getElementById("txttitle").value == "")

	{

		document.getElementById('tdtitle').innerHTML = "Please enter Title.";

		document.getElementById("txttitle").focus();

		return false;

	}

	else

		document.getElementById('tdtitle').innerHTML = "";

		

	strtitle = document.getElementById("txttitle").value

	if(strtitle.length > 255) {

		document.getElementById('tdtitle').innerHTML = "Title length should be maximum 255 characters.";

		document.getElementById("txttitle").focus();

		return false;

	}

	else

		document.getElementById('tdtitle').innerHTML = "";

	

	if(mode == 'Add')

	{

		if(document.getElementById("txtphoto").value=="")

		{

			document.getElementById('tdphoto').innerHTML = "Please enter Image.";

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



			

	return true;

}



function Reset()

{

	document.frmNews.reset();

}



function Reset1()

{

	document.frmOperator.reset();

}



function DeleteRecordsChk()

{

	 if(confirm("Are you sure to delete this Banner?"))

		return true;

	 else

	 return false;

}



function submitPaging(frm,page)

{	

	document.frmPaging.pageNo.value = page;

	document.frmPaging.submit();

}

</script>

<form method="post" name="frmPaging" enctype="multipart/form-data">

  <input name="pageNo" type="hidden" value="" id="pageNo">

</form>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
<?php

	############################ Add product code ################################

	if(!isset($_REQUEST['id']))

	 {
?>
  <tr>
    <td colspan="4" class="cptxt" valign="top" align="center"><form name="frmNews" id="frmNews" action="control-panel.php?DetailMode=Add" method="post" enctype="multipart/form-data" onsubmit="javascript: return FrmValidation('Add');">
        <input name="module" id="module" type="hidden" value="<?=$module?>" />
        <input name="fname" id="fname" type="hidden" value="<?=$fname?>" />
        <table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">
          <tr>
            <td height="25" colspan="3" align="Left" class="tblHeading">Add Slide Image</td>
            <td height="25"  align="center" class="tblHeading">&nbsp;</td>
          </tr>
          <tr>
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="16%" class="cptxt">&nbsp;</td>
            <td colspan="2" align="Left" class="cptxt" height="25"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">
              <?php echo @$displayMessage = (@$displayMessage == "") ?@ $_REQUEST['message'] : @$displayMessage;?>
              </font></td>
          </tr>
          <tr>
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="16%" align="left" valign="top" class="cptxt"> Title:</td>
            <td width="44%" align="left"><input type="text" name="txttitle" id="txttitle" class="textfields" value="" size="39" maxlength="255" style="width:256px;"  />
            <span class="manidatory">&nbsp;*</span></td>
            <td width="39%" height="25" align="left" class="manidatory" id="tdtitle">&nbsp;</td>
          </tr>
          <tr>
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="16%" align="left" valign="top" class="cptxt"> Link:</td>
            <td width="44%" align="left"><input type="text" name="txtlink" id="txtlink" class="textfields" value="" size="39" maxlength="400" style="width:356px;"  />
            <span class="manidatory">&nbsp;</span></td>
            <td width="39%" height="25" align="left" class="manidatory" id="tdtitle">&nbsp;</td>
          </tr>
          <tr style="display:none">
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="16%" align="left" valign="top" class="cptxt">Short Description:</td>
            <td width="44%" align="left"><textarea type="text" name="txtdescription" id="txtdescription" class="textfields" value="" size="39" maxlength="255" style="width:256px;"></textarea>
              <span class="manidatory" style="vertical-align:top">&nbsp;*</span></td>
            <td width="39%" height="25" align="left" class="manidatory" id="tdDescription">&nbsp;</td>
          </tr>
          <tr>
            <td class="cptxt">&nbsp;</td>
            <td align="left" valign="top" class="cptxt"> Image:</td>
            <td height="25" align="left"><input name="txtphoto" type="file" class="textfields" id="txtphoto" value="" size="32" maxlength="100" style="width:256px" />
              <span class="manidatory">&nbsp;* (Recommended
              <?php echo $banner_width?>px x <?php echo $banner_height?>px)</span></td>
            <td height="25" align="left" id="tdphoto" class="manidatory">&nbsp;</td>
          </tr>
          <tr>
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="16%" align="left" valign="top" class="cptxt">Status:</td>
            <td width="44%" align="left" valign="top"><input type="checkbox" value="1" class="cptxt" name="chkstatus" id="chkstatus" checked="checked" /></td>
            <td width="39%" height="25" align="left" class="cptxt">&nbsp;</td>
          </tr>
          <tr>
            <td class="cptxt">&nbsp;</td>
            <td class="cptxt" valign="top" align="left">&nbsp;</td>
            <td align="left"><input type="image" src="images/cmdSave.gif">
              &nbsp;<a onclick="javascript:Reset()" href="javascript:void(0)"><img border="0" src="images/cmdReset.gif"></a></td>
            <td height="26" align="left" class="cptxt">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" colspan="4" align="Left" class="cptxt">&nbsp;</td>
          </tr>
        </table>
      </form></td>
  </tr>
  <?php
  	}  	############################ Edit block of code in case edit product record ################################
	if(isset($_REQUEST['id']) && $_REQUEST['id'] != "" && $_REQUEST['DetailMode'] == "Edit")
	{
		$whereCondition = " bnr_id  =".$_REQUEST['id'];
		$newsSql = $objQryBuilder->selectQry('*','tbl_home_banner',$whereCondition);
		$newsResult = $objConMgr->DML_executeQry($newsSql);
		$newsRS = mysql_fetch_object($newsResult);
  ?>
  <tr>
    <td colspan="4" class="cptxt" valign="top" align="center"><form name="frmNews" id="frmNews" action="control-panel.php?DetailMode=Edit" method="post" enctype="multipart/form-data" onsubmit="javascript: return FrmValidation('Edit');">
        <input name="module" id="module" type="hidden" value="<?php echo $module?>"/>
        <input name="fname" id="fname" type="hidden" value="<?php echo $fname?>"/>
        <table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">
          <tr>
            <td height="25" colspan="3" align="Left" class="tblHeading">Edit  Slide Image [ <a href="control-panel.php?menuId=4&amp;module=<?php echo $module?>&fname=<?php echo $fname?>" style="text-decoration:none;">Add Slide Image</a> ] </td>
            <td height="25"  align="center" class="tblHeading">&nbsp;</td>
          </tr>
          <tr>
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="16%" class="cptxt">&nbsp;</td>
            <td colspan="2" align="Left" class="cptxt" height="25"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">
              <?php echo $displayMessage?>
              </font></td>
          </tr>
          <tr>
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="16%" align="left" valign="top" class="cptxt"> Title:</td>
            <td width="44%" align="left"><input type="text" name="txttitle" id="txttitle" class="textfields" value="<?php echo stripslashes($newsRS->bnr_title)?>" size="39" maxlength="255" style="width:256px;">
            <span class="manidatory" style="vertical-align:top;">&nbsp;*</span></td>
            <td width="39%" height="25" align="left" class="manidatory" id="tdtitle">&nbsp;</td>
          </tr>
          <tr>
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="16%" align="left" valign="top" class="cptxt"> Link:</td>
            <td width="44%" align="left"><input type="text" name="txtlink" id="txtlink" class="textfields" value="<?php echo stripslashes($newsRS->bnr_link)?>" size="39" maxlength="400" style="width:356px;">
            <span class="manidatory" style="vertical-align:top;">&nbsp;</span></td>
            <td width="39%" height="25" align="left" class="manidatory" id="tdtitle">&nbsp;</td>
          </tr>
          <tr style="display:none">
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="16%" align="left" valign="top" class="cptxt">Short Description:</td>
            <td width="44%" align="left"><textarea type="text" name="txtdescription" id="txtdescription" class="textfields" value="" size="39" maxlength="255" style="width:256px;"><?php echo stripslashes($newsRS->bnr_description)?>
</textarea>
              <span class="manidatory" style="vertical-align:top">&nbsp;*</span></td>
            <td width="39%" height="25" align="left" class="manidatory" id="tdDescription">&nbsp;</td>
          </tr>
          <tr>
            <td class="cptxt">&nbsp;</td>
            <td align="left" valign="top" class="cptxt">Image:</td>
            <td height="25" align="left"><input name="txtphoto" type="file" class="textfields" id="txtphoto" value="" size="32" maxlength="100" style="width:256px" />
              <span class="manidatory">&nbsp; (Recommended
              <?php echo $banner_width?>px x <?php echo $banner_height?>px)</span></td>
            <td height="25" align="left" id="tdphoto" class="manidatory">&nbsp;</td>
          </tr>
          <tr>
            <td width="1%" class="cptxt">&nbsp;</td>
            <td width="16%" align="left" valign="top" class="cptxt">Status:</td>
            <td width="44%" align="left" valign="top"><input name="chkstatus" type="checkbox" class="cptxt" id="chkstatus" value="1" <?=($newsRS->bnr_status == 1 ? "checked" : "")?> /></td>
            <td width="39%" height="25" align="left" class="cptxt">&nbsp;</td>
          </tr>
          <tr>
            <td class="cptxt">&nbsp;</td>
            <td class="cptxt" valign="top" align="left">&nbsp;</td>
            <td align="left"><input type="image" src="images/cmdUpdate.gif">
              &nbsp;<a onclick="javascript:Reset()" href="javascript:void(0)"><img border="0" src="images/cmdReset.gif"></a></td>
            <td height="26" align="left" class="cptxt"><input type="hidden" name="id" id="id" value="<?=$newsRS->bnr_id?>" />
              <input type="hidden" name="preimage" id="preimage" value="<?php echo $newsRS->bnr_img?>" /></td>
          </tr>

          <tr>

            <td height="25" colspan="4" align="Left" class="cptxt">&nbsp;</td>

          </tr>

        </table>

      </form></td>

  </tr>

  <?php

   }  // edit if statment 

  ?>

  <tr>

    <td height="25" colspan="4" align="Left" class="tblHeading">Search Criteria</td>

  </tr>

  <form name="frmOperator" id="frmOperator" action="control-panel.php?DetailMode=Edit" method="post" enctype="multipart/form-data" >

    <input name="module" id="module" type="hidden" value="<?php echo $module?>"/>

    <input name="fname" id="fname" type="hidden" value="<?php echo $fname?>"/>

    <tr>

      <td width="1%" class="cptxt">&nbsp;</td>

      <td width="16%" align="left" valign="top" class="cptxt"> Title :</td>

      <td width="53%" align="left"><input type="text" name="Srchtxtname" id="Srchtxtname" class="textfields" value="" size="39" maxlength="50" style="width:256px">

        <span class="manidatory" style="vertical-align:top;">&nbsp;</span></td>

      <td width="30%" height="25" align="left" class="manidatory" id="tdname">&nbsp;</td>

    </tr>

    <tr>

      <td class="cptxt">&nbsp;</td>

      <td class="cptxt" valign="top" align="left">&nbsp;</td>

      <td align="left"><input type="image" src="images/cmdsearch.gif">

        &nbsp;<a href="javascript:Reset1();"><img src="images/cmdReset.gif" border="0"/></a></td>

      <td height="26" align="left" class="cptxt">

    </tr>

  </form>

  <?php

	$where = " 1=1 ";

	if(isset($_POST['Srchtxtname']) && $_POST['Srchtxtname'] != "")

	{

		 $where .= " AND bnr_title LIKE '%".$_POST['Srchtxtname']."%'"; 

	}

	

	$newsSql = "SELECT * FROM tbl_home_banner WHERE ".$where;

	$paging_results = new MySQLPagedResults($newsSql,"pageNo","",20,"4","<<","Previous","Next",">>"," | ");

    $first_nav 		= $paging_results->getFirstNav();

	$prev_nav 		= $paging_results->getPrevNav();

	$next_nav 		= $paging_results->getNextNav();

	$last_nav 		= $paging_results->getLastNav();

	$pages_nav 		= $paging_results->getPagesNav();

	$offset 		= $paging_results->currentOffset();	

	

	$results_per_page = $paging_results->results_per_page; 

	$limit = " LIMIT $offset , $results_per_page"; // Limit variable for paging display

	

	$newsSql .= $limit;

	

	$newsResult = $objConMgr->DML_executeQry($newsSql );

	if(mysql_num_rows($newsResult) > 0)

	{

  ?>

  <tr>

    <td height="25" colspan="4" align="Left" class="tblHeading">Slide Images  List</td>

  </tr>

  <tr>

    <td colspan="4" class="cptxt" valign="top" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">

        <tr class="tblHeading">

          <td align="Left">&nbsp;</td>

          <td height="25" align="Left"><strong>Status</strong></td>

          <td width="22%" height="25" align="left"><strong>Title</strong></td>
          <td width="22%" height="25" align="left"><strong>Link</strong></td>

          <td width="52%" height="25" align="center"><strong>Images</strong></td>

          <td width="7%" align="center"><strong>Edit</strong></td>

          <td align="center"><strong>Delete</strong></td>

        </tr>

        <?php

		$bg = "#f0f0f0";

		$counter = 0;

		while($newsRow = mysql_fetch_object($newsResult))
		{
			if($newsRow->bnr_status== 1)
				$showStatus = "<img src='../admin/images/enable.gif' title='Enabled'>";
			else
				$showStatus = "<img src='../admin/images/disable.gif' title='Disabled'>";
			if(@$newsRow->nws_show_on_homepage == 1)
				$showOnHomepage = "<img src='../admin/images/icon-home.jpg' title='Show on Home'>";
			else
				$showOnHomepage = "";			
	?>
        <tr bgcolor="<?php if($counter%2 != 0) echo $bg;?>">
          <td width="1%" align="center" class="cptxt">&nbsp;</td>
          <td width="10%" align="left" class="cptxt" valign="top"><?php echo $showStatus?></td>
          <td align="left" valign="top" class="cptxt"><?php echo substr(strip_tags(stripslashes($newsRow->bnr_title)),0,50)?></td>
          <td align="left" valign="top" class="cptxt"><?php echo substr(strip_tags(stripslashes($newsRow->bnr_link)),0,50)?></td>
          <td height="25" align="center" valign="top" class="cptxt"><img src="../upload/images/home_banner/<?php echo $newsRow->bnr_img?>" border="1" width="125" height="69"/></td>
          <td align="center" valign="top" class="cptxt"><a href="control-panel.php?id=<?php echo $newsRow->bnr_id?>&module=<?php echo $module?>&fname=<?php echo $fname?>&DetailMode=Edit" title="Edit Record" style="text-decoration:none;color:#0099FF;"><img src="images/edit.gif" border="0"/></a></td>
          <td width="8%" align="center" valign="top" class="cptxt"><a href="control-panel.php?menuId=4&amp;id=<?php echo $newsRow->bnr_id?>&module=<?php echo $module?>&fname=<?php echo $fname;?>&DetailMode=Delete" title="Delete" onclick="javascript: return DeleteRecordsChk();"><img src="images/delete.gif" border="0"/></a>&nbsp;</td>
        </tr>
        <?php
	  	$counter++; 
	  }
	  ?>
      </table>
      <table style="padding:5px;" cellpadding="1" width="100%" align="right"  border=0 cellspacing=10>
        <tr> <a>
          <td align="right" style="padding-right:10px " class="cptxt"><?php
				if($paging_results->totalPages() > 1) {
					echo "$first_nav $prev_nav $pages_nav $next_nav $last_nav"; 
				}
			?></td>
          </a> </tr>
      </table></td>
  </tr>
  <?php } else{?>
  <tr>
    <td colspan="4" class="manidatory" valign="top" align="center">No Record Found </td>
  </tr>
  <?php } ?>
</table>