<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//Route Usertypes
$route['api/v1/addusername']	= 'User_api/Addusername';
$route['api/v1/users']	= 'User_api/Users';
$route['api/v1/deleteuser/(:any)']	= 'User_api/Deleteuser/$1';
//Route Categories



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
