<?php 
//include_once ("includes/includes.inc.php");
//$mtp_id = 11;
//$con = "S"; 
//include_once("includes/header.php");
?>
<?php 
include_once ("includes/includes.inc.php");
$mtp_id = 112;
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

<p>&nbsp;<BR>



<table border="0" bordercolor="#FFFFFF" style="background-color:#FFFFFF" width="100%" cellpadding="0" cellspacing="0">

<tr><td>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<font size="3"><B>Galaxy S II</B></font><p><BR></p>
<img src="images/SamsungGalaxySII.jpg" alt="Samsung Galaxy S II screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Number :</b><BR>
&nbsp;GT-i9100<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;70<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;&nbsp;

<font size="3"><B>Galaxy S III mini</B></font><p><BR></p>
<img src="images/SamsungGalaxySIIImini.jpg" alt="Samsung Galaxy S III mini screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Number :</b><BR>
&nbsp;GT-i8190<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;70<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<font size="3"><B>Galaxy S III</B></font><p><BR></p>
<img src="images/SamsungGalaxySIII.jpg" alt="Samsung Galaxy S III screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Number :</b><BR>
&nbsp;GT-i9300<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;100<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td></tr><tr><td>

&nbsp;&nbsp;

<font size="3"><B>Galaxy S 4 mini</B></font><p><BR></p>
<img src="images/SamsungGalaxyS4Mini.jpg" alt="Samsung Galaxy S 4 Mini screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Number :</b><BR>
&nbsp;GT-i9190<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;100<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<font size="3"><B>Galaxy S 4</B></font><p><BR></p>
<img src="images/SamsungGalaxyS4.jpg" alt="Samsung Galaxy S 4 screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Number :</b><BR>
&nbsp;GT-i9500<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;100<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;&nbsp;&nbsp;

<font size="3"><B>Galaxy S 5 mini</B></font><p><BR></p>
<img src="images/SamsungGalaxyS5.jpg" alt="Samsung Galaxy S5 mini screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Number :</b><BR>
&nbsp;SM-G800F<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;130<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td></tr><tr><td>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<font size="3"><B>Galaxy S 5</B></font><p><BR></p>
<img src="images/SamsungGalaxyS5.jpg" alt="Samsung Galaxy S5 screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Number :</b><BR>
&nbsp;SM-G900F<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;140<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<font size="3"><B>Galaxy S 6</B></font><p><BR></p>
<img src="images/SamsungGalaxyS5.jpg" alt="Samsung Galaxy S6 screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Number :</b><BR>
&nbsp;SM-G920F<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;150<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;

<font size="3"><B>Galaxy S 6 Edge</B></font><p><BR></p>
<img src="images/SamsungGalaxyS5.jpg" alt="Samsung Galaxy S6 edge screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Number :</b><BR>
&nbsp;SM-G925F<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;180<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td></tr><tr><td>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<font size="3"><B>Galaxy Note</B></font><p><BR></p>
<img src="images/SamsungGalaxyNote.jpg" alt="Samsung Galaxy Note screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Number :</b><BR>
&nbsp;GT-N7000<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;110<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;&nbsp;&nbsp;&nbsp;

<font size="3"><B>Galaxy Note II</B></font><p><BR></p>
<img src="images/SamsungGalaxyNoteII.jpg" alt="Samsung Galaxy Note II screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Number :</b><BR>
&nbsp;GT-N7100<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;140<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;&nbsp;&nbsp;&nbsp;

<font size="3"><B>Galaxy Note 3</B></font><p><BR></p>
<img src="images/SamsungGalaxyNote3.jpg" alt="Samsung Galaxy Note 3 screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Number :</b><BR>
&nbsp;SM-N9000<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;170<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

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

      <a href="contactus.php"><img src="upload/images/rightpanel/no_appointment.gif" alt="galaxy s4" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/repaired_today.gif" alt="galaxy screen" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/cardiff_iphone_repair.gif" alt="galaxy repair cardiff" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/credit_card1.gif" alt="samsung repair" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/free_delivery.gif" alt="samsung screen" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/we_are_local.jpg" alt="tablet repair cardiff" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/fast_repair1.gif" alt="galaxy digitizer" class="right" style="margin-top:25px;"/></a>
	  <a href="contactus.php"><img src="upload/images/rightpanel/90_day_warranty.jpg" alt="new ipad screen" class="right" style="margin-top:25px;"/></a>
	  <a href="contactus.php"><img src="upload/images/rightpanel/call_us_today.jpg" alt="" class="right" style="margin-top:25px;"/></a>
	  <a href="http://www.wewillfixyourpc.co.uk/laptop_screen_replacement_cardiff.php"><img src="upload/images/rightpanel/laptop_screen2.jpg" alt="ipad digitizer" class="right" style="margin-top:25px;"/></a>
      <a href="http://www.wewillfixyourpc.co.uk"><img src="upload/images/rightpanel/laptop_repair.jpg" alt="ipad mini repair" class="right" style="margin-top:25px;"/></a>

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
