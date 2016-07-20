<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Our_menu extends CI_Controller {

	 public function __construct() {
			parent::__construct();
			$this->load->model("our_menu_model", "m");
			$this->load->library('encrypt');
			
	}
		
	public function index($type_id = NULL)
	{
	
		$where = array('m.status !=' => 0, 'm.branch_id' => 0);
		
		if($type_id!=NULL){
			
			$tname = $this->db->get_where('menu_type', array('id' => $type_id))->row();
			$data['title'] = 'Our Menu - '.$tname->name;
			
			$where['type_id'] = $type_id;
			$data['menu'] = $this->m->get_menu(NULL, $where);
			
			$data['main_content'] = 'our_menu/list';
		} else {
			$data['menu_type'] = $this->db->get_where('menu_type', array('status !=' => 0))->result();
			$data['main_content'] = 'our_menu/base';
		}
		
		$this->load->view('include/template', $data);
	}
		
	public function branch($branch_id = NULL)
	{
	
		$where = array('m.status !=' => 0);
		
		if($branch_id!=NULL){
			
			$bname = $this->db->get_where('branch', array('id' => $branch_id))->row();
			$data['title'] = $bname->name.' - Menu';
			
			$where['branch_id'] = $branch_id;
			$data['menu'] = $this->m->get_menu(NULL, $where);
			
			$data['main_content'] = 'our_menu/list';
		} else {
			$data['main_content'] = 'our_menu/base';
		}
		
		$this->load->view('include/template', $data);
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */