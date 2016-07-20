
<div class="image_preview" id="<?php echo $url;?>" >

<?php 
	
	echo $status;
	
?>

	<img src="<?php echo base_url('../'.$url_thumb);?>" class="img-rounded" style="height:100%; width: auto;"><br/>
	<a role="button" class="btn btn-sm" onClick="rmv_photo('<?php echo $url;?>')">[ Hapus Gambar ]</a>
	<input type="hidden" name="image" value="<?php echo $url;?>">
	<input type="hidden" name="image_thumb" value="<?php echo $url_thumb;?>">
	
</div>
