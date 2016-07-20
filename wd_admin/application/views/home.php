</div>

	<link href="<?php echo base_url('assets/css/cover.css')?>" rel="stylesheet">
	
 <div class="site-wrapper">

      <div class="site-wrapper-inner">
	  
		  
		  
		
        <div class="cover-container">

		  
          <div class="inner cover">
            <h1 class="cover-heading">Selamat Datang di Halaman Admin - www.waroengdjoglo.com</h1>
           
		  </div>
		  
		  
				
			
          <div class="row">
			<div class="col-sm-12" >
				<!--<div id="chartdiv" style="height:400px;width:100%; "></div>
				<div id="chart"></div>-->
				<div id="chartContainer" style="height: 300px; width: 100%;">
	</div>
			</div>
		  </div>

	  

        </div>

      </div>

    </div>
	
	<script>
	
		window.onload = function () {
				var chart = new CanvasJS.Chart("chartContainer",
				{

					title:{
						text: "Grafik Jumlah Iklan (daily)",
						fontSize: 20
					},
					axisX:{

						gridColor: "Silver",
						tickColor: "silver",
						valueFormatString: "DD/MMM",
						interval:1,
						intervalType: "day",
						labelAngle: -80

					},                        
								toolTip:{
								  shared:true
								},
					theme: "theme2",
					axisY: {
						gridColor: "Silver",
						tickColor: "silver"
					},
					legend:{
						verticalAlign: "center",
						horizontalAlign: "right"
					},
					data: [
					        
						<?php
							foreach($cat as $row){
								echo '{';
									echo 'type: "line",';
									echo 'showInLegend: true,';
									echo 'lineThickness: 2,';
									echo 'name: "'.$row->name.'",';
									//echo 'markerType: "square",';
									//echo 'color: "#F08080",';
									echo 'dataPoints: [';
									foreach($ads[$row->name] as $row2) {
										echo '{ x: new Date('.date('Y,m-1,d', strtotime($row2->date)).'), y: '.$row2->count.' },';
									}
									echo ']';
								echo '},';
							}
							?>
						
					],
				  legend:{
					cursor:"pointer",
					itemclick:function(e){
					  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
						e.dataSeries.visible = false;
					  }
					  else{
						e.dataSeries.visible = true;
					  }
					  chart.render();
					}
				  },
				  creditText: '',
				  backgroundColor: "#f1f1f1"
				});

		chart.render();
		}
	
	</script>
	