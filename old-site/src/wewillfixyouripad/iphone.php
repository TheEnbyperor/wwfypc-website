<?php 
//include_once ("includes/includes.inc.php");
//$mtp_id = 9;
//$con = "S"; 
//include_once("includes/header.php");
?>
<?php 
include_once ("includes/includes.inc.php");
$mtp_id = 110;
$choose = "S"; 
include_once("includes/header.php");
## Get Page Content ##
$rsPage = $db->select("SELECT * FROM tbl_pages WHERE pageId='110' LIMIT 1");
#print_arr ($rsPage); die();
if (!empty($rsPage)) {
	$page_content		= $rsPage[0];
} else {
    $errorMessage = "Page not exist. Please try later";
}

#####
?>
<?=stripcslashes($page_content['pageText'])?>


<table border="0" bordercolor="#FFFFFF" style="background-color:#FFFFFF" width="100%" cellpadding="0" cellspacing="0">

<tr><td>



<font size="3"><b>iPhone 4 / 4S</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1349 | A1332 | A1431 | A1387<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Smashed screen &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
Home Button or small parts &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
Charging Port &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
Battery (No Warranty) &nbsp;&nbsp;&nbsp; &pound;20.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 1 hour</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPhone 5 / 5c / 5s / SE</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1428 | A1429 | A1442 | A1456 | A1507 | A1516 | A1529 | A1532 | A1453<BR>
Model Numbers : A1457 | A1518 | A1528 | A1530 | A1533 | A1723 | A1662 | A1724<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Smashed screen &nbsp;&nbsp;&nbsp; &pound;40.00<BR>
Home Button or small parts &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
Charging Port &nbsp;&nbsp;&nbsp; &pound;40.00<BR>
Battery (No Warranty) &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 30 mins</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPhone 6</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1549 | A1586 | A1589<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Smashed screen &nbsp;&nbsp;&nbsp; &pound;45.00<BR>
Home Button or small parts &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
Charging Port &nbsp;&nbsp;&nbsp; &pound;40.00<BR>
Battery (No Warranty) &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 30 mins</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPhone 6 + Plus</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1522 | A1524 | A1593<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Smashed screen &nbsp;&nbsp;&nbsp; &pound;50.00<BR>
Home Button or small parts &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
Charging Port &nbsp;&nbsp;&nbsp; &pound;40.00<BR>
Battery (No Warranty) &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 30 mins</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPhone 6s</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1633 | A1688 | A1700<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Smashed screen &nbsp;&nbsp;&nbsp; &pound;60.00<BR>
Home Button or small parts &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
Charging Port &nbsp;&nbsp;&nbsp; &pound;40.00<BR>
Battery (No Warranty) &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 30 mins</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPhone 6s + Plus</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1634 | A1687 | A1699<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Smashed screen &nbsp;&nbsp;&nbsp; &pound;70.00<BR>
Home Button or small parts &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
Charging Port &nbsp;&nbsp;&nbsp; &pound;40.00<BR>
Battery (No Warranty) &nbsp;&nbsp;&nbsp; &pound;30.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 30 mins</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPhone 7</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1660 | A1778 | A1779<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Smashed screen &nbsp;&nbsp;&nbsp; &pound;85.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 1 hour</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPhone 7 + Plus</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1661 | A1784 | A1785<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Smashed screen &nbsp;&nbsp;&nbsp; &pound;100.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 1 hour</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPhone 8</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1863 | A1905 | A1906<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Smashed screen &nbsp;&nbsp;&nbsp; &pound;100.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 1 hour</B><BR></font>

<P>&nbsp;<P>
<P>&nbsp;<P>

<font size="3"><b>iPhone 8 + Plus</b><BR></font>
<P>&nbsp;<P>


<font size="2">Model Numbers : A1864 | A1897 | A1898<BR>
<P>&nbsp;<P>
<B>Repairs Available :</B><BR>
Smashed screen &nbsp;&nbsp;&nbsp; &pound;115.00<BR>
<P>&nbsp;<P>
<B>Repair Time : Approx. 1 hour</B><BR></font>





<P>&nbsp;<P><font>


</td></tr>
<BR><P><BR></table>









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
      <a href="contactus.php"><img src="upload/images/rightpanel/repaired_today.gif" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/we_are_local.jpg" alt="ipad 2 screen" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/fast_repair1.gif" alt="ipad digitizer" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/repaired_today.gif" alt="iphone screen repair" class="right" style="margin-top:25px;"/></a>
      <a href="laptop_screen_replacement_cardiff.php"><img src="upload/images/rightpanel/laptop_screen2.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="Laptop_Power_Connector_DC_Jack.php"><img src="upload/images/rightpanel/dc_jack.jpg" alt="" class="right" style="margin-top:25px;"/></a>
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
