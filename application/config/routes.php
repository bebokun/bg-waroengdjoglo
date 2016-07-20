<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';
require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();


$mtype = $db->get_where('menu_type', array('status !=' => 0))->result();
foreach($mtype as $row){
	$mjname = str_replace(' ', '_', $row->name);
	$route['our_menu/'.$mjname] = "our_menu/index/".$row->id;
	$route['our_menu/'.$mjname.'/page/(:num)'] = "our_menu/index/".$row->id."/page/$1";
	
	$route['our_menu/'.strtolower($mjname)] = "our_menu/index/".$row->id;
	$route['our_menu/'.strtolower($mjname).'/page/(:num)'] = "our_menu/index/".$row->id."/page/$1";
}

$mbranch = $db->get_where('branch', array('status !=' => 0))->result();
foreach($mbranch as $row){
	$bname = str_replace(' ', '_', $row->name);
	$route['branch/'.$bname] = "branch/index/".$row->id;
	$route['branch/'.$bname.'/page/(:num)'] = "branch/index/".$row->id."/page/$1";
	
	$route['branch/'.strtolower($bname)] = "branch/index/".$row->id;
	$route['branch/'.strtolower($bname).'/page/(:num)'] = "branch/index/".$row->id."/page/$1";
}


/* End of file routes.php */
/* Location: ./application/config/routes.php */