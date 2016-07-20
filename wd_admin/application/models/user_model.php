<?php 

class user_model extends CI_Model {
 
   
	public function get_user($id = NULL, $where = NULL, $like = NULL, $limit = NULL, $offset = NULL, $order_by = NULL, $num_rows = NULL){
		
		$this->db->select('u.*, g.name AS group_name')
					->join('user_group AS g', 'g.id = u.group_id', 'left outer')
					->from('user AS u');
		
		if($id != NULL) 
		{
		
			$this->db->where('u.id', $id);
			
			$query = $this->db->get();
			
			if($query->num_rows() == 1) {
				$row = $query->row();
				
				$row->time = $this->time_elapsed_string($row->created_at);
				$row->created_at = $this->get_datetime($row->created_at, 'datetime');
				$row->updated_at = $this->get_datetime($row->updated_at, 'datetime');
				
				return $row;
			}
			else return false;
		} else
		{
		
			if(is_array($where)) $this->db->where($where);
			if($like) $this->db->where("(".$like.")");
			
			if($limit)	$this->db->limit($limit, $offset);
			
			$this->db->order_by('updated_at', 'DESC');
			
			$query = $this->db->get();
			
			
			foreach($query->result() as $row){
				$row->last_login = $this->time_elapsed_string($row->last_login);
				$row->created_at = $this->get_datetime($row->created_at, 'datetime');
				$row->updated_at = $this->get_datetime($row->updated_at, 'datetime');
				$row->status_label = $this->get_status_label($row->status, 'datetime');
			}
			
			if($num_rows == NULL) return $query->result();
			else return $query->num_rows();
		}
	   
	}
   
   
    public function can_log_in(){
        
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', md5($this->input->post('password')));
        $this->db->where('status', 1);
        
        $query = $this->db->get('user');
        
        if($query->num_rows() == 1){
			return $query->row();
        } else {
            return false;
        }
        
    }
    
	
	public function last_login($id){
        
		$this->db->where('id', $id);
		$query = $this->db->update('user', array('last_login' => date('Y-m-d H:i:s')));
		
    }
	
	
	public function change_password($id){
	
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
	
   
	public function add_user(){
	
		$data = array(
					'username'		=> $_POST['username'],
					'password'		=> $_POST['password'],
					'email'			=> $_POST['email'],
					'group_id'		=> $_POST['group_id'],
					'fullname'		=> $_POST['fullname'],
					'description'	=> $_POST['description'],
					'phone'			=> $_POST['phone'],
					'pin_bb'		=> $_POST['pin_bb'],
					'facebook'		=> $_POST['facebook'],
					'twitter'		=> $_POST['twitter'],
					'gplus'			=> $_POST['gplus'],
					'status'		=> $_POST['status'],
					'created_at'	=> date('Y-m-d H:i:s'),
					'updated_at'	=> date('Y-m-d H:i:s')
				);
		
		if(isset($_POST['image'])) $data['photo']	=  $_POST['image'];
		if(isset($_POST['image_thumb'])) $data['photo_thumb']	=  $_POST['image_thumb'];
		
		
		if($this->db->insert('user', $data)) return true;
		else return false;
	}
	
	
	public function edit_user($id){
	
		
		$data = array(
					'username'		=> $_POST['username'],
					'password'		=> $_POST['password'],
					'email'			=> $_POST['email'],
					'group_id'		=> $_POST['group_id'],
					'fullname'		=> $_POST['fullname'],
					'description'	=> $_POST['description'],
					'phone'			=> $_POST['phone'],
					'pin_bb'		=> $_POST['pin_bb'],
					'facebook'		=> $_POST['facebook'],
					'twitter'		=> $_POST['twitter'],
					'gplus'			=> $_POST['gplus'],
					'status'		=> $_POST['status'],
					'created_at'	=> date('Y-m-d H:i:s'),
					'updated_at'	=> date('Y-m-d H:i:s')
				);
		
		if(isset($_POST['image'])) $data['photo']	=  $_POST['image'];
		else $data['photo']	=	'';
		if(isset($_POST['image_thumb'])) $data['photo_thumb']	=  $_POST['image_thumb'];
		else $data['photo_thumb']	=	'';
		
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