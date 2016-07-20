
	<!-- Footer -->


		<div class="col-sm-12" id="footer" style="">
		  
			<div class="row">
				<div class="col-sm-6">
					<span class="glyphicon glyphicon-copyright-mark"></span> 2014 <a href="#">Waroeng Djoglo</a>
				</div>
				<div class="col-sm-6 text-right">
					<div class="btn-group open">
						<a class="" target="_blank" href="http://www.facebook.com/<?php if($info_wd) echo $info_wd->facebook;?>" >
							<span class="fa-stack fa-md">
							  <i class="fa fa-square-o fa-stack-2x"></i>
							  <i class="fa fa-facebook fa-stack-1x"></i>
							</span> Facebook
						</a>
					</div>
				</div>
			</div>
			
		</div> 
		
	
	</div>
	</div>

	<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/owl.carousel.js')?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.magnific-popup.min.js')?>"></script>
	<!--<script src="<?php echo base_url('assets/js/xhr2.js')?>"></script>-->
	
	<script>
	
		
		$(document).ready(function() {
		 
		  $("#owl-branch").owlCarousel({
			items : 2,
			itemsDesktop : [1199,2],
			itemsDesktopSmall : [979,2],
			itemsMobile : [479,2],
			navigation: true,
			lazyLoad : true,
			autoPlay : 2500
		  });
		  
		  $("#owl-menu").owlCarousel({
			items : 8,
			itemsDesktop : [1199,6],
			itemsDesktopSmall : [979,6],
			itemsMobile : [479,2],
			navigation: true,
			lazyLoad : true,
			autoPlay : true,
			autoPlay : 2500
		  });
		  
			$('.menu-gallery').magnificPopup({
				type:'image',
				gallery:{
					enabled:true
				}});
			});
		
		$(window).bind("load", function () {
			var footer = $("#footer");
			var pos = footer.position();
			var height = $(window).height();
			height = height - pos.top + 50;
			height = height - footer.height() - 30;
			
			if (height > 0) {
				footer.css({
					//'margin-top': height + 'px'
				});
			}
		});
		
		
	</script>
	
</body>
</html>
