<?php 
$agent = $_SERVER['HTTP_USER_AGENT'];
$profile = $_SERVER['HTTP_PROFILE'];
$wap_profile = $_SERVER['HTTP_X_WAP_PROFILE'];

if ((eregi("BlackBerry", $agent) || eregi("BlackBerry", $profile) || eregi("BlackBerry", $wap_profile)))
{
	header('Location: index_wap.php', false, 301);
}

require_once('mobile_device_detect.php');
//mobile_device_detect(false,false,true,true,true,true,true,'http://www.wewillfixyourpc.co.uk/index_wap.php',false);
mobile_device_detect(false,false,true,true,true,true,true,'http://mobile.wewillfixyourpc.co.uk',false);
include_once ("includes/includes.inc.php");
$mtp_id = 1;
$index = "S"; 
include_once("includes/new_header.php");
## Home Page Slider
$query = $db->select("SELECT * FROM tbl_home_banner WHERE bnr_status='1' ORDER BY bnr_id DESC");
$result = $query;
############
?>
<div id="featured"> 
	<?php
        if (!empty($result) && $result > 0)
        {
            echo $total_count = count($result);
            for($i=0;$i<$total_count;$i++)
            {
    ?>
        <img src="upload/images/home_banner/<?=$result[$i]['bnr_img']?>" alt="<?=$result[$i]['bnr_title']?>" title="<?=$result[$i]['bnr_title']?>" />
    <?php 	} 
        } 
    ?>
</div>
</div>
<div class="rightpanel">
<?php include_once("includes/contact.php"); ?>
</div>
</div>
<?php
$rsPage = $db->select("SELECT * FROM tbl_pages WHERE pageId IN (1,2,3,4,5) LIMIT 5");
#print_arr ($rsPage); die();
if (!empty($rsPage)) {
	$homepage_text		= $rsPage[0];
    $phone_support 		= $rsPage[1];
	$simple_issues		= $rsPage[2];
	$complex_issues 	= $rsPage[3];
	$critical_issues 	= $rsPage[4];
} else {
    $errorMessage = "Page not exist. Please try later";
}
?>
<div class="supportdiv">
  <div class="maindiv">
    <div class="support"> <a href="ipadservices.php"><img src="images/support.jpg" alt=""/></a>
      <div class="supporth"> <span style="color:#fff;">Phone</span> Support </div>
      <div class="supportp"><?=$phone_support['pageText']?> <?=$errorMessage?></div>
    </div>
    <div class="support1"> <a href="ipadservices.php"><img src="images/support1.jpg" alt=""/></a>
      <div class="supporth"> <span style="color:#fff;">Simple</span> Issues </div>
      <div class="supportp"><?=$simple_issues['pageText']?> <?=$errorMessage?></div>
    </div>
    <div class="support2"> <a href="ipadservices.php"><img src="images/support2.jpg" alt=""/></a>
      <div class="supporth"> <span style="color:#fff;">Complex</span> Issues </div>
      <div class="supportp"><?=$complex_issues['pageText']?> <?=$errorMessage?></div>
    </div>
    <div class="support3"> <a href="ipadservices.php"><img src="images/support3.jpg" alt=""/></a>
      <div class="supporth"> <span style="color:#fff;">Critical </span> Issues </div>
      <div class="supportp"><?=$critical_issues['pageText']?> <?=$errorMessage?></div>
    </div>
  </div>
</div>
<div class="maindiv">
  <div class="leftpanel">
    <div class="whead" style="text-transform:uppercase; "> <?=$homepage_text['pageTitle']?></div>
    <div class="wpara" style="margin-bottom:0px;"> <?=$homepage_text['pageText']?> <?=$errorMessage?></div>
  </div>
  <?php
	### Getting rightpanel image for this Page
	$rightpanel_image = $db->select("SELECT * FROM tbl_rightpanel_images WHERE status='1' AND id='1' LIMIT 0,1");
	if (!empty($rightpanel_image)) {
	
		$rightpanel_image 	= $rightpanel_image[0];
	} else {
		$error = "Page not exist. Please try later";
	}
	####
	?>
  <div class="rightpanel"> <a href="ipadappointment.php"><img src="upload/images/rightpanel/<?=$rightpanel_image['image']?>" alt=""/></a> </div>
</div>
<?php
### Getting Quote for this Page
$quote = $db->select("SELECT * FROM tbl_feedback WHERE status='1' AND id='1' LIMIT 0,1");
if (!empty($quote)) {


?>
<div class="quote">
  <div class="maindiv">
    <div class="quoteimg"> <img src="upload/images/feedback/<?=$quote[0]['image']?>" alt=""/> </div>
    <div class="quotetext"> <span><img src="images/quote.jpg" alt=""/></span> <?=stripslashes($quote[0]['title'])?><span><img src="images/quoteb.jpg" alt=""/></span> </div>
  </div>
</div>
<?php }
####
?>
<?php include_once("includes/footer.php");?>