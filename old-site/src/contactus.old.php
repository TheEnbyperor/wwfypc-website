<?php 
include_once ("includes/includes.inc.php");
$mtp_id = 5;
$con = "S"; 
include_once("includes/header.php");
?>

<div class="whead2"><font color="ff7b00">Great Tech Support</font> is only a phone call away</div>
<div class="maindiv">
  <div class="cleft">

    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:29px;"> By Phone : </div>
    <div class="whead" style="color:#8b0000; margin-top:11px;"><a href="tel:02920758299" >02920 758299</a></div>
    <div class="whead" style="color:#8b0000; margin-top:11px;"><a href="tel:07999056096" >07999 056096</a></div>

    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:34px;"> By Email :<br/>
    <a href="mailto:neil@willfixyourpc.co.uk">neil@willfixyourpc.co.uk</a></div></div>

  <div class="cleft">

    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:29px;"> By Post or Visit : </div>
    <div class="whead" style="color:#494949; margin-top:11px; font-size:20px;"> 2 Tatham Road<br/>Llanishen<br/>Cardiff<br/>CF14 5FB<br/></div>

    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:14px;"> Location Map : <br/>
    <a href="http://www.wewillfixyourpc.co.uk/Directions to We WILL Fix Your PC.pdf" target="_blank">Download Directions</a></div>
<p>&nbsp;<BR>
</div>
</div>



<a href="https://maps.google.co.uk/maps?q=we+will+fix+your+pc&hl=en&ll=51.523825,-3.198287&spn=0.004036,0.008256&sll=51.50355,-3.19823&sspn=0.01142,0.033023&t=h&z=18&iwloc=A" target="_blank"><img src="images/our_map.jpg" alt="laptop screen repair"></a>



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


      <a href="appointment.php"><img src="upload/images/rightpanel/book_your_repair.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="laptop_screen_replacement_cardiff.php"><img src="upload/images/rightpanel/laptop_screen2.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="Laptop_Power_Connector_DC_Jack.php"><img src="upload/images/rightpanel/dc_jack.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="Lost_Data_Recovered.php"><img src="upload/images/rightpanel/file_recover.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="Replacement_Hard_Drive.php"><img src="upload/images/rightpanel/hard_drive.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="Virus_Removal.php"><img src="upload/images/rightpanel/virus_malware.jpg" alt="" class="right" style="margin-top:25px;"/></a>

 <?php } } ?>
  </div>
</div>
<?php
### Getting Quote for this Page
$quote = $db->select("SELECT * FROM tbl_feedback WHERE status='1' AND id='5' LIMIT 0,1");
if (!empty($quote)) {


?>
<div class="quote">
  <div class="maindiv">
    <div class="quoteimg"> <img src="upload/images/feedback/<?=$quote[0]['image']?>" alt="computer repair"/> </div>
    <div class="quotetext"> <span><img src="images/quote.jpg" alt="laptop repair"/></span> <?=stripslashes($quote[0]['title'])?><span><img src="images/quoteb.jpg" alt="pc repair"/></span> </div>
  </div>
</div>
<?php }
####
?>
<?php include_once("includes/footer.php");?>