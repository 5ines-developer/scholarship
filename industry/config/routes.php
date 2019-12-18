<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// authentication
$route['default_controller']        = 'auth';
$route['login']                     = 'auth';
$route['register']                  = 'auth/registration';
$route['register1']                  = 'auth/register1';
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
$route['change-password']           = 'account/changePassword';
$route['update-password']           = 'account/update_password';

//scholarship request
$route['application-request']       = 'application/index';
$route['application/(:any)']        = 'application/singleStudent/$1';
$route['application-rejected']      = 'application/reject_list';
$route['application-approved']      = 'application/approve_list';
$route['application-approve']       = 'application/approve';
$route['application-reject']        = 'application/reject';





$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
