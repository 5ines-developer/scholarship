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
$route['profile']                 	= 'dashboard/profile';
$route['change-password']           = 'dashboard/changepassword';
$route['update-password']           = 'dashboard/updatepassword';
// employee management
$route['employee']                  = 'employee';
$route['employee/add']              = 'employee/add';
$route['employee/edit/(:any)']      = 'employee/edit/$1';

//student management
$route['student']                  	= 'student/index';
$route['student/(:any)']            = 'student/index/$1';
$route['student-add']               = 'student/add';
$route['student-emailcheck']        = 'student/emailcheck';
$route['student-mobile_check']      = 'student/mobile_check';
$route['student-edit/(:any)']      	= 'student/edit/$1';
$route['student-delete/(:any)']     = 'student/delete/$1';

//scholareship application
$route['applications']                  =   'scholar/index';
$route['applications/detail/(:any)']   	= 	'scholar/singleGet/$1';
$route['applications/approved']         =   'scholar/approved';
$route['applications/rejected']         =   'scholar/rejected';
$route['application-approve']           =   'scholar/approve';
$route['application-reject']           	=   'scholar/reject';


//institute management
$route['institute']                  	= 'school/index';
$route['institute/(:any)']              = 'school/index/$1';
$route['institute-add']                 = 'school/add';
$route['institutes']                 	= 'school/schoolGet'; //all school list
$route['institute-edit/(:any)']         = 'school/edit/$1';
$route['institute-request']         	= 'school/requestLists';
$route['institute-request/(:any)']      = 'school/requestLists/$1';
$route['upload-institute']         		= 'school/import_excel';
$route['institute-delete/(:any)']       = 'school/delete/$1';


//industry management
$route['industry']                  	= 'industry/index';
$route['industry/detail/(:any)']        = 'industry/index/$1';
$route['industries']                 	= 'industry/industryGet'; //all school list
$route['industry-request']         	    = 'industry/requestLists';
$route['industry-request/(:any)']       = 'industry/requestLists/$1';
$route['industry-add']                 	= 'industry/add';
$route['industry-edit/(:any)']         	= 'industry/edit/$1';
$route['upload-industry']         		= 'industry/import_excel';

// fees managemnet
$route['fees/add']                  	= 'fees/add';
$route['fees/edit/(:any)']              = 'fees/edit/$1';
$route['fees/manage']            		= 'fees/manage';
$route['fees/delete/(:any)']            = 'fees/delete/$1';
// Reports
$route['reports']                  		= 'reports/index';



