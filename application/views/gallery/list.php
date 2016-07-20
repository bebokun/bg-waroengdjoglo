
	
	<div class="row">		
		<div class="col-sm-12 col-md-12 main-content">
		
			<div class="page-header text-center">
			  <h1><?php echo $title;?></h1>
			</div>
			
			<div class="row middle-content">		
				<div id="owl-menu" >
				
				<?php 
				foreach($gallery as $row){
				
				$photo = base_url($row->url);
				
				if (@getimagesize(base_url($row->thumb_url))) {
						$thumb = base_url($row->thumb_url);
				} else {
						$thumb = $photo;
				}
				
				echo '<div class="item">';
					echo '<a href="'.$photo.'" class="main-menu menu-gallery" title="'.$row->name.'">';
						echo '<img src="'.$thumb.'" alt="'.$row->name.'" class="img-rounded" >';
						echo '<div class="caption">';
							//echo '<h4>'.$row->name.'</h4>';
							//echo '<span class="label label-primary">Rp '.$row->price.'</span><br/>';
							//echo '<small>'.$row->info.'</small>';
						echo '</div>';
					echo '</a>';
				echo '</div>';
				
				}
				?>
				
				</div>
				
			</div>
			
			
			
			
		</div>
		
	</div>
	
