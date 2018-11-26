<?php
include_once ("includes/includes.inc.php");
$mtp_id = 2; 
$help = "S"; 
include_once("includes/header.php");
## Get Page Content ##

#print_arr ($rsPage); die();
if (!empty($rsPage)) {
	$page_content		= $rsPage[0];
} else {
    $errorMessage = "Page not exist. Please try later";
}

#####
?>
<?=stripcslashes($page_content['pageText'])?>

<P><P><BR><P>&nbsp;<P><BR><P>

<div class="maindiv"><P><BR><P><center><img src="images/SamsungLogo.jpg" alt="samsung repair cardiff"></center></div>

<P><BR><P>&nbsp;<P><BR><P>

<div class="maindiv"><center><P><BR><P><a href="http://www.wewillfixyouripad.co.uk/samsungphonerepair.php"><img src="images/SamsungPhone.gif" alt="galaxy phone screen"/>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a href="http://www.wewillfixyouripad.co.uk/samsungtabletrepair.php"><img src="images/SamsungTablet.gif" alt="samsung tablet repair"/></center></div>

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

      <a href="contactus.php"><img src="upload/images/rightpanel/no_appointment.gif" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/fast_repair2.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/free_delivery.gif" alt="" class="right" style="margin-top:25px;"/></a>

<?php } } ?>
  </div>
</div>





<?php
### Getting Quote for this Page
$quote = $db->select("SELECT * FROM tbl_feedback WHERE status='1' AND id='2' LIMIT 0,1");
if (!empty($quote)) {


?>
<div class="quote">
  <div class="maindiv">
    <div class="quoteimg"> <img src="upload/images/feedback/<?=$quote[0]['image']?>" alt="computer shop"/> </div>
    <div class="quotetext"> <span><img src="images/quote.jpg" alt="laptop screen repair"/></span> <?=stripslashes($quote[0]['title'])?><span><img src="images/quoteb.jpg" alt="pc repair"/></span> </div>
  </div>
</div>
<?php }
####
?>
<?php include_once("includes/footer.php");?>