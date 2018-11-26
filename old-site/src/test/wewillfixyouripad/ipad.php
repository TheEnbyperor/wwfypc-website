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

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<font size="3"><B>iPad 2, 3 or 4</B></font><p><BR></p>
<img src="images/iPad2.jpg" alt="ipad 2 screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Numbers :</b><BR>
&nbsp;A1395 | A1396 | A1397<BR>
&nbsp;A1403 | A1416 | A1430<BR>
&nbsp;A1458 | A1459 | A1460<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Reseat, Dock, Lock or Home Button : &pound;50<BR>
&nbsp;Broken Digitiser (Top Glass) : &pound;70<BR>
&nbsp;Broken LCD screen : &pound;105<BR>
&nbsp;Broken Digitiser & LCD screen : &pound;110<P></font>

<p>&nbsp;<BR>

&nbsp;<b>Repair Time :<BR></b>
&nbsp;Approx. half a day<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>


<font size="3"><B>iPad Mini 1, 2 or 3</B></font><p><BR></p>
<img src="images/iPadmini.jpg" alt="ipad mini screen repair"><BR>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR><p>

&nbsp;<font size="2"><b>Model Numbers :</b><BR>
&nbsp;A1432 | A1454 | A1455<BR>
&nbsp;A1489 | A1490 | A1599<BR>
&nbsp;A1600<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Broken Digitiser (Top Glass) : &pound;80<BR>
&nbsp;Broken LCD screen : &pound;115<BR>
&nbsp;Broken Digitiser & LCD screen : &pound;120<P></font>

<p>&nbsp;<BR>

&nbsp;<b>Repair Time :<BR></b>
&nbsp;Approx. half a day<P></font>

<p>&nbsp;<BR><p>&nbsp;<BR><p>&nbsp;<BR>

</td><td>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<font size="3"><B>iPad Air</B></font><p><BR></p>
<img src="images/iPad5.jpg" alt="ipad 5 screen repair"><BR>

<p>&nbsp;<BR><p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Numbers :</b><BR>
&nbsp;A1474 | A1475<BR>
&nbsp;A1566 | A1567<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Broken Digitiser (Top Glass) (Air 1) : &pound;80<BR>
&nbsp;Broken LCD screen (Air 1) : &pound;115<BR>
&nbsp;Broken Digitiser & LCD screen (Air 1) : &pound;125<BR>
&nbsp;Broken Digitiser and / or LCD (Air 2) : &pound;275<P></font>

<p>&nbsp;<BR>

&nbsp;<b>Repair Time :<BR></b>
&nbsp;Approx. half a day<P></font>

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

      <a href="contactus.php"><img src="upload/images/rightpanel/no_appointment.gif" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/repaired_today.gif" alt="" class="right" style="margin-top:25px;"/></a>

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
