<?php

include_once("../admin/include/include.inc_2.php");



//Editing Testimonials

if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Edit") {

	$emailTitle 		= trim($_POST['emailTitle']);

	$email 		= trim($_POST['Email']);

	$phon       = trim($_POST['phon']);

	$whereCondition		= "emailId= 1";//.$_POST['emailId'];	

	$values 			= "email = '$email', phoneno ='$phon'";



	$updateQuery = $objQryBuilder->updateQry("tbl_emailpref",$values,$whereCondition); //die();

	$updateQueryResult = $objConMgr->DDL_executeQry($updateQuery);

	

	//Selecting proper message according to return value  		

	switch ($updateQueryResult) {

		case 1:

			$displayMessage =  UPDATEMESSAGE;

			header("Location:control-panel.php?menuId=$menuId&module=$module&fname=$fname");

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

<script language="javascript" type="text/javascript">

function FrmValidation(mode) {



	if(document.getElementById("emailTitle").value =="" ) {

		alert("Please enter Title.");	

		document.getElementById("emailTitle").focus();

		return false;

	}

	if(document.getElementById("Email").value == "") {

		document.getElementById('tdmail').innerHTML ="Please enter your Email Address.";	

		document.getElementById("Email").focus();

		return false;

	}	

	if(Validate(document.getElementById("Email").value,"[A-Za-z0-9_\\.][A-Za-z]*@[A-Za-z]*\\.[A-Za-z0-9]") == false)	{

		document.getElementById('tdmail').innerHTML ="Please enter valid Email Address.";

		document.getElementById("Email").focus();

		return false;

	}

	if(document.getElementById("phon").value == "") {

		document.getElementById('tdphone').innerHTML ="Please enter your Contact Number.";	

		document.getElementById("phon").focus();

		return false;

	}

	if(Validate(document.getElementById('phon').value,"[^0-9]") == true)

			{

			document.getElementById('tdphone').innerHTML ="Please enter valid Contact number. Only digits are allowed.";

			 document.getElementById('phon').focus();

			 return false;

			}

		else

			{

			 document.getElementById('tdstatus').innerHTML = "";

			}



	return true;

}



function Validate(strToValidate,RegPattern)

{

	var expr = new RegExp(RegPattern);

	var result = expr.test(strToValidate);

	if(result==true){

		return true;

	}else{

		return false;

	}

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

		alert("Invalid image. Please upload a file ending with jpg, jpeg, gif or png etc!");

		filename.focus();

		return false;

	}

	return true;

}

function deleteRecordsChk() {

	if(confirm("Are you sure that you want to delete this record?")){

		return true;

	} else {

		return false;

	}

}

</script>

<script type="text/javascript">

	function TrimString(fieldId)

    {

        var txtObj = document.getElementById(fieldId);

		txtObj.value = txtObj.value.replace(/^\s+/,""); //Left trim        

        txtObj.value = txtObj.value.replace(/\s+$/,""); //Right trim

    }

	

</script>

<link href="../administrator/css/style.css" rel="stylesheet" type="text/css">

<table width="100%" border="0" cellspacing="0" cellpadding="2">

  <tr>

	<td height="19" colspan="4" class="conetntmenutxt" valign="middle">&nbsp;&nbsp;</td>

  </tr>

	<?php

	############################ Add product code ################################

	if(!isset($_REQUEST['emailId']))

	 {

		

	?>	

	<tr>

   	  <td colspan="4" class="cptxt" valign="top" align="center">&nbsp;</td>

  	</tr>	

	<tr>

    <td colspan="4" class="cptxt" valign="top" align="center">

	<table width="95%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">

	<form name="frmUserDetail" id="frmUserDetail" action="control-panel.php?menuId=5&amp;module=Email Preferences&amp;fname=email-def.php" method="post" enctype="multipart/form-data" onSubmit="javascript: return FrmValidation('add');">

	 <input type="hidden" name="db" value="esp_db1">

	 <input type="hidden" name="db" value="lss">

	 <input name="module" id="module" type="hidden" value="<?php if(isset($_REQUEST['module']) && $_REQUEST['module'] != "") echo $_REQUEST['module'];?>"/>

	<input name="fname" id="fname" type="hidden" value="<?php if(isset($_REQUEST['fname']) && $_REQUEST['fname'] != "") echo $_REQUEST['fname'];?>"/>

	  

	 

    </form></table></td>

  </tr>

  <?php

  	} 

 	############################ Edit block of code in case edit record ################################

	if(isset($_REQUEST['emailId']) && $_REQUEST['emailId'] != "") {

		$whereCondition = "emailId =".$_REQUEST['emailId'];

		$selectUserDetailSql = $objQryBuilder->selectQry('*','tbl_emailpref',$whereCondition);



		$selectUserDetailResult = $objConMgr->DML_executeQry($selectUserDetailSql);

		$userDetailRS = mysql_fetch_object($selectUserDetailResult);

  ?>

	<tr>

	    <td colspan="4" class="cptxt" valign="top" align="center">

		<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">

		<form name="frmUserDetail" id="frmUserDetail" action="control-panel.php?menuId=<?=$menuId?>&amp;module=<?=$module?>&amp;fname=<?=$fname?>&amp;DetailMode=Edit" method="post" enctype="multipart/form-data" onSubmit="javascript: return FrmValidation('Edit');">

		<input type="hidden" name="db" value="esp_db1">

	 <input type="hidden" name="db" value="lss">

		<input name="module" id="module" type="hidden" value="<?php if(isset($_REQUEST['module']) && $_REQUEST['module'] != "") echo $_REQUEST['module'];?>"/>

		<input name="fname" id="fname" type="hidden" value="<?php if(isset($_REQUEST['fname']) && $_REQUEST['fname'] != "") echo $_REQUEST['fname'];?>"/>

		<input type="hidden" name="emailId" id="emailId" value="<?php echo $userDetailRS->emailid;?>"/>		

		<tr>

	  		<td height="25" colspan="3" align="Left" class="tblHeading">Edit Email Preferences</td> 

	  		<td height="25"  align="center" class="tblHeading">&nbsp;</td>

		</tr>

		<tr>

	 		<td width="1%" class="cptxt">&nbsp;</td>

	 		<td width="15%" class="cptxt">&nbsp;</td>

			<td colspan="2" align="Left" class="cptxt" height="25"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif"><?php echo @$displayMessage = (@$displayMessage == "") ? @$_REQUEST['message'] : @$displayMessage;?></font></td> 

		</tr>

		<tr>

			<td width="1%" class="cptxt">&nbsp;</td>

    		<td width="15%" align="left" valign="top" class="cptxt">Description:</td>

    		<td width="43%" align="left"><input readonly="readonly" type="text" name="emailTitle" id="emailTitle" class="textfields" value="<?=$userDetailRS->emailtitle?>" style="width:250px;" maxlength="30" onblur="TrimString('emailTitle');" /></td>

    		<td width="41%" height="25" align="left" class="cptxt">&nbsp;</td>

		</tr>

		<tr>

			<td class="cptxt">&nbsp;</td>

			<td align="left" valign="top" class="cptxt">Email Address:</td>

			<td align="left" valign="top">

				<input name="Email" type="text" class="textfields"  id="Email" style="width:250px; vertical-align:top;" value="<?php echo $userDetailRS->email?>" maxlength="250" onblur="TrimString('Email');" /><span class="manidatory" style="vertical-align:top;">&nbsp;*</span> </td>

			<td height="25" align="left" class="manidatory" id="tdmail">&nbsp;</td>

		</tr>

		<tr>

          <td class="cptxt">&nbsp;</td>

		  <td align="left" valign="top" class="cptxt">Phone No:</td>

		  <td align="left" valign="top"><input name="phon" type="text" class="textfields"  id="phon" style="width:250px; vertical-align:top;" value="<?php echo $userDetailRS->phoneno?>" maxlength="11"  />

		      <span class="manidatory" style="vertical-align:top;">&nbsp;*</span> </td>

		  <td height="25" align="left" class="manidatory" id="tdphone">&nbsp;</td>

		  </tr>

		<tr>

			<td class="cptxt">&nbsp;</td>

			<td class="cptxt" valign="top" align="left">&nbsp;</td>

			<td align="left"><input type="image" src="images/cmdUpdate.gif">&nbsp;<a href="javascript:document.getElementById('frmUserDetail').reset()"><img src="images/cmdReset.gif" border="0"/></a></td>

			<td height="26" align="left" class="cptxt"><input type="hidden" name="emailId" id="emailId" value="<?php echo $userDetailRS->emailid?>" /></td>

		</tr>

		<tr>

			<td height="25" colspan="4" align="Left" class="cptxt">&nbsp;</td>

		</tr>

		<tr>

		  <td height="25" align="Left" class="cptxt">&nbsp;</td>

		  <td height="25" colspan="2" align="Left" class="cptxt">All fields marked <font color="#FF0000">*</font> are mandatory.</td>

		  <td height="25" align="Left" class="cptxt">&nbsp;</td>

		  </tr>

		</form>

		</table>

	</td>

</tr>

<?php }  // edit if statment ?>





<?php

############################# Display User Information################################   

$userDetailSelectSql = $objQryBuilder->selectQry('*','tbl_emailpref');

$userDetailSelectResult = $objConMgr->DML_executeQry($userDetailSelectSql);



if(mysql_num_rows($userDetailSelectResult) > 0) { ?>

<tr>

	<td colspan="4" class="cptxt" valign="top" align="center">

	<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">

	<tr class="tblHeading">

	<td height="25" align="Left">&nbsp;</td>

	<td height="25" align="left">Description</td>

	<td width="29%" align="Left"><strong>Email Address</strong></td>

	<td width="24%" align="center"><div align="left"><strong>Phone No</strong></div></td>

	<td width="19%" height="25" align="center"><strong>Edit</strong></td>

</tr>

<?php

$bg = "#f0f0f0";

$counter = 0;

while($userDetailRS = mysql_fetch_object($userDetailSelectResult)) {

	$phon=$userDetailRS->phoneno;

?>

<tr bgcolor="<?php if($counter%2 != 0) echo $bg;?>">

	<td width="2%" align="center" class="cptxt">&nbsp;</td>

	<td width="26%" align="left" valign="top" class="cptxt"><?=$userDetailRS->emailtitle?></td>

	<td width="29%" align="left" valign="top" class="cptxt"><?=$userDetailRS->email?></td>

	<td align="center" valign="top" class="cptxt"><div align="left">

	  <?php echo $userDetailRS->phoneno?>

	</div></td>

	<td height="25" align="center" valign="top" class="cptxt"><a href="control-panel.php?menuId=<?php echo $menuId?>&amp;emailId=<?php echo $userDetailRS->emailid?>&amp;module=<?php if(isset($_REQUEST['module']) && $_REQUEST['module'] != "") echo $_REQUEST['module'];?>&amp;fname=<?php if(isset($_REQUEST['fname']) && $_REQUEST['fname'] != "") echo $_REQUEST['fname'];?>" title="Edit Record"><img src="images/edit.gif" border="0"/></a></td>

<?php $counter++; }?></tr>

</table></td>

</tr>

<?php } else{?>

<tr>

	<td colspan="4" class="manidatory" valign="top" align="center">No Record Found

	</td>

</tr>

<?php } ?>

</table>

 