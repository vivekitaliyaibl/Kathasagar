<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
 */
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

$route['login'] = "Login"; 
$route['check-login'] = "Login/check_login";
$route['logout'] = "Login/logout"; 
$route['logout/(:any)'] = "Login/logout/$1";
$route['change-password'] = 'Login/change_password';

$route['videos'] = "Videos";
$route['videos/video-upload'] = 'Videos/video_upload';
$route['videos/change-status'] = 'Videos/change_status';
$route['videos/video-delete'] = 'Videos/video_delete';

$route['about-us'] = "Aboutus";
$route['about-us/add-edit-aboutus-notes'] = "Aboutus/add_edit_notes";
$route['about-us/change-status'] = "Aboutus/change_status";
$route['about-us/delete-notes'] = "Aboutus/delete_notes";

$route['contact-us'] = "Contactus";
$route['contact-us/add-edit-contactus'] = "Contactus/add_edit_contactus";

$route['event'] = "Event";
$route['event/event-upload'] = "Event/event_upload";
$route['event/change-status'] = "Event/change_status";
$route['event/event-delete'] = "Event/event_delete";

/*advertisement*/
$route['advertisement'] = "Advertisement";
$route['valamadvertise/valamadvertise-upload'] = "Advertisement/advertisement_upload";
$route['valamadvertise/change-status'] = "Advertisement/change_status";
$route['valamadvertise/valamadvertise-delete'] = "Advertisement/advertisement_delete";
