<?php	ob_start();



	include_once("../admin/require/webconfig.inc.php");



	include_once("../admin/lib/connection-manager-mysql.class.php");



	include_once("../admin/lib/query-builder-mysql.class.php");



	//include_once("webadmin/lib/Showpagecontents.class.php");



	include_once("../admin/lib/MySQLPagedResults.class.php");



	include_once("../admin/lib/db.class.php");



	



	$objQryBuilder = new QueryBuilder();



	$objConMgr	   = new ConnectionMgr();	



	



	$db = new db();



	



	



	$displayMessage = "";



	


	$rsPage = $db->select("SELECT * FROM tbl_laptop_appointments WHERE id=".$_REQUEST['id']." LIMIT 1"); 





	if (!empty($rsPage)) 



	{



		 $rsPage = $rsPage[0];



	}



	else



	{



		$displayMessage = "Page not exist. Please try later";



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

<link href="../admin/css/style.css" rel="stylesheet" type="text/css" />



<form name="frmUserDetail" id="frmUserDetail" action="" method="post" enctype="multipart/form-data">

  <input name="module" id="module" type="hidden" value="<?php echo @$module ?>" />

  <input name="fname" id="fname" type="hidden" value="<?php echo @$fname ?>" />

  <input name="cus_id" id="cus_id" type="hidden" value="<?php echo @$rsPage["id"] ?>"/>

  <table width="500" border="0" cellpadding="0" cellspacing="0" class="" align="center">

    <tr>

      <td align="center"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">

        <?php echo $displayMessage?>

        </font></td>

    </tr>

    <tr>

      <td width="551" align="center" valign="top" class="txt_01"><table width="100%" border="0" cellspacing="0" cellpadding="2" >

          <tr>

            <td colspan="4" align="Left" class="tblHeading" height="25">Appointment Detail</td>

            <td width="1" align="center" class="tblHeading">&nbsp;</td>

          </tr>

          <tr>

            <td></td>

            <td width="448" align="left"></td>

          </tr>

          <tr>

            <td></td>

            <td align="left" id="tdblock" class="regularSmallRed"></td>

          </tr>

          <tr>

            <td width="18" height="23" align="left" class="txt_01">&nbsp;</td>

            <td align="left" class="cptxt" style="color:#009; font-size:13px; text-transform:uppercase;"><strong></strong></td>

            <td width="7" class="" align="left">&nbsp;</td>

          </tr>

          <tr>

            <td colspan="2"><table width="100%" height="144" bgcolor="#FFFFFF">

                <tr>

                  <td width="127" height="20" align="left" class="cptxt"><strong>Name:</strong></td>

                  <td class="cptxt"><?php echo  $rsPage["name"] ?></td>

                </tr>

                <tr>

                  <td height="20" align="left" class="cptxt"><strong>E-mail:</strong></td>

                  <td class="cptxt"><a href="mailto:<?php echo  $rsPage["email"] ?>">

                    <?php echo $rsPage["email"] ?>

                    </a></td>

                </tr>

                <tr>

                  <td height="22" align="left" class="cptxt"><strong>Phone Number:</strong></td>

                  <td class="cptxt"><?php echo  $rsPage["phone"] ?></td>

                </tr>

                <tr>

                  <td height="22" align="left" class="cptxt"><strong>Laptop Maker:</strong></td>

                  <td class="cptxt"><?php echo  $rsPage["laptop_maker"] ?></td>

                </tr>

                <tr>

                  <td height="22" align="left" class="cptxt"><strong>Laptop Model:</strong></td>

                  <td class="cptxt"><?php echo  $rsPage["laptop_model"] ?></td>

                </tr>


                <tr>

                  <td height="22" colspan="2" align="center" class="cptxt"><strong>Problem Description</strong></td>

                </tr>

                <tr>

                  <td height="22" colspan="2" align="left" class="cptxt" style="text-align:justify"><?php echo  $rsPage["problem_desc"] ?></td>

                </tr>

              </table></td>

            <td width="7"></td>

          </tr>

        </table></td>

    </tr>

  </table>

</form>

