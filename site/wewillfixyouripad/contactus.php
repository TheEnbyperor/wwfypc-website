<?php 
include_once ("includes/includes.inc.php");
$mtp_id = 5;
$con = "S"; 
include_once("includes/header.php");
?>

<div class="whead2"><font color="ff7b00">Great Tech Support</font> is only a phone call away</div>
<div class="maindiv">
  <div class="cleft">

    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:29px;">By Phone :</div>
    <div class="whead" style="color:#8b0000; margin-top:11px;"><a href="tel:02920766039" >02920 766039</a></div>
    <div class="whead" style="color:#8b0000; margin-top:11px;"><a href="tel:07999056096" >07999 056096</a></div>

    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:29px;">By Post or Visit :</div>
    <div class="whead" style="color:#494949; margin-top:11px; font-size:21px;">39 Lambourne Crescent<br/>Cardiff Business Park<br/>Llanishen<br/>Cardiff<br/>CF14 5GG</div></div>

  <div class="cleft">

    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:34px;">By Email :<br/>
    <a href="mailto:neil@wewillfixyourpc.co.uk">neil@wewillfixyourpc.co.uk</a></div>

    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:14px;">Opening Hours :<br/></div>
    <div class="whead" style="color:#494949; margin-top:11px; font-size:16px;">Mon to Fri : 9.00am to 5.30pm<br/>Saturday : 10.30am to 2.30pm</div>

    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:14px;">Public Transport :<br/></div>
    <div class="whead" style="color:#494949; margin-top:11px; font-size:16px;">By Bus : 28 (Jump off at Leisure Center)<br/>By Train : Ty-Glas Station (10mins walk)</div>

    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:14px;"><P><BR>Location Map :<br/>
</div>

<p>&nbsp;<BR>
</div>
</div>



<a href="https://www.google.co.uk/maps/place/We+Will+Fix+Your+iPad/@51.5240224,-3.19228,349m/data=!3m2!1e3!4b1!4m5!3m4!1s0x486e1c7820dc2ee3:0x82c5cc5bc9f2af98!8m2!3d51.5240207!4d-3.1911813?hl=en" target="_blank"><img src="images/our_map.jpg" alt="laptop screen repair"></a>



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
      <a href="Virus_Removal.php"><img src="upload/images/rightpanel/virus_malware.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/credit_cards.jpg" alt="" class="right" style="margin-top:25px;"/></a>
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