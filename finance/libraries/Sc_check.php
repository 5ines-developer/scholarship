<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sc_check {

	protected $ci;

	public function __construct()
    {
        $this->ci =& get_instance();
    }

	public function loginSuccess($value='')
	{
		$ip = $this->ci->input->ip_address();
		$sess = $this->ci->session->userdata();
		$msg = '---------------------Success -- Finance officer Logged in with '.$sess['sfn_mail'].' and IP aaddress '.$ip.' --------------';
		log_message('info', ''.$msg.'');
	}

	public function loginError($mail='')
	{
		$ip = $this->ci->input->ip_address();
		$msg = '---------------------Failed -- Finance officer Log in Failed and tried login with '.$mail.' password and IP aaddress '.$ip.' --------------';
		log_message('error', ''.$msg.'');
	}


}