<?php
include_once ("includes/includes.inc.php");
$mtp_id = 4;
$services = "S"; 
include_once("includes/header.php");
## Get Page Content ##
$rsPage = $db->select("SELECT * FROM tbl_pages WHERE pageId='7' LIMIT 1");
#print_arr ($rsPage); die();
if (!empty($rsPage)) {
	$page_content		= $rsPage[0];
} else {
    $errorMessage = "Page not exist. Please try later";
}

#####
?>
<?=stripcslashes($page_content['pageText'])?>
</div>
<div class="rightpanel">
	  <?php include_once("includes/contact.php"); ?>
        <?php
		### Getting rightpanel image for this Page
		$rightpanel_image = $db->select("SELECT * FROM tbl_rightpanel_images WHERE status='1' AND id IN (1) ORDER BY id ASC LIMIT 0,1");
		if($rightpanel_image)
			
		{
			$_total = count($rightpanel_image);
			for($i=0; $i<$_total; $i++){
		####
		?>

      <a href="contactus.php"><img src="upload/images/rightpanel/no_appointment.gif" alt="iphone screen repair" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/free_delivery.gif" alt="iphone 5 screen" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/credit_card1.gif" alt="ipad screen cardiff" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/repaired_today.gif" alt="replacement iphone screen" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/90_day_warranty.jpg" alt="new ipad screen" class="right" style="margin-top:25px;"/></a>
      <a href="http://www.wewillfixyourpc.co.uk"><img src="upload/images/rightpanel/laptop_repair.jpg" alt="ipad mini repair" class="right" style="margin-top:25px;"/></a>
      <a href="http://www.wewillfixyourpc.co.uk/laptop_screen_replacement_cardiff.php"><img src="upload/images/rightpanel/laptop_screen2.jpg" alt="ipad digitizer" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/call_us_today.jpg" alt="" class="right" style="margin-top:25px;"/></a>

 <?php } } ?>
  </div>
</div>
<?php
### Getting Quote for this Page
$quote = $db->select("SELECT * FROM tbl_feedback WHERE status='1' AND id='4' LIMIT 0,1");
if (!empty($quote)) {


?>
<div class="quote">
  <div class="maindiv">
    <div class="quoteimg"> <img src="upload/images/feedback/<?=$quote[0]['image']?>" alt="computer repair cardiff"/> </div>
    <div class="quotetext"> <span><img src="images/quote.jpg" alt="laptop repair cardiff"/></span> <?=stripslashes($quote[0]['title'])?><span><img src="images/quoteb.jpg" alt="pc repair cardiff"/></span> </div>
  </div>
</div>
<?php }
####
?>
<?php include_once("includes/footer.php");?>



<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50569125-1', 'wewillfixyouripad.co.uk');
  ga('send', 'pageview');

</script>
