<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if( !$this->session->userdata('wd_user') || ( $this->session->userdata('group_id') > 1 )) redirect('user/login');
		else {
		
			/*$data['cat'] = $this->db->where('status !=', 0)->get('category')->result();
			
			foreach($data['cat'] as $row){
				$data['ads'][$row->name] = $this->db->select('count(*) as count, created_at as date')
								->from('ads')
								->where('CAST(created_at AS DATE) >=', date('Y-m-d', strtotime(' -30 day')))
								->where('cat_id', $row->id)
								->group_by('CAST(created_at AS DATE)')
								->get()->result();
			}
		*/
			$data['main_content'] = 'home';
			$this->load->view('include/template', $data);
		} 
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */