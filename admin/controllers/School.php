<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_school');
        if ($this->session->userdata('said') == '') { $this->session->set_flashdata('error','Please login and try again!'); }
    }

	public function index($id='')
	{
		$data['title']      = 'Institute Management';
		if(!empty($id)){
			$data['result']= $this->m_school->getSchool($id);
			$data['apply']= $this->m_school->getscholar($id);
			$this->load->view('school/detail.php', $data, FALSE);
		}else{
			$data['result']= $this->m_school->getSchool();
			$this->load->view('school/list.php', $data, FALSE);
		}
    }

    	public function block($value='')
    {
        $id = $this->input->post('id');
        $status = '3';
        if($this->m_school->stasChange($id,$status)){
             $data = array('status' => 1, 'msg' => '🙂 Institute Blocked Successfully ');
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
        if($this->m_school->stasChange($id,$status)){
             $data = array('status' => 1, 'msg' => '🙂 Institute Unblocked  Successfully ');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }
    

    public function add($value='')
    {
        $data['title']      = 'Institute Management';
        if(!empty($this->input->post())){
            $insert = array(
                'reg_no'            => $this->input->post('rno'), 
                'school_address'    => $this->input->post('name'), 
                'management_type'   => $this->input->post('mtype'), 
                'school_category'   => $this->input->post('sccat'), 
                'school_type'       => $this->input->post('sctype'), 
                'urban_rural'       => $this->input->post('rural'), 
                'taluk'             => $this->input->post('taluk'), 
                'status'            => '1' , 
            );
            if($this->m_school->add($insert))
            {
                $this->session->set_flashdata('success','institute added Successfully');
                redirect('institute','refresh');
            }else{

                $this->session->set_flashdata('error','Please login and try again!');
                redirect('institutes/edit','refresh');
            }
        }else{
            $data['taluk'] = $this->m_school->getTalluk();
            $data['district'] = $this->m_school->getDistrict();
            $this->load->view('school/add', $data, FALSE);
        }
    }

}