<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sess_log
{
    protected $ci;
    public function __construct()
    {
    	$this->ci =& get_instance();
    	$this->ci->load->model('m_auth');
    }

    public function check_auth($id = null)
    {
    	$output = $this->ci->m_auth->checkLogin($id);
	    	if (empty($output)) {
	        	$session_data = array(
	            'sgt_mail'      => $this->ci->session->userdata('sgt_mail'),
	            'sgt_id'        => $this->ci->session->userdata('sgt_id'),
	            'sgt_status'    => $this->ci->session->userdata('sgt_status'),
	            'sgt_name'      => $this->ci->session->userdata('sgt_name'),
	            'sgt_type'      => $this->ci->session->userdata('sgt_type')
	        );
        	$this->ci->session->unset_userdata($session_data);
        	$this->ci->session->sess_destroy();
        	$this->ci->session->set_flashdata('error', 'you are no longer able to access your account,<br>Your account has been blocked by admin');
        	redirect('/');
    	}else{
    		return true;
    	}
    }
}

