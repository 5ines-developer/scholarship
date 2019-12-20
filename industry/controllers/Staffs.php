<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staffs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_staffs');
        if($this->session->userdata('scinds') == ''){ redirect('/','refresh'); }
        if ($this->session->userdata('scctype') != '1') { redirect('dashboard','refresh');  }
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
        $data['title'] = 'Add Verification staffs';
        $this->load->helper('string');
        if($this->input->post()){
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
        }   
        $this->load->view('staffs/add', $data, FALSE);
    }

    /**
     * industry staffs add-> email check exist
     * url : staff/create
    **/
    public function emailcheck($value='')
    {
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
        $id = $this->input->post('id');
        $status = '2';

        if($this->M_staffs->stasChange($id,$status)){
             $data = array('status' => 1, 'msg' => '🙂 Staff Blocked Successfully ');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }

    public function unblock($value='')
    {
        $id = $this->input->post('id');
        $status = '1';
        if($this->M_staffs->stasChange($id,$status)){
             $data = array('status' => 1, 'msg' => '🙂 Staff Unblocked  Successfully ');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }



}
/* End of file Staffs.php */