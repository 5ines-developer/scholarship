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
		if($this->input->post('terms') == 'true'){ $terms = 1; }
    	$apply = array(
    		'application_year' 	=> date('Y') , 
    		'Student_id' 		=> $this->stid , 
    		'school_id' 		=> $this->input->post('iname') , 
    		'company_id' 		=> $this->input->post('inname') , 
    		'uniq' 				=> random_string('alnum',10) , 
    		'terms ' 			=>  $terms, 
    	);

    	$output = $this->m_stdapplication->insertAppli($apply);

    	if (!empty($output)) {
    		if($this->applicantBasic($this->input->post(),$output))
	    	{
				if($this->applicantAccount($this->input->post(),$output))
				{
					if($this->applicantCompany($this->input->post(),$output))
					{
						if($this->applicantSchool($this->input->post(),$output))
						{
							echo $output = 1;
						}
					}
				}
	    	}
    	}

    	


    }


    public function applicantBasic($data='',$apid='')
    {
    	$this->load->library('upload');
    	$files = $_FILES;
    	if (file_exists($_FILES['cfile']['tmp_name'])) {
    		$config['upload_path'] = 'student-cast/';
    		$config['allowed_types'] = 'jpg|png|jpeg|pdf|doxc';
	        $config['max_width'] = 0;
	        $config['encrypt_name'] = true;
	        $this->upload->initialize($config);
	        if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
	        $this->upload->do_upload('cfile');
	        $upload_data = $this->upload->data();
	        $cast = 'student-cast/'.$upload_data['file_name'];
	    }

	    if (file_exists($_FILES['axerox']['tmp_name'])) {
    		$config['upload_path'] = 'student-adhar/';
    		$config['allowed_types'] = 'jpg|png|jpeg|pdf|doxc';
	        $config['max_width'] = 0;
	        $config['encrypt_name'] = true;
	        $this->upload->initialize($config);
	        if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
	        $this->upload->do_upload('axerox');
	        $upload_data = $this->upload->data();
	        $adhar = 'student-adhar/'.$upload_data['file_name'];
	    }

    	$insert = array(
    		'application_id'=> $apid, 
    		'name ' 		=> $this->input->post('sname'), 
    		'father_name' 	=> $this->input->post('sfather'), 
    		'mothor_name' 	=> $this->input->post('smother'), 
    		'address' 		=> $this->input->post('saddress'), 
    		'parent_phone' 	=> $this->input->post('sphone'), 
    		'is_scst' 		=> $this->input->post('clow'), 
    		'adharcard_no' 		=> $this->input->post('anumber'), 
    	);
    	if (!empty($cast)) { $insert['cast_certificate'] = $cast; } 
    	if (!empty($adhar)) { $insert['adharcard_file'] = $adhar; }

    	$output = $this->m_stdapplication->aplliBasic($insert); 

    	if (!empty($output)) {
    		return true;
    	}else{
    		return false;
    	}
    }


    public function applicantAccount($data='',$apid='')
    {
    	$insert = array(
    		'application_id'=> $apid, 
    		'name ' 		=> $this->input->post('bname'), 
    		'branch' 		=> $this->input->post('branch'), 
    		'ifsc' 			=> $this->input->post('bifsc'), 
    		'acc_no' 		=> $this->input->post('baccount'), 
		);
		
		if (file_exists($_FILES['bpassbook']['tmp_name'])) {
    		$config['upload_path'] = 'student-passbook/';
    		$config['allowed_types'] = 'jpg|png|jpeg|pdf|doxc';
	        $config['max_width'] = 0;
	        $config['encrypt_name'] = true;
	        $this->upload->initialize($config);
	        if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
	        $this->upload->do_upload('bpassbook');
	        $upload_data = $this->upload->data();
			$pass = 'student-passbook/'.$upload_data['file_name'];			
			$insert['passbook'] = $pass;
		}
		
		$output = $this->m_stdapplication->applicantAccount($insert);
		if (!empty($output)) {
    		return true;
    	}else{
    		return false;
    	} 
	}
	
	public function applicantCompany($data='',$apid='')
	{
		$insert = array(
    		'application_id'=> $apid, 
    		'who_working  ' 		=> $this->input->post('incard'), 
    		'name' 					=> $this->input->post('inpname'), 
    		'relationship' 			=> $this->input->post('inrelation'), 
    		'msalary' 				=> $this->input->post('insalary'), 
    		'pincode' 				=> $this->input->post('inpin'), 
    		'talluk' 				=> $this->input->post('intalluk'), 
    		'district' 				=> $this->input->post('indistrict'), 
    		'ind_address' 			=> $this->input->post('inaddress'), 
		);
		$output = $this->m_stdapplication->applicantCompany($insert);
		if (!empty($output)) {
    		return true;
    	}else{
    		return false;
    	} 
	}

	public function applicantSchool($data='',$apid='')
	{
		$insert = array(
    		'application_id'=> $apid, 
    		'class  ' 		=> $this->input->post('ipclass'), 
    		'ins_pin' 		=> $this->input->post('ipin'), 
    		'ins_talluk' 	=> $this->input->post('italluk'), 
    		'ins_district' 	=> $this->input->post('idistrict'), 
    		'prv_class' 	=> $this->input->post('pclass'), 
    		'prv_marks' 	=> $this->input->post('pmarks'), 
		);

		if (file_exists($_FILES['bpassbook']['tmp_name'])) {
    		$config['upload_path'] = 'student-passbook/';
    		$config['allowed_types'] = 'jpg|png|jpeg|pdf|doxc';
	        $config['max_width'] = 0;
	        $config['encrypt_name'] = true;
	        $this->upload->initialize($config);
	        if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
	        $this->upload->do_upload('bpassbook');
	        $upload_data = $this->upload->data();
			$pass = 'student-passbook/'.$upload_data['file_name'];			
			$insert['prv_markcard'] = $pass;
		}

		$output = $this->m_stdapplication->applicantSchool($insert);
		if (!empty($output)) {
    		return true;
    	}else{
    		return false;
    	} 
	}


    /**
    * student application - fetch the application detail
    * @url      : student/application-detail
    * @param    : null
    * @data     : student application data,
    **/
    public function viewApplication($value='')
    {
        # code...
    }

}

/* End of file Std_application.php */
/* Location: ./application.php */