<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Branch extends CI_Controller {

	 public function __construct() {
			parent::__construct();
			$this->load->model("our_menu_model", "m");
			$this->load->model("branch_model", "b");
			
	}
		
	public function index($id = NULL)
	{
		
		if($id!=NULL){
			
			$this->load->library('googlemaps');
			
			$where = array('m.status !=' => 0);
			
			$branch = $this->db->get_where('branch', array('id' => $id))->row();
			$data['title'] = $branch->name.' - Menu';
			$data['branch'] = $branch;
			
			//$config['center'] = '37.4419, -122.1419';
			$config['center'] = $branch->long.', '.$branch->lat;
			$config['zoom'] = '13';
			$config['map_height'] = "300px";
			$this->googlemaps->initialize($config);
			
			//marker
			$marker = array();
			$marker['position'] = $branch->long.', '.$branch->lat;
			$this->googlemaps->add_marker($marker);
			
			$data['map'] = $this->googlemaps->create_map();
			
			$where['branch_id'] = $id;
			$data['menu'] = $this->m->get_menu(NULL, $where);
			
			$data['main_content'] = 'branch/view';
		} else {
			$where = array('status !=' => 0);
			
			$data['branch'] = $this->b->get_branch(NULL, $where);
			
			$data['title'] = 'Branch';
			$data['main_content'] = 'branch/menu';
		}
		
		$this->load->view('include/template', $data);
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */