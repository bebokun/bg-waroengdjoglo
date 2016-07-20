<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

		 public function __construct() {
			parent::__construct();
			$this->load->model("menu_model", "m");
			$this->load->library('encrypt');
			 
			if( !$this->session->userdata('wd_user') || ( $this->session->userdata('group_id') > 1 ) ) redirect('home');
			
		}
		
		public function index()
		{
			
			$data['title'] 	= 'Daftar Menu waroengdjoglo.com';
			$data['back'] 	= 'home';
			$breadcrumbs	= array("Daftar Menu" => 'menu');
			
			$limit	 	= 12;
			
			$where 		= array();
			$order_by 	= NULL;
			$get_par 	= '/?';
			
			$data['menu'] 		= $this->m->get_menu(NULL, $where);
			
			$data['breadcrumbs']	= get_breadcrumbs($breadcrumbs);
			
			$data['main_content'] = 'menu/list';
			$this->load->view('include/template', $data);
            
        }
		
		//open insert form
		public function form($id = NULL){
			$data['menu_type'] 		= $this->db->where('status !=', 0)->get('menu_type')->result();	
			$data['branch'] 		= $this->db->where('status !=', 0)->get('branch')->result();	
			
			if($id != NULL) {
				$data['menu'] 			= $this->m->get_menu($id);	
			} 
			
			$this->load->view('menu/form', $data);
		}
		
		//get data list
		public function get_datatable(){
			$data['menu'] 		= $this->m->get_menu();
			$this->load->view('menu/datatable', $data);
		}
		
		
		public function add_menu(){
			$status = '<div class="alert alert-warning"><strong>Gagal.</strong> Terjadi kesalahan dalam membuat menu baru, silahkan mencoba kembali.</div>';
			
			$this->form_validation->set_rules('type_id', 'Jenis Menu', 'trim');
			$this->form_validation->set_rules('branch_id', 'Branch', 'trim');
			$this->form_validation->set_rules('name', 'Nama', 'required|trim|max_length[50]|is_unique[menu.name]');
			$this->form_validation->set_rules('image', 'Foto Menu', 'trim|max_length[250]');
			$this->form_validation->set_rules('image_thumb', 'Thumb Foto Menu', 'trim|max_length[250]');
			$this->form_validation->set_rules('info', 'Info Menu', 'trim|max_length[50]');
			$this->form_validation->set_rules('price', 'Harga Menu', 'trim|numeric');
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			
			if($this->form_validation->run()){

                    if($new_photo = $this->m->add_menu())
                    {
						$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Menu baru telah ditambahkan</div><script>get_datatable("menu/get_datatable");</script>';
                    }
            } else {
				$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Silahkan isi data dengan benar.<br/>'.validation_errors('- ','').'</div>';
			}
			
			echo $status;
		}
		
		public function edit_menu($id){
			
			if(!isset($id)) $status = '<div class="alert alert-warning"><strong>Gagal.</strong> Data tidak ditemukan.</div>';
			
			else {
				
				$menu 		= $this->m->get_menu($id);
				
				if(isset($_POST['name']) && $_POST['name'] != $menu->name) $unique = '|is_unique[menu.name]';
				else $unique = '';
				
				$this->form_validation->set_rules('type_id', 'Jenis Menu', 'trim');
				$this->form_validation->set_rules('branch_id', 'Branch', 'trim');
				$this->form_validation->set_rules('name', 'Nama', 'required|trim|max_length[50]'.$unique);
				$this->form_validation->set_rules('image', 'Foto Menu', 'trim|max_length[250]');
				$this->form_validation->set_rules('image_thumb', 'Thumb Foto Menu', 'trim|max_length[250]');
				$this->form_validation->set_rules('info', 'Info Menu', 'trim|max_length[50]');
				$this->form_validation->set_rules('price', 'Harga Menu', 'trim|numeric');
				$this->form_validation->set_rules('status', 'Status', 'required|trim');
				
				if($this->form_validation->run()){

						if($new_cat = $this->m->edit_menu($id))
						{
							$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Menu telah diedit</div><script>get_datatable("menu/get_datatable");</script>';
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
			
            if($this->db->delete('menu', array('id' => $id))){
                $status = '<div class="alert alert-success"><strong>Berhasil</strong>. Data telah dihapus</div>';
            }
            else {
                $status = '<div class="alert alert-warning"><strong>Gagal</strong>. Terjadi kesalahan dalam menghapus data</div>';
            }
            
			echo $status;
        }
        
        
		
		
		
}
