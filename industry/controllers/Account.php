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
    }

    public function index()
    {
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
        $mobile =  $this->input->post('mobile');
        $output = $this->M_account->mobile_check($mobile);
        echo  $output;
    }

    public function inmobile_check($value='')
    {
        $mobile =  $this->input->post('mobile');
        $output = $this->M_account->inmobile_check($mobile);
        echo  $output;
    }

    public function emailcheck($value='')
    {
        $this->security->xss_clean($_POST);
        $email = $this->input->post('email');
        $output = $this->M_account->email_check($email);
        echo  $output;
    }

    public function update()
    {
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
                $this->session->set_flashdata('success', 'Your Profile has been updated <br> Please check your mail to verify the Email Id 🙂');
            }else{
                $this->session->set_flashdata('success', 'Profile details Updated Successfully 🙂');
            }
            
        }else{
            $this->session->set_flashdata('error', '😕 Server error occurred. Please try again later');             
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
       $id = urldecode(base64_decode($ids));

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
    }



    

    // update images
    public function industry_doc()
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
            $data = array( 'register_doc' => $key.'/'.$upload_data['file_name']);
        }elseif($key == 'pan') {
            $data = array( 'pancard' => $key.'/'.$upload_data['file_name']);
        }else{
            $data = array( 'gst' => $key.'/'.$upload_data['file_name']);
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
        $output = $this->M_account->checkpsw($this->input->post('crpass'));
        echo $output;
    }

    // update password
    public function update_password()
    {
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
    }

}

/* End of file Account.php */
