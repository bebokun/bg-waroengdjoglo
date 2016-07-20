	
	<div class="row" id="div_button">
		<div class="col-sm-12 text-right">
			<a href="javascript:change_top_content('slideshow/form')" class="btn btn-primary">Tambah Foto <small class="glyphicon glyphicon-plus"></small></a>
		</div>
	</div>
	
	<div class="row div_loader" id="div_loader1">
		<div class="container">
			<img src="<?php echo base_url('assets/img/ajax-loader.gif');?>" alt="mohon tunggu..">
		</div>
	</div>
	
	<div id="div_form">
		
	</div>
	
			
	<hr/>
	
	<div id="ajaxResult"></div>
	
	<div id="list_table">
	</div>
	
	
	<script>
	$(document).ready(function(){
		get_datatable('slideshow/get_datatable');
	});
	
	
	
	</script>