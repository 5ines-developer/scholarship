<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// authentication
$route['default_controller']        = 'auth';
$route['login']                     = 'auth';
$route['register']                  = 'auth/registration';
$route['register1']                 = 'auth/register1';
$route['account-activation/(:any)'] = 'auth/account_activation/$1';
$route['set-password']              = 'auth/set_password';



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
$route['change-password']           = 'account/changePassword';
$route['update-password']           = 'account/update_password';

//scholarship request
$route['application-request']       = 'application/index';
$route['application/(:any)']        = 'application/singleStudent/$1';
$route['application-rejected']      = 'application/reject_list';
$route['application-approved']      = 'application/approve_list';
$route['application-approve']       = 'application/approve';
$route['application-reject']        = 'application/reject';

//Verification staffs
$route['staffs']                    = 'staffs';
$route['staffs/create']             = 'staffs/create';
$route['staffs/delete/(:any)']      = 'staffs/delete/$1';
$route['staffs/update/(:any)']      = 'staffs/update/$1';
$route['staffs/detail/(:any)']      = 'staffs/detail/$1';
$route['staffs/account-activation/(:any)'] = 'staffs/account_activation/$1';
$route['staffs/create']             = 'staffs/create';

$route['staffs/pdf']             = 'application/pdfTest';




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
