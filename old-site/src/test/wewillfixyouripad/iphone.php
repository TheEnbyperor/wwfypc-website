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

&nbsp;&nbsp;&nbsp;

<font size="3"><B>iPhone 4 or 4s</B></font><p><BR></p>
<img src="images/iPhone4.jpg" alt="iphone 4 screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Numbers :</b><BR>
&nbsp;A1332 | A1349<BR>
&nbsp;A1387 | A1431<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;50<BR>
&nbsp;Charging Dock / Jack : &pound;30<BR>
&nbsp;Power / Home button : &pound;30<BR>
&nbsp;Speaker / Ear Piece : &pound;30<BR>
&nbsp;Battery : &pound;20<BR><P></font>

<p>&nbsp;<BR>

&nbsp;<b>Repair Time :<BR></b>
&nbsp;1 hour<P></font>

</td><td>

<BR><P><BR><P><BR><P><BR>

<font size="3"><B>iPhone 5 or 5c or 5s</B></font><p><BR></p>
<img src="images/iPhone5.jpg" alt="iphone 5 screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Numbers :</b><BR>
&nbsp;A1428 | A1429 | A1442<BR>
&nbsp;A1456 | A1507 | A1516<BR>
&nbsp;A1526 | A1529 | A1532<BR>
&nbsp;A1453 | A1457 | A1518<BR>
&nbsp;A1528 | A1530 | A1533<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen : &pound;70<BR>
&nbsp;Charging Dock / Jack : &pound;40<BR>
&nbsp;Power / Home button : &pound;40<BR>
&nbsp;Speaker / Ear Piece : &pound;40<BR>
&nbsp;Battery : &pound;20<BR><P></font>

<p>&nbsp;<BR>

&nbsp;<b>Repair Time :<BR></b>
&nbsp;10 minutes<P></font>

</td><td>
<BR><P><BR>

<font size="3"><B>iPhone 6 or 6 plus</B></font><p><BR></p>
<img src="images/iPhone6.jpg" alt="iphone 6 screen repair"><BR>

<p>&nbsp;<BR>

&nbsp;<font size="2"><b>Model Numbers :</b><BR>
&nbsp;iPhone 6 &nbsp;&nbsp;| A1549 | A1586<BR>
&nbsp;iPhone 6 plus | A1522 | A1524<P>

<p>&nbsp;<BR>

&nbsp;<b>Repairs Available :<BR></b>
&nbsp;Smashed screen (iPhone 6) : &pound;80<BR>
&nbsp;Charging Dock / Jack (iPhone 6) : &pound;40<BR>
&nbsp;Smashed screen (iPhone 6 plus) : &pound;110<BR>
&nbsp;Smashed screen (iPhone 6S) : &pound;220<BR>
&nbsp;Smashed screen (iPhone 6S plus) : &pound;275<P></font>

<p>&nbsp;<BR>

&nbsp;<b>Repair Time :<BR></b>
&nbsp;10 minutes<P></font>

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
