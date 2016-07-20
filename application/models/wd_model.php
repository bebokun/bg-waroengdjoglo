<?php 

class Wd_model extends CI_Model {
 
   
	public function get_branch($id = NULL, $where = NULL ){
		
		$this->db->select('*')
					->from('branch AS b');
		
		if($id != NULL) 
		{
		
			$this->db->where('b.id', $id);
			
			$query = $this->db->get();
			
			if($query->num_rows() == 1) {
				$row = $query->row();
				
				return $row;
			}
			else return false;
		} else
		{
		
			if(is_array($where)) $this->db->where($where);
			
			//$this->db->order_by('a.updated_at', 'DESC');
			
			$query = $this->db->get();
			
			return $query->result();
		}
	   
	}
	
	public function get_carousel($id = NULL, $where = NULL ){
		
		$this->db->select('*')
					->from('carousel AS c');
		
		if($id != NULL) 
		{
		
			$this->db->where('c.id', $id);
			
			$query = $this->db->get();
			
			if($query->num_rows() == 1) {
				$row = $query->row();
				
				return $row;
			}
			else return false;
		} else
		{
		
			if(is_array($where)) $this->db->where($where);
			
			//$this->db->order_by('a.updated_at', 'DESC');
			
			$query = $this->db->get();
			
			return $query->result();
		}
	   
	}
   
	public function get_story($where = NULL ){
		
		$this->db->select('*')
					->from('our_story AS os');
		
		/* if($id != NULL) 
		{
		
			$this->db->where('c.id', $id);
			
			$query = $this->db->get();
			
			if($query->num_rows() == 1) {
				$row = $query->row();
				
				return $row;
			}
			else return false;
		} else
		{ */
		
			if(is_array($where)) $this->db->where($where);
			
			//$this->db->order_by('a.updated_at', 'DESC');
			
			$query = $this->db->get();
			
			return $query->row();
		//	}
	   
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