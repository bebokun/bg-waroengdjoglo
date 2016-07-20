<?php 

class Our_menu_model extends CI_Model {
 
   
	public function get_menu($id = NULL, $where = NULL ){
		
		$this->db->select('m.*, b.name AS bname, t.name AS tname')
					->from('menu AS m')
					->join('branch AS b', 'm.branch_id = b.id', 'left outer')
					->join('menu_type AS t', 'm.type_id = t.id', 'left outer');
					//->join('item_group AS g', 'i.group_id = g.id', 'left outer');
		
		if($id != NULL) 
		{
		
			$this->db->where('m.id', $id);
			
			$query = $this->db->get();
			
			if($query->num_rows() == 1) {
				$row = $query->row();
				
				/* $row->time = $this->time_elapsed_string($row->created_at);
				$row->created_at = $this->get_datetime($row->created_at, 'datetime');
				$row->updated_at = $this->get_datetime($row->updated_at, 'datetime');
				$row->photo = $this->db->where('ad_id', $row->id)->get('ad_photo')->result(); */
				
				return $row;
			}
			else return false;
		} else
		{
		
			if(is_array($where)) $this->db->where($where);
			
			//if($limit)	$this->db->limit($limit, $offset);
				
			//$this->db->order_by('a.updated_at', 'DESC');
			
			
			$query = $this->db->get();
			
			foreach($query->result() as $row){
				
			}
			
			return $query->result();
			//else return $query->num_rows();
		}
	   
	}
   
   
	function get_datetime($datetime, $format){
	
		$dt = strtotime($datetime);
		$date = strtolower(date("d F Y", $dt));
		$time = strtolower(date("H:i", $dt));
		
		if($format == 'date') return $date;
		if($format == 'time') return $time;
		else return $date.'<br/>'.$time;
	
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