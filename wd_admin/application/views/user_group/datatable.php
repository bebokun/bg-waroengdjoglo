

	<table class="table dataTable table-bordered table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama User Group</th>
				<th>Status</th>
				<th>Tanggal Dibuat / Diedit</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="tbody_list">
		<?php
				$i = 1;
				foreach($user_group as $row){
					echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$row->name.'</td>';
						echo '<td>'.$row->status_label.'</td>';
						
						echo '<td>';
							echo 'Dibuat : '.$row->created_at.'<br/>';
							echo 'Diedit : '.$row->updated_at;
						echo '</td>';
						
						echo '<td>';
						echo '<div class="btn-group">';
						echo '<button onclick="change_top_content(\'user_group/form/'.$row->id.'\')" class="btn btn-default btn-sm"> Edit</button>';
						echo '<button type="button" id="delete'.$row->id.'" data-loading-text="loading.." onclick="delete_row('.$row->id.', \'user_group\')" href="#" class="btn btn-danger btn-sm"> Hapus</button>';
						echo '</div>';
						echo '</td>';
					echo '</tr>';
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