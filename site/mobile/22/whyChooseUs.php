<?php
include("db_connection.php");

$query=mysql_query("SELECT *FROM content WHERE id='2'");

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
					
					<div class="indent" style="text-align:center; background:#FFFFFF;" >
						<font color="#e46c0a" >Why choose us</font>
						
					</div>
				</div>
			</div>
            <div class="box3">
				<div class="corner-left-bottom">
					
					<div class="indent" style="font-size:14px; color:#000; background:#FFFFFF;">
						<!--<p><strong>We have over 15 years of experience serving residential and small businesses. We offer a fast friendly service with:</strong>  </p>
                        <div id="circle">
                        <ul style="margin-top:20px;">
                        <li>Lowest price guarantee.</li>
                        <li>No Fix - No Fee.</li>
                        <li>FREE diagnostics.</li>
                        <li>Quick 24 hour repair turnaround on most services.</li>
                        <li>Specific appointment times to fit around your availability.</li>
                        <li>Longer working hours.</li>
                        <li>90 day guarantee / warranty.</li>
                        <li>FREE collection and delivery.</li>
                        <li>FREE Courtesy laptop available.</li>
                        <li>Local personalised service.</li>
                        <li>We will buy your old laptop for parts!</li>
                        </ul>
						</div>
                        <p><strong>Give us try, Call us now! </strong> </p> -->
                        <?php echo $text;?>
					</div>
				</div>
			</div>
            <div class="box3">
				<div class="corner-left-bottom">
					
					<div class="indent" style="text-align:center; background:#FFFFFF;" >
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