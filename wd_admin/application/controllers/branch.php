<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Branch extends CI_Controller {

		 public function __construct() {
			parent::__construct();
			$this->load->model("branch_model", "b");
			$this->load->library('encrypt');
			 
			if( !$this->session->userdata('wd_user') || ( $this->session->userdata('group_id') > 1 ) ) redirect('home');
			
		}
		
		public function index()
		{
			
			$data['title'] 	= 'Branch';
			$data['back'] 	= 'home';
			$breadcrumbs	= array("Branch" => 'branch');
			
			$limit	 	= 12;
			
			$where 		= array();
			$order_by 	= NULL;
			$get_par 	= '/?';
			
			$data['branch'] 		= $this->b->get_branch(NULL, $where);
			
			$data['breadcrumbs']	= get_breadcrumbs($breadcrumbs);
			
			$data['main_content'] = 'branch/list';
			$this->load->view('include/template', $data);
            
        }
		
		//open insert form
		public function form($id = NULL){
			
			//$data['branch'] 		= $this->db->where('status !=', 0)->get('branch')->result();	
			
			if($id != NULL) {
				$data['branch'] 			= $this->b->get_branch($id);	
			} else $data = '';
			
			$this->load->view('branch/form', $data);
		}
		
		//get data list
		public function get_datatable(){
			$data['branch'] 		= $this->b->get_branch();
			$this->load->view('branch/datatable', $data);
		}
		
		
		public function add_branch(){
			$status = '<div class="alert alert-warning"><strong>Gagal.</strong> Terjadi kesalahan dalam menambah branch , silahkan mencoba kembali.</div>';
			
			
			$this->form_validation->set_rules('name', 'Nama Foto', 'required|trim|max_length[50]|is_unique[branch.name]');
			$this->form_validation->set_rules('image', 'Foto', 'trim|max_length[250]');
			$this->form_validation->set_rules('image_thumb', 'Thumbnail Foto', 'trim|max_length[250]');
			$this->form_validation->set_rules('address', 'Alamat', 'trim|max_length[250]');
			$this->form_validation->set_rules('contact', 'Contact Person', 'trim|max_length[250]');
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			
			if($this->form_validation->run()){

                    if($new_photo = $this->b->add_branch())
                    {
						$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Branch baru telah ditambahkan</div><script>get_datatable("branch/get_datatable");</script>';
                    }
            } else {
				$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Silahkan isi data dengan benar.<br/>'.validation_errors('- ','').'</div>';
			}
			
			echo $status;
		}
		
		public function edit_branch($id){
			
			if(!isset($id)) $status = '<div class="alert alert-warning"><strong>Gagal.</strong> Data tidak ditemukan.</div>';
			
			else {
				$branch = $this->b->get_branch($id);
				
				if(isset($_POST['name']) && $_POST['name'] != $branch->name) $unique = '|is_unique[branch.name]';
				else $unique = '';
				
				$this->form_validation->set_rules('name', 'Nama Foto', 'required|trim|max_length[50]'.$unique);
				$this->form_validation->set_rules('image', 'Foto', 'trim|max_length[250]');
				$this->form_validation->set_rules('image_thumb', 'Thumbnail Foto', 'trim|max_length[250]');
				$this->form_validation->set_rules('address', 'Alamat', 'trim|max_length[250]');
				$this->form_validation->set_rules('contact', 'Contact Person', 'trim|max_length[250]');
				$this->form_validation->set_rules('status', 'Status', 'required|trim');
				
				if($this->form_validation->run()){

						if($new_photo = $this->b->edit_branch($id))
						{
							$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Data branch telah dirubah</div><script>get_datatable("branch/get_datatable");</script>';
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
			
            if($this->db->delete('branch', array('id' => $id))){
                $status = '<div class="alert alert-success"><strong>Berhasil</strong>. Data telah dihapus</div>';
            }
            else {
                $status = '<div class="alert alert-warning"><strong>Gagal</strong>. Terjadi kesalahan dalam menghapus data</div>';
            }
            
			echo $status;
        }
        
        
		
		
		
}
