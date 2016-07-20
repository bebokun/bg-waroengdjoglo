<?php

class Branch_model extends CI_Model {

	public function get_branch($id = NULL, $where = NULL){
	
		if($id!=NULL){
			$query = $this->db->get_where('branch', array('id'=> $id));
			
			if($query->num_rows() == 1) {
				return $query->row();
			} else return false;
			
		} else {
		
			if(is_array($where)) $this->db->where($where);
			
			$query = $this->db->get('branch');
			
			return $query->result();
			
		}
	
	}

}