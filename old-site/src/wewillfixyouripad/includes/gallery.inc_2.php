<?php 
$rsGalleryImages = $db->select("SELECT * FROM tbl_gallery_images ORDER BY bnr_id LIMIT 4");

if(!empty($rsGalleryImages)) {
	$_totalImages = count($rsGalleryImages);
?>
	<div class="maindiv" style="margin-top:20px;" id="gallery">
	  <?php for($i=0; $i<$_totalImages; $i++) {?>
	  <div class="panel" <?php if($i==0){echo 'style="margin-right:12px;"';}if($i==1){echo 'style="margin-right:13px;"';}elseif($i==2){echo 'style="margin-right:13px;"';}elseif($i==3){echo 'style="margin-right:0px;"';}?>>
		<div class="pimg"> <a href="upload/images/gallery_images/large/<?=$rsGalleryImages[$i]['bnr_img']?>" title="<?=$rsGalleryImages[$i]['bnr_title']?>" class="xyz"><img src="upload/images/gallery_images/thumb/<?=$rsGalleryImages[$i]['bnr_img']?>" alt="<?=$rsGalleryImages[$i]['bnr_title']?>" title="<?=$rsGalleryImages[$i]['bnr_title']?>"/></a> </div>
		<div class="ptext"> <?=$rsGalleryImages[$i]['bnr_title']?> </div>
	  </div>
	  <?php }?>
	</div>

<?php }?>