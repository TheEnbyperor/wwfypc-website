<?php
include("db_connection.php");

$query=mysql_query("SELECT *FROM content WHERE id='1'");

while($row=mysql_fetch_array($query))
{
	$text=$row['text'];
}
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta http-equiv="cache-control" content="max-age=200" />
<link href="style.css" media="handheld, screen" rel="stylesheet" type="text/css" />
<title>Wewillfixyourpc</title>
<div class="mainwrapper" style="background:#FFFFFF;">
	
	<div id="content">
		<div class="min-width" style="background:#FFFFFF;">
		<div class="box3" style="border-top:1px solid #999; border-left: solid 1px #999999; border-right: 1px solid #999999;">
				<div class="corner-left-bottom" style="background:#FFFFFF;">
					
					<div class="indent" style="background:#FFFFFF; text-align:center;" >
						<img alt="" src="images/waplogo.jpg" />
						
					</div>
				</div>
			</div>
			
			<div class="box3" style="background:#e46c0a;">
				<div class="corner-left-bottom">
					
					<div class="indent" style="text-align:center; background:#e46c0a; color:#FFFFFF;" >
						<font color="#FFFFFF" >02920 758299&nbsp;&nbsp;&nbsp;&nbsp;07999 056096</font>
						
					</div>
				</div>
			</div>
			
			<div class="box3">
				<div class="corner-left-bottom">
					
					<div class="indent" style="text-align:center;" >
						<font color="#e46c0a" >Our Services</font>
						
					</div>
				</div>
			</div>
            <div class="box3">
				<div class="corner-left-bottom">
					
					<div class="indent" style="font-size:14px; color:#000;">
						<!--<p>We provide a wide range of computer services and support for residential and small business customers in the Cardiff and Caerphilly area. </p>
                        <p>We specialise in repairing computer desktops, laptops and netbooks.</p>
                        <div id="bullet">
                        <ul style="margin-top:20px;">
                        <li>We diagnose, repair, upgrade and rebuild all makes and models.</li>
                        <li>Carry out motherboard component level repairs, power socket replacements (DC Jacks) and laptop screen replacements at very competitive rates with a quick turnaround. </li>
                        <li>24 hour turnaround on virus removal, data recovery, software upgrades, including speeding up your slow pc or laptop.</li>
                        <li>Internet and network setup, parental controls, etc.</li>
                        </ul>
						</div>
                        <p><strong>Our Prices start from as low as £19.00. Click here for our <a href="price.php">price guide.</a></strong> </p> -->
                        <?php echo $text;?>
					</div>
				</div>
			</div>
            <div class="box3">
				<div class="corner-left-bottom">
					
					<div class="indent" style="text-align:center;" >
						<font color="#e46c0a" ><a href="index.php" style="text-decoration:none; color:#e46c0a;">Home</a></font>
						
					</div>
				</div>
			</div>
            
            
			<div class="box3" style="border-bottom:1px solid #999; border-left: solid 1px #999999; border-right: 1px solid #999999;">
				<div class="corner-left-bottom">
					
					<div class="indent" style="background:#FFFFFF;text-align:center;">
						
							<h5 style="font-size:12px;">&copy; 2012 wewillfixyourpc.co.uk. All Rights Reserved.</h5>
							
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
</body>
</html>