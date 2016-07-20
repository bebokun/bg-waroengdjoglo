<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Our_story extends CI_Controller {

	public function __construct() {
			parent::__construct();
			$this->load->model("wd_model", "wd");
			
	}
	
	public function index()
	{
		$data['our_story'] = $this->wd->get_story();
		
		$data['main_content'] = 'our_story';
		$this->load->view('include/template', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */