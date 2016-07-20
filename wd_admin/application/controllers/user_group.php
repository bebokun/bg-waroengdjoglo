<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_group extends CI_Controller {

		 public function __construct() {
			parent::__construct();
			$this->load->model("user_group_model", "d");
			
			if( !$this->session->userdata('mrm_user') || ( $this->session->userdata('group_id') > 1 ) ) redirect('home');
			
		}
		
		public function index()
		{
			
			$data['title'] 	= 'Daftar User Group';
			$data['back'] 	= 'home';
			$breadcrumbs	= array("User Group" => 'user_group');
			
			$where 		= array();
			$order_by 	= NULL;
			$get_par 	= '/?';
			
			$data['user_group'] 		= $this->d->get_user_group(NULL, $where);
			
			$data['breadcrumbs']	= get_breadcrumbs($breadcrumbs);
			
			$data['main_content'] = 'user_group/list';
			$this->load->view('include/template', $data);
            
        }
		
		//open insert form
		public function form($id = NULL){
			if($id != NULL) {
				$data['user_group'] 		= $this->d->get_user_group($id);	
			} else $data = '';
			
			
			$this->load->view('user_group/form', $data);
		}
		
		//get data list
		public function get_datatable(){
			$data['user_group'] 		= $this->d->get_user_group();
			$this->load->view('user_group/datatable', $data);
		}
		
		
		public function add_user_group(){
			$status = '<div class="alert alert-warning"><strong>Gagal.</strong> Terjadi kesalahan dalam menambah data, silahkan mencoba kembali.</div>';
			
			$this->form_validation->set_rules('name', 'Nama User Group', 'required|trim|min_length[3]|max_length[15]|is_unique[user_group.name]|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			
			if($this->form_validation->run()){

                    if($new_user_group = $this->d->add_user_group())
                    {
						$status = '<div class="alert alert-success"><strong>Berhasil</strong>. User Group baru telah ditambahkan</div><script>get_datatable("user_group/get_datatable");</script>';
                    }
            } else {
				$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Silahkan isi data dengan benar.<br/>'.validation_errors('- ','').'</div>';
			}
			
			echo $status;
		}
		
		public function edit_user_group($id){
			
			if(!isset($id)) $status = '<div class="alert alert-warning"><strong>Gagal.</strong> Data tidak ditemukan.</div>';
			
			else {
				
				$user_group 		= $this->d->get_user_group($id);
				
				if(isset($_POST['name']) && $_POST['name'] != $user_group->name) $unique1 = '|is_unique[user_group.name]';
				else $unique1 = '';
				
				$this->form_validation->set_rules('name', 'Nama User Group', 'required|trim|min_length[3]|max_length[15]|xss_clean'.$unique1);
				$this->form_validation->set_rules('status', 'Status', 'trim|required');
				
				if($this->form_validation->run()){

						if($new_cat = $this->d->edit_user_group($id))
						{
							$status = '<div class="alert alert-success"><strong>Berhasil</strong>. User Group telah diedit</div><script>get_datatable("user_group/get_datatable");</script>';
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
			
            if($this->db->delete('user_group', array('id' => $id))){
                $status = '<div class="alert alert-success"><strong>Berhasil</strong>. Data telah dihapus</div>';
            }
            else {
                $status = '<div class="alert alert-warning"><strong>Gagal</strong>. Terjadi kesalahan dalam menghapus data</div>';
            }
            
			echo $status;
        }
        
        
		
		
		
}
