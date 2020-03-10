<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_account');
        if($this->session->userdata('scinst') == ''){ redirect('/','refresh'); }
        $this->load->library('sc_check');
        $this->load->library('form_validation');
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

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);
        $this->form_validation->set_rules('prname', 'Name', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('number', 'Phone Number', 'trim|required|numeric|max_length[10]|min_length[10]');
        if ($this->form_validation->run() == true) {
            $schoolId = $this->session->userdata('school');
            $data['schoolDetail'] = array(
                'principal'         => $this->input->post('prname'),
                'email'             => $this->input->post('email'),
                'phone'             => $this->input->post('number'),
            );
            $data['school_address'] = array(
                'address'   => $this->input->post('address'),
            );
            $this->M_account->update($data, $schoolId);
            $this->session->set_flashdata('success', 'Updated Successfully 🙂');
            redirect('account','refresh');
        }else{
            $this->session->set_flashdata('error','😕 Server error occurred. Please try again later');
            redirect('account','refresh');
        }
    }

    // update images
    public function institute_doc()
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);
        foreach ($_FILES as $key => $value) {
        $fl =  explode('.', $value['name']);
        if($fl[1] !='png' && $fl[1] !='pdf' && $fl[1] !='jpg' && $fl[1] !='jpeg' && $fl[1] !='svg' && $fl[1] !='gif' && $fl[1] !='JPG' && $fl[1] !='JPEG' && $fl[1] !='PNG' && $fl[1] !='png'){
                $this->sc_check->sus_mail($this->session->userdata('scmail'));
           }
        }

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

    public function changePassword()
    {
        $data['title']  = 'Student Change Password';
		$this->load->view('auth/change-password', $data, FALSE);
    }

    public function checkPassword()
    {
        $output = $this->M_account->checkpsw($this->input->post('crpass'));
        echo $output;
    }

    // update password
    public function update_password()
    {

            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->security->xss_clean($_POST);
    
        $this->load->library('form_validation');
        $this->form_validation->set_rules('cpswd', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('npswd', 'Password', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('cn_pswd', 'Password Confirmation', 'trim|required|matches[npswd]');
        if ($this->form_validation->run() == true) {
        	$hash  = $this->bcrypt->hash_password($this->input->post('npswd'));
        	$datas = array('psw' => $hash );
        	if ($this->M_account->changePassword($datas)) {
               	$this->session->set_flashdata('success', '🙂 Your password has been updated successfully');
               	redirect('change-password', 'refresh');
            } else {
               	$this->session->set_flashdata('error', '😕 Something went wrong please try again later!');
               	redirect('change-password', 'refresh');
            }

        }else{
        	$error = validation_errors();
            $this->session->set_flashdata('error', $error);
            redirect('change-password','refresh');
        }
    }

}

/* End of file Account.php */
