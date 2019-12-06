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
        $this->load->model('m_auth');
        $data['title'] = 'Scholarship account';
        $data['taluk'] = $this->m_auth->getTaluk();
        $data['district'] = $this->m_auth->getDistrict();
        $data['info'] = $this->M_account->getAccountDetails();
        $this->load->view('auth/account', $data, FALSE);
    }

    public function update()
    {
        $schoolId = $this->session->userdata('school');
        $data['schoolDetail'] = array(
            'name'              => $this->input->post('iname'),
            'principal'         => $this->input->post('prname'),
            'email'             => $this->input->post('email'),
            'phone'             => $this->input->post('number'),
            'reg_no'            => $this->input->post('regno'),
        );

        $data['school_address'] = array(
            'address'   => $this->input->post('address'),
            'city'      => $this->input->post('district'),
            'taluq'     => $this->input->post('taluk'),
            'pin'       => $this->input->post('pin'),
        );
        $this->M_account->update($data, $schoolId);
        $this->session->set_flashdata('success', 'Updated Successfully 🙂');
        redirect('account','refresh');
    }

}

/* End of file Account.php */
