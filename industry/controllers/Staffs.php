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
        if($this->input->post()){
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

        $this->security->xss_clean($_POST);
        $email = $this->input->post('email');
        $output = $this->M_staffs->email_check($email);
        echo  $output;
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

        $this->security->xss_clean($_POST);
        $mobile = $this->input->post('mobile');
        $output = $this->M_staffs->mobile_check($mobile);
        echo  $output;
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

        if($this->M_staffs->stasChange($id,$status)){
            $this->session->set_flashdata('success', 'Staff Blocked Successfully');
        }else{
            $this->session->set_flashdata('Error', 'Something went wrong please try again!');
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
        if($this->M_staffs->stasChange($id,$status)){
            $this->session->set_flashdata('success', 'Staff Unblocked Successfully');
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
        if($this->M_staffs->delete($id)){
            $this->session->set_flashdata('success', 'Staff Deleted Successfully');
        }else{
            $this->session->set_flashdata('error', 'Something went wrong please try again!');
        }
        redirect('staffs','refresh');
    }



}
/* End of file Staffs.php */