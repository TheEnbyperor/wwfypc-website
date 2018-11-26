<?php 
$agent = $_SERVER['HTTP_USER_AGENT'];
$profile = $_SERVER['HTTP_PROFILE'];
include_once ("includes/includes.inc.php");
$mtp_id = 1;
$index = "S"; 
include_once("includes/header.php");
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
        <a href="<?=$result[$i]['bnr_link']?>"><img src="upload/images/home_banner/<?=$result[$i]['bnr_img']?>" alt="<?=$result[$i]['bnr_title']?>" title="<?=$result[$i]['bnr_title']?>" /></a>
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
    <div class="support"> <a href="services.php"><img src="images/step1.gif" alt="computer repair"/></a>
    </div>
    <div class="support1"> <a href="services.php"><img src="images/step2.gif" alt="computer shop"/></a>
    </div>
    <div class="support2"> <a href="services.php"><img src="images/step3.gif" alt="laptop repair"/></a>
    </div>
    <div class="support3"> <a href="services.php"><img src="images/step4.gif" alt="laptop screen"/></a>
    </div>
  </div>
</div>
<div class="maindiv">
  <div class="leftpanel">
    <div class="whead" style="text-transform:none; "> <?=$homepage_text['pageTitle']?></div>
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
  <div class="rightpanel">


<a href="contactus.php"><img src="upload/images/rightpanel/<?=$rightpanel_image['image']?>" alt="computer shop"/></a>

</div>

</div>
<?php
### Getting Quote for this Page
$quote = $db->select("SELECT * FROM tbl_feedback WHERE status='1' AND id='1' LIMIT 0,1");
if (!empty($quote)) {


?>
<div class="quote">
  <div class="maindiv">
    <div class="quoteimg"> <img src="upload/images/feedback/<?=$quote[0]['image']?>" alt="computer store"/> </div>
    <div class="quotetext"> <span><img src="images/quote.jpg" alt="pc repair"/></span> <?=stripslashes($quote[0]['title'])?><span><img src="images/quoteb.jpg" alt="laptop screen repair"/></span> </div>
  </div>
</div>
<?php }
####
?>
<?php include_once("includes/footer.php");?>