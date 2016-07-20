		
		<div class="col-sm-12">
			
			
			<?php 
			if(isset($gallery->status)) $status = $gallery->status;
			else $status = '1';
			
			if(isset($gallery)) echo '<h4>Edit Data</h4>';
			else echo '<h4>Tambah Foto</h4>';
			
			?>
			
			<hr/>
			<form class="form-horizontal" name="add_form" id="add_form" method="POST" onsubmit="submitForm(this);return false">
				
						
						
						<div class="form-group">
								
								<label class="col-sm-2 control-label">Foto</label>
									
									<div id="upload-frame" class=" col-sm-4" >
										<div class="progress" id="progress">
											<div id="meter" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 0%; display:none;">
											</div>
										</div>
										
										<span class="btn btn-default btn-file btn-file-upload">Cari foto<input id="browse" type="file" name="browse" onchange="ajaxFileUpload('gallery');" multiple></span>
										
										<div id="preview" style="height:180px;">
										
											<?php if(isset($gallery->url) && ($gallery->url))
											{
												echo '<div id="'.$gallery->url.'" class="image_preview">';
													echo '<img src="'.base_url('../'.$gallery->url).'" class="img-rounded" style="height:100%; width: auto;"><br/>';
													echo '<a role="button" class="btn btn-sm" onClick="rmv_photo(\''.$gallery->url.'\')">[ Hapus Gambar ]</a>';
													echo form_hidden('image', $gallery->url);
													echo form_hidden('image_thumb', $gallery->thumb_url);
												echo '</div>';
											} 
											?>
											
										</div>
									</div>
								
						  </div>
						
						
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Nama</label>
							<div class="col-md-5">
							  <input type="text" class="form-control" name="name" id="name" value="<?php echo (isset($gallery->name)) ? $gallery->name : '';?>" placeholder="masukan nama gallery"> 
							</div>
						  </div>
						
						<!--
						<div class="form-group">
							<label for="info" class="col-sm-2 control-label">Info</label>
							<div class="col-md-5">
							  <input type="text" class="form-control" name="info" id="info" value="<?php echo (isset($gallery->info)) ? $gallery->info : '';?>" placeholder="masukan informasi gallery"> 
							</div>
						  </div>
						-->
						
						<div class="form-group">
							<label for="status" class="col-sm-2 control-label">Status *</label>
							<div class="col-sm-6">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-info <?php echo ($status == 1) ? 'active' : '';?>">
											<input type="radio" name="status" id="1" value="1" <?php echo ($status == 1) ? 'checked' : '';?>>Aktif
									</label>
									<label class="btn btn-info <?php echo ($status == 0) ? 'active' : '';?>">
											<input type="radio" name="status" id="0" value="0" <?php echo ($status == 0) ? 'checked' : '';?>>Tidak Aktif
									</label>
									<!--<label class="btn btn-info <?php echo ($status == 100) ? 'active' : '';?>">
											<input type="radio" name="status" id="100" value="100" <?php echo ($status == 100) ? 'checked' : '';?>>Default
									</label>-->
								</div>
							</div>
						  </div>
						
						<hr/>
						
				  <div class="form-group">
					<div class="col-sm-offset-2 col-sm-6">
						<button type="button" onclick="javasript:$('#div_form').hide()" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary" id="emailSubmit">Kirim</button>
					</div>
				  </div>
			  
			  </form>
			  
			  
		</div>
		
		<script>
		$(document).ready( function(){
			$('#div_form').show()
		});
		

		function submitForm(form){
			$.ajax({
				type: 'POST',
					<?php 
					if(isset($gallery->id)) $url = 'gallery/edit_gallery/'.$gallery->id;
					else $url = 'gallery/add_gallery';
					?>
				url: '<?php echo base_url($url);?>',
				data: $('#add_form').serialize(),
				success: function(data){
					$('#ajaxResult').html(data);
					$("#ajaxResult").find("script").each(function(i) {
							eval($(this).text());
						});
				}
			})
		}
		
		</script>