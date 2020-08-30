<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/************student**********************/ 
// Registration


$route['kannada'] 			= 'home/kannada';

$route['student/register'] 			= 'student/register';
$route['student/submit-register'] 	= 'student/registerInsert';
$route['student/verification'] 		= 'student/email_verification';
$route['student/otp-verify'] 		= 'student/otpVerify';
//login
$route['student/login'] 			= 'student/index';
$route['student/login-check'] 		= 'student/login_submit';
//forgot password - email
$route['student/forgot-password'] 	= 'student/forgot_pass';
$route['student/forgot-verify'] 	= 'student/forgot_verify';
$route['student/reset-password'] 	= 'student/reset_password';
//forgot password - security question
$route['student/forgot-validate'] 	    = 'student/forgot_validate';
$route['student/reset-pass'] 	        = 'student/qst_resetpass';
//change password
$route['student/change-password'] 	    = 'std_account/changePassword';
$route['student/update-password'] 	    = 'std_account/update_pass';
//profile settings
$route['student/profile'] 			    = 'std_account/index';
$route['student/update-profile'] 	    = 'std_account/updateprofile';
// scholarship application
$route['student/application'] 			= 'Std_application/index';
$route['student/submit-application'] 	= 'Std_application/insertAppli';
$route['student/application-detail'] 	= 'Std_application/getApplication';
$route['student/application-status'] 	= 'Std_application/getStatus';
$route['student/application-list'] 		= 'Std_application/list';
$route['student/application-list/(:any)'] 		= 'Std_application/list/$1';


$route['show-image/(:any)'] 		= 'home/show_image/$1';
$route['show-image/(:any)/(:any)'] 		= 'home/show_image/$1/$2';




