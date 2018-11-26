<?php 
//include_once ("includes/includes.inc.php");
//$mtp_id = 10;
//$con = "S"; 
//include_once("includes/header.php");
?>
<?php 
include_once ("includes/includes.inc.php");
$mtp_id = 111;
$choose = "S"; 
include_once("includes/header.php");
## Get Page Content ##
$rsPage = $db->select("SELECT * FROM tbl_pages WHERE pageId='111' LIMIT 1");
#print_arr ($rsPage); die();
if (!empty($rsPage)) {
	$page_content		= $rsPage[0];
} else {
    $errorMessage = "Page not exist. Please try later";
}

#####
?>
<?=stripcslashes($page_content['pageText'])?>


<p>&nbsp;<BR><p>&nbsp;<BR>



<table border="0" bordercolor="#FFFFFF" style="background-color:#FFFFFF" width="100%" cellpadding="0" cellspacing="0">

<tr><td>




<font size="3"><b>iPad 2, 3, 4</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1395 | A1396 | A1397 | A1403 | A1416 | A1430 | A1458 | A1459 | A1460<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Reseat (Fuzzy screen) &nbsp;&nbsp;&nbsp; &pound;40.00<BR>
Home Button or small parts &nbsp;&nbsp;&nbsp; &pound;40.00<BR>
Digitiser (Top Glass) &nbsp;&nbsp;&nbsp; &pound;60.00<BR>
LCD Screen &nbsp;&nbsp;&nbsp; &pound;110.00<BR>
Battery (No Warranty / Will need to order part) &nbsp;&nbsp;&nbsp; &pound;70.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 6 hours</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPad Air 1</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1474 | A1475<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Home Button or small parts &nbsp;&nbsp;&nbsp; &pound;40.00<BR>
Digitiser (Top Glass) &nbsp;&nbsp;&nbsp; &pound;60.00<BR>
LCD Screen &nbsp;&nbsp;&nbsp; &pound;130.00<BR>
Charging Port &nbsp;&nbsp;&nbsp; &pound;60.00<BR>
Battery (No Warranty / Will need to order part) &nbsp;&nbsp;&nbsp; &pound;70.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 6 hours</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPad Air 2</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1566 | A1567<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
LCD Screen & Digitiser &nbsp;&nbsp;&nbsp; &pound;210.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 6 hours (we will need to order part)</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPad Mini 1, 2, 3</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1432 | A1454 | A1455 | A1489 | A1490 | A1491 | A1599 | A1600<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Home Button &nbsp;&nbsp;&nbsp; &pound;60.00<BR>
Digitiser (Top Glass) &nbsp;&nbsp;&nbsp; &pound;60.00<BR>
Charging Port &nbsp;&nbsp;&nbsp; &pound;60.00<BR>
Battery (No Warranty) &nbsp;&nbsp;&nbsp; &pound;70.00<BR>
iPad Mini 1 LCD Screen &nbsp;&nbsp;&nbsp; &pound;85.00<BR>
iPad Mini 2 / 3 LCD Screen &nbsp;&nbsp;&nbsp; &pound;100.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 6 hours</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPad Mini 4</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1538 | A1550<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
LCD Screen & Digitiser &nbsp;&nbsp;&nbsp; &pound;175.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 6 hours (we will need to order part)</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPad Pro 9.7 inch (2016)</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1673 | A1674 | 
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
LCD Screen & Digitiser &nbsp;&nbsp;&nbsp; &pound;175.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 6 hours (we will need to order part)</B><BR>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPad Pro 10.5 inch (2017)</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1701 | A1709<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
LCD Screen & Digitiser &nbsp;&nbsp;&nbsp; &pound;320.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 6 hours (we will need to order part)</B><BR>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPad Pro 12.9 inch (2015)</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1584 | A1652<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
LCD Screen & Digitiser &nbsp;&nbsp;&nbsp; &pound;320.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 6 hours (we will need to order part)</B><BR>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPad Pro 12.9 inch (2017)</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1670 | A1671<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
LCD Screen & Digitiser &nbsp;&nbsp;&nbsp; &pound;N/A<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 6 hours (we will need to order part)</B><BR>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPad 5</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1822 | A1823<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Home Button &nbsp;&nbsp;&nbsp; &pound;40.00<BR>
Digitiser (Top Glass) &nbsp;&nbsp;&nbsp; &pound;60.00<BR>
LCD Screen &nbsp;&nbsp;&nbsp; &pound;130.00<BR>
Charging Port &nbsp;&nbsp;&nbsp; &pound;60.00<BR>
Battery (No Warranty / Will need to order part) &nbsp;&nbsp;&nbsp; &pound;N/A<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 6 hours (we will need to order part)</B><BR>
<P>&nbsp;<P><font>



</td></tr></table>


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
      <a href="contactus.php"><img src="upload/images/rightpanel/we_are_local.jpg" alt="ipad 2 screen" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/fast_repair1.gif" alt="ipad digitizer" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/repaired_today.gif" alt="iphone screen repair" class="right" style="margin-top:25px;"/></a>
      <a href="appointment.php"><img src="upload/images/rightpanel/book_your_repair.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="laptop_screen_replacement_cardiff.php"><img src="upload/images/rightpanel/laptop_screen2.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="Laptop_Power_Connector_DC_Jack.php"><img src="upload/images/rightpanel/dc_jack.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="Lost_Data_Recovered.php"><img src="upload/images/rightpanel/file_recover.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="Virus_Removal.php"><img src="upload/images/rightpanel/virus_malware.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/credit_cards.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/call_us_today.jpg" alt="" class="right" style="margin-top:25px;"/></a>




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


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50569125-1', 'wewillfixyouripad.co.uk');
  ga('send', 'pageview');

</script>
