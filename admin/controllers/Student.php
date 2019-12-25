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


	public function index()
	{
		$data['title']      = 'Student Management';
		$data['result']= $this->m_student->getStudent();
		echo "<pre>";
		print_r ($data);
		echo "</pre>";
		$this->load->view('student/list.php', $data, FALSE);
	}

}

/* End of file Student.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/controllers/Student.php */