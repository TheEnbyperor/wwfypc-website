<?php

include_once ("lib/connection-manager-mysql.class.php");

include_once ("lib/query-builder-mysql.class.php");

$objQryBuilder = new QueryBuilder();

$objConMgr = new ConnectionMgr();

if ($controller->CheckIsSet(WEBSITE_NAME) && WEBSITE_NAME != "cms")

{

    $contentManagerStatus = 0;

    $xmlFileName = "menuoptions.xml";

    $handle = fopen($xmlFileName, "r");

    $contents = fread($handle, filesize($xmlFileName));

    fclose($handle);

    $xmlDoc = new DOMIT_Document();

    $success = $xmlDoc->parseXML($contents, true); //parse document

    $saxParser = $xmlDoc->parsedBy();

}

############################## fetching user associated modules ids

$userAssociatedModulesId = "";

$userAssociatedModulesCondition = "userId =" . $_SESSION['userId'];

$userAssociatedModulesSelectSql = $objQryBuilder->selectQry('*', 'tbl_admin_users', $userAssociatedModulesCondition);

$userAssociatedModulesSelectResult = $objConMgr->DML_executeQry($userAssociatedModulesSelectSql);

if (mysql_num_rows($userAssociatedModulesSelectResult) > 0)

{

    $userAssociatedModulesRS = mysql_fetch_object($userAssociatedModulesSelectResult);



    $ids = ''; //access module ids



    if ($userAssociatedModulesRS->department == 0)

    {

        $getModules = $objQryBuilder->selectQry('moduleId', 'tbl_modules');

        $getModulesResult = $objConMgr->DML_executeQry($getModules);

        while ($rs = mysql_fetch_object($getModulesResult))

        {

            $ids .= $rs->moduleId . "|";

        }

        $ids = substr($ids, 0, strlen($ids) - 1);

        $userAssociatedModulesId = explode("|", $ids);



    } else

    {

        $getModules = $objQryBuilder->selectQry('moduleId', 'tbl_modules', '( moduleName like "%Manage Documents%" OR moduleName like "%Manage Content Items%")');

        $getModulesResult = $objConMgr->DML_executeQry($getModules);

        while ($rs = mysql_fetch_object($getModulesResult))

        {



            $ids .= $rs->moduleId . "|";

        }

        $userAssociatedModulesId = explode("|", $ids);

    }

    $associatedCount = 0;

}

//print_r( $userAssociatedModulesId );
?>

<script>
		selectedMenu = '1';
</script>
<style>
.submenu{visibility:hidden;display:none;}
</style>

<td width="282" valign="top" style="padding-top:10px;">
<table width="268" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr>
    <td width="4"><img width="4" height="4" src="images/img-bluetop_left.jpg"></td>
    <td width="260" background="images/img-bluetop_cent.jpg"></td>
    <td width="4"><img width="4" height="4" src="images/img-bluetop_right.jpg"></td>
  </tr>
  <tr>
    <td width="4" background="images/img-bluecent_left.jpg"></td>
    <td bgcolor="#C6DEFA"><table width="260" cellspacing="0" cellpadding="0" border="0">
        <tbody><tr>
          <td height="75"><img width="207" height="52" src="images/img-panel_title.jpg"></td>
        </tr>
        <tr>
          <td valign="top"><table width="260" cellspacing="0" cellpadding="0" border="0">
              <tbody><tr>
                <td height="3" colspan="2"></td>
              </tr>
              <tr>
                <td height="3" style="padding-left:0px; " colspan="2"><div style=" border:solid 2px #C6DEFA;" class="sdmenu"> <span style="background-color:#dbe9fb; border:solid 2px #C6DEFA; padding-left:5px; padding-top:8px;" id="top1" class="title1"><img align="top" alt="-" class="arrow1" src="images/img_plus.gif"><a class="navTxt" href="control-panel.php">Home</a></span>
                                        <span style="background-color:#dbe9fb;border:solid 2px #C6DEFA;padding-left:5px; padding-top:8px;vertical-align:middle;" id="top" class="titlehidden" onclick="return toggleMe('para1',1)">
									<img align="top" alt="-" class="arrow" src="images/img_plus.gif" id="para11">Manage Content Items</span>
									<div style="background-color: rgb(255, 255, 255); border: 2px solid rgb(198, 222, 250);  <?php echo (((isset($_REQUEST['menuId'])&&$_REQUEST['menuId']!='')&&$_REQUEST['menuId']==1)?'visibility:visible;display:block;':'display:none;');?> " class="submenu" id="para1">
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(1)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Welcome to We WILL Fix Your PC</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(6)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Who We Help</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(7)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Services and Prices</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(8)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Why Choose Us</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(100)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Laptop Appointments</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(2)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Phone Support</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(3)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Simple Issues</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(4)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Complex Issues</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(5)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Critical Issues</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(37)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Computer repair in Cyncoed</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(44)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Computer repair in Heath</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(46)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Computer repair in Lisvane</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(47)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Computer repair in Llandaff</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(49)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Computer repair in Llanishen</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(56)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Computer repair in Penylan</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(58)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Computer repair in Pontprennau</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(60)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Computer repair in Rhiwbina</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(62)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Computer repair in Roath</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(71)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Computer repair in Whitchurch</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(87)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Laptop Overheating</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(88)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Laptop Power Connector DC Jack</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(91)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Lost Data Recovered</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(84)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Replacement Hard Drive</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(97)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Virus Removal</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(99)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Wireless Networking</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(101)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Windows XP End of Life</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(102)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Sell your laptop</a>
														<a href="control-panel.php?menuId=1&amp;module=Manage Content Items&amp;fname=contents-detail-manager.php&amp;contentId=(103)"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Tablet screen repair</a></div>                    <span style="background-color:#dbe9fb;border:solid 2px #C6DEFA;padding-left:5px; padding-top:8px;vertical-align:middle;" id="top" class="titlehidden" onclick="return toggleMe('para2',2)">
									<img align="top" alt="-" class="arrow" src="images/img_plus.gif" id="para22">Manage Banner</span>
									<div style="background-color: rgb(255, 255, 255); border: 2px solid rgb(198, 222, 250);  <?php echo (((isset($_REQUEST['menuId'])&&$_REQUEST['menuId']!='')&&$_REQUEST['menuId']==2)?'visibility:visible;display:block;':'display:none;');?> " class="submenu" id="para2">
														<a href="control-panel.php?menuId=2&amp;module=Manage Banner&amp;fname=home-manager.php"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Manage Home Banner</a>
														<a href="control-panel.php?menuId=2&amp;module=Manage Banner&amp;fname=manage_right_banners.php"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Manage Rightpanel Banners</a></div>                    <span style="background-color:#dbe9fb;border:solid 2px #C6DEFA;padding-left:5px; padding-top:8px;vertical-align:middle;" id="top" class="titlehidden"  onclick="return toggleMe('para3',3)">
									<img align="top" alt="-" class="arrow" src="images/img_plus.gif" id="para33">Email Preferences</span>
									<div style="background-color: rgb(255, 255, 255); border: 2px solid rgb(198, 222, 250);  <?php echo (((isset($_REQUEST['menuId'])&&$_REQUEST['menuId']!='')&&$_REQUEST['menuId']==3)?'visibility:visible;display:block;':'display:none;');?> " class="submenu" id="para3">
														<a href="control-panel.php?menuId=3&amp;module=Email Preferences&amp;fname=email-preferences.php"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Email Preferences</a></div>                    <span style="background-color:#dbe9fb;border:solid 2px #C6DEFA;padding-left:5px; padding-top:8px;vertical-align:middle;" id="top" class="titlehidden"  onclick="return toggleMe('para4',4)">
									<img align="top" alt="-" class="arrow" src="images/img_plus.gif"  id="para44">Manage Meta Tags</span>
									<div style="background-color: rgb(255, 255, 255); border: 2px solid rgb(198, 222, 250);  <?php echo (((isset($_REQUEST['menuId'])&&$_REQUEST['menuId']!='')&&$_REQUEST['menuId']==4)?'visibility:visible;display:block;':'display:none;');?> " class="submenu" id="para4">
														<a href="control-panel.php?menuId=4&amp;module=Manage Meta Tags&amp;fname=manage-metainfo.php"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Manage Meta Tags</a></div>                    <span style="background-color:#dbe9fb;border:solid 2px #C6DEFA;padding-left:5px; padding-top:8px;vertical-align:middle;" id="top" class="titlehidden"  onclick="return toggleMe('para5',5)">
									<img align="top" alt="-" class="arrow" src="images/img_plus.gif"  id="para55">Manage Client Feedback</span>
									<div style="background-color: rgb(255, 255, 255); border: 2px solid rgb(198, 222, 250);  <?php echo (((isset($_REQUEST['menuId'])&&$_REQUEST['menuId']!='')&&$_REQUEST['menuId']==5)?'visibility:visible;display:block;':'display:none;');?> " class="submenu" id="para5">
														<a href="control-panel.php?menuId=5&amp;module=Manage Client Feedback&amp;fname=manage_feedback.php"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Manage Client Feedback</a></div>                    
                                                        
                                                        <span style="background-color:#dbe9fb;border:solid 2px #C6DEFA;padding-left:5px; padding-top:8px;vertical-align:middle;" id="top" class="titlehidden"        onclick="return toggleMe('para6',6)">
									<img align="top" alt="-" class="arrow" src="images/img_plus.gif"       id="para66">Manage Appointments</span>
									<div style="background-color: rgb(255, 255, 255); border: 2px solid rgb(198, 222, 250);  <?php echo (((isset($_REQUEST['menuId'])&&$_REQUEST['menuId']!='')&&$_REQUEST['menuId']==6)?'visibility:visible;display:block;':'display:none;');?> " class="submenu"     id="para6">
														<a href="control-panel.php?menuId=6&amp;module=Manage Appointments&amp;fname=manage-inquires.php"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Manage Appointments</a>
														<a href="control-panel.php?menuId=6&amp;module=Manage Appointments&amp;fname=manage-laptop-inquires.php"><img border="0" src="images/img-icon-arrow.jpg">&nbsp;&nbsp;Manage Laptop Appointments</a></div>       
													</div>
                  </td>
              </tr>
              <tr>
                <td height="3" colspan="2"></td>
              </tr>
              <tr>
                <td height="3" colspan="2"></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
            </tbody></table></td>
        </tr>
      </tbody></table></td>
    <td width="4" background="images/img-blueright_cent.jpg"></td>
  </tr>
  <tr>
    <td><img width="4" height="4" src="images/img-bluebot_left.jpg"></td>
    <td background="images/img-bluebot_cent.jpg"></td>
    <td><img width="4" height="4" src="images/img-bluebot_right.jpg"></td>
  </tr>
</tbody></table>
<script type="text/javascript">
	function toggleMe(a,b){
		var e=document.getElementById(a);
		if(e.style.display=="none"){
			e.style.visibility="visible"
			e.style.display="block"
			document.getElementById(a+b).src="images/img_minus.gif";
		} else {
			e.style.visibility="hidden"
			e.style.display="none"
			document.getElementById(a+b).src="images/img_plus.gif";
		}
		return true;
	}
</script>


</td>
