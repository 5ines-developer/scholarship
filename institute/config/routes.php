<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// authentication
$route['default_controller']        = 'auth';
$route['login']                     = 'auth';
$route['register']                  = 'auth/registration';
$route['account-activation/(:any)'] = 'auth/account_activation/$1';
$route['set-password']              = 'auth/set_password';
$route['logout']                    = 'auth/logout';
$route['forgot-password']           = 'auth/forgotPassword';
$route['checkEmail']                = 'auth/checkEmail';
$route['forgot-password-check']     = 'auth/forgot_password_check';
$route['forgot-verify/(:any)']      = 'auth/verification/$1';
$route['set-new-password']          = 'auth/set_new_password';
$route['account']                   = 'account';
$route['update-account']            = 'account/update';
$route['institute-doc']             = 'account/institute_doc';
$route['change-password']           = 'account/changePassword';
$route['checkPassword']             = 'account/checkPassword';
$route['update-password']           = 'account/update_password';
// Dashboard
$route['scholarship-request']       = 'dashboard/scholarship_request';
$route['student/(:any)']            = 'dashboard/singleStudent/$1';
$route['approval']                  = 'dashboard/approval';
$route['reject']                    = 'dashboard/reject';
$route['reject-list']               = 'dashboard/reject_list';
$route['student-rejects']           = 'dashboard/student_rejects';
$route['approve-list']              = 'dashboard/approve_list';
$route['student-approved']          = 'dashboard/student_approved';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
