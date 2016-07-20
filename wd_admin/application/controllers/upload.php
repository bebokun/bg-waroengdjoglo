<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('files_model');
		
		/*
		if(!$this->session->userdata('sim_logged_in'))
		{
            redirect('users/restricted');
		}
		*/
        
		
    }
    
    
	
	public function upload_foto($type = NULL)
	{
		//$this->check_privilege();
		
		$data['status'] = "";
		$data['msg'] = "";
		$data['url'] = "";
		$data['img_id'] = "";
		
		if($type != NULL) $dir = '../assets/images/'.$type.'/'.date('Y/m/');
		else $dir = '../assets/images/'.date('Y/m/');
			
		if (!is_dir($dir)) mkdir($dir, 0777, true);
		
		//$file_element_name = 'browse'.$id;
		$file_element_name = 'browse';
		
		  $config['upload_path'] = './'.$dir;
		  $config['allowed_types'] = 'gif|jpg|png|jpeg';
		  //$config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = FALSE;
	 
		  $this->load->library('upload', $config);
	 
		  if (!$this->upload->do_upload($file_element_name))
		  {
			 echo 'Error. '.$this->upload->display_errors('<div>', '</div>');
		  }
		  else
		  {
		  
				$data = $this->upload->data();
			
				$data['status'] = "";
				$data['msg'] = "";
				
				$dir_url = $dir.''.$data['file_name'];
				
				$thumbnail = $this->create_thumb($dir, $data['file_name']);
				$dir_thumb = $dir.'s/'.$thumbnail;
				
				$data['url'] 		= str_replace('../','', $dir_url);
				$data['url_thumb'] 	= str_replace('../','', $dir_thumb);
				$data['img_id'] = $data['file_name'];
				/* $data['id'] = $id;
				$id++; */
				
				$this->load->view('preview_file', $data);
		  }
		  //@unlink($_FILES[$file_element_name]);
	   
	}
	
	
	public function create_thumb($dir, $filename){
		$this->load->library('image_lib');
		
		$dir_thumb = $dir.'/s/';
		if (!is_dir($dir_thumb)) mkdir($dir_thumb, 0777, true);

		$config['image_library'] = 'gd2';
		$config['source_image'] = $dir.''.$filename;
		$config['new_image'] = $dir_thumb.''.$filename;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']     = 265;
		$config['height']   = 155;

		$this->image_lib->clear();
		$this->image_lib->initialize($config);

		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
			return FALSE;
		}
		
		$this->image_lib->resize();
		// get file extension //
		preg_match('/(?<extension>\.\w+)$/im', $filename, $matches);
		$extension = $matches['extension'];
		// thumbnail //
		$thumbnail = preg_replace('/(\.\w+)$/im', '', $filename) . '_thumb' . $extension;
		return $thumbnail;

	}
		
	
	public function upload_file()
	{
		//$this->check_privilege();
		
	   $status = "";
	   $msg = "";
	   $file_element_name = 'userfile';
		
	   if (empty($_POST['title']))
	   {
		  $status = "error";
		  $msg = "Please enter a title";
	   }
		
	   if ($status != "error")
	   {
		  
		  $config['upload_path'] = './assets/img/';
		  $config['allowed_types'] = 'gif|jpg|png|doc|txt';
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
	 
		  $this->load->library('upload', $config);
	 
		  if (!$this->upload->do_upload($file_element_name))
		  {
			 $status = 'error';
			 $msg = $this->upload->display_errors('', '');
		  }
		  else
		  {
			 $data = $this->upload->data();
			 $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($file_id)
			 {
				$status = "success";
				$msg = "File successfully uploaded";
			 }
			 else
			 {
				unlink($data['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
		  @unlink($_FILES[$file_element_name]);
	   }
	   echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	

	
	
    public function delete($dt, $id)
    {
		$this->check_privilege();
		
        $db_id = 'id';
        $db = 'master_'.$dt;
             
        $query1 = $this->db->delete($db, array($db_id => $id));
        $query2 = $this->db->delete('master_history', array('aset_id' => $id));
		
            if($query1 && $query2){
                $data['status'] = 'Sukses';
                $data['msg'] = 'Data telah berhasil dihapus';
            }
            else {
                $data['status'] = 'Error';
                $data['msg'] = 'Terjadi kesalahan dalam menghapus data. Silahkan coba kembali';
            }
            
			
            $data['back'] = 'inventarisasi';
            $data['main_content'] = 'formsuccess';
            $this->load->view('include/template', $data);
    }
        
        
	
        public function check_privilege(){
			if($this->session->userdata('uLvl') == 'staff')
			{
				redirect('users/restricted');
			}
		}	
        
}
