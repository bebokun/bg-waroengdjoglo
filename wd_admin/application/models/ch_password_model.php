<?php 

class Ch_password_model extends CI_Model {
 
   
	
	
	public function edit_ch_password($id){
	
		$data = array(
					'password'		=> md5($_POST['pwd']),
				);
		
		if(isset($_POST['image'])) $data['image']	= $_POST['image'];
		if(isset($_POST['image_thumb'])) $data['image_thumb']	= $_POST['image_thumb'];
		if(isset($_POST['address'])) $data['address']	= $_POST['address'];
		if(isset($_POST['contact'])) $data['contact']	= $_POST['contact'];
		
		$this->db->where('id', $id);
		
		if($this->db->update('user', $data)) return true;
		else return false;
	}
	
	
	
	public function user_log($user_id, $description = "")
	{
		
		$data = array(
         'user_id'        => $user_id,
		 'description'       => $description,
		 'created_at'			=> date('Y-m-d H:i:s')
		);
      
       $this->db->insert('user_log', $data);
      
	}
   
   
	function get_datetime($datetime, $format){
	
		$dt = strtotime($datetime);
		$date = strtolower(date("d F Y", $dt));
		$time = strtolower(date("H:i", $dt));
		
		if($format == 'date') return $date;
		if($format == 'time') return $time;
		else return $date.'<br/>'.$time;
	
	}
	
	function get_status_label($status){
	
		if($status == 0) return '<span class="label label-danger">tidak aktif</span>';
		else if($status == 1) return '<span class="label label-info">aktif</span>';
		else if($status == 100) return '<span class="label label-warning">default</span>';
	
	}
	
	public function time_elapsed_string($ptime) {
		$time = strtotime($ptime);
		$etime = time() - $time;
		
		if ($etime < 1) {
			return '0 detik';
		}
		
		$a = array( 12 * 30 * 24 * 60 * 60  =>  'tahun',
					30 * 24 * 60 * 60       =>  'bulan',
					24 * 60 * 60            =>  'hari',
					60 * 60                 =>  'jam',
					60                      =>  'menit',
					1                       =>  'detik'
					);
		
		foreach ($a as $secs => $str) {
			$d = $etime / $secs;
			if ($d >= 1) {
				$r = round($d);
				return $r . ' ' . $str . ($r > 1 ? '' : ''). ' yang lalu';
			}
		}
    }
	
   
 
}