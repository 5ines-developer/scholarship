<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// authentication
$route['default_controller']        = 'auth';
$route['register']                  = 'auth/registration';
$route['account-activation/(:any)'] = 'auth/account_activation/$1';
$route['set-password']              = 'auth/set_password';
$route['account']                   = 'account';

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
