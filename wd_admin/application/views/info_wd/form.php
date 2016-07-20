		
		<div class="col-sm-12">
			
			
			<?php 
			if(isset($info_wd->status)) $status = $info_wd->status;
			else $status = '1';
			
			if(isset($info_wd)) echo '<h4>Edit Data</h4>';
			else echo '<h4>Tambah Foto</h4>';
			
			?>
			
			<hr/>
			<form class="form-horizontal" name="add_form" id="add_form" method="POST" onsubmit="submitForm(this);return false">
				
						
						<div class="form-group">
								
								<label class="col-sm-2 control-label">Logo</label>
									
									<div id="upload-frame" class=" col-sm-4" >
										<div class="progress" id="progress">
											<div id="meter" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 0%; display:none;">
											</div>
										</div>
										
										<span class="btn btn-default btn-file btn-file-upload">Cari gambar<input id="browse" type="file" name="browse" onchange="ajaxFileUpload('info_wd');" multiple></span>
										
										<div id="preview" style="height:180px;">
										
											<?php if(isset($info_wd->logo_url) && ($info_wd->logo_url))
											{
												echo '<div id="'.$info_wd->logo_url.'" class="image_preview">';
													echo '<img src="'.base_url('../'.$info_wd->logo_url).'" class="img-rounded" style="height:100%; width: auto;"><br/>';
													echo '<a role="button" class="btn btn-sm" onClick="rmv_photo(\''.$info_wd->logo_url.'\')">[ Hapus Gambar ]</a>';
													echo form_hidden('image', $info_wd->logo_url);
													//echo form_hidden('image_thumb', $info_wd->thumb_url);
												echo '</div>';
											} 
											?>
											
										</div>
									</div>
								
						  </div>
						
						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">Email</label>
							<div class="col-md-5">
							  <input type="text" class="form-control" name="email" id="email" value="<?php echo (isset($info_wd->email)) ? $info_wd->email : '';?>" placeholder="masukan email WD"> 
							</div>
						  </div>
						
						<div class="form-group">
							<label for="facebook" class="col-sm-2 control-label">Facebook</label>
							<div class="col-md-6">
								<div class="input-group">
								  <span class="input-group-addon">www.facebook.com/</span>
								  <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo (isset($info_wd->facebook)) ? $info_wd->facebook : '';?>" placeholder="masukan username facebook WD"> 
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
					if(isset($info_wd->id)) $url = 'info_wd/edit_info_wd/'.$info_wd->id;
					else $url = 'info_wd/add_info_wd';
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