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

    // update images
    public function institute_doc()
    {
        $key =  $this->input->post('type');
      
        $config['upload_path'] = './'.$key;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_width'] = 0;
        $config['encrypt_name'] = true;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
        $this->upload->do_upload('file');
        $upload_data = $this->upload->data();

        if($key == 'regfile'){
            $data = array( 'reg_certification' => $key.'/'.$upload_data['file_name']);
        }elseif($key == 'signature') {
            $data = array( 'priciple_signature' => $key.'/'.$upload_data['file_name']);
        }else{
            $data = array( 'seal' => $key.'/'.$upload_data['file_name']);
        }
        $schoolId = $this->session->userdata('school');
        if($this->M_account->updateSchool($data,  $schoolId)){
            $data = array('status' => 1, 'msg' => '🙂 Updated Successfully ');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }

}

/* End of file Account.php */
