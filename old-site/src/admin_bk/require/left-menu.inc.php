<?
include_once ("lib/connection-manager-mysql.class.php");
include_once ("lib/query-builder-mysql.class.php");
$objQryBuilder = &new QueryBuilder();
$objConMgr = &new ConnectionMgr();
if ($controller->CheckIsSet(WEBSITE_NAME) && WEBSITE_NAME != "cms")
{
    $contentManagerStatus = 0;
    $xmlFileName = "menuoptions.xml";
    $handle = fopen($xmlFileName, "r");
    $contents = fread($handle, filesize($xmlFileName));
    fclose($handle);
    $xmlDoc = &new DOMIT_Document();
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
//print_r($userAssociatedModulesId);
?>

<table width="268" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="4"><img src="images/img-bluetop_left.jpg" width="4" height="4"></td>
    <td width="260" background="images/img-bluetop_cent.jpg"></td>
    <td width="4"><img src="images/img-bluetop_right.jpg" width="4" height="4"></td>
  </tr>
  <tr>
    <td width="4" background="images/img-bluecent_left.jpg"></td>
    <td bgcolor="#C6DEFA"><table width="260" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="75"><img src="images/img-panel_title.jpg" width="207" height="52"></td>
        </tr>
        <tr>
          <td valign="top"><table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2" height="3"></td>
              </tr>
              <tr>
                <td colspan="2" height="3" style="padding-left:0px; "><div class="sdmenu" style=" border:solid 2px #C6DEFA;" > <span class="title1" id="top1" style="background-color:#dbe9fb; border:solid 2px #C6DEFA; padding-left:5px; padding-top:8px;"><img align="top" src="images/img_plus.gif" class="arrow1" alt="-" /><a href="control-panel.php" class="navTxt" >Home</a></span>
                    <? 
			  if($controller->CheckIsSet(WEBSITE_NAME) && WEBSITE_NAME != "cms")
			  {
					if ($xmlDoc->documentElement->hasChildNodes())
					{	
						
						$moduleChildNodes =& $xmlDoc->documentElement->childNodes;
						$numChildren =&   $xmlDoc->documentElement->childCount; 
					
						  for ($i = 1;$i<=$numChildren;$i++)
						  {
								$curentNode	= $i - 1;
								$moduleSubChildNode = & $moduleChildNodes[$curentNode]->childNodes;
								$moduleSubChildren = & $moduleChildNodes[$curentNode]->childCount;
								for($associatedCount = 0; $associatedCount < count($userAssociatedModulesId); $associatedCount++)
								{
								if($userAssociatedModulesId[$associatedCount] == $moduleSubChildNode[0]->getText())
								{
									if($moduleSubChildNode[2]->nodeName == "module_Enable" && $moduleSubChildNode[2]->getText() == "true")
								{
											
									$moduleName = "";
						?>
                    <?				
									
									echo '<span class="title" id="top" 
										style="background-color:#dbe9fb;border:solid 2px #C6DEFA;padding-left:5px; padding-top:8px;vertical-align:middle;">
									<img align="top" src="images/img_plus.gif" class="arrow" alt="-" />'.$moduleSubChildNode[1]->getText().'</span>
									<div class="submenu" style="background-color:#ffffff; border:solid 2px #C6DEFA;">';
										if($moduleSubChildNode[1]->nodeName == "module_Name")
										  {
											 $moduleName = $moduleSubChildNode[1]->getText();
											 	
										  }
											 
										 for($j = 1; $j<=$moduleSubChildren;$j++)
										  {
												$curentNode	= $j - 1;
												$moduleDisplayTextNode = &$moduleSubChildNode[$curentNode]->getElementsByPath("displayText",1);
												$moduleFileSourceNode = &$moduleSubChildNode[$curentNode]->getElementsByPath("sourceFile",1);
													
												if($moduleDisplayTextNode  != null && $moduleFileSourceNode != null) 
												{													
													
													$fileName = $moduleFileSourceNode->getText();
													$displayText = $moduleDisplayTextNode->getText();
													if($displayText !="" && $fileName != "")
													{
														echo '
														<a href="control-panel.php?menuId='.$i.'&module='.$moduleName.'&fname='.$fileName.'" ><img border=0  src="images/img-icon-arrow.jpg">&nbsp;&nbsp;'.	
														$displayText.'</a>';
													} ####   $displayText !="" && $fileName != ""
												
												}  #### $moduleDisplayTextNode  != null && $moduleFileSourceNode != null
													
										  }		   #### $j = 1; $j<=$moduleSubChildren;$j++	
										  echo "</div>";
												    
								 }				   #### $moduleSubChildNode[2]->nodeName == "module_Enable"
								//echo $userAssociatedModulesId[$associatedCount];
								}
								}				   #### associated modules conditions						
									
						
						 }						   #### $i = 1;$i<=$numChildren;$i++
					  
				   }							   #### $xmlDoc->documentElement->hasChildNodes()
			 	
			 }									   #### $controller->CheckIsSet(WEBSITE_NAME) && WEBSITE_NAME != "cms"
			 					
		?>
       
													</div>
                  </div></td>
              </tr>
              <tr>
                <td colspan="2" height="3"></td>
              </tr>
              <tr>
                <td colspan="2" height="3"></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
    <td width="4" background="images/img-blueright_cent.jpg"></td>
  </tr>
  <tr>
    <td><img src="images/img-bluebot_left.jpg" width="4" height="4"></td>
    <td background="images/img-bluebot_cent.jpg"></td>
    <td><img src="images/img-bluebot_right.jpg" width="4" height="4"></td>
  </tr>
</table>
<? if(isset($_GET['menuId'])){
	$_SESSION['menuId'] = $_GET['menuId'];?>
<script>
		selectedMenu = '<?=$_GET['menuId']?>';
</script>
<? }else if (isset($_SESSION['menuId'])){?>
<script>
		selectedMenu = '<?=$_SESSION['menuId']?>';
</script>
<? } ?>