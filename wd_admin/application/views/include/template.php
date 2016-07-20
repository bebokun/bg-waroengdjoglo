<?php


    $this->load->view('include/header');
    $this->load->view('include/nav');
    $this->load->view($main_content);
    //if(!isset($no_right)) $this->load->view('include/right-content');
    $this->load->view('include/footer');

?>