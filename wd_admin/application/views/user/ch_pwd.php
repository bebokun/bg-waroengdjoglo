		
		<div class="col-sm-12">
			
			
			<?php 
			
			echo '<h4>'.$title.'</h4>';
			
						if(isset($status)):    
							echo '<div class="row">';
								echo '<div class="col-sm-8 col-md-6 columns ">';
									echo '<div data-alert class="alert-success">';
										echo '<b>'.$status.'.</b> '.$msg;
									echo '<a href="#" class="close">&times;</a></div>';
								echo '</div>';
							echo '</div>';
								
						endif;
			
			?>
			
			<hr/>
			<form class="form-horizontal" name="chpwd_form" id="chpwd_form" method="POST" action="<?php echo base_url('user/ganti_password');?>">
					
						
						
						<div class="form-group">
							<label for="old_pwd" class="col-sm-2 control-label">Password Lama</label>
							<div class="col-md-5">
							  <input type="password" class="form-control" name="old_pwd" id="old_pwd" placeholder="masukan password lama"> 
							</div>
						  </div>
						
						<hr/>
						
						
						<div class="form-group">
							<label for="pwd" class="col-sm-2 control-label">Password Baru</label>
							<div class="col-md-5">
							  <input type="password" class="form-control" name="pwd" id="pwd" placeholder="masukan password baru"> 
							</div>
						</div>
						
						<div class="form-group">
							<label for="cpwd" class="col-sm-2 control-label">Konfirmasi Password Baru</label>
							<div class="col-md-5">
							  <input type="password" class="form-control" name="cpwd" id="cpwd" placeholder="masukan kembali password baru"> 
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
		
		