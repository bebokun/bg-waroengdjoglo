

	<table class="table dataTable table-bordered table-striped">
		<thead>
			<tr>
				<!--<th>Nomor</th>
				<th>Foto</th>
				<th>Teks</th>
				<th>Status</th>
				<th>Aksi</th>-->
				<th>Story</th>
			</tr>
		</thead>
		<tbody id="tbody_list">
		<?php
				//$i = 1;
				//foreach($slideshow as $row){
					echo '<tr>';
						echo '<td style="padding: 10px">'.nl2br($our_story->story).'</td>';
						echo '<td>';
						echo '<div class="btn-group">';
						echo '<button onclick="change_top_content(\'our_story/form/'.$our_story->id.'\')" class="btn btn-default btn-md"> Edit</button>';
						//echo '<button type="button" id="delete'.$row->id.'" data-loading-text="loading.." onclick="delete_row('.$row->id.', \'slideshow\')" href="#" class="btn btn-danger btn-sm"> Hapus</button>';
						echo '</div>';
						echo '</td>';
					echo '</tr>';
					//$i++;
				//}
			?>
	
		</tbody>
	</table>
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('.dataTable').dataTable();
		} );
	</script>