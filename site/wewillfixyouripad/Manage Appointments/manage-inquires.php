<?

	include_once("../admin/include/include.inc.php");

	$displayMessage = "";

	

	



####################################  Delete member Detail #######################################################		

if(isset($_GET['DetailMode'])&& $_GET['DetailMode'] == "Delete")

{





	if(isset($_GET['id']) && $_GET['id'] != "")

	{

		$mbrid = treatGet($_GET['id']);



		$whereCondition = " id = ".$mbrid;

		$deleteQuery = $objQryBuilder->deleteQry("tbl_appointments",$whereCondition);

		$deleteResult = $objConMgr->DDL_executeQry($deleteQuery);

		

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

############################################## End of Delete member detail ################################	

	

if( isset($_REQUEST['message']) && $_REQUEST['message'] !="") {

	$displayMessage = $_REQUEST['message'];

}	

		

		

?>
<script src="jvs/functions.js"></script>
<link href="css/thickbox.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery.js"></script>
<script src="js/thickbox-compressed.js"></script>
<script language="javascript" type="text/javascript">

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

</script>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <form method="post" name="frmPaging" enctype="multipart/form-data">
    <input name="pageNo" type="hidden" value="" id="pageNo">
  </form>
  <? 

	

	$searchSql = "SELECT * FROM tbl_appointments where id !='' order by id DESC";

				   

	$paging_results = new MySQLPagedResults($searchSql,"pageNo","",20,"100","<<","Previous","Next",">>"," | ");

    $first_nav 		= $paging_results->getFirstNav();

	$prev_nav 		= $paging_results->getPrevNav();

	$next_nav 		= $paging_results->getNextNav();

	$last_nav 		= $paging_results->getLastNav();

	$pages_nav 		= $paging_results->getPagesNav();

	$offset 		= $paging_results->currentOffset();

	

	$results_per_page = $paging_results->results_per_page; 

	$limit = " LIMIT $offset , $results_per_page"; // Limit variable for paging display

	

	$searchSql .= $limit;

	

	$searchResult = $objConMgr->DML_executeQry($searchSql);

	if(mysql_num_rows($searchResult) > 0 )

	{

	?>
  <tr>
    <td height="35" colspan="5" align="center" class="cptxt"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="tblHeading">
          <td width="1%" height="26" class="cptxt"></td>
          <td width="23%" align="left"><strong>Name</strong></td>
          <td width="31%" height="26" align="left"><strong>E-mail</strong></td>
          <td width="22%" height="26" align="left"><strong>Appointment Date</strong></td>
          <td width="11%" height="26" align="center"><strong>Detail</strong></td>
          <td width="12%" align="center">Delete</td>
        </tr>
        <?

	  		while($searchRow = mysql_fetch_object($searchResult)){	

	  ?>
        <tr>
          <td height="26" class="cptxt"></td>
          <td height="26" class="cptxt"><?=$searchRow->name?></td>
          <td height="26" align="left" class="cptxt"><a href="mailto:<?=$searchRow->email?>">
            <?=$searchRow->email?>
            </a></td>
          <td height="26" align="left" class="cptxt"><?=$searchRow->date?>
            -
            <?=$searchRow->month?></td>
          <td height="26" align="center" class="cptxt"><a href="../Manage Appointments/inquires-detail.php?id=<?= $searchRow->id?>&height=400&width=600&keepThis=true&TB_iframe=true" class="thickbox">Detail</a></td>
          <td align="center" class="cptxt"><a href="control-panel.php?id=<?=$searchRow->id?>&module=<?=$module?>&fname=<?=$fname?>&DetailMode=Delete" title="Delete" onclick="javascript: return deleteRecordsChk();"><img src="images/delete.gif" border="0"/></a>&nbsp;</td>
        </tr>
        <? } ?>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td align="left">&nbsp;</td>
          <td class="ptext" align="left">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table style="padding:5px;" cellpadding="1" width="100%" align="right"  border=0 cellspacing=10>
        <tr> <a>
          <td align="right" style="padding-right:10px " class="cptxt"><?

										if($paging_results->totalPages() > 1) {

											echo "$first_nav $prev_nav $pages_nav $next_nav $last_nav"; 

										}

									?></td>
          </a> </tr>
      </table></td>
  </tr>
  <? } else{?>
  <tr>
    <td colspan="4" class="manidatory" valign="top" align="center">No Record Found </td>
  </tr>
  <? } ?>
</table>
