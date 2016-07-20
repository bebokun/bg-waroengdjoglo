<?php

	// Mengambil info WD (limit 1)
	$dt['info_wd'] = $this->db->limit(1)->get('info_wd')->row();
	

    $this->load->view('include/header', $dt);
    $this->load->view('include/nav', $dt);
    $this->load->view($main_content);
    //if(!isset($no_right)) $this->load->view('include/right-content');
    $this->load->view('include/footer');

?>