
	
	<div class="row">		
		<div class="col-sm-12 col-md-12 main-content">
		
			<div class="page-header text-center">
			  <h1><?php echo $title;?></h1>
			</div>
			
			<div class="row middle-content">		
				<div id="owl-menu" >
				
				<?php 
				foreach($menu as $row){
				
				echo '<div class="item">';
					echo '<a href="#" class="main-menu">';
						echo '<img src="'.base_url($row->photo).'" alt="'.$row->name.'" class="img-rounded">';
						echo '<div class="caption">';
							echo $row->name;
						echo '</div>';
					echo '</a>';
				echo '</div>';
				
				}
				?>
				
				</div>
				
			</div>
			
			
			
			
		</div>
		
	</div>
	
