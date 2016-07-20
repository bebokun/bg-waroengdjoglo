
	
	<div class="row">		
		<div class="col-sm-12 col-md-12 main-content">
		
			<div class="page-header text-center">
			  <h1>Our Menu</h1>
			</div>
			
			<div class="row vertical-center">		
				
				<?php
				foreach($menu_type as $row) {
				?>
				<div class="col-sm-12 col-md-6">
					<a href="<?php echo base_url('our_menu/'.str_replace(' ', '_', strtolower($row->name)));?>" class="main-menu">
						<img src="<?php echo base_url($row->image).'" alt="'.$row->name;?>" class="img-circle">
						<div class="caption">
							<h4><?php echo $row->name;?></h4>
						</div>
					</a>
				</div>
				<?php
				}
				?>
				
				<!--<div class="col-sm-12 col-md-6">
					<a href="<?php echo base_url('our_menu/minuman');?>" class="main-menu">
						<img src="<?php echo base_url('assets/img/gallery-3.jpg');?>" alt="makanan" class="img-circle">
						<div class="caption">
							<h4>Minuman</h4>
						</div>
					</a>
				</div>
				
				<div class="col-sm-12 col-md-4">
					<a href="#" class="main-menu">
						<img src="<?php echo base_url('assets/img/gallery-7.jpg');?>" alt="makanan" class="img-circle">
						<div class="caption">
							Khas Tiap Cabang
						</div>
					</a>
				</div>-->
				
			</div>
			
			
			
			
		</div>
		
	</div>
	
