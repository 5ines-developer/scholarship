<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Std_application extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if ($this->session->userdata('stlid') == '') { $this->session->set_flashdata('error','Please login and try again!'); redirect('student/login','refresh'); } 
        $this->load->model('m_stdapplication');
        $this->stid = $this->session->userdata('stlid');
        $this->sid = $this->session->userdata('stlid');
    }

	/**
    * student application - load view
    * @url      : student/application
    * @param    : null
    * @data     : null,
    **/
	public function index()
	{
		$data['title']  	= 'Student Application';
		$data['talluk'] 	= $this->m_stdapplication->getTalluk();
		$data['district'] 	= $this->m_stdapplication->getDistrict();
		$data['school'] 	= $this->m_stdapplication->getSchool();
		$data['company'] 	= $this->m_stdapplication->getCompany();
		$this->load->view('student/application', $data, FALSE);
	}

	/**
    * student application - insert application
    * @url      : student/submit-application
    * @param    : null
    * @data     : student application data,
    **/
    public function insertAppli($value='')
    {

    	$input = $this->input->post();
    	$apply = array(
    		'application_year' 	=> date('Y') , 
    		'Student_id' 		=> $this->stid , 
    		'school_id' 		=> $this->input->post('pr_insti') , 
    		'company_id' 		=> $this->input->post('id_name') , 
    		'uniq' 				=> $this->input->post('uniq') , 
    	);

    	$output = $this->m_stdapplication->insertAppli($apply);

    	if (!empty($output)) {
    		if($this->applicantBasic($input,$output))
	    	{
	    		$this->applicantCompany($input,$output);
	    		echo "<pre>";
	    		print_r ($input);
	    		echo "</pre>";exit();
	    	}
    	}

    	


    }


    public function applicantBasic($data='',$apid='')
    {
    	$this->load->library('upload');
    	$files = $_FILES;
    	if (file_exists($_FILES['std_castfile']['tmp_name'])) {
    		$config['upload_path'] = 'student-cast/';
    		$config['allowed_types'] = 'jpg|png|jpeg|pdf|doxc';
	        $config['max_width'] = 0;
	        $config['encrypt_name'] = true;
	        $this->upload->initialize($config);
	        if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
	        $this->upload->do_upload('std_castfile');
	        $upload_data = $this->upload->data();
	        $cast = 'student-cast/'.$upload_data['file_name'];
	    }

	    if (file_exists($_FILES['adhar']['tmp_name'])) {
    		$config['upload_path'] = 'student-adhar/';
    		$config['allowed_types'] = 'jpg|png|jpeg|pdf|doxc';
	        $config['max_width'] = 0;
	        $config['encrypt_name'] = true;
	        $this->upload->initialize($config);
	        if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
	        $this->upload->do_upload('adhar');
	        $upload_data = $this->upload->data();
	        $adhar = 'student-adhar/'.$upload_data['file_name'];
	    }

    	$insert = array(
    		'application_id'=> $apid, 
    		'name ' 		=> $this->input->post('s_name'), 
    		'father_name' 	=> $this->input->post('s_father'), 
    		'mothor_name' 	=> $this->input->post('s_mother'), 
    		'address' 		=> $this->input->post('s_address'), 
    		'parent_phone' 	=> $this->input->post('s_phone'), 
    		'pincode' 		=> $this->input->post('s_name'), 
    		'is_scst' 		=> $this->input->post('std_cast'), 
    		'adharcard_no' 		=> $this->input->post('adhar_no'), 
    	);
    	if (!empty($cast)) {$insert['cast_certificate'] = $cast; } 
    	if (!empty($adhar)) {$insert['adharcard_file'] = $adhar; }

    	$output = $this->m_stdapplication->aplliBasic($insert); 

    	if (!empty($output)) {
    		return true;
    	}else{
    		return false;
    	}
    }


    public function applicantCompany($data='',$apid='')
    {
    	array(
    		'application_id' 	=> $apid, 
    		'who_working ' 		=> $this->input->post('in_group'), 
    		'name' 				=> $this->input->post('id_pname'), 
    		'vages' 			=> $this->input->post('id_msal'), 
    	);
    }

}

/* End of file Std_application.php */
/* Location: ./application.php */