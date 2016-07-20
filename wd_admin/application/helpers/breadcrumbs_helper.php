<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_breadcrumbs'))
{
    function get_breadcrumbs($b){
		
		$bc = '<li><a href="'.base_url().'">Home</a></li>';
		foreach($b as $key => $val){
				$key = str_replace('&+', '', $key);
				if($val == end($b)) $bc .= '<li class="active">'.$key.'</li>';
				else $bc .= '<li><a href="'.base_url().$val.'">'.$key.'</a></li>';
		}
		return $bc;
		
    }   
}