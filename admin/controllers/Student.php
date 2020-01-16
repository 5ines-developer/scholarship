<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_student');
        if ($this->session->userdata('said') == '') { $this->session->set_flashdata('error','Please login and try again!'); }
    }


	public function index($id='')
	{
		$data['title']      = 'Student Management';
		$year = $this->input->get('year');
		if(!empty($id)){
			$data['result']= $this->m_student->getStudent($year,$id);
			$data['apply']= $this->m_student->getscholar($id);
			$this->load->view('student/detail.php', $data, FALSE);
		}else{
			$data['result']= $this->m_student->getStudent($year);
            $data['count'] = $this->m_student->stdcount($year);
			$this->load->view('student/list.php', $data, FALSE);
		}
	}

	public function block($value='')
    {
        $id = $this->input->post('id');
        $status = '2';
        if($this->m_student->stasChange($id,$status)){
             $data = array('status' => 1, 'msg' => '🙂 Student Blocked Successfully ');
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
        if($this->m_student->stasChange($id,$status)){
             $data = array('status' => 1, 'msg' => '🙂 Student Unblocked  Successfully ');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }

}

/* End of file Student.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/controllers/Student.php */