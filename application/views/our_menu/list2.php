
	
	<div class="row">		
		<div class="col-sm-12 col-md-12 main-content">
		
			<div class="page-header text-center">
			  <h1><?php echo $title;?></h1>
			</div>
			
			<div class="row middle-content">		
				<div id="owl-menu" >
				
				<?php 
				foreach($menu as $row){
				
				$photo = base_url($row->photo);
				
				if (@getimagesize(base_url($row->photo_thumb))) {
						$thumb = base_url($row->photo_thumb);
				} else {
						$thumb = $photo;
				}
				
				echo '<div class="item">';
					echo '<a href="#" class="main-menu">';
						echo '<img src="'.$thumb.'" alt="'.$row->name.'" class="img-rounded">';
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
	
