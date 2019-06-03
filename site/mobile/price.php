<?php
include("db_connection.php");

$query=mysql_query("SELECT *FROM content WHERE id='3'");

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
					<div id="phone-div" class="indent" >
						<a href="tel:02920766039">02920 766039</a><br /><br />
						<a href="tel:07999056096">07999 056096 </a>
					</div>
				</div>
			</div>
			
			<div class="box3">
				<div class="corner-left-bottom">
					
					<div class="indent" style="text-align:center; background:#FFFFFF;" >
						<font color="#e46c0a" >Price guide</font>
						
					</div>
				</div>
			</div>
<div id="full"><!--Start full -->
       <!--start database --> 
       <?php echo $text;?>
            
            <!--end of database --> 
</div><!--End of full -->
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
						
							<h5 style="font-size:12px;">&copy; 2018 wewillfixyourpc.co.uk. All Rights Reserved.</h5>
							
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
</body>
</html>