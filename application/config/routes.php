<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['Dashboard/add_room/(:any)'] = "/Dashboard/add_room/$1";
$route['Dashboard/room_type_data/(:any)'] = "/Dashboard/room_type_data/$1";
$route['Dashboard/allocated_room_form/(:any)'] = '/Dashboard/allocated_room_form/$1';
$route['Dashboard/class_room_booking/(:any)'] = '/Dashboard/class_room_booking/$1';
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['Dashboard/room_type_deletes/(:any)'] = "/Dashboard/room_type_deletes/$1";
$route['image-upload'] = 'DropzoneImageController';
$route['image-upload/post']['post'] = 'DropzoneImageController/imageUploadPost';


//user

$route['Dashboard_user/add_room/(:any)'] = "/Dashboard_user/add_room/$1";
$route['Dashboard_user/room_type_data/(:any)'] = "/Dashboard_user/room_type_data/$1";

$route['Dashboard_user/allocated_room_form/(:any)'] = '/Dashboard_user/allocated_room_form/$1';
$route['Dashboard_user/class_room_booking/(:any)'] = '/Dashboard_user/class_room_booking/$1';
$route['Dashboard_user/room_type_deletes/(:any)'] = "/Dashboard_user/room_type_deletes/$1";

