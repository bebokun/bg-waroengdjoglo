
<!-- Footer -->
	  
</div>

	  <div id="footer"  >
		<div class="col-sm-12" style="background: #354b60; color: #999; padding: 20px">
		  
			<div class="row">
				<p class="text-center">&copy; 2014 <a href="#">Waroeng Djoglo</a>, </p>
			</div>
			
		</div> 
	  </div>
	
	<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/dataTables.bootstrap.js')?>"></script>
	<script src="<?php echo base_url('assets/js/xhr2.js')?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.chained.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/canvasjs.min.js')?>"></script>
	
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('.dataTable').dataTable();
		} );
		
		
		/* Admin JS */
		
			function get_datatable(url){
				var loader = '<div colspan="100%" class="div_loader"><img src="<?php echo base_url('assets/img/ajax-loader.gif');?>" alt="mohon tunggu.."></div>';
				$("#list_table").html(loader);
					$.ajax({
						url : '<?php echo base_url();?>'+url,
						success: function(data){
							$("#list_table").html(data);
							$("#list_table").find("script").each(function(i) {
										eval($(this).text());
									});
						}
					})
					
			}
			
			function change_top_content(url){
				//alert(url);
				$('#div_loader1').show();
				$.ajax({
					url : '<?php echo base_url();?>'+url,
					success: function(data){
						$('#div_loader1').hide();
						$("#div_form").html(data);
						$("#div_form").find("script").each(function(i) {
									eval($(this).text());
								});
						// scroll animation
						$('html,body').animate({
						  scrollTop: $("#div_form").offset().top - 50
						});
					}
				})
			}
			
			// hapus data
			function delete_row(id, uri){
				var btn = $('#delete'+id)
				btn.button('loading')
				var r=confirm("Apakah Anda yakin untuk menghapus data ini?");
				if (r==true)
				{
					$.ajax({
						url : '<?php echo base_url();?>'+uri+'/delete/'+id,
						success: function(data){
							$('#ajaxResult').html(data);
							get_datatable(uri+'/get_datatable');
						}
					})
				} else {
					btn.button('reset')
				}
			}
			
			
			
		function ajaxFileUpload(type)
		{
			$("#meter").width('0%');
			//ajax
							$("#browse").upload("<?php echo site_url('upload/upload_foto');?>/" +type, {
							}, 
							
							function(success){
								document.getElementById("preview").innerHTML = success; 
								$("#preview").find("script").each(function(i) {
									eval($(this).text());
								});
							}, 
							
							function(prog, value){
								$("#meter").show();
								$("#meter").width(value+'%');
								$("#meter").html(value+'%');
							});
			return false;
		}
		
		/* Admin JS End*/
		
		
		
		
		// hapus foto
		function rmv_photo(div){
			var r=confirm("Apakah Anda yakin untuk menghapus foto ini?");
            if (r==true)
            {
				var div = div;
				var divX = document.getElementById(div);
				divX.parentNode.removeChild(divX);
			}
		}
		
		$(window).bind("load", function () {
			var footer = $("#footer");
			var pos = footer.position();
			var height = $(window).height();
			height = height - pos.top + 90;
			//height = height - footer.height() - 100;
			
			if (height > 0) {
				footer.css({
					'margin-top': height + 'px'
				});
			}
		});
		
		function checkAll(cboxClass, status) {
			var cbox = document.getElementsByClassName(cboxClass);
				
					for (i = 0; i < cbox.length; i++)
					{
						cbox[i].checked = status;
					}
		}
	</script>
	
</body>
</html>
