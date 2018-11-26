<?
include_once("require/webconfig.inc.php");
include_once("lib/query-builder-mysql.class.php");
include_once("lib/connection-manager-mysql.class.php");

		$objQryBuilder = & new QueryBuilder();
		$objConMgr = & new ConnectionMgr();	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><title>Welcome to Etisalat</title>
<meta name="keywords" content="telecom, telecommunication, mobile, internet, ISP">
<meta name="description" content="Welcome to Etisalat. We help people to reach each other, businesses to find new markets and everyone to fulfil their potential. We provide telephone, TV and Internet across the UAE and beyond. Our customers enjoy the latest services and technologies, as well as a choice of great entertainment.">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="ROBOTS" content="ALL">
<script language="javascript1.2" src="../pages/Etisalat/Welcome to Etisalat_files/scroller.js" type="text/javascript"></script>
<script language="javascript1.2" src="../pages/Etisalat/Welcome to Etisalat_files/dropdown.js" type="text/javascript"></script>
<script language="javascript1.2" src="../pages/Etisalat/Welcome to Etisalat_files/switch.js" type="text/javascript"></script>
<script language="javascript1.2" src="../pages/Etisalat/Welcome to Etisalat_files/image.js" type="text/javascript"></script>

<link href="../pages/Etisalat/Welcome to Etisalat_files/style.css" rel="stylesheet" type="text/css">
<link rel="SHORTCUT ICON" href="http://www.etisalat.ae/assets/skin/en/images/etisalat.ico">

</head>

<body>

<center>
<div class="shadow"><div class="shadow2"><div class="allContent green">
<div class="header">
	<table class="" border="0" cellpadding="0" cellspacing="0" background="../pages/img/topbg.jpg">
	<tbody><tr>
		<td class="headerLogo" rowspan="2">
			<a href="http://www.etisalat.ae/index.jsp?lang=en"><img src="../pages/Etisalat/Welcome to Etisalat_files/logo.gif" alt="Etisalat Logo" border="0" height="41" width="189"></a>
		</td>
		<td class="headerLang">&nbsp;</td>
	</tr>
 	</tbody></table>
	
</div>
<div class="mainHome" style="background: transparent url(/assets/skin/en/images/main/home.jpg) repeat scroll 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;"><img src="../pages/img/home.jpg" /></div>

<div class="mainContent">
	
	<div style="width:70%; float:left; font-size:12; vertical-align:top; font-family:Arial, Helvetica, sans-serif ">
    
 <?

 	if($_POST['all']=true)
	{
		echo $selectQuery= $objQryBuilder->selectQry("*","tbl_register");
		echo $sQuery =	$objConMgr->DML_executeQry($selectQuery);
	}
	else
	{print"not";}
	/*
	if($_POST)
{	
	if($_POST['all'])
	$selectQuery= $objQryBuilder->selectQry("*","tbl_register");
	$sQuery =	$objConMgr->DML_executeQry($selectQuery);
	
	if ($sQuery>0 )					    
		{
		$value = mysql_fetch_object($sQuery);
		
		$title 		= $value->title;
		$fname 		= $value->fname;
		$lname 		= $value->lname;
		$mailid 	= $value->email;
		$contactno 	= $value->contactno;
		$region 	= $value->region;
		$companyname= $value->cmp_name;
		$type 		= $value->type_use;
		$serviceuse = $value->bb_service;
		$deviceuse 	= $value->deviced_use;
		$regno 		= $value->regno;
	    }
	else
		{
		$Msg="Sorry, No record found";
		}

}*/

?>

    
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
    <tr >
      <td width="2"></td>
      <td colspan="3"></td>
    </tr>
    
    <tr>
      <td></td>
      <td><b>First Name</b></td>
      <td><b>E-mail</b></td>
      <td width="143"><b>Region</b></td>
      <td width="121"></td>
    </tr>
    <? while($info = mysql_fetch_array($sQuery))
		{?>
    <tr>
      <td></td> 
      <td width="100" class="serviceSubHeader"><?= $info['fname']?></td>
      <td width="125"><?= $info['email']?></td>
       <td><?= $info['region']?></td>
       <td><a href="../Manage Reports/view_record.php?fname=<?=$info['fname']?>,email=<?=$info['email']?>,region= <?=$info['region']?>" ><b>view</b></a></td>
    </tr>   
      <? } ?>      
    <tr>
      <td height="20"></td>
      <td></td>
      <td></td>
    </tr>
  </table>
            
          </div>
          <div style="width:25%; float:left; margin-left:10px;">
            <table  border="0" cellpadding="0" cellspacing="0">
               <tr>
                  <td height="6"></td>
              </tr>
              <tr>
              	<td style="font-size:18px; font-family:'Times New Roman', Times, serif" align="left" ><img src="../pages/img/press.jpg" alt="" /></td>
              </tr>
              <tr><td height="10"></td></tr>
              <tr>
              	<td align="left" style="text-align:left" >
                <p>
With a unique touch screen and cutting-edge multimedia capabilities, the BlackBerry® Storm™ smartphone makes a great impression as you travel across town or to almost any corner of the world.
                </p>
                
                </td>
              </tr>
              <tr>
                   <td><img src="../pages/img/mobile.jpg" alt="" /></td>
              </tr>
              <tr><td height="10"></td></tr>
              <tr>
                	<td height="20" align="left"><img src="../pages/img/logoBalckB.jpg" alt="" width="198" height="36" /></td>
              </tr>
 
                
               </table>
            
     
	</div>
    
</div>



    




</div></div></div>






 



    
<p class="copyright">Copyright 2009 © Etisalat</p>

</center>
</body></html>
<?
function prepearString($value){
	$objConMgr  = new ConnectionMgr();
	$value = mysql_real_escape_string(trim($value),$objConMgr->createConnection());
	$value = "'" .$value. "'";
	return $value;
}

?>