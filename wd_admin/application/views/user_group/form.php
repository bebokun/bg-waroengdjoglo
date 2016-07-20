		
		<div class="col-sm-12">
			
			
			<?php 
			if(isset($user_group->status)) $status = $user_group->status;
			else $status = 1;
			if(isset($user_group->group_id)) $group_id = $user_group->group_id;
			else $group_id = '';
			
			if(isset($user_group)) echo '<h4>Edit Data</h4>';
			else echo '<h4>Tambah Data</h4>';
			
			?>
			
			<hr/>
			<form class="form-horizontal" name="add_form" id="add_form" method="POST" onsubmit="submitForm(this);return false">
				
						  <div class="form-group">
							<label for="name" class="col-sm-2 control-label">Nama User Group</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" name="name" id="name" value="<?php echo (isset($user_group->name)) ? $user_group->name : '';?>"> 
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
					if(isset($user_group->id)) $url = 'user_group/edit_user_group/'.$user_group->id;
					else $url = 'user_group/add_user_group';
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