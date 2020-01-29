<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_employee');
        if($this->session->userdata('said') == ''){ redirect('/','refresh'); }
    }

    public function index()
    {
        $data['title'] = 'Employee List | Scholarship';
        $data['result'] = $this->M_employee->getEmployee();
        $this->load->view('employee/list', $data, FALSE);
    }

    public function add($var = null)
    {
       
        $data['title'] = 'Employee Add | Scholarship';
        if($this->input->post()){
            $this->load->helper('string');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<p class="red-text">', '</p>');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[admin.email]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_unique[admin.phone]');
            if ($this->form_validation->run() == True){
                $name   = $this->input->post('em_name', true);
                $email  = $this->input->post('email', true);
                $phone  = $this->input->post('phone', true);
                $desig  = $this->input->post('designation', true);
                $data   = array(
                    'email'         => $email, 
                    'phone'         => $phone, 
                    'created_by'    => $this->session->userdata('said'), 
                    'ref_link'      => random_string('alnum', 40), 
                    'name'          => $name, 
                    'type'          => $desig, 
                    'otp'           => date('sm'), 
                );
                if($this->M_employee->addEmp($data)){
                    $this->sendActivation($data);
                    $this->session->set_flashdata('success', 'New staff addedd successfully. <br> Activation link send to mail');
                }
                else{
                    $this->session->set_flashdata('error', 'Server error occurred. <br>Please try agin later');
                }
            }
            $this->load->view('employee/add', $data, false);
        }else{
            $this->load->view('employee/add', $data, false);
        }
    }

    // Send activation
    public function sendActivation($insert = null)
    {
        $data['email'] = $insert['email'];
        $data['regid'] = $insert['ref_link'];
        $data['name'] = $insert['name'];
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        if ($insert['type'] == '3') {
            $msg = $this->load->view('mail/finance-register', $data, true);
        }else if ($insert['type'] == '2') {
            $msg = $this->load->view('mail/reg-verify', $data, true);
        }

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

    public function edit($id='')
    {
        $data['title'] = 'Employee List | Scholarship';
        $data['result'] = $this->M_employee->singleEmployee($id);
        $this->load->view('employee/edit', $data, FALSE);
    }


    public function block($value='')
    {
        $id = $this->input->get('id');
        $status = '2';

        if($this->M_employee->stasChange($id,$status)){
            $this->session->set_flashdata('success', 'Employee Blocked Successfully');
        }else{
            $this->session->set_flashdata('Error', 'Something went wrong please try again!');
        }
       redirect('employee','refresh');
    }

    public function unblock($value='')
    {
        $id = $this->input->get('id');
        $status = '1';
        if($this->M_employee->stasChange($id,$status)){
            $this->session->set_flashdata('success', 'Employee Unblocked Successfully');
        }else{
            $this->session->set_flashdata('error', 'Something went wrong please try again!');
        }
        redirect('employee','refresh');
    }



}

/* End of file Employee.php */
