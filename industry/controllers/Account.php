<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_account');
        if($this->session->userdata('scinds') == ''){ redirect('/','refresh'); }
        $this->inId = $this->session->userdata('sccomp');
        $this->reg = $this->session->userdata('scinds');
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

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        $this->load->model('m_auth');
        $data['title'] = 'Industry account';
        $data['taluk'] = $this->m_auth->getTaluk();
        $data['district'] = $this->m_auth->getDistrict();
        if ($this->session->userdata('scctype') == '1') {
            $data['info'] = $this->M_account->getAccountDetails();
            $this->load->view('account/profile', $data, FALSE);
        }else{
             $data['info'] = $this->M_account->getaccount();
            $this->load->view('account/hr-profile', $data, FALSE);
        }
    }

    public function mobile_check($value='')
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mobile =  $this->input->post('mobile');
            $output = $this->M_account->mobile_check($mobile);
            echo  $output;
        }else{
            echo null;
        }
    }

    public function inmobile_check($value='')
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mobile =  $this->input->post('mobile');
            $output = $this->M_account->inmobile_check($mobile);
            echo  $output;
        }else{
            echo null;
        }
    }

    public function emailcheck($value='')
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->security->xss_clean($_POST);
            $email = $this->input->post('email');
            $output = $this->M_account->email_check($email);
            echo  $output;
        }else{
            echo null;
        }
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
        $this->form_validation->set_rules('iname', 'Industry Name', 'trim|required');
        $this->form_validation->set_rules('taluk', 'Taluk', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('district', 'District', 'trim|required|alpha_numeric_spaces');

        $this->form_validation->set_rules('director', 'Director Name', 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('number', 'Phone Number', 'trim|numeric|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('gstno', 'GST Number', 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('panno', 'Pancard Number', 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('address', 'Address', 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');


        if ($this->form_validation->run() == true) {
            $insert = array(
                'talluk'       => $this->input->post('taluk'),
                'district'     => $this->input->post('district'),
                'name'         => $this->input->post('director'),
                'mobile'       => $this->input->post('number'),
                'pan_no'       => $this->input->post('panno'),
                'gst_no'       => $this->input->post('gstno'),
                'address'      => $this->input->post('address'),
            );
            $email = $this->input->post('email');
            if($this->M_account->update($insert,$this->reg))
            {
                if($email != $this->session->userdata('sinmail')){
                    $this->verifyMail($email,$this->reg);
                    $this->session->set_flashdata('success', 'Please check your registered mail inbox and do not forget to check your spam folder verify your Email Id 🙂');
                }else{
                    $this->session->set_flashdata('success', 'Profile details Updated Successfully 🙂');
                }
                
            }else{
                $this->session->set_flashdata('error', '😕 Server error occurred. Please try again later');             
            }
        }else{
            $this->form_validation->set_error_delimiters('', '<br>');
                $this->session->set_flashdata('error', str_replace(array("\n", "\r"), '', validation_errors()));
        }

        }else{
            $this->session->set_flashdata('error', 'Some error occured, please try again!');
            
        }
        redirect('dashboard','refresh');
    }


    public function verifyMail($email='',$indid='')
    {

        $data['id'] = urlencode(base64_encode($indid));
        $data['email'] = $email;
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/mail-verify', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($email);
        $this->email->subject('Industry Director Email Verification'); 
        $this->email->message($msg);
        if($this->email->send())  
        {
            return true;
        } 
        else
        {
            return false;
        }
        
    }

    public function mail_verify($value='')
    {
       $ids = $this->input->get('rid');
       $email = $this->input->get('client');
       

       $id = urldecode($ids);
        $id = base64_decode($id);

       $insert =  array('email' => $email);

       if($this->M_account->update($insert,$id))
        {
            $this->session->set_flashdata('success', 'Your mail id Updated Successfully 🙂');
        }else{
            $this->session->set_flashdata('error', '😕 Some error occurred. Please try again later');
        }
        redirect('dashboard','refresh');
    }

    public function hrupdate($value='')
    {
        $this->sc_check->limitRequests();

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('name', 'Name', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone Number', 'trim|numeric');
            if ($this->form_validation->run() == true) {
                $insert = array(
                'name'   => $this->input->post('name'),
                'email'  => $this->input->post('email'),
                'mobile' => $this->input->post('phone'),
            );

            if($this->M_account->update($insert, $this->reg))
            {
                $this->session->set_flashdata('success', 'Profile details Updated Successfully 🙂');
            }else{
                $this->session->set_flashdata('error', '😕 Server error occurred. Please try again later');             
            }
             redirect('dashboard','refresh');
            }else{
                $this->form_validation->set_error_delimiters('', '<br>');
                $this->session->set_flashdata('error', str_replace(array("\n", "\r"), '', validation_errors()));
                redirect('dashboard','refresh');
            }
        }else{
            $this->session->set_flashdata('error', '😕 Server error occurred. Please try again later'); 
            redirect('dashboard','refresh');
        }
    }



    

    // update images
    public function industry_doc()
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
                $this->sc_check->sus_mail($this->session->userdata('sinmail'));
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
            $data = array( 'register_doc' => $key.'/'.$upload_data['file_name']);
        }elseif($key == 'pan') {
            $data = array( 'pancard' => $key.'/'.$upload_data['file_name']);
        }elseif($key == 'gst') {
            $data = array( 'gst' => $key.'/'.$upload_data['file_name']);
        }elseif($key == 'seal') {
            $data = array( 'seal' => $key.'/'.$upload_data['file_name']);
        }elseif($key == 'sign') {
            $data = array( 'sign' => $key.'/'.$upload_data['file_name']);
        }
        
        
        if($this->M_account->update($data,  $this->reg)){
            $data = array('status' => 1, 'msg' => 'Document 🙂 Updated Successfully ');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }

    public function changePassword()
    {
        $data['title']  = 'Industry Change Password';
		$this->load->view('account/change-password', $data, FALSE);
    }

    public function checkPassword()
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

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
            	$hash  =  $this->bcrypt->hash_password($this->input->post('npswd'));
                $datas = array('password' => $hash );
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
        }else{
            $this->session->set_flashdata('error', 'Some error occured, please try again!');
            redirect('change-password','refresh');
        }
    }




}

/* End of file Account.php */
