<?php 

class Menu_type_model extends CI_Model {
 
   
	public function get_menu_type($id = NULL, $where = NULL, $like = NULL, $limit = NULL, $offset = NULL, $order_by = NULL, $num_rows = NULL){
		
		$this->db->select('mt.*')
					->from('menu_type AS mt');
		
		if($id != NULL) 
		{
		
			$this->db->where('mt.id', $id);
			
			$query = $this->db->get();
			
			if($query->num_rows() == 1) {
				$row = $query->row();
				
				/* $row->time = $this->time_elapsed_string($row->created_at);
				$row->created_at = $this->get_datetime($row->created_at, 'datetime');
				$row->updated_at = $this->get_datetime($row->updated_at, 'datetime'); */
				
				return $row;
			}
			else return false;
		} else
		{
		
			if(is_array($where)) $this->db->where($where);
			if($like) $this->db->where("(".$like.")");
			
			if($limit)	$this->db->limit($limit, $offset);
				
			//$this->db->order_by('c.number', 'ASC');
			
			$query = $this->db->get();
			
			foreach($query->result() as $row){
				$row->status_label = $this->get_status_label($row->status, 'datetime');
			}
			
			if($num_rows == NULL) return $query->result();
			else return $query->num_rows();
		}
	   
	}
   
	public function add_menu_type(){
	
		$data = array(
					'name'		=> $_POST['name'],
					'status'	=> $_POST['status']
				);
		
		if(isset($_POST['image'])) $data['image']	= $_POST['image'];
		
		if($this->db->insert('menu_type', $data)) return true;
		else return false;
	}
	
	
	public function edit_menu_type($id){
	
		$data = array(
					'name'		=> $_POST['name'],
					'status'	=> $_POST['status']
				);
		
		if(isset($_POST['image'])) $data['image']	= $_POST['image'];
		else $data['image']	= '';
		
		$this->db->where('id', $id);
		
		if($this->db->update('menu_type', $data)) return true;
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