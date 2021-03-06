<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// authentication
$route['default_controller']        = 'auth';
$route['login']                     = 'auth/index';
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

//payments
$route['make-payment']              = 'payments/index'; //make payment
$route['payment-list']              = 'payments/payList'; //make payment
$route['receipt/(:any)']            = 'payments/receipt/$1'; //make payment
$route['formd-download/(:any)']     = 'payments/formds/$1'; //make payment

$route['reminder']              	= 'payments/reminder'; //make payment
$route['notification']              = 'payments/notification'; //make payment
$route['show-images/(:any)'] = 'auth/show_images/$1';
$route['show-images/(:any)/(:any)'] = 'auth/show_images/$1/$2';









$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
