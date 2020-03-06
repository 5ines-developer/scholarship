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
		$msg = '---------------------Success -- Institute Logged in with '.$sess['scmail'].' and IP aaddress '.$ip.' --------------';
		log_message('info', ''.$msg.'');
	}

	public function loginError($mail='')
	{
		$ip = $this->ci->input->ip_address();
		$msg = '---------------------Failed -- Institute Log in Failed and tried login with '.$mail.' password and IP aaddress '.$ip.' --------------';
		log_message('error', ''.$msg.'');
	}

	public function sus_mail($mail='')
	{
		$data['email'] = $mail;
        $data['ip'] = $this->ci->input->ip_address();
        $this->ci->load->config('email');
        $this->ci->load->library('email');
        $from = $this->ci->config->item('smtp_user');
        $msg = $this->ci->load->view('mail/suspic', $data, true);
        $this->ci->email->set_newline("\r\n");
        $this->ci->email->from($from , 'Karnataka Labour Welfare Board');
        $this->ci->email->to('prathwi@5ine.in');
        $this->ci->email->subject('Suspicious alert mail'); 
        $this->ci->email->message($msg);
        if($this->ci->email->send())  
        {
            return true;
        } 
        else
        {
            return false;
        }
	}


}