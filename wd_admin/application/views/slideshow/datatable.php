

	<table class="table dataTable table-bordered table-striped">
		<thead>
			<tr>
				<th>Nomor</th>
				<th>Foto</th>
				<th>Teks</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody id="tbody_list">
		<?php
				$i = 1;
				foreach($slideshow as $row){
					echo '<tr>';
						echo '<td>'.$row->id.'</td>';
						//echo '<td>'.$row->name.'</td>';
						echo ($row->url) ? '<td><img src="'.base_url('../'.$row->url).'" alt="'.$row->teks.'"></td>' : '<td></td>';
						echo '<td>'.$row->teks.'</td>';
						echo '<td>'.$row->status_label.'</td>';
						//echo '<td>'.$row->created_at.'</td>';
						//echo '<td>'.$row->updated_at.'</td>';
						echo '<td>';
						echo '<div class="btn-group">';
						echo '<button onclick="change_top_content(\'slideshow/form/'.$row->id.'\')" class="btn btn-default btn-sm"> Edit</button>';
						echo '<button type="button" id="delete'.$row->id.'" data-loading-text="loading.." onclick="delete_row('.$row->id.', \'slideshow\')" href="#" class="btn btn-danger btn-sm"> Hapus</button>';
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