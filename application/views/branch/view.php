
	
	<div class="row">		
		<div class="col-sm-12 col-md-12 main-content">
		
			<div class="page-header text-center">
			  <h1><?php echo $title;?></h1>
			</div>
			
		<div class="row">		
			
			<div class="col-sm-12 text-center">
				
				  <img src="<?php echo base_url($branch->image);?>" alt="Selamat datang di Waroeng Djoglo!" style="max-height:500px;" class="img-thumbnail">
				  <br/>
				  
				  <img src="<?php echo base_url('assets/img/bottom-shape.png');?>" >
				  
			</div>
			
	</div>
			
			<br/>
			<br/>
			
			<?php
			if($menu) {
			?>
			<h3>Makanan Khas</h3>
			
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
					echo '<a href="'.$photo.'" class="main-menu menu-gallery" title="'.$row->name.'">';
						echo '<img src="'.$thumb.'" alt="'.$row->name.'" class="img-rounded">';
						echo '<div class="caption">';
							echo '<h4>'.$row->name.'</h4>';
						echo '</div>';
					echo '</a>';
				echo '</div>';
				
				}
				?>
				
				</div>
				
			</div>
			<?php
			}
			?>
			
			<?php
				if(!$menu) {
					echo "<hr/>";
				}
			?>
			
			<div class="row">
				<!-- <div class="col-sm-12 col-md-8 main-content"> -->
				<div class="col-sm-12 ">
				
				<h3>Alamat & Contact Person</h3>
				<hr/>
				
				<div class="well">
				<?php echo nl2br($branch->address);?>
				<hr/>
				<?php echo nl2br($branch->contact);?>
				</div>
				
				<!--
				
				<div class="col-sm-12 col-md-4 right-content">
			
				<h3>Peta (Gmap)</h3>
				<?php //echo $map['html']; ?>
			
				</div>
				</div>
				-->
				</div>
			</div>
			<br/>
			
			
		</div>
		
	</div>
	
