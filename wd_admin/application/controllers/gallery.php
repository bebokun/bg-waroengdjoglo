<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

		 public function __construct() {
			parent::__construct();
			$this->load->model("gallery_model", "g");
			$this->load->library('encrypt');
			 
			if( !$this->session->userdata('wd_user') || ( $this->session->userdata('group_id') > 1 ) ) redirect('home');
			
		}
		
		public function index()
		{
			
			$data['title'] 	= 'Photo Gallery waroengdjoglo.com';
			$data['back'] 	= 'home';
			$breadcrumbs	= array("Gallery" => 'gallery');
			
			$limit	 	= 12;
			
			$where 		= array();
			$order_by 	= NULL;
			$get_par 	= '/?';
			
			$data['gallery'] 		= $this->g->get_gallery(NULL, $where);
			
			$data['breadcrumbs']	= get_breadcrumbs($breadcrumbs);
			
			$data['main_content'] = 'gallery/list';
			$this->load->view('include/template', $data);
            
        }
		
		//open insert form
		public function form($id = NULL){
			
			//$data['branch'] 		= $this->db->where('status !=', 0)->get('branch')->result();	
			
			if($id != NULL) {
				$data['gallery'] 			= $this->g->get_gallery($id);	
			} else $data = '';
			
			$this->load->view('gallery/form', $data);
		}
		
		//get data list
		public function get_datatable(){
			$data['gallery'] 		= $this->g->get_gallery();
			$this->load->view('gallery/datatable', $data);
		}
		
		
		public function add_gallery(){
			$status = '<div class="alert alert-warning"><strong>Gagal.</strong> Terjadi kesalahan dalam menambah gallery , silahkan mencoba kembali.</div>';
			
			
			$this->form_validation->set_rules('image', 'Foto', 'required|trim|max_length[250]');
			$this->form_validation->set_rules('image_thumb', 'Thumbnail Foto', 'trim|max_length[250]');
			$this->form_validation->set_rules('name', 'Nama Foto', 'trim|max_length[50]');
			//$this->form_validation->set_rules('info', 'Keterangan Foto', 'trim|max_length[150]');
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			
			if($this->form_validation->run()){

                    if($new_photo = $this->g->add_gallery())
                    {
						$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Foto baru telah ditambahkan</div><script>get_datatable("gallery/get_datatable");</script>';
                    }
            } else {
				$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Silahkan isi data dengan benar.<br/>'.validation_errors('- ','').'</div>';
			}
			
			echo $status;
		}
		
		public function edit_gallery($id){
			
			if(!isset($id)) $status = '<div class="alert alert-warning"><strong>Gagal.</strong> Data tidak ditemukan.</div>';
			
			else {
				
				$this->form_validation->set_rules('image', 'Foto', 'required|trim|max_length[250]');
				$this->form_validation->set_rules('image_thumb', 'Thumbnail Foto', 'trim|max_length[250]');
				$this->form_validation->set_rules('name', 'Nama Foto', 'trim|max_length[50]');
				//$this->form_validation->set_rules('info', 'Keterangan Foto', 'trim|max_length[150]');
				$this->form_validation->set_rules('status', 'Status', 'required|trim');
				
				if($this->form_validation->run()){

						if($new_photo = $this->g->edit_gallery($id))
						{
							$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Data gallery telah dirubah</div><script>get_datatable("gallery/get_datatable");</script>';
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
			
            if($this->db->delete('gallery', array('id' => $id))){
                $status = '<div class="alert alert-success"><strong>Berhasil</strong>. Data telah dihapus</div>';
            }
            else {
                $status = '<div class="alert alert-warning"><strong>Gagal</strong>. Terjadi kesalahan dalam menghapus data</div>';
            }
            
			echo $status;
        }
        
        
		
		
		
}
