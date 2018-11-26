<?php
$sqlMetaInfo = "SELECT * FROM tbl_meta_info WHERE mtp_id =" . $mtp_id;
$resMetaInfo = $objConMgr->DML_executeQry($sqlMetaInfo);
$meta_DESCRIPTION = "";
$meta_KEYWORDS = "";

if (@mysql_num_rows($resMetaInfo) > 0) {
    $rsMetaInfo = mysql_fetch_object($resMetaInfo);
    $meta_DESCRIPTION = $rsMetaInfo->mti_description;
    $meta_KEYWORDS = $rsMetaInfo->mti_keywords;
    $meta_Others = stripslashes($rsMetaInfo->mti_others);
    $page_Title = $rsMetaInfo->mti_title;
    $google_analytics = $rsMetaInfo->mti_google;
}

$userDetailSelectSql = $objQryBuilder->selectQry('*', 'tbl_emailpref', 'emailid=1');
$userDetailSelectResult = $objConMgr->DML_executeQry($userDetailSelectSql);
$phon = "";
$contactus = "";

if (mysql_num_rows($userDetailSelectResult) > 0) {
    while ($userDetailRS = mysql_fetch_object($userDetailSelectResult)) {
        $contactEmail = $userDetailRS->email;
        $phon = $userDetailRS->phoneno;
    }
}
function GetContactusEmailInfo()
{
    $objQryBuilder = &new QueryBuilder();
    $objConMgr = &new ConnectionMgr();

    $sqlContactusEmail = $objQryBuilder->selectQry("*", "tbl_emailpref", " emailid = 1");
    $CUEResult = $objConMgr->DML_executeQry($sqlContactusEmail);
    return mysql_fetch_object($CUEResult);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?= $meta_Others ?>
<meta name="description" content="<?= $meta_DESCRIPTION ?>" />
<meta name="keywords" content="<?= $meta_KEYWORDS ?>" />

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-13164522-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<title><?= $page_Title ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
<link href="css/ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<link href="css/slider_main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery.orbit-1.2.3.min.js"></script>
<script type="text/javascript">
	$(window).load(function() {
		$('#featured').orbit();
	});
</script>
</head>
<body>
<div class="container">
<div class="header"> <a href="index.php"><img src="images/logo.png" alt="" class="logo"/></a> <a href="contactus.php"><img src="images/map.jpg" alt="" class="map"/></a>
  <div class="call"> Call Now<br />
    <span style="color:#000;">
    <?=$phon[0].$phon[1].$phon[2].$phon[3].$phon[4]." ".$phon[5].$phon[6].$phon[7].$phon[8].$phon[9].$phon[10]?></span><br />

<span style="color:#494949; font-size:11px; font-weight:bold; text-align:center; float:center;">No Fix. No Fee. Prices start from &pound;19</span> </div>


<div class="menu"> 
					<a href="index.php" class="menuh<?=$index?>">Home</a>  
					<a href="help.php" class="menua<?=$help?>">Who We Help</a> 
                    <a href="choose.php" class="menua<?=$choose?>">Why Choose Us ?</a>  
                    <a href="services.php" class="menua<?=$services?>">Services and Prices</a>  
                    <a href="contactus.php" class="menuc<?=$con?>">Contact Us</a> 
                    </div>
</div>
<div class="maindiv">
<div class="leftpanel">