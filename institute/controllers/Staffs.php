<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staffs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_staffs');
        if($this->session->userdata('scinst') == ''){ redirect('/','refresh'); }
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
            $name   = $this->input->post('name', true);
            $email  = $this->input->post('email', true);
            $phone  = $this->input->post('phone', true);
            $data   = array(
                'email'         => $email, 
                'phone'         => $phone, 
                'school_id'     => $this->session->userdata('school'), 
                'created_by'    => $this->session->userdata('scinst'), 
                'ref_id'        => random_string('alnum', 40), 
                'name'          => $name, 
                'otp'           => date('sm'), 
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

        // Send activation
    public function sendActivation($insert = null)
    {
        $data['email'] = $insert['email'];
        $data['regid'] = $insert['ref_id'];
        $data['team'] = 'Team';
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/reg-verify', $data, true);
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
    public function pdfTest()
    {
        $this->load->library('pdf');
        $this->pdf->load_view('dashboard/pdf');
        $this->pdf->setPaper('A5', 'portrait');
        $this->pdf->render();
        $output = $this->pdf->output();
        if (!file_exists('temp')) { mkdir('temp', 0777, true); }
        $created = file_put_contents('temp/application.pdf', $output);
    }

    public function mpdf()
    {
        //     load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
       // retrieve data from model
        
        $data['title'] = "items";
        ini_set('memory_limit', '256M'); 
       // boost the memory limit if it's low ;)
        $html = $this->load->view('dashboard/pdf', $data, true);
       // render the view into HTML
        $pdf->WriteHTML($html); // write the HTML into the PDF
        $output = 'itemreport' . date('Y_m_d_H_i_s') . '_.pdf';
        $pdf->Output("$output", 'I'); // save to file because we can
        exit();
    }


    public function block($value='')
    {

            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->security->xss_clean($_GET);

        $id = $this->input->get('id');
        $status = '3';

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

}
/* End of file Staffs.php */