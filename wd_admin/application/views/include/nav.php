		<?php
			$uri = $this->uri->segment(1);
		?>
			
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			  <div class="container">
			  
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="<?php echo base_url();?>">Admin - waroengdjoglo.com</a>
				</div>
				
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  
				  
				  <ul class="nav navbar-nav navbar-right">
					
					<!--
					<li class="<?php if($uri=='iklan') echo 'active';?>">
					  <a href="<?php echo base_url('iklan');?>" >Iklan</a>
					</li>
					-->
					
					<li class="dropdown <?php if($uri=='tentang_wd') echo 'active';?>">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tentang WD <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<!--<li role="presentation" class="dropdown-header">Foto Utama</li>-->
						<li><a href="<?php echo base_url('tentang_wd/slideshow');?>">Foto Utama</a></li>
						<li><a href="<?php echo base_url('tentang_wd/our_story');?>">Our Story</a></li>
						<li><a href="<?php echo base_url('tentang_wd/info_wd');?>">Info WD</a></li>
						<!--<li class="divider"></li>-->
						
					  </ul>
					</li>
					
					
					<li <?php echo ($uri == 'branch') ? 'class="active"' : '' ;?>>
						<a href="<?php echo base_url('branch');?>"><!--<span class="glyphicon glyphicon-picture"></span>--> Branch</a>
					</li>
					
					
					<li class="dropdown <?php if($uri=='our_menu') echo 'active';?>">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Our Menu <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<!--<li role="presentation" class="dropdown-header">Foto Utama</li>-->
						<li><a href="<?php echo base_url('our_menu/menu_type');?>">Jenis Menu</a></li>
						<li><a href="<?php echo base_url('our_menu/menu');?>">Daftar Menu</a></li>
						<!--<li class="divider"></li>-->
						
					  </ul>
					</li>
					
					
					<li <?php echo ($uri == 'gallery') ? 'class="active"' : '' ;?>>
						<a href="<?php echo base_url('gallery');?>"><!--<span class="glyphicon glyphicon-picture"></span>--> Gallery</a>
					</li>
					
					
					
					
					<!--<li class="dropdown <?php if($uri=='user') echo 'active';?>">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url('user');?>">Users</a></li>
						<li><a href="<?php echo base_url('user_group');?>">Kelompok User</a></li>
					  </ul>
					</li>-->
					
					<li class="dropdown blue">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('uName');?> <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url('user/ganti_password');?>" >Ganti Password <span class="glyphicon glyphicon-cog"></span></a></li>
						<li><a href="<?php echo base_url('../');?>" target="_blank">Lihat Website <span class="glyphicon glyphicon-eye-open"></span></a></li>
						<li><a href="<?php echo base_url('user/logout');?>">Logout</a></li>
					  </ul>
					</li>
					
				  </ul>
				  
				</div><!-- /.navbar-collapse -->
			  </div>
			</nav>
			
	<div class="container" id="body-content">
	
		
		<?php
		if(isset($title)) {
		echo '<div class="page-header">';
			echo '<div class="container">';
				echo '<h1>'.$title.'</h1>';
			echo '</div>';
		echo '</div>';
		}
		
		if(isset($breadcrumbs)) {
		echo '<ol class="breadcrumb">';
				echo $breadcrumbs;
		echo '</ol>';
		}
		?>