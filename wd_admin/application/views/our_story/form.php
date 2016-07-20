		
		<div class="col-sm-12">
			
			
			<?php 
			if(isset($our_story->status)) $status = $our_story->status;
			else $status = '1';
			
			if(isset($our_story)) echo '<h4>Edit Data</h4>';
			else echo '<h4>Tambah Foto</h4>';
			
			?>
			
			<hr/>
			<form class="form-horizontal" name="add_form" id="add_form" method="POST" onsubmit="submitForm(this);return false">
				
						
						  
						   <div class="form-group">
							<label for="story" class="col-sm-2 control-label">Story</label>
							<div class="col-sm-8">
								<?php
								$data = array(
									'name'	=> 'story',
									'id'	=> 'story',
									'class'	=> 'form-control',
									'rows'	=> '10',
									'cols' => '20'
									);
								
								if(isset($our_story->story)) $data['value']	= $our_story->story;
								
								echo form_textarea($data);
								?>
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
					if(isset($our_story->id)) $url = 'our_story/edit_our_story/'.$our_story->id;
					else $url = 'our_story/add_our_story';
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