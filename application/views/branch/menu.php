		
	<div class="row">		
		<div class="col-sm-12 col-md-12 main-content">
		
			<div class="page-header text-center">
			  <h1><?php echo $title;?></h1>
			</div>
			
			<div id="owl-branch-wide" class="row middle-content">
				<?php
				foreach($branch as $row){
					echo '<div class="col-xs-6 col-md-2"> ';
						echo '<a href="'.base_url('branch/'.str_replace(' ', '_', strtolower($row->name))).'" class="thumbnail">';
							echo '<img src="'.base_url($row->image).'" alt="'.$row->name.'"> ';
							echo '<div class="caption">'.$row->name.'</div>';
						echo '</a>';
					echo '</div>';
				}
				?>
			</div>
			
				
			
		</div>
		
	</div>
	