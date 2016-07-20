

	<table class="table dataTable table-bordered table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Username</th>
				<th>Contact</th>
				<th>User Group</th>
				<th>Nama Lengkap</th>
				<th>Foto</th>
				<th width="100px">Social Media</th>
				<th>Status</th>
				<th>Tanggal Dibuat / Diedit</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="tbody_list">
		<?php
				$i = 1;
				foreach($user as $row){
					echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$row->username.'</td>';
						echo '<td>Email : '.$row->email.'<br/>Telepon : '.$row->phone.'<br/>Pin BB : '.$row->pin_bb.'</td>';
						echo '<td>'.$row->group_name.'</td>';
						echo '<td>'.$row->fullname.'</td>';
						echo '<td><img src="'.base_url('../'.$row->photo_thumb).'" alt="thumbnail photo"></td>';
						
						echo '<td>';
							echo '- Facebook : '.$row->facebook.'<br/>';
							echo '- Twitter : '.$row->twitter.'<br/>';
							echo '- Google + : '.$row->gplus;
						echo '</td>';
						
						echo '<td>';
							echo $row->status_label.'<br/>';
							echo 'Login terakhir : '.$row->last_login;
						echo '</td>';
						
						echo '<td>';
							echo 'Dibuat : '.$row->created_at.'<br/>';
							echo 'Diedit : '.$row->updated_at;
						echo '</td>';
						
						echo '<td>';
						echo '<div class="btn-group">';
						echo '<button onclick="change_top_content(\'user/form/'.$row->id.'\')" class="btn btn-default btn-sm"> Edit</button>';
						echo '<button type="button" id="delete'.$row->id.'" data-loading-text="loading.." onclick="delete_row('.$row->id.', \'user\')" href="#" class="btn btn-danger btn-sm"> Hapus</button>';
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