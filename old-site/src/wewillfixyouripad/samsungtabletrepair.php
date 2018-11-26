<?php 
//include_once ("includes/includes.inc.php");
//$mtp_id = 12;
//$con = "S"; 
//include_once("includes/header.php");
?>
<?php 
include_once ("includes/includes.inc.php");
$mtp_id = 113;
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


<p>&nbsp;<BR>



<table border="0" bordercolor="#FFFFFF" style="background-color:#FFFFFF" width="100%" cellpadding="0" cellspacing="0">

<tr><td>


&nbsp;
<font size="3"><B>Samsung Galaxy<BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tab</B></font><p><BR></p>
<img src="images/GalaxyTab.jpg" alt="Samsung Galaxy Tab screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Numbers :</b><BR>
&nbsp;GT-P6200 | GT-P7300<BR>
&nbsp;GT-P7500<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed touch screen : &pound;60<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;

<font size="3"><B>Samsung Galaxy<BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tab 2</B></font><p><BR></p>
<img src="images/GalaxyTab2.jpg" alt="Samsung Galaxy Tab 2 screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Numbers :</b><BR>
&nbsp;GT-P3100 | GT-P5100<P>

<p>&nbsp;<BR>
<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed touch screen : &pound;60<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;

<font size="3"><B>Samsung Galaxy<BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tab 3</B></font><p><BR></p>
<img src="images/GalaxyTab3.jpg" alt="Samsung Galaxy Tab 3 screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Numbers :</b><BR>
&nbsp;SM-T110 | SM-T210<BR>
&nbsp;SM-T310 | GT-P5200<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed touch screen : &pound;60<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td></tr><tr><td>

&nbsp;

<font size="3"><B>Samsung Galaxy<BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tab 4</B></font><p><BR></p>
<img src="images/GalaxyTab4.jpg" alt="Samsung Galaxy Tab 4 screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Numbers :</b><BR>
&nbsp;SM-T230 | SM-T330<BR>
&nbsp;SM-T530<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed touch screen : &pound;60<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;

<font size="3"><B>Samsung Galaxy<BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tab PRO</B></font><p><BR></p>
<img src="images/GalaxyTabPRO.jpg" alt="Samsung Galaxy Tab PRO screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Numbers :</b><BR>
&nbsp;SM-T320<P>

<p>&nbsp;<BR>
<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed touch screen : &pound;60<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;

<font size="3"><B>Samsung Galaxy<BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Note</B></font><p><BR></p>
<img src="images/GalaxyNote.jpg" alt="galaxy note screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Numbers :</b><BR>
&nbsp;GT-N5110 | GT-N8000<BR>
&nbsp;SM-P600<P>

<p>&nbsp;<BR>
<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed touch screen : &pound;80<P></font>

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

      <a href="contactus.php"><img src="upload/images/rightpanel/no_appointment.gif" alt="samsung tablet repair" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/repaired_today.gif" alt="tablet screen cardiff" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/we_fix_mac.jpg" alt="galaxy tab screen" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/credit_card1.gif" alt="galaxy repair cardiff" class="right" style="margin-top:25px;"/></a>
      <a href="http://www.wewillfixyourpc.co.uk"><img src="upload/images/rightpanel/laptop_repair.jpg" alt="galaxy tab repair" class="right" style="margin-top:25px;"/></a>
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
