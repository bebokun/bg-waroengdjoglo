			<div class="row text-center">
				<br/>
				<h4>Branch</h4>
			</div>
			<hr/>
			
			<div id="owl-branch" class="owl-carousel">
				<?php
					$branch = $this->db->get_where('branch', array('status !=' => 0))->result();
					foreach($branch as $row){
						//echo $row->id;
						?>
						<div class="item"> 
							<a href="<?php echo base_url('branch/'.str_replace(' ', '_', strtolower($row->name)));?>" class="thumbnail">
							<?php echo '<img src="'.base_url($row->image).'" alt="'.$row->name.'"> <div class="caption">'.$row->name.'</div>';?>
							</a>
						</div>
					<?php	
					}
				?>
				
				
				<!--
				<div class="item"> 
					<a href="#" class="thumbnail">
					<img src="<?php echo base_url('assets/img/gallery-3.jpg');?>" alt="..."> <div class="caption">WD Kapencar</div>
					</a>
				</div>
				<div class="item"> 
					<a href="#" class="thumbnail">
					<img src="<?php echo base_url('assets/img/gallery-4.jpg');?>" alt="..."> <div class="caption">WD Ndalem Kanoman</div>
					</a>
				</div>
				<div class="item"> 
					<a href="#" class="thumbnail">
					<img src="<?php echo base_url('assets/img/gallery-7.jpg');?>" alt="..."> <div class="caption">WD Ndalan Kidul</div>
					</a>
				</div>
				<div class="item"> 
					<a href="#" class="thumbnail">
					<img src="<?php echo base_url('assets/img/gallery-9.jpg');?>" alt="..."> <div class="caption">WD Nggunung Lawu</div>
					</a>
				</div>
				<div class="item"> 
					<a href="#" class="thumbnail">
					<img src="<?php echo base_url('assets/img/gallery-10.jpg');?>" alt="..."> <div class="caption">Bakar-bakar by WD</div>
					</a>
				</div>
				-->
				
			</div>