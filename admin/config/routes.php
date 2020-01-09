<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller']        = 'auth';
$route['404_override']              = '';
$route['translate_uri_dashes']      = FALSE;
// auth
$route['login']                     = 'auth/login';
$route['logout']                    = 'auth/logout';
$route['forgot-password']           = 'auth/forgotPassword';
$route['checkEmail']                = 'auth/checkEmail';
$route['forgot-password-check']     = 'auth/forgot_password_check';
$route['forgot-verify/(:any)']      = 'auth/verification/$1';
$route['set-new-password']          = 'auth/set_new_password';
$route['account-activation/(:any)'] = 'auth/account_activation/$1';
$route['set-password']              = 'auth/set_password';
// dashboard
$route['dashboard']                 = 'dashboard';
// employee management
$route['employee']                  = 'employee';
$route['employee/add']              = 'employee/add';
//student management
$route['student']                  	= 'student/index';
$route['student/(:any)']            = 'student/index/$1';
//scholareship application
$route['scholarship-application/(:any)']   = 'scholar/singleGet/$1';
