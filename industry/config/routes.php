<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// authentication
$route['default_controller']        = 'auth';
$route['login']                     = 'auth';
$route['register']                  = 'auth/registration';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
