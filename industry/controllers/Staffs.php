<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staffs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_staffs');
        if($this->session->userdata('scinds') == ''){ redirect('/','refresh'); }
        if ($this->session->userdata('scctype') != '1') { redirect('dashboard','refresh');  }
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
        header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
        
    }

    public function index()
    {
        $data['title'] = 'Manage Staffs';
        $data['staffs'] = $this->M_staffs->lists();
        $this->load->view('staffs/list', $data);
    }

    // create employee
    public function create($var = null)
    {

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        $data['title'] = 'Add Verification staffs';
        $this->load->helper('string');
        if(!empty($this->input->post())){
            $this->sc_check->limitRequests();
            $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|numeric|max_length[10]|min_length[10]');
            if ($this->form_validation->run() == true) {

                $name   = $this->input->post('name', true);
                $email  = $this->input->post('email', true);
                $phone  = $this->input->post('phone', true);
                $data   = array(
                    'email'         => $email, 
                    'mobile'         => $phone, 
                    'industry_id'   => $this->session->userdata('sccomp'), 
                    'created_by'    => $this->session->userdata('scinds'), 
                    'ref_id'        => random_string('alnum', 40), 
                    'name'          => $name, 
                    'type'          => 2,
                );
                if($this->M_staffs->addEmp($data)){
                    $this->sendActivation($data);
                    $this->session->set_flashdata('success', 'New staff addedd successfully. <br> Activation link send to mail');
                }
                else{
                    $this->session->set_flashdata('error', 'Server error occurred. <br>Please try agin later');
                }
            }else{
                $this->session->set_flashdata('error', 'Server error occurred. <br>Please try agin later');
            }
        }   
        $this->load->view('staffs/add', $data, FALSE);
    }

    /**
     * industry staffs add-> email check exist
     * url : staff/create
    **/
    public function emailcheck($value='')
    {

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $this->input->post('email');
            $output = $this->M_staffs->email_check($email);
            echo  $output;
        }else{
            echo null;
        }
    }

    /**
     * industry staffs add-> mobile check exist
     * url : staff/create
    **/
    public function mobile_check($value='')
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mobile = $this->input->post('mobile');
            $output = $this->M_staffs->mobile_check($mobile);
            echo  $output;
        }else{
            echo null;
        }
    }
        // Send activation
    public function sendActivation($insert = null)
    {
        $data['email'] = $insert['email'];
        $data['regid'] = $insert['ref_id'];
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/staff-reg-verify', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($data['email']);
        $this->email->subject('Verification staff activation'); 
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

    public function block($value='')
    {

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_GET);

        $id = $this->input->get('id');
        $status = '2';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if($this->M_staffs->stasChange($id,$status)){
                $this->session->set_flashdata('success', 'Staff Blocked Successfully');
            }else{
                $this->session->set_flashdata('error', 'Something went wrong please try again!');
            }
        }else{
            $this->session->set_flashdata('error', 'Some error occured, please try again!');
        }
       redirect('staffs','refresh');
    }

    public function unblock($value='')
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_GET);

        $id = $this->input->get('id');
        $status = '1';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if($this->M_staffs->stasChange($id,$status)){
                $this->session->set_flashdata('success', 'Staff Unblocked Successfully');
            }else{
                $this->session->set_flashdata('error', 'Something went wrong please try again!');
            }
        }else{
            $this->session->set_flashdata('error', 'Something went wrong please try again!');
        }   
        redirect('staffs','refresh');
    }

    public function delete($value='')
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_GET);

        $id = $this->input->get('id');
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if($this->M_staffs->delete($id)){
                $this->session->set_flashdata('success', 'Staff Deleted Successfully');
            }else{
                $this->session->set_flashdata('error', 'Something went wrong please try again!');
            }
        }else{
            $this->session->set_flashdata('error', 'Some error occured, please try again!');
        }
        redirect('staffs','refresh');
    }



}
/* End of file Staffs.php */