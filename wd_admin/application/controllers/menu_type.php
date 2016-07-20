<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_type extends CI_Controller {

		 public function __construct() {
			parent::__construct();
			$this->load->model("menu_type_model", "mt");
			$this->load->library('encrypt');
			 
			if( !$this->session->userdata('wd_user') || ( $this->session->userdata('group_id') > 1 ) ) redirect('home');
			
		}
		
		public function index()
		{
			
			$data['title'] 	= 'Jenis Menu waroengdjoglo.com';
			$data['back'] 	= 'home';
			$breadcrumbs	= array("Menu type" => 'menu_type');
			
			$limit	 	= 12;
			
			$where 		= array();
			$order_by 	= NULL;
			$get_par 	= '/?';
			
			$data['menu_type'] 		= $this->mt->get_menu_type(NULL, $where);
			
			$data['breadcrumbs']	= get_breadcrumbs($breadcrumbs);
			
			$data['main_content'] = 'menu_type/list';
			$this->load->view('include/template', $data);
            
        }
		
		//open insert form
		public function form($id = NULL){
			if($id != NULL) {
				$data['menu_type'] 		= $this->mt->get_menu_type($id);	
			} else $data = '';
			
			$this->load->view('menu_type/form', $data);
		}
		
		//get data list
		public function get_datatable(){
			$data['menu_type'] 		= $this->mt->get_menu_type();
			$this->load->view('menu_type/datatable', $data);
		}
		
		
		public function add_menu_type(){
			$status = '<div class="alert alert-warning"><strong>Gagal.</strong> Terjadi kesalahan dalam membuat jenis menu, silahkan mencoba kembali.</div>';
			
			$this->form_validation->set_rules('name', 'Nama', 'required|trim|max_length[50]|is_unique[menu_type.name]');
			$this->form_validation->set_rules('image', 'Image Jenis Menu', 'trim|max_length[250]');
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			
			if($this->form_validation->run()){

                    if($new_photo = $this->mt->add_menu_type())
                    {
						$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Jenis menu telah ditambahkan</div><script>get_datatable("menu_type/get_datatable");</script>';
                    }
            } else {
				$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Silahkan isi data dengan benar.<br/>'.validation_errors('- ','').'</div>';
			}
			
			echo $status;
		}
		
		public function edit_menu_type($id){
			
			if(!isset($id)) $status = '<div class="alert alert-warning"><strong>Gagal.</strong> Data tidak ditemukan.</div>';
			
			else {
				
				$menu_type 		= $this->mt->get_menu_type($id);
				
				if(isset($_POST['name']) && $_POST['name'] != $menu_type->name) $unique = '|is_unique[menu_type.name]';
				else $unique = '';
				
				$this->form_validation->set_rules('name', 'Nama', 'required|trim|max_length[50]'.$unique);
				$this->form_validation->set_rules('image', 'Image Jenis Menu', 'trim|max_length[250]');
				$this->form_validation->set_rules('status', 'Status', 'required|trim');
				
				if($this->form_validation->run()){

						if($new_cat = $this->mt->edit_menu_type($id))
						{
							$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Jenis menu telah diedit</div><script>get_datatable("menu_type/get_datatable");</script>';
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
			
            if($this->db->delete('menu_type', array('id' => $id))){
                $status = '<div class="alert alert-success"><strong>Berhasil</strong>. Data telah dihapus</div>';
            }
            else {
                $status = '<div class="alert alert-warning"><strong>Gagal</strong>. Terjadi kesalahan dalam menghapus data</div>';
            }
            
			echo $status;
        }
        
        
		
		
		
}
