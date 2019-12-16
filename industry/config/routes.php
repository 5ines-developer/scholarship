<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// authentication
$route['default_controller']        = 'auth';
$route['login']                     = 'auth';
$route['register']                  = 'auth/registration';
$route['register']                  = 'auth/registration';
$route['account-activation/(:any)'] = 'auth/account_activation/$1';
$route['dashboard']                 = 'auth/dashboard';
$route['security']                  = 'auth/security';
$route['logout']                    = 'auth/logout';
$route['forgot-password']           = 'auth/forgot_pass';
$route['forgot-verify/(:any)']      = 'auth/forgot_verify/$1';
$route['reset-password']           	= 'auth/reset_password';

//company add request
$route['company-request']           	= 'auth/requestAdd';



// account settings
$route['dashboard']                 = 'account/index';
$route['dashboard/update']          = 'account/update';
$route['industry-doc']           	= 'account/industry_doc';
$route['change-password']          = 'account/changePassword';
$route['update-password']          = 'account/update_password';





$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
