

	<table class="table dataTable table-bordered table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Foto</th>
				<th>Nama Foto</th>
				<!--<th>Keterangan</th>-->
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody id="tbody_list">
		<?php
				$i = 1;
				foreach($gallery as $row){
					//if($gallery){
					echo '<tr>';
							echo '<td>'.$i.'</td>';
							echo '<td style="padding: 10px"><img src="'.base_url('../'.$row->url).'" alt="'.$row->name.'"></td>';
							echo '<td style="padding: 10px">'.$row->name.'</td>';
							//echo '<td style="padding: 10px">'.$row->info.'</td>';
							echo '<td style="padding: 10px">'.$row->status_label.'</td>';
							echo '<td>';
							echo '<div class="btn-group">';
							echo '<button onclick="change_top_content(\'gallery/form/'.$row->id.'\')" class="btn btn-default btn-sm"> Edit</button>';
							echo '<button type="button" id="delete'.$row->id.'" data-loading-text="loading.." onclick="delete_row('.$row->id.', \'gallery\')" href="#" class="btn btn-danger btn-sm"> Hapus</button>';
							echo '</div>';
							echo '</td>';
					echo '</tr>';
					//} 
					$i++;
				}
			?>
	
		</tbody>
	</table>
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('.dataTable').dataTable();
		} );
	</script>