<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Our_story extends CI_Controller {

		 public function __construct() {
			parent::__construct();
			$this->load->model("our_story_model", "os");
			$this->load->library('encrypt');
			 
			if( !$this->session->userdata('wd_user') || ( $this->session->userdata('group_id') > 1 ) ) redirect('home');
			
		}
		
		public function index()
		{
			
			$data['title'] 	= 'Our Story';
			$data['back'] 	= 'home';
			$breadcrumbs	= array("Our_story" => 'Our_story');
			
			$limit	 	= 12;
			
			$where 		= array();
			$order_by 	= NULL;
			$get_par 	= '/?';
			
			$data['our_story'] 		= $this->os->get_our_story(NULL, $where);
			
			$data['breadcrumbs']	= get_breadcrumbs($breadcrumbs);
			
			$data['main_content'] = 'our_story/list';
			$this->load->view('include/template', $data);
            
        }
		
		//open insert form
		public function form($id = NULL){
			if($id != NULL) {
				$data['our_story'] 		= $this->os->get_our_story($id);	
			} else $data = '';
			
			$this->load->view('our_story/form', $data);
		}
		
		//get data list
		public function get_datatable(){
			$data['our_story'] 		= $this->os->get_our_story();
			$this->load->view('our_story/datatable', $data);
		}
		
		
		public function add_our_story(){
			$status = '<div class="alert alert-warning"><strong>Gagal.</strong> Terjadi kesalahan dalam menambah foto, silahkan mencoba kembali.</div>';
			
			/* $this->form_validation->set_rules('id', 'Nomor', 'numeric|trim|3]|is_unique[carousel.id]');
			$this->form_validation->set_rules('teks', 'Teks', 'trim|min_length[2]|max_length[50]');
			$this->form_validation->set_rules('image', 'Foto', 'required|trim');
			$this->form_validation->set_rules('image_thumb', 'Thumbnail foto', 'trim'); */
			$this->form_validation->set_rules('story', 'Story', 'required|trim');
			
			if($this->form_validation->run()){

                    if($new_photo = $this->s->add_our_story())
                    {
						$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Story baru telah ditambahkan</div><script>get_datatable("our_story/get_datatable");</script>';
                    }
            } else {
				$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Silahkan isi data dengan benar.<br/>'.validation_errors('- ','').'</div>';
			}
			
			echo $status;
		}
		
		public function edit_our_story($id){
			
			if(!isset($id)) $status = '<div class="alert alert-warning"><strong>Gagal.</strong> Data tidak ditemukan.</div>';
			
			else {
				/*
				$our_story 		= $this->os->get_our_story($id);
				
				if(isset($_POST['id']) && $_POST['id'] != $our_story->id) $unique = '|is_unique[carousel.id]';
				else $unique = '';
				
				 $this->form_validation->set_rules('id', 'Nomor', 'numeric|trim|3]'.$unique);
				$this->form_validation->set_rules('teks', 'Teks', 'trim|min_length[2]|max_length[50]');
				$this->form_validation->set_rules('image', 'Foto', 'required|trim');
				$this->form_validation->set_rules('image_thumb', 'Thumbnail foto', 'trim');
				$this->form_validation->set_rules('status', 'Status', 'required|trim'); */
				$this->form_validation->set_rules('story', 'Story', 'required|trim');
				
				if($this->form_validation->run()){

						if($new_cat = $this->os->edit_our_story($id))
						{
							$status = '<div class="alert alert-success"><strong>Berhasil</strong>. Story telah diedit</div><script>get_datatable("our_story/get_datatable");</script>';
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
			
            if($this->db->delete('our_story', array('id' => $id))){
                $status = '<div class="alert alert-success"><strong>Berhasil</strong>. Data telah dihapus</div>';
            }
            else {
                $status = '<div class="alert alert-warning"><strong>Gagal</strong>. Terjadi kesalahan dalam menghapus data</div>';
            }
            
			echo $status;
        }
        
        
		
		
		
}
