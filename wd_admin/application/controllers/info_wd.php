<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info_wd extends CI_Controller {

		 public function __construct() {
			parent::__construct();
			$this->load->model("info_wd_model", "iw");
			$this->load->library('encrypt');
			 
			if( !$this->session->userdata('wd_user') || ( $this->session->userdata('group_id') > 1 ) ) redirect('home');
			
		}
		
		public function index()
		{
			
			$data['title'] 	= 'Informasi waroengdjoglo.com';
			$data['back'] 	= 'home';
			$breadcrumbs	= array("Info_wd" => 'Info_wd');
			
			$limit	 	= 12;
			
			$where 		= array();
			$order_by 	= NULL;
			$get_par 	= '/?';
			
			$data['info_wd'] 		= $this->iw->get_info_wd(NULL, $where);
			
			$data['breadcrumbs']	= get_breadcrumbs($breadcrumbs);
			
			$data['main_content'] = 'info_wd/list';
			$this->load->view('include/template', $data);
            
        }
		
		//open insert form
		public function form($id = NULL){
			if($id != NULL) {
				$data['info_wd'] 		= $this->iw->get_info_wd($id);	
			} else $data = '';
			
			$this->load->view('info_wd/form', $data);
		}
		
		//get data list
		public function get_datatable(){
			$data['info_wd'] 		= $this->iw->get_info_wd();
			$this->load->view('info_wd/datatable', $data);
		}
		
		
		public function add_info_wd(){
			$status = '<div class="alert alert-warning"><strong>Gagal.</strong> Terjadi kesalahan dalam membuat informasi, silahkan mencoba kembali.</div>';
			
			$this->form_validation->set_rules('image', 'Logo Waroeng Djoglo', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'trim|max_length[50]|valid_email');
			$this->form_validation->set_rules('facebook', 'Facebook', 'trim|max_length[100]');
			//$this->form_validation->set_rules('image_thumb', 'Thumbnail foto', 'trim'); 
			//$this->form_validation->set_rules('story', 'Story', 'required|trim');
			
			if($this->form_validation->run()){

                    if($new_photo = $this->iw->add_info_wd())
                    {
						$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Info telah ditambahkan</div><script>get_datatable("info_wd/get_datatable");</script>';
                    }
            } else {
				$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Silahkan isi data dengan benar.<br/>'.validation_errors('- ','').'</div>';
			}
			
			echo $status;
		}
		
		public function edit_info_wd($id){
			
			if(!isset($id)) $status = '<div class="alert alert-warning"><strong>Gagal.</strong> Data tidak ditemukan.</div>';
			
			else {
				
				
				$this->form_validation->set_rules('image', 'Logo Waroeng Djoglo', 'required|trim');
				$this->form_validation->set_rules('email', 'Email', 'trim|max_length[50]|valid_email');
				$this->form_validation->set_rules('facebook', 'Facebook', 'trim|max_length[100]');
				
				if($this->form_validation->run()){

						if($new_cat = $this->iw->edit_info_wd($id))
						{
							$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Informasi telah diedit</div><script>get_datatable("info_wd/get_datatable");</script>';
						} else {
							$status = '<div class="alert alert-warning"><strong>Gagal.</strong> Terjadi kesalahan dalam mengedit data.</div>';
						}
				} else {
					$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Silahkan isi data dengan benar.<br/>'.validation_errors('- ','').'</div>';
				}
			}
			
			echo $status;
		}
		
		
        public function delete($id = NULL)
        {
			
            if($this->db->delete('info_wd', array('id' => $id))){
                $status = '<div class="alert alert-success"><strong>Berhasil</strong>. Data telah dihapus</div>';
            }
            else {
                $status = '<div class="alert alert-warning"><strong>Gagal</strong>. Terjadi kesalahan dalam menghapus data</div>';
            }
            
			echo $status;
        }
        
        
		
		
		
}
