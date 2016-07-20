
		
		<div class="container">
		<div class="panel panel-info">	
		<div class="panel-body">
			<h4></h4>
		  <hr/>
		<?php
			
			if(isset($status)):    
                //echo '<div class="row">';
						echo '<div class="alert alert-warning">';
							echo '<b>'.$status.'.</b> '.$msg;
						echo '<a href="#" class="close">&times;</a></div>';
				//echo '</div>';
				
				
				
			endif;
            
			
			?>
			
		</div>
		</div>
		</div>
		  
		  