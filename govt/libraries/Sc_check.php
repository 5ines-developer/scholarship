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
		$msg = '---------------------Success -- Govt  Verification Officer Logged in with '.$sess['sgt_mail'].' and IP aaddress '.$ip.' --------------';
		log_message('info', ''.$msg.'');
	}

	public function loginError($mail='')
	{
		$ip = $this->ci->input->ip_address();
		$msg = '---------------------Failed -- Govt  Verification Officer Logged Failed and tried login with '.$mail.' password and IP aaddress '.$ip.' --------------';
		log_message('error', ''.$msg.'');
	}


}