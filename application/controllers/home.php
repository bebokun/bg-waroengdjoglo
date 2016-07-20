<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

		
	 public function __construct() {
		parent::__construct();
		$this->load->model("wd_model", "wd");			
	}
	
	public function index()
	{
		
		$where = array('c.branch_id' => 0, 'c.status !=' => 0);
		$data['carousel'] = $this->wd->get_carousel(NULL, $where);
		
		$data['main_content'] = 'home';
		$this->load->view('include/template', $data);
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */