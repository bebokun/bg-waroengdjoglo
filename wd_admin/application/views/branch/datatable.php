

	<table class="table dataTable table-bordered table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Branch</th>
				<th>Foto</th>
				<th>Alamat</th>
				<th>Contact Person</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody id="tbody_list">
		<?php
				$i = 1;
				foreach($branch as $row){
					//if($branch){
					echo '<tr>';
							echo '<td>'.$i.'</td>';
							echo '<td style="padding: 10px">'.$row->name.'</td>';
							echo '<td style="padding: 10px"><img src="'.base_url('../'.$row->image).'" alt="'.$row->name.'"></td>';
							echo '<td style="padding: 10px">'.$row->address.'</td>';
							echo '<td style="padding: 10px">'.$row->contact.'</td>';
							echo '<td style="padding: 10px">'.$row->status_label.'</td>';
							echo '<td>';
							echo '<div class="btn-group">';
							echo '<button onclick="change_top_content(\'branch/form/'.$row->id.'\')" class="btn btn-default btn-sm"> Edit</button>';
							echo '<button type="button" id="delete'.$row->id.'" data-loading-text="loading.." onclick="delete_row('.$row->id.', \'branch\')" href="#" class="btn btn-danger btn-sm"> Hapus</button>';
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