<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']        = 'auth';
$route['register']                  = 'auth/registration';
$route['account-activation/(:any)'] = 'auth/account_activation/$1';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
