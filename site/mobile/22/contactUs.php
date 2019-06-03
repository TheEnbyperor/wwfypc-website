<?php
include("db_connection.php");

$query=mysql_query("SELECT *FROM content WHERE id='4'");

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
						<font color="#e46c0a" >Contact us</font>
						
					</div>
				</div>
			</div>
            <div class="box3">
				<div class="corner-left-bottom">
					
				  <div class="indent" style="font-size:14px; color:#000; background:#FFFFFF;">
				<!--		<strong style="color:#3890bd; font-size:14px;"> By Phone</strong> <br />
    		<strong style="color:#990000;"> 02920 758299 </strong> <br /> <br /> <strong style="color:#990000;">07999 056096 </strong> <br /><br />
            <strong style="color:#3890bd; font-size:14px;" >By Email:</strong> <br />
            <strong style="color:#0066cc; text-decoration:underline; font-size:14px;"><a href="mailto:neil@willfixyourpc.co.uk">neil@willfixyourpc.co.uk</a> </strong> <br /><br />
            
           <strong style="color:#3890bd; font-size:14px;"> By Post or Visit: </strong> <br />
            2 Tatham Road <br />
			Llanishen <br />
  	    Cardiff <br />
			CF14 5FB <br />			 -->	
            <?php echo $text;?>
            <img src="images/Map.jpg" width="244" />	
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