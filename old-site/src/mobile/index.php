<?php
	session_start();
	if($_SESSION['msg'])
	{
		$message	=	$_SESSION['msg'];
		unset($_SESSION['msg']);	
		$fullMsg = '<div class="box3">
						<div class="indent" style="background:#FFFFFF;">
							<ul class="list">
								<li>'.$message.'</h5></li>
							</ul>
						</div>
					</div>';
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
            <?php echo $fullMsg; unset($fullMsg); ?>
			<div class="box3">
				<div class="indent" style="background:#FFFFFF;">
					<ul class="list">
						<li><a href="services.php">Our Services</a><h5>Find out about us and what we do.</h5></li>
					</ul>
				</div>
			</div>
            <div class="box3">
				<div class="corner-left-bottom">
					<div class="indent" style="background:#FFFFFF;">
						<ul class="list">
							<li><a href="whyChooseUs.php">Why choose us</a><h5>See how we go the extra mile.</h5></li>
						</ul>
					</div>
				</div>
			</div>
            <div class="box3">
				<div class="corner-left-bottom">
					<div class="indent" style="background:#FFFFFF;">
						<ul class="list">
							<li><a href="price.php">Price Guide</a><h5>Competitive, affordable and simple.</h5></li>
						</ul>
					</div>
				</div>
			</div>
            <div class="box3">
				<div class="corner-left-bottom">
					<div class="indent" style="background:#FFFFFF;">
						<ul class="list">
							<li><a href="contactUs.php">Contact us</a><h5>Where are we based?</h5></li>
						</ul>
					</div>
				</div>
			</div>
            <div class="box3">
				<div class="corner-left-bottom">
					<div class="indent" style="background:#FFFFFF;">
						<ul class="list">
							<li><a href="http://www.wewillfixyourpc.co.uk/index_fullsite.php" target="_blank">Full desktop website</a><br /><h5>Go to our full website.</h5></li>
						</ul>
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