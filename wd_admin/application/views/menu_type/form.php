		
		<div class="col-sm-12">
			
			
			<?php 
			if(isset($menu_type->status)) $status = $menu_type->status;
			else $status = '1';
			
			if(isset($menu_type)) echo '<h4>Edit Data</h4>';
			else echo '<h4>Tambah Foto</h4>';
			
			?>
			
			<hr/>
			<form class="form-horizontal" name="add_form" id="add_form" method="POST" onsubmit="submitForm(this);return false">
				
						
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Nama</label>
							<div class="col-md-5">
							  <input type="text" class="form-control" name="name" id="name" value="<?php echo (isset($menu_type->name)) ? $menu_type->name : '';?>" placeholder="masukan nama jenis menu"> 
							</div>
						  </div>
						
						
						<div class="form-group">
								
								<label class="col-sm-2 control-label">Image</label>
									
									<div id="upload-frame" class=" col-sm-4" >
										<div class="progress" id="progress">
											<div id="meter" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 0%; display:none;">
											</div>
										</div>
										
										<span class="btn btn-default btn-file btn-file-upload">Cari gambar<input id="browse" type="file" name="browse" onchange="ajaxFileUpload('menu_type');" multiple></span>
										
										<div id="preview" style="height:180px;">
										
											<?php if(isset($menu_type->image) && ($menu_type->image))
											{
												echo '<div id="'.$menu_type->image.'" class="image_preview">';
													echo '<img src="'.base_url('../'.$menu_type->image).'" class="img-rounded" style="height:100%; width: auto;"><br/>';
													echo '<a role="button" class="btn btn-sm" onClick="rmv_photo(\''.$menu_type->image.'\')">[ Hapus Gambar ]</a>';
													echo form_hidden('image', $menu_type->image);
													//echo form_hidden('image_thumb', $menu_type->thumb_url);
												echo '</div>';
											} 
											?>
											
										</div>
									</div>
								
						  </div>
						
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
					if(isset($menu_type->id)) $url = 'menu_type/edit_menu_type/'.$menu_type->id;
					else $url = 'menu_type/add_menu_type';
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