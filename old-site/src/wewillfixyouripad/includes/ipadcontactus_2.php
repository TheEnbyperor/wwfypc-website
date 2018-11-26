<?php 
include_once ("includes/includes.inc.php");
$mtp_id = 0;
$con = "S"; 
include_once("includes/new_header.php");
?>

<div class="whead2"> Great </div>
<div class="whead2" style="color:#ff7b00;"> Tech Support </div>
<div class="whead2" style="font-size:18px;"> is only a phone call away </div>
<div class="maindiv">
  <div class="cleft">
    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:29px;"> By Phone : </div>
    <div class="whead" style="color:#8b0000; margin-top:11px;"> 02920 758299 </div>
    <div class="whead" style="color:#8b0000; margin-top:11px;"> 07999 056096 </div>
    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:42px;"> By Email :<br/>
      <a href="mailto:neil@willfixyourpc.co.uk">neil@willfixyourpc.co.uk</a> </div>
  </div>
  <div class="cleft">
    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:29px;"> By Post or Visit : </div>
    <div class="whead" style="color:#494949; margin-top:11px; font-size:20px;"> 2 Tatham Road<br/>
      Llanishen<br/>
      Cardiff<br/>
      CF14 5FB<br/>
    </div>
    <div class="whead2" style="font-size:22px; color:#3990bd; margin-top:14px;"> Location Map : <BR><a href="http://www.wewillfixyourpc.co.uk/Directions to We WILL Fix Your PC.pdf" target="_blank">Download Directions</a></div>
  </div>
</div>
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  var geocoder;
  var map;
  var infowindow = new google.maps.InfoWindow();
  var marker;
  var markersArray = [];
  
  
    function initialize(chk) {
	
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(35.906571224623576,14.449424743652344);
    var myOptions = {
      zoom: 14,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("Googlemap"), myOptions);
	if(chk == 1)
	{
	  document.getElementById("MainImage1").style.display = "block";
	  document.getElementById("Googlemap").style.display = "none";
	}
  }


    $(document).ready(function() {
        // put all your jQuery goodness in here.
 		adAddress1 = document.getElementById("map_action").value;
		codeAddress(adAddress1);		
    });

	
  
  
   function codeAddress(address) {
    initialize();
    if (geocoder) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
          var marker = new google.maps.Marker({
              map: map, 
              position: results[0].geometry.location
          });
		  
		  	 infowindow.setContent(results[0].formatted_address);
             infowindow.open(map, marker);
        } else {
          //alert("Geocode was not successful for the following reason: " + status);
        }
      });
    }
  }


function clearOverlays() 
  { 
  	if (markersArray) {
  	  for (i in markersArray) {
		markersArray[i].setMap(null);
    }
  }
}
</script>
<input type="hidden" value="2 Tatham Road Llanishen Cardiff CF14 5FB" name="map_action" id="map_action" />
<div class="maindiv" style="margin-top:70px; width:702px;color:#000; height:370px;float:left; border:1px solid #CCC" id="Googlemap"></div>
</div>
<div class="rightpanel">
	  <?php include_once("includes/contact.php"); ?>
        <?php
		### Getting rightpanel image for this Page
		$rightpanel_image = $db->select("SELECT * FROM tbl_rightpanel_images WHERE status='1' AND id IN (14,15,16,17) ORDER BY id ASC LIMIT 0,4");
		if($rightpanel_image)
			
		{
			$_total = count($rightpanel_image);
			for($i=0; $i<$_total; $i++){
		####
		?>
      <a href="appointment.php"><img src="upload/images/rightpanel/<?=$rightpanel_image[$i]['image']?>" alt="" class="right" style="margin-top:25px;"/></a> <?php } } ?>
  </div>
</div>
<?php
### Getting Quote for this Page
$quote = $db->select("SELECT * FROM tbl_feedback WHERE status='1' AND id='5' LIMIT 0,1");
if (!empty($quote)) {


?>
<div class="quote">
  <div class="maindiv">
    <div class="quoteimg"> <img src="upload/images/feedback/<?=$quote[0]['image']?>" alt=""/> </div>
    <div class="quotetext"> <span><img src="images/quote.jpg" alt=""/></span> <?=stripslashes($quote[0]['title'])?><span><img src="images/quoteb.jpg" alt=""/></span> </div>
  </div>
</div>
<?php }
####
?>
<?php include_once("includes/footer.php");?>