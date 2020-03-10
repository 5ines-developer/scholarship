<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dashboard');
        if($this->session->userdata('sfn_id') == ''){ redirect('/','refresh'); }
        $this->adid = $this->session->userdata('sfn_id');
        $this->load->library('sess_log');
        $this->sess_log->check_auth($this->adid);
    }

    public function index()
    {
        $data['title']      = 'Dashboard';
        $data['count']      = $this->m_dashboard->dashcounts();
        $data['indcount']   = $this->m_dashboard->industry_counts();
        $data['inscount']   = $this->m_dashboard->insti_counts();
        $this->load->view('dashboard/index', $data, FALSE);
    }

    /**
	* get total scholarship by year to display in graph
	* @url : dashboard/getordergraph
	**/
	public function getordergraph()
	{
		$startdate 	= '2000'; //start date of the year (jan first)
		$result		= $this->m_dashboard->getordergraph($startdate);
		echo json_encode($result);
	}


    public function profile($value='')
    {
    	$data['title'] = 'Profile';
    	$data['result'] = $this->m_dashboard->getProfile($this->adid);
    	$this->load->view('dashboard/profile', $data, FALSE);
    }

    public function updateprofile($value='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

    	$insert   = array(
            'name'    => $this->input->post('name'), 
            'phone'  => $this->input->post('phone'), 
        );        
    	$result = $this->m_dashboard->updateprofile($insert);
    	if (!empty($result )) {
    		$this->session->set_flashdata('success', 'Profile updated succesfully');
    	}else{
            $this->session->set_flashdata('error', 'Server error occurred. <br>Please try agin later');
    	}

    	redirect('profile','refresh');
    }

    public function changepassword($value='')
    {
        $data['title'] = 'Profile';
        $this->load->view('dashboard/change-password', $data, FALSE);
    }

        // psw check function
    public function checkpsw($psw='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        $output = $this->m_dashboard->checkpsw($this->input->post('crpass'));
        echo $output;
    }

    public function updatepassword($value='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);
    
        $this->form_validation->set_rules('cpswd', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('npswd', 'Password', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('cn_pswd', 'Password Confirmation', 'trim|required|matches[npswd]');
        if ($this->form_validation->run() == true) {
            $hash  = $this->bcrypt->hash_password($this->input->post('npswd'));
            $datas = array('psw' => $hash );
            if ($this->m_dashboard->changePassword($datas)) {
                $this->session->set_flashdata('success', 'Your password has been updated successfully');
                redirect('change-password', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong please try again later!');
                redirect('change-password', 'refresh');
            }

        }else{
            $error = validation_errors();
            $this->session->set_flashdata('error', $error);
            redirect('change-password','refresh');

        }
    }

}

/* End of file Dashboard.php */
