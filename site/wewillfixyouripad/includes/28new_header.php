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

<title>We Will Fix Your PC - <?= $page_Title ?></title>
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
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

<div class="header"> 
		<div id="forlogo" style="width:300px; height:160px; float:left;"><a href="index.php"><img src="../images/logo.png" alt="" width="296" height="155"/></a></div>
<div id="mapphonemenu" style="width:685px; height:160px; float:left;">
        	<div id="mapphone" style="width:685px; height:121px;">
            <div id="null" style="width:100px; height:114px; float:left;"></div>
                <div id="map" style="width:260px; height:114px; float:left;"><a href="contactus.php"><img src="../images/map.jpg" alt=""/></a></div>
                
                <div id="phone" style="width:300px; height:114px; float:left; text-align:right;">
                 <h5 style="color:#ff7b00; font-family:Arial, Helvetica, sans-serif;font-size:32px;">Call Now</h5><br/>
                <span style="color:#000; font-size:24px; font-weight:bold; text-align:center;">
                <?=$phon[0].$phon[1].$phon[2].$phon[3].$phon[4]." ".$phon[5].$phon[6].$phon[7].$phon[8].$phon[9].$phon[10]?></span><br />
                <span style="color:#494949; font-size:11px; font-weight:bold; text-align:center; float:center;">No Fix. No Fee. Prices start from &pound;19</span>
                </div>
            </div>
            <div class="menu" style="width:683px; height:39px;">
            <a href="index.php" class="menuh<?=$index?>">Home</a> <img src="../images/separator.jpg" class="left"/> <a href="help.php" class="menua<?=$help?>">Who We Help              </a><img src="../images/separator.jpg" class="left"/> <a href="choose.php" class="menua<?=$choose?>">Why Choose Us ?</a> <img src="../images/separator.jpg"              class="left"/> <a    href="services.php" class="menua<?=$services?>">Services and Prices</a> <img src="../images/separator.jpg" class="left"/> <a href=             "contactus.php" class="menuc<?=$con    ?>">Contact Us</a> 
            </div>
        </div>
       <!-- <a href="index.php"><img src="images/logo.png" alt="" class="logo"/></a> <a href="contactus.php"><img src="images/map.jpg" alt="" class="map"/></a>
          
          <div class="call">
                Call Now<br/>
                <span style="color:#000;">
                <?=$phon[0].$phon[1].$phon[2].$phon[3].$phon[4]." ".$phon[5].$phon[6].$phon[7].$phon[8].$phon[9].$phon[10]?></span>
                <span style="color:#494949; font-size:11px; font-weight:bold; text-align:center; float:center;">No Fix. No Fee. Prices start from &pound;19</span> 
           </div>
        
        
        <div class="menu">
            <a href="index.php" class="menuh<?=$index?>">Home</a> <img src="images/separator.jpg" class="left"/> <a href="help.php" class="menua<?=$help?>">Who We Help              </a><img src="images/separator.jpg" class="left"/> <a href="choose.php" class="menua<?=$choose?>">Why Choose Us ?</a> <img src="images/separator.jpg"              class="left"/> <a    href="services.php" class="menua<?=$services?>">Services and Prices</a> <img src="images/separator.jpg" class="left"/> <a href=             "contactus.php" class="menuc<?=$con    ?>">Contact Us</a> 
        </div> -->

</div>

<div class="maindiv">
<div class="leftpanel">