<?
ob_start();
include_once("../administrator/require/webconfig.inc.php");
include_once("../administrator/lib/connection-manager-mysql.class.php");
include_once("../administrator/lib/query-builder-mysql.class.php");
include_once("../includes/sessions.inc.php");
include_once("../administrator/phpmailer/class.phpmailer.php");

$menuId = $_REQUEST['menuId'];
$module = $_REQUEST['module'];
$fname = $_REQUEST['fname'];

//$File_Type_Error	= false;
$objQryBuilder 	= & new QueryBuilder();
$objConMgr 		= & new ConnectionMgr();
$displayMessage = "";
$whereCondition = "mbr_id =".$_REQUEST['id'];
$selectUserDetailSql = $objQryBuilder->selectQry('*','tbl_members',$whereCondition);
$selectUserDetailResult = $objConMgr->DML_executeQry($selectUserDetailSql);
$userDetailRS = mysql_fetch_object($selectUserDetailResult);


if(isset($_REQUEST['DetailMode'])&& $_REQUEST['DetailMode'] == "Edit") {	
	$mbrid = $_REQUEST['id'];
	
	$whereCondition = "mbg_id=".$_REQUEST['mpkid'];
	$ok= $_REQUEST['status'];
	$values = " mbg_status = ". $_REQUEST['status'];
	$updateQuery = $objQryBuilder->updateQry("tbl_member_package",$values,$whereCondition);
	$updateQueryResult = $objConMgr->DDL_executeQry($updateQuery);
	 $sql = "SELECT distinct *
				   FROM tbl_member_package mbp
				   INNER JOIN tbl_packages pkg ON mbp.pkg_id = pkg.pkg_id
				   INNER JOIN tbl_members mbr ON mbp.mbr_id = mbr.mbr_id
				   WHERE  mbp.mbr_id = ".$mbrid." and mbp.mbg_id = ".$_REQUEST['mpkid'];				    $Result = $objConMgr->DML_executeQry($sql);
	$RS = mysql_fetch_object($Result);
	 $uname = $RS->mbr_title." ".$RS->mbr_fname." ".$RS->mbr_sname; 
	 $memPackage = $RS->pkg_name;
	 $validTill  = date("Y-m-d", strtotime($RS->mbg_valid_to));
	 $status	= $RS->mbg_status;
	 $user		= $RS->mbr_email ;
	if($ok==1)
	{		
			//echo LOGIN_EMAIL_FROM;
			$fromInfo = GetfromInfo();
			
			$from=$fromInfo['email'];
			$emailObj = &new eMail();
			 $emailBody = RenewalEmail($uname, $memPackage, $validTill, $status); 
			$emailsubject = WEBSITE_NAME. "Account Renewal Information";
			$emailObj->SendEmail($from, $user, $emailsubject, $emailBody, "","Positive Path");
			
			}
	
	switch ($updateQueryResult){
			case 1:
				$displayMessage = "The status of customer membership Package has been changed successfully.";
				header("Location:member-detail.php?id=$mbrid&message=$displayMessage");
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

if(isset($_REQUEST['message']) && $_REQUEST['message'] != ""){
	$displayMessage = $_REQUEST['message'];
}
?>
<script>
function deleteRecordsChk() {
	if(confirm("Are you sure that you want to change customer status?")){
		return true;
	} else {
		return false;
	}
}
</script>
<script>
	function validate(){
		if(document.getElementById('block').checked == false){
			document.getElementById('tdblock').innerHTML = "Please check the checkbox below to change the status of customer.";
			document.getElementById('block').focus();
			return false;
		}
		else{
			document.getElementById('tdblock').innerHTML = "";
		}
		return true;
	}
</script>
<link href="../administrator/css/style.css" rel="stylesheet" type="text/css" />
<form name="frmUserDetail" id="frmUserDetail" action="" method="post" enctype="multipart/form-data"> 
    <input name="module" id="module" type="hidden" value="<?= $module ?>" />
  		<input name="fname" id="fname" type="hidden" value="<?= $fname ?>" />
        
        <input name="cus_id" id="cus_id" type="hidden" value="<?=$userDetailRS->cus_id?>"/>
<table width="500" border="0" cellpadding="0" cellspacing="0"  align="center">
  <tr><td align="center"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif"><?=$displayMessage?></font></td></tr>
  <tr>
    <td width="100%" align="center" valign="top" class="cptxt">
		<table width="100%" border="0" cellspacing="0" cellpadding="2" >
        	
			<tr>
	  			<td colspan="6" align="Left" class="tblHeading" height="25">View Member Detail</td> 
	  			<td width="2" align="center" class="tblHeading">&nbsp;</td>
			</tr>
            <tr>
            	<td></td>
                <td colspan="3" align="left"></td>
            </tr>
            <tr>
            	<td></td>
                <td align="left" colspan="3" id="tdblock" ></td>
            </tr>
			<tr>
             	<td width="16" class="cptxt" align="left">&nbsp;</td>
             	<td width="210" class="cptxt" align="center" style="color:#009; font-size:13px; text-transform:uppercase;"><strong>
           	    <?=$userDetailRS->mbr_title." ".$userDetailRS->mbr_fname." ".$userDetailRS->mbr_sname?>
       	    </strong> </td>
             	<td width="36" class="" align="left" valign="middle">&nbsp;</td>
		        <td width="210" class="cptxt" align="left" valign="middle"><strong>Payment Status :</strong><?=($userDetailRS->mbr_status == 1 ? "Done" : "Failed")?></td>
		        <td width="1" class="" align="left">&nbsp;</td>
		  </tr>
            <tr>
                <td colspan="4">
                	<table width="100%" height="183" bgcolor="#FFFFFF">
                    	<tr>
                       	  <td width="132" height="20" align="right" class="cptxt"><strong>Login Id:</strong></td>
                          <td colspan="3"  class="cptxt">
                            <?=$userDetailRS->mbr_email ?>
                          </td>
                   	  </tr>
                        
                        <tr>
                       	  <td height="20" align="right" class="cptxt"><strong>Forename:</strong></td>
                            <td width="130" class="cptxt">
                              <?=$userDetailRS->mbr_fname ?>
                            </td>
                          <td width="87" align="left" class="cptxt"><strong>Surname:</strong></td>
                          <td width="115" align="left" class="cptxt"><?=$userDetailRS->mbr_sname ?></td>
                        </tr>
                        
                        <tr>
                       	  <td height="22" align="right" class="cptxt"><strong>House #/Name</strong>:</td>
                            <td colspan="3" class="cptxt"><?=$userDetailRS->mbr_address_line1 ?></td>
                      </tr>
                        
                         <tr>
                       	   <td height="20" align="right" class="cptxt"><strong>Street Name</strong>:</td>
                            <td colspan="3" class="cptxt"><?=$userDetailRS->mbr_address_line2 ?></td>
                      </tr>
                        
                        
                        
                         <tr>
                       	   <td height="20" align="right" class="cptxt"><strong>City/Town:</strong></td>
                            <td width="130" class="cptxt"><?=$userDetailRS->mbr_city ?></td>
                           <td align="left" class="cptxt"><strong>Zip Code</strong></td>
                           <td align="left" class="cptxt"><?=$userDetailRS->mbr_zip ?></td>
                      </tr>
                        
                         <tr>
                           <td height="21" align="right" class="cptxt"><strong>Home Telephone</strong>:</td>
                           <td class="cptxt"><?=$userDetailRS->mbr_hphone ?></td>
                       	   <td  align="left" class="cptxt"><strong>Country:</strong></td>
                           <td  align="left" class="cptxt"><?=$userDetailRS->mbr_country ?></td>
                      </tr>
                        
                      <tr>
                       	  <td height="21" align="right" class="cptxt">&nbsp;</td>
                            <td width="130" class="cptxt">&nbsp;</td>
                          <td align="left" class="cptxt">&nbsp;</td>
                          <td align="left" class="cptxt">&nbsp;</td>
                      </tr>
              </table>                </td>
                
                <td width="1"></td>
            </tr>
           
	</table>
    
    </td>
  </tr>
	

<tr>
	<td colspan="4" class="cptxt" valign="top" align="center">
</td>
</tr>

</table>
</form>
<script>
function showDiv(objectID) {
	var theElementStyle = document.getElementById(objectID);

	if(theElementStyle.style.display == "none")
	{
		theElementStyle.style.display = "";
	}
	else
	{
		theElementStyle.style.display = "none";
	}
}
</script>
<?php
function RenewalEmail($uname, $memPackage, $validTill, $status)
		{
			$CompanyInfo = GetContactusInfo();
			
			$emailBody = '<style>
							.Bold14gray{
								font-size:14px;
								font-weight:bold;
								font-family:Arial;
								color:black;
							}
							
							.regular12gray{
								font-size:12px;
								color:black;
								font-family:Arial;
							}
							
							.regular12red{
								font-size:12px;
								color:black;
								font-family:Arial;
							}
							
							.Bold12DarkRed{
								font-size:12px;
								color:black;
								font-weight:bold;
								font-family:Arial;
							}
							
							.regular12DarkRed{
								font-family:Arial;
								font-size:12px;
								color:black;
							}
		
						 </style><table cellpadding="0" cellspacing="0">
							<tr><td width="25"></td>
								<td colspan="2"><img src="logo.jpg" /></td>
							</tr>
							<tr>
								<td height="60"></td>
								<td ></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td class="regular12gray">Dear '.$uname.' </td>
							</tr>
							<tr>
								<td height="30"></td>
								<td class="regular12gray"></td>
							</tr>
							<tr>
								<td></td>
								<td class="regular12gray">Your account renewal request is fulfilled.</td>
							</tr>
							<tr>
								<td height="20"></td>
								<td></td>
							</tr>
							<tr>
								<td ></td>
								<td class="Bold12DarkRed">Your Account Details are</td>
							</tr>
							<tr>
								<td ></td>
								<td><span class="Bold12DarkRed">Memebership Package :</span><span class="regular12gray">'.$memPackage.'</span></td>
							</tr>
							<tr>
								<td ></td>
								<td><span class="Bold12DarkRed">Valid till :</span><span class="regular12gray">'.$validTill.'</span></td>
							</tr>
							
							<tr>
								<td height="45"></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td class="regular12gray">We look forward to seeing you again.</td>
							</tr>
							<tr>
								<td height="45"></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td class="regular12gray">Thanks</td>
							</tr>
							<tr>
								<td height="25"></td>
								<td></td>
							</tr>
							
								
							<tr>
								<td></td>
								<td class="regular12gray">Yours sincerely,</td>
							</tr>
							<tr>
								<td></td>
								<td class="regular12gray">'.$CompanyInfo['name'].'</td>
							</tr>
							<tr>
								<td></td>
								<td class="regular12gray"><b>Address: </b>'.$CompanyInfo['address'].'</td>
							</tr>
							<tr>
								<td height="20"></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td><span class="regular12gray"><b>Tel:</b></span><span class="regular12gray">'.$CompanyInfo['phone'].'</span> </td>
							</tr>
							<tr>
								<td></td>
								<td><span class="regular12gray"><b>Fax:</b></span><span class="regular12gray">'.$CompanyInfo['fax'].'</span> </td>
							</tr>
							<tr>
								<td height="20"></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td><span class="regular12gray"><b>Web: </b></span><span class="regular12gray">'.WEBSITE_HOST.'</span> </td>
							</tr>
							<tr>
								<td></td>
								<td><span class="regular12gray"><b>Email:</b></span><span class="regular12gray">'.$CompanyInfo['email'].'</span></td>
							</tr>
						</table>';
						
				return $emailBody;		
		}
		
		
	
	class eMail
{
	function eMail()
	{
	}

	function SendEmail($from, $to, $subject, $body, $bcc,$fromName="Postive Path Administrator")
	{
		$mail = &new PHPMailer();
		$mail->IsSMTP(); // send via SMTP
		$mail->Host		=  SMTP_SERVER; // SMTP servers
		$mail->Mailer   = MAILER;
		$mail->IsHTML(true);
		$mail->FromName     = $fromName;
		$mail->From     = $from;
		$mail->Subject  = $subject;
		$mail->Body 	= $body;
		$mail->AddAttachment("../images/logo.jpg", "logo.jpg"); 	  
		$mail->AddAddress($to, $to); 
		
		if(!$mail->Send()) 
			{
				return false;
			}
		else 
			{
				return true;
			 }
	}

		
}
function GetContactusInfo()
	{
		$objQryBuilder = & new QueryBuilder();
		$objConMgr = & new ConnectionMgr();	
		
		$selectQuery= $objQryBuilder->selectQry("*","tbl_emailpref");
		$selectResult =	$objConMgr->DML_executeQry($selectQuery);
		
		$row = mysql_fetch_array($selectResult);
		
		return $row;
			
	}
function GetfromInfo()
{
	$objQryBuilder = & new QueryBuilder();
		$objConMgr = & new ConnectionMgr();	
	$where='emailId=3';
	$selectfrom  = $objQryBuilder->selectQry("*","tbl_emailpref1",$where);
	$fromResult =	$objConMgr->DML_executeQry($selectfrom);
	
	$rowfrom = mysql_fetch_array($fromResult);
	
	return $rowfrom;
		
}		
        ?>