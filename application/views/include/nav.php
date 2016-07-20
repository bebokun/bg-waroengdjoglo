
<?php 
$uri = $this->uri->segment(1);
//$this->load->model("wd_model", "wd");
?>
		
		<br/><div class="logo-text">
			<!--<h1>Waroeng Djoglo</h1>-->
			<img alt="Logo WD" width="130px" src="<?php if($info_wd) echo base_url($info_wd->logo_url);?>">
			<p>bersih, nyaman, berkelas</p>
		</div>

	
	
<div class="container">
	
<div class="header-bg"></div>


	
	<nav class="navbar navbar-inverse " role="navigation">
			 
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
				
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				   
				  
				  <ul class="nav navbar-nav nav-justified">
					
					<li <?php echo ($uri == '') ? 'class="active"' : '' ;?>>
						<a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-home"></span> Home</a>
					</li>
					<li <?php echo ($uri == 'our_story') ? 'class="active"' : '' ;?>>
						<a href="<?php echo base_url('our_story');?>"><i class="fa fa-history"></i> Our Story</a>
					</li>
					
					<li class="dropdown <?php echo ($uri == 'our_menu') ? 'active' : '' ;?>">
					  <a href="<?php echo base_url('our_menu');?>" class="dropdown-toggle disabled" data-toggle="dropdown"><span class="glyphicon glyphicon-cutlery"></span> Our Menu <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
					  <?php
						$menu_type = $this->db->get_where('menu_type', array('status !=' => 0))->result();
						$i = 0;
						foreach($menu_type as $row){
							echo '<li><a href="'.base_url('our_menu/'.str_replace(' ', '_', strtolower($row->name))).'">'.$row->name.'</a></li>';
						}
						?>
						
						<li class="dropdown-submenu">
							<a tabindex="-1" href="#">Khas Tiap Cabang</a>
							
							<ul class="dropdown-menu">
								<?php
								$branch = $this->db->get_where('branch', array('status !=' => 0))->result();
								$i = 0;
								foreach($branch as $row){
									echo '<li><a ';
										echo ($i==0) ? 'tabindex="-1"' : ''; 
									echo 'href="'.base_url('branch/'.str_replace(' ', '_', strtolower($row->name))).'">'.$row->name.'</a></li>';
									$i++;
								}
								?>
							</ul>
						  </li>
					  </ul>
					</li>
					
					<li <?php echo ($uri == 'gallery') ? 'class="active"' : '' ;?>>
						<a href="<?php echo base_url('gallery');?>"><span class="glyphicon glyphicon-picture"></span> Gallery</a>
					</li>
					
					<li class="dropdown <?php echo ($uri == 'branch') ? 'active' : '' ;?>">
						<a href="<?php echo base_url('branch');?>" class="dropdown-toggle disabled" data-toggle="dropdown"><span class="glyphicon glyphicon-cutlery"></span> Branch <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<?php
							$i = 0;
							foreach($branch as $row){
								echo '<li><a href="'.base_url('branch/'.str_replace(' ', '_', strtolower($row->name))).'">'.$row->name.'</a></li>';
								$i++;
							}
						?>
					  </ul>
					</li>
					
					<!--
					<li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-envelope"></span> Contact</a></li>
					-->
					
				  </ul>
				  
				</div>  
				  
			</nav>
	
		<div class="main-container">
		<?php
		/* if(isset($title)) {
		echo '<div class="page-header ">';
			echo '<div class="container">';
				echo '<h1>'.$title.'</h1>';
			echo '</div>';
		echo '</div>';
		}
		
		if(isset($breadcrumbs)) {
		echo '<ol class="breadcrumb">';
				echo $breadcrumbs;
		echo '</ol>';
		} */
		?>