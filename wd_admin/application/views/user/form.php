		
		<div class="col-sm-12">
			
			
			<?php 
			if(isset($user->status)) $status = $user->status;
			else $status = 1;
			if(isset($user->group_id)) $group_id = $user->group_id;
			else $group_id = '';
			
			if(isset($user)) echo '<h4>Edit Data</h4>';
			else echo '<h4>Tambah Data</h4>';
			
			?>
			
			<hr/>
			<form class="form-horizontal" name="add_form" id="add_form" method="POST" onsubmit="submitForm(this);return false">
				
						  <div class="form-group">
							<label for="username" class="col-sm-2 control-label">Username</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" name="username" id="username" value="<?php echo (isset($user->username)) ? $user->username : '';?>"> 
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="password" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-4">
							  <input type="password" class="form-control" name="password" id="password" value="" <?php echo (isset($user->password)) ? 'placeholder="diisi jika ingin diganti"' : '';?>> 
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="passconf" class="col-sm-2 control-label">Konfirmasi Password</label>
							<div class="col-sm-4">
							  <input type="password" class="form-control" name="passconf" id="passconf" value="" > 
							</div>
						  </div>
						  
						  
						  <div class="form-group">
							<label for="fullname" class="col-sm-2 control-label">Nama Lengkap</label>
							<div class="col-sm-6">
							  <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo (isset($user->fullname)) ? $user->fullname : '';?>"> 
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="email" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-3">
							  <input type="text" class="form-control" name="email" id="email" value="<?php echo (isset($user->email)) ? $user->email : '';?>" placeholder="contoh@email.com"> 
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="group_id" class="col-sm-2 control-label">User Group</label>
							<div class="col-sm-4">
							  <select class="form-control" name="group_id" id="group_id">
								<option value="">-- Pilih User Group --</option>
								<?php
								foreach($user_group as $row){
									echo '<option value="'.$row->id.'" ';
										if($group_id==$row->id) echo 'selected';
									echo '>'.$row->name.'</option>';
								}
								?>
							  </select>
							</div>
						  </div>
						  
						   <div class="form-group">
								
								
									<label class="col-sm-2 control-label">Foto</label>
									
									<div id="upload-frame" class=" col-sm-4" >
										<div class="progress" id="progress">
											<div id="meter" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 0%; display:none;">
											</div>
										</div>
										
										<span class="btn btn-default btn-file btn-file-upload">Cari gambar<input id="browse" type="file" name="browse" onchange="ajaxFileUpload();" multiple></span>
										
										<div id="preview" style="height:150px;">
										
											<?php if(isset($user->image) && ($user->image))
											{
												echo '<div id="'.$user->image.'" class="image_preview">';
													echo '<img src="'.base_url('../'.$user->image).'" class="img-rounded" style="height:100%; width: auto;"><br/>';
													echo '<a role="button" class="btn btn-sm" onClick="rmv_photo(\''.$user->image.'\')">[ Hapus Gambar ]</a>';
													echo form_hidden('image', $user->photo);
													echo form_hidden('image_thumb', $user->photo_thumb);
												echo '</div>';
											} 
											?>
											
										</div>
									</div>
								
						  </div>
						  
						  
						  <div class="form-group">
							<label for="description" class="col-sm-2 control-label">Deskripsi User</label>
							<div class="col-sm-4">
								<?php
								$data = array(
									'name'	=> 'description',
									'id'	=> 'description',
									'class'	=> 'form-control',
									'rows'	=> '5'
									);
								
								if(isset($user->description)) $data['value']	= $user->description;
								
								echo form_textarea($data);
								?>
							</div>
						  </div>
					
							
						  <div class="form-group">
							<label for="phone" class="col-sm-2 control-label">Telepon</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" name="phone" id="phone" value="<?php echo (isset($user->phone)) ? $user->phone : '';?>" placeholder="cth : 081801xxxxxx"> 
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="pin_bb" class="col-sm-2 control-label">Pin BB</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" name="pin_bb" id="pin_bb" value="<?php echo (isset($user->pin_bb)) ? $user->pin_bb : '';?>" > 
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="facebook" class="col-sm-2 control-label">Facebook</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo (isset($user->facebook)) ? $user->facebook : '';?>" placeholder="cth : https://www.facebook.com/username"> 
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="twitter" class="col-sm-2 control-label">Twitter</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo (isset($user->twitter)) ? $user->twitter : '';?>" placeholder="cth : https://www.twitter.com/username"> 
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="gplus" class="col-sm-2 control-label">Google +</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" name="gplus" id="gplus" value="<?php echo (isset($user->gplus)) ? $user->gplus : '';?>" placeholder="cth : https://plus.google.com/u/0/1"> 
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
									<label class="btn btn-info <?php echo ($status == 100) ? 'active' : '';?>">
											<input type="radio" name="status" id="100" value="100" <?php echo ($status == 100) ? 'checked' : '';?>>Default
									</label>
								</div>
							</div>
						  </div>
						
						
						<hr/>
						
				  <div class="form-group">
					<div class="col-sm-offset-2 col-sm-6">
						<button type="button" onclick="javasript:$('#div_form').hide()" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary" id="formSubmit">Kirim</button>
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
					if(isset($user->id)) $url = 'user/edit_user/'.$user->id;
					else $url = 'user/add_user';
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