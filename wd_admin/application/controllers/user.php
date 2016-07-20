<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

		 public function __construct() {
			parent::__construct();
			$this->load->model("user_model", "d");
			
			//if( (!$this->session->userdata('wd_user')) ) redirect('home');
			
		}
		
		public function index()
		{
			
			$data['title'] 	= 'Daftar User';
			$data['back'] 	= 'home';
			$breadcrumbs	= array("User" => 'user');
			
			$where 		= array();
			$order_by 	= NULL;
			$get_par 	= '/?';
			
			$data['user'] 		= $this->d->get_user(NULL, $where);
			
			$data['breadcrumbs']	= get_breadcrumbs($breadcrumbs);
			
			$data['main_content'] = 'user/list';
			$this->load->view('include/template', $data);
            
        }
		
		
		public function login($status = ''){
            
			$data['status'] = $status;
            if( $this->session->userdata('wd_user') && ( $this->session->userdata('group_id') < 2 ))
			{
                
				redirect('home');
				
            } else {
                $this->load->view('include/header');
                $this->load->view('login', $data);
                $this->load->view('include/footer');
            }
            
            //$data['title'] = 'User - Login';
        }
        
        
        // validasi login form
        //
        public function login_validation($ajax = 1){
            
            
            $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|callback_validate_credentials');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            
            if($this->form_validation->run()){
                    redirect($_SERVER['HTTP_REFERER']);
            } else {
					$status = 'Username/Password yang Anda masukan salah';
					$this->login($status);
            }
        }
        
        
        public function validate_credentials(){
            
            if($this->d->can_log_in()){
                $login = $this->d->can_log_in();
                
				//$group = $this->db->get_where('user_group', array('id'=>$login->group_id))->row();
				
				$this->d->last_login($login->id);
				
                $data = array(
                    'uName' 	=> $login->username,
                    'fullname' 	=> $login->fullname,
					'phone' 	=> $login->phone,
                    'pin_bb' 	=> $login->pin_bb,
					'email' 	=> $login->email,
                    'uId' 		=> $login->id,
                    'group_id' => $login->group_id,
                    //'group_name' => $group->name,
                    'wd_user' 	=> 1,
                );
                
                $this->session->set_userdata($data);
                return true;
            } else {
                $this->form_validation->set_message('validate_credentials', 'Username/Password yang Anda masukan salah');
                return false;
            }
            
        }
		
		
		// Ganti Password
        //
        public function ganti_password($data = array()){
			
			$id = $this->session->userdata('uId');
		
			$data['title'] = 'Ganti Password';
			$data['back'] = '';
			
			if($_POST==NULL){
				
				//$data["profile"] = $this->user_model->get_user($id);
				
                $data['main_content'] = 'user/ch_pwd';
                $this->load->view('include/template', $data);
				
            }
			else {
				
				$data['status'] = "Gagal";
				$data['msg'] = "";
				
				$qname = $this->db->get_where('user', array('id' => $id))->row();
				
				$this->form_validation->set_rules('old_pwd', 'Password Lama', 'required|trim');
				$this->form_validation->set_rules('pwd', 'Password Baru', 'required|trim|min_length[3]|max_length[20]');
				$this->form_validation->set_rules('cpwd', 'Konfirmasi Password', 'required|trim|matches[pwd]');
					
				if($this->form_validation->run()){

						
						if(md5($this->input->post('old_pwd')) != $qname->password){
							
							$_POST=NULL;
							$data['msg'] = 'Password lama Anda Salah';
							$this->ganti_password($data);
						} else {
							if($this->d->change_password($id))
							{
								$data['status'] = "Berhasil";
								$data['msg'] = "Password telah diganti";
									   
								$data['main_content'] = 'formsuccess';
								$this->load->view('include/template', $data);
							}
							else
							{
								$data['status'] = "Gagal";
								$data['msg'] = "Terjadi kesalahan saat menambahkan data ke database, silahkan coba kembali";
								$this->ganti_password($data);
							}
						}
						
					
				} else {
					$_POST=NULL;
					$data['msg'] = 'Mohon masukan data dengan benar.<br/>'.validation_errors('- ','');
					$this->ganti_password($data);
				}
			}
			
        }
        /*
         * Edit Profile END
         */
		
		
		//open insert form
		public function form($id = NULL){
			if($id != NULL) {
				$data['user'] 		= $this->d->get_user($id);	
			} else $data = '';
			
			$data['user_group']		= $this->db->get_where('user_group', array('status !=' => 0))->result();
			
			$this->load->view('user/form', $data);
		}
		
		//get data list
		public function get_datatable(){
			$data['user'] 		= $this->d->get_user();
			$this->load->view('user/datatable', $data);
		}
		
		
		public function add_user(){
			$status = '<div class="alert alert-warning"><strong>Gagal.</strong> Terjadi kesalahan dalam menambah data, silahkan mencoba kembali.</div>';
			
			$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[15]|is_unique[user.username]|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[passconf]|md5');
			$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('group_id', 'User Group', 'trim|required');
			$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|trim|min_length[3]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('image', 'Foto', 'trim');
			$this->form_validation->set_rules('image_thumb', 'Foto Thumbnail', 'trim');
			$this->form_validation->set_rules('description', 'Deskripsi User', 'trim');
			$this->form_validation->set_rules('phone', 'Telepon', 'trim|required');
			$this->form_validation->set_rules('pin_bb', 'Pin BB', 'trim');
			$this->form_validation->set_rules('facebook', 'Facebook', 'trim');
			$this->form_validation->set_rules('twitter', 'Twitter', 'trim');
			$this->form_validation->set_rules('gplus', 'Google +', 'trim');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			
			if($this->form_validation->run()){

                    if($new_user = $this->d->add_user())
                    {
						$status = '<div class="alert alert-success"><strong>Berhasil</strong>. User baru telah ditambahkan</div><script>get_datatable("user/get_datatable");</script>';
                    }
            } else {
				$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Silahkan isi data dengan benar.<br/>'.validation_errors('- ','').'</div>';
			}
			
			echo $status;
		}
		
		public function edit_user($id){
			
			if(!isset($id)) $status = '<div class="alert alert-warning"><strong>Gagal.</strong> Data tidak ditemukan.</div>';
			
			else {
				
				$user 		= $this->d->get_user($id);
				
				if(isset($_POST['username']) && $_POST['username'] != $user->username) $unique1 = '|is_unique[user.username]';
				else $unique1 = '';
				
				if(isset($_POST['email']) && $_POST['email'] != $user->email) $unique2 = '|is_unique[user.email]';
				else $unique2 = '';
				
				$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[15]|xss_clean'.$unique1);
				
				if(isset($_POST['password'])) {
					$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[passconf]|md5');
					$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|trim|min_length[3]');
				}
				
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'.$unique2);
				$this->form_validation->set_rules('group_id', 'User Group', 'trim|required');
				$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|trim|min_length[3]|max_length[100]|xss_clean');
				$this->form_validation->set_rules('image', 'Foto', 'trim');
				$this->form_validation->set_rules('image_thumb', 'Foto Thumbnail', 'trim');
				$this->form_validation->set_rules('description', 'Deskripsi User', 'trim');
				$this->form_validation->set_rules('phone', 'Telepon', 'trim|required');
				$this->form_validation->set_rules('pin_bb', 'Pin BB', 'trim');
				$this->form_validation->set_rules('facebook', 'Facebook', 'trim');
				$this->form_validation->set_rules('twitter', 'Twitter', 'trim');
				$this->form_validation->set_rules('gplus', 'Google +', 'trim');
				$this->form_validation->set_rules('status', 'Status', 'trim|required');
				
				if($this->form_validation->run()){

						if($new_cat = $this->d->edit_user($id))
						{
							$status = '<div class="alert alert-success"><strong>Berhasil</strong>. User telah diedit</div><script>get_datatable("user/get_datatable");</script>';
						} else {
							$status = '<div class="alert alert-warning"><strong>Gagal.</strong> Terjadi kesalahan dalam mengedit data.</div>';
						}
				} else {
					$status = '<div class="alert alert-warning"><strong>Gagal</strong>. Silahkan isi data dengan benar.<br/>'.validation_errors('- ','').'</div>';
				}
			}
			
			echo $status;
		}
		
		
        
        public function logout(){
            $this->session->sess_destroy();
            redirect('home');
        }
		
		
        public function delete($id = NULL)
        {
			
            if($this->db->delete('user', array('id' => $id))){
                $status = '<div class="alert alert-success"><strong>Berhasil</strong>. Data telah dihapus</div>';
            }
            else {
                $status = '<div class="alert alert-warning"><strong>Gagal</strong>. Terjadi kesalahan dalam menghapus data</div>';
            }
            
			echo $status;
        }
        
        
		
		
		
}
