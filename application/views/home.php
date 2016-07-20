	
	<!--
	<div class="row">		
		<div class="col-sm-12" style="border-bottom: 1px solid #ddd;">
			<br/>
			<div class="well text-center">
				<h3>Selamat Datang di Waroeng Djoglo</h3>
			</div>
		</div>
	</div>
	-->
	
	<div class="row">		
		<div class="col-sm-12 col-md-8 main-content">
			
			<div id="carousel-home" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
				<?php
					$c = 0;
					foreach($carousel as $row){
						echo '<li data-target="#carousel-home" data-slide-to="'.$c.'" ';
							echo ($c == 0)? 'class="active"' : '';
						echo '></li>';
						$c++;
					}
				?>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner">
				
				<?php
					$c = 0;
					foreach($carousel as $row){
						echo '<div class="item ';
							echo ($c == 0) ? ' active' : '' ; 
							echo '">';
							echo '<img src="'.base_url($row->url).'" alt="'.$row->teks.'">';
							echo '<div class="carousel-caption">';
							echo '<h3>'.$row->teks.'</h3>';
							echo '</div>';
						echo '</div>';
						$c++;
					}
				?>
				
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-home" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			  </a>
			  <a class="right carousel-control" href="#carousel-home" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			  </a>
			</div>
			
		</div>
		
		<div class="col-sm-12 col-md-4 right-content">
			
			<?php $this->load->view('branch_col'); ?>
			
		</div>
		
	</div>
	
