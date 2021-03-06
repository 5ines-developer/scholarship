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
        header_remove("X-Powered-By"); 
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("Strict-Transport-Security: max-age=31536000");
        header("Content-Security-Policy: frame-ancestors none");
        header("Referrer-Policy: no-referrer-when-downgrade");
        // header("Content-Security-Policy: default-src 'none'; script-src 'self' https://www.google.com/recaptcha/api.js https://www.gstatic.com/recaptcha/releases/v1QHzzN92WdopzN_oD7bUO2P/recaptcha__en.js https://www.google.com/recaptcha/api2/anchor?ar=1&k=6Le6xNYUAAAAADAt0rhHLL9xenJyAFeYn5dFb2Xe&co=aHR0cHM6Ly9oaXJld2l0LmNvbTo0NDM.&hl=en&v=v1QHzzN92WdopzN_oD7bUO2P&size=normal&cb=k5uv282rs3x8; connect-src 'self'; img-src 'self'; style-src 'self';");
        // header("Referrer-Policy: origin-when-cross-origin");
        // header("Expect-CT: max-age=7776000, enforce");
        // header('Public-Key-Pins: pin-sha256="d6qzRu9zOECb90Uez27xWltNsj0e1Md7GkYYkVoZWmM="; pin-sha256="E9CZ9INDbd+2eRQozYqqbQ2yXLVKB9+xcprMF+44U1g="; max-age=604800; includeSubDomains; report-uri="https://example.net/pkp-report"');
        ////header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
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

        $this->sc_check->limitRequests();

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('prname', 'Name', 'trim|required|callback_customAlpha');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('number', 'Phone Number', 'trim|required|numeric|max_length[10]|min_length[10]');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|callback_customAlpha');

            $this->form_validation->set_rules('regno', 'Register no', 'alpha_numeric_spaces');
            $this->form_validation->set_rules('iname', 'Institute Name', 'callback_customAlpha');
            $this->form_validation->set_rules('taluk', 'Taluk', 'alpha_numeric_spaces');
            $this->form_validation->set_rules('district', 'District', 'alpha_numeric_spaces');
            $this->form_validation->set_rules('pin', 'Pincode', 'alpha_numeric_spaces');


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
                $this->form_validation->set_error_delimiters('', '<br>');
                $this->session->set_flashdata('error', str_replace(array("\n", "\r"), '', validation_errors()));
                redirect('account','refresh');
            }
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
            $pos = strrpos($value['name'], '.');
            $fl = substr($value['name'], $pos+1);
            if($fl !='png' && $fl !='pdf' && $fl!='jpg' && $fl !='jpeg' && $fl !='svg' && $fl !='gif' && $fl !='JPG' && $fl !='JPEG' && $fl !='PNG' && $fl !='png'){
                $this->sc_check->sus_mail($this->session->userdata('scmail'));
                die();
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $output = $this->M_account->checkpsw($this->input->post('crpass'));
            echo $output;
        }else{
            echo null;
        }
    }

    // update password
    public function update_password()
    {
        $this->sc_check->limitRequests();

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
            	$this->form_validation->set_error_delimiters('', '<br>');
                $this->session->set_flashdata('error', str_replace(array("\n", "\r"), '', validation_errors()));
                redirect('change-password','refresh');
            }
        }else{
            $this->session->set_flashdata('error', 'Some error occured, please try again!');
            redirect('change-password','refresh');
        }
    }


    public function customAlpha($str) 
    {
        if (!preg_match('/^[a-z 0-9~%.:_\-@\&+=,]+$/i',$str))
        {
            $this->form_validation->set_message('customAlpha', 'The {field} contains invalid special characters');
            return false;
        }else
        {
                return TRUE;
        }
    }




}

/* End of file Account.php */
