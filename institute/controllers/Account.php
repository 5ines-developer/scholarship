<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_account');
        if($this->session->userdata('scinst') == ''){ redirect('/','refresh'); }
    }

    public function index()
    {
        $data['title'] = 'Scholarship account';
        $data['info'] = $this->M_account->getAccountDetails();
        $this->load->view('auth/account', $data, FALSE);
    }

}

/* End of file Account.php */
