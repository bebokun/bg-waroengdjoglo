<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ch_password extends CI_Controller {

		 public function __construct() {
			parent::__construct();
			$this->load->model("ch_password_model", "cp");
			$this->load->library('encrypt');
			 
			if( !$this->session->userdata('wd_user') || ( $this->session->userdata('group_id') > 1 ) ) redirect('home');
			
		}
		
		public function index($data = array())
		{
			
			$data['title'] 	= 'Ganti Password';
			$data['back'] 	= 'home';
			$breadcrumbs	= array("Ganti Password" => 'ch_password');
			
			$limit	 	= 12;
			
			
			//$data['status']	= '';
			$data['uId']	= $this->session->userdata('uId');
			$data['breadcrumbs']	= get_breadcrumbs($breadcrumbs);
			
			$data['main_content'] = 'ch_password/form';
			$this->load->view('include/template', $data);
            
        }
		
		
		public function edit_ch_password($id){
			
			if(!isset($id)) $status = '<div class="alert alert-warning"><strong>Gagal.</strong> Data tidak ditemukan.</div>';
			
			else {
				
				$this->form_validation->set_rules('old_pwd', 'Password Lama', 'required|trim|max_length[20]');
				$this->form_validation->set_rules('pwd', 'Password Baru', 'required|trim|min_length[3]|max_length[20]');
				$this->form_validation->set_rules('cpwd', 'Konfirmasi Password Baru', 'required|trim|min_length[3]|max_length[20]|matches[pwd]');
				
				
				
				if($this->form_validation->run()){
						
					if(md5($this->input->post('old_pwd')) != $id){
						$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Password lama Anda Salah.<br/>'.validation_errors('- ','').'</div>';
					} else {
						if($new_photo = $this->cp->edit_ch_password($id))
						{
							$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Password telah dirubah</div><script>get_datatable("ch_password/get_datatable");</script>';
						} else {
							$status = '<div class="alert alert-warning"><strong>Gagal.</strong> Terjadi kesalahan dalam mengedit data.</div>';
						}
					} 
					
				} else {
					$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Silahkan isi data dengan benar.<br/>'.validation_errors('- ','').'</div>';
				}
			}
			
			$this->index( $status);
		}
		
        
        
		
		
		
}
