<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// authentication
$route['default_controller']        = 'auth';
$route['login']                     = 'auth';
$route['logout']                    = 'auth/logout';
$route['forgot-password']           = 'auth/forgotPassword';
$route['checkEmail']                = 'auth/checkEmail';
$route['forgot-password-check']     = 'auth/forgot_password_check';
$route['forgot-verify/(:any)']      = 'auth/verification/$1';
$route['set-new-password']          = 'auth/set_new_password';

//employee account activate & set password
$route['account-activation/(:any)'] = 'auth/account_activation/$1';
$route['set-password']              = 'auth/set_password';

// dashboard
$route['dashboard']                 = 'dashboard';
$route['profile']                 	= 'dashboard/profile';
$route['change-password']           = 'dashboard/changepassword';
$route['update-password']           = 'dashboard/updatepassword';

//scholareship application
$route['applications']                  =   'scholar/index';
$route['applications/detail/(:any)']   	= 	'scholar/singleGet/$1';
$route['applications/approved']         =   'scholar/approved';
$route['applications/rejected']         =   'scholar/rejected';
$route['application-approve']           =   'scholar/approve';
$route['application-reject']           	=   'scholar/reject';




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
