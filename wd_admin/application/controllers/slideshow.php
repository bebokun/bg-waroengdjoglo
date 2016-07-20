<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slideshow extends CI_Controller {

		 public function __construct() {
			parent::__construct();
			$this->load->model("slideshow_model", "s");
			$this->load->library('encrypt');
			 
			if( !$this->session->userdata('wd_user') || ( $this->session->userdata('group_id') > 1 ) ) redirect('home');
			
		}
		
		public function index()
		{
			
			$data['title'] 	= 'Daftar Foto Slideshow';
			$data['back'] 	= 'home';
			$breadcrumbs	= array("Slideshow" => 'Slideshow');
			
			$limit	 	= 12;
			
			$where 		= array('branch_id' => 0, 'status !=' => 0);
			$order_by 	= NULL;
			$get_par 	= '/?';
			
			$data['slideshow'] 		= $this->s->get_slideshow(NULL, $where);
			
			$data['breadcrumbs']	= get_breadcrumbs($breadcrumbs);
			
			$data['main_content'] = 'slideshow/list';
			$this->load->view('include/template', $data);
            
        }
		
		//open insert form
		public function form($id = NULL){
			if($id != NULL) {
				$data['photo'] 		= $this->s->get_slideshow($id);	
			} else $data = '';
			
			$this->load->view('slideshow/form', $data);
		}
		
		//get data list
		public function get_datatable(){
			//$data['carousel'] 		= $this->c->get_category();
			$data['slideshow'] 		= $this->s->get_slideshow();
			$this->load->view('slideshow/datatable', $data);
		}
		
		
		public function add_slideshow(){
			$status = '<div class="alert alert-warning"><strong>Gagal.</strong> Terjadi kesalahan dalam menambah foto, silahkan mencoba kembali.</div>';
			
			$this->form_validation->set_rules('id', 'Nomor', 'numeric|trim|3]|is_unique[carousel.id]');
			$this->form_validation->set_rules('teks', 'Teks', 'trim|min_length[2]|max_length[50]');
			$this->form_validation->set_rules('image', 'Foto', 'required|trim');
			$this->form_validation->set_rules('image_thumb', 'Thumbnail foto', 'trim');
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			
			if($this->form_validation->run()){

                    if($new_photo = $this->s->add_slideshow())
                    {
						$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Foto baru telah ditambahkan</div><script>get_datatable("slideshow/get_datatable");</script>';
                    }
            } else {
				$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Silahkan isi data dengan benar.<br/>'.validation_errors('- ','').'</div>';
			}
			
			echo $status;
		}
		
		public function edit_slideshow($id){
			
			if(!isset($id)) $status = '<div class="alert alert-warning"><strong>Gagal.</strong> Data tidak ditemukan.</div>';
			
			else {
				
				$slideshow 		= $this->s->get_slideshow($id);
				
				if(isset($_POST['id']) && $_POST['id'] != $slideshow->id) $unique = '|is_unique[carousel.id]';
				else $unique = '';
				
				$this->form_validation->set_rules('id', 'Nomor', 'numeric|trim|3]'.$unique);
				$this->form_validation->set_rules('teks', 'Teks', 'trim|min_length[2]|max_length[50]');
				$this->form_validation->set_rules('image', 'Foto', 'required|trim');
				$this->form_validation->set_rules('image_thumb', 'Thumbnail foto', 'trim');
				$this->form_validation->set_rules('status', 'Status', 'required|trim');
				
				if($this->form_validation->run()){

						if($new_cat = $this->s->edit_slideshow($id))
						{
							$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Data Foto telah diedit</div><script>get_datatable("slideshow/get_datatable");</script>';
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
			
            if($this->db->delete('carousel', array('id' => $id))){
                $status = '<div class="alert alert-success"><strong>Berhasil</strong>. Data telah dihapus</div>';
            }
            else {
                $status = '<div class="alert alert-warning"><strong>Gagal</strong>. Terjadi kesalahan dalam menghapus data</div>';
            }
            
			echo $status;
        }
        
        
		
		
		
}
