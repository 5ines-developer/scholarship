<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scholar extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_scholar');
        $this->load->model('m_scholar');
        if ($this->session->userdata('sgt_id') == '') { $this->session->set_flashdata('error','Please login and try again!'); redirect('/','refresh'); }
        $this->load->library('sess_log');
        $this->sess_log->check_auth($this->session->userdata('sgt_id'));
    }

    public function index($district='')
    {
        $dist = $this->input->get('district');
        if (!empty($dist)) {
            $district = $this->m_scholar->distGet($dist);
        }
        $data['title'] = 'Scholarship List';
        $data['district'] = $this->m_scholar->getDistrict();
        $data['taluk'] = $this->m_scholar->getTalluk($district);
        $data['count'] = $this->m_scholar->scholarcount();
        $this->load->view('scholar/list', $data, FALSE);        
    }

    public function allApplication($value='')
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        $filt['year']   = $this->input->post('year');
        $dist           = $this->input->post('district');
        $tal            = $this->input->post('taluk');
        $filt['caste']  = $this->input->post('caste');
        $filt['item']  = $this->input->post('item');

        if (!empty($dist)) {
            $filt['district'] = $this->m_scholar->distGet($dist);
        }

        if (!empty($tal)) {
            $filt['taluk'] = $this->m_scholar->talGet($tal);
        }
        
        $fetch_data   = $this->m_scholar->make_datatables($filt);
        $data = array();
        foreach($fetch_data as $row)  
        {  


            $btn = '<a href="'.base_url('applications/detail/').urlencode(base64_encode($row->id)).'" class="vie-btn blue-text waves-effect waves-light"> View</a>';

            if($row->application_state == 3){
                $state = 'Verification Officer';
            }else if ($row->application_state == 2) {
                $state = 'Industry';
            }else if ($row->application_state == 1) {
                $state = 'Institute';
            }else{
                $state = 'Admin';
            }

            if ($row->status == 2) {
                $sttus = 'Rejected By';
                $color = 'red';
            }else if ($row->status == 1) {
                $sttus = 'Approved By';
                $color = 'green';
            }else{
                $sttus = 'Pending From';
                 $color = 'blue';
            }
            $status =  '<p class="status '.$color.' darken-2">'.$sttus.' '.$state.'</p>';

            $sub_array = array();
            $sub_array[] = $row->name;
            $sub_array[] = character_limiter($row->school, 10);
            $sub_array[] = character_limiter($row->industry, 10);  
            $sub_array[] = $row->course.'-'.$row->clss;
            $sub_array[] = $row->application_year;  
            $sub_array[] = $row->adharcard_no;  
            $sub_array[] = $this->m_scholar->getamnt($row->application_year,$row->graduation);  
            $sub_array[] = date('d M, Y',strtotime($row->date));  
            $sub_array[] = $row->district;  
            $sub_array[] = $row->taluk;  
            $sub_array[] = $status;  
            $sub_array[] = $btn;  

            $data[] = $sub_array;  
        }

        $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>      $this->m_scholar->get_all_data(),  
            "recordsFiltered"     =>     $this->m_scholar->get_filtered_data(),  
            "data"                =>     $data  
        );
        echo json_encode($output);
    }


    // single student data
    public function singleGet($id = null)
    {
        $id =urldecode(base64_decode($id));
        $data['title'] = 'Scholarship Details';
        $data['result'] = $this->m_scholar->singleGet($id);
        $this->load->view('scholar/application', $data, FALSE);
    }

        // approve application
    public function approve($id = null,$msg='')
    {

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        
        $id = $this->input->post('id');
        if($this->m_scholar->approval($id)){
            $data = array('status' => 1, 'msg' => 'Scholarship Approved successfully.');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => 'Server error occurred. Please try again');
        }
        echo json_encode($data);
    }

        // Reject 
    public function reject()
    {

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

       $id = $this->input->post('id');
       $data = array(
           'reject_reason' => $this->input->post('reason'),
           'status' => 2,
        );
        if($this->m_scholar->reject($data, $id)){
            $this->session->set_flashdata('success', 'Application rejected Successfully');
            redirect('applications?item=rejected','refresh');
        }else{
            $this->session->set_flashdata('error', 'Server error occurred.<br> Please try agin later');
            redirect('applications/detail/'.$id,'refresh');
        }
    }
}