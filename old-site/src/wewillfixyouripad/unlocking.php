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

if(isset($_POST) && (isset($_POST['unlocking_form']) == 1))
{
        $txtName	= trim($_POST['name']);
	    $txtEmail	= trim($_POST['email']);
	    $imei		= trim($_POST['imei']);
	    $network	= trim($_POST['network']);
	    $model		= trim($_POST['model']);


		$message = $message;
		$subject="Unlocking request";
		$semail = 'Neil <neil@wewillfixyourpc.co.uk>';

		$bcc = 'wewillfixyourpc@gmail.com';
		$cc = 'neil@cardifftec.co.uk';		// for testing again using cc and bcc
		$values = " Name: '$txtName' <br> Email Address: '$txtEmail' <br> Phone model: '$model' <br> Network: '$network' <br> IMEI: '$imei'";
		$message = "Thank you. Your Request has been sent. We will be in touch shortly with your quote. If urgent, then please call us now on 02920 766039.";

		$to = "neil@wewillfixyourpc.co.uk,wewillfixyourpc@gmail.com";
		$body = $values;


		$headers = "MIME-Version: 1.0\n" ;
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
        $headers .= "X-Priority: 1 (Highest)\n";
        $headers .= "X-MSMail-Priority: High\n";
        $headers .= "Importance: High\n";

		// Additional headers
		$headers .= 'From: '.$txtName." <noreply@noreply.wewillfixyourpc.co.uk>\r\n";
		$headers .= 'Reply-to: '. $txtEmail."\r\n";
		$headers .= 'Cc: '.$cc. "\r\n";       // just comment this line if you dont want to use it
		$headers .= 'Bcc: '.$cc . "\r\n";    // just comment this line if you dont want to use it

		// Mail it
		mail($to, $subject, $body, $headers);
}
?>

<h1>Phone unlocking</h1>
<p>Input the details of the phone you want unlocked here and someone will be in touch to arrange payment.</p>
<p><?=$message?></p>
<hr>
<form action="" method="post">
<input type="hidden" name="unlocking_form" id="unlocking_form" value="1" />
  <table>
    <tbody>
      <tr>
        <td>
          <label for="model">Phone model</label>
        </td>
        <td>
          <select name="model" id="model" required>
            <option value="iPhone">iPhone</option>
            <option value="iPad">iPad</option>
            <option value="Samsung">Samsung</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>
          <label for="network">Network the phone is currently locked to</label>
        </td>
        <td>
          <select name="network" id="network" required>
            <option value="O2">O2</option>
            <option value="EE">EE</option>
            <option value="Three">Three</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>
          <label for="imei">Phone IMEI</label>
          <br>
          <small>You can find your IMEI by dialing *#06#</small>
        </td>
        <td>
          <input type="text" name="imei" id="imei" maxlength="15" minlength="15" size="15" required></input>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <hr>
        </td>
    </tr>
      <tr>
        <td>
          <label for="name">Your name</label>
        </td>
        <td>
          <input type="text" name="name" id="name" required></input>
        </td>
      </tr>
      <tr>
        <td>
          <label for="email">Your email</label>
        </td>
        <td>
          <input type="email" name="email" id="email" required></input>
        </td>
      </tr>
    </tbody>
</table>
  <button type="submit">
    Submit
  </button>
</form>


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
