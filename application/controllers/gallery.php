<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	 public function __construct() {
			parent::__construct();
			$this->load->model("gallery_model", "g");
			//$this->load->library('encrypt');
			
	}
		
	public function index()
	{
	
		$where = array('status !=' => 0);
		
			//$tname = $this->db->get_where('menu_type', array('id' => $type_id))->row();
			$data['title'] = '<i class="fa fa-photo"></i> Photo Gallery - ';//.$tname->name;
			
			//$where['type_id'] = $type_id;
			//$data['gallery'] = $this->g->get_gallery(NULL, $where);
			$data['gallery'] = $this->db->where($where)->get('gallery')->result();
			
			$data['main_content'] = 'gallery/list';
		
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