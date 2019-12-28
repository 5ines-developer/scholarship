<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Std_application extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
        //Do your magic here
        if ($this->session->userdata('stlid') == '') { $this->session->set_flashdata('error','Please login and try again!'); redirect('student/login','refresh'); } 
        $this->load->model('m_stdapplication');
		$this->sid = $this->session->userdata('stlid');
		$this->slmail = $this->session->userdata('slmail');
		$this->check = $this->m_stdapplication->checkApply($this->sid);
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
		$item = $this->input->get('item');		
		if (!empty($this->check) && (!empty($item)) ) {
			$this->load->view('student/re_application', $data, FALSE);
		}else if(!empty($this->check)  ){
			$this->session->set_flashdata('error', 'You have already applied to the scholarsip this year.');			
			redirect('student/application-status','refresh');
		}else{
			$this->load->view('student/application', $data, FALSE);
		}
	}

	public function appliGet($value='')
	{
		$data = $this->m_stdapplication->getApplication($this->sid);
		echo json_encode($data);
	}

	/**
    * student application - get district
    * @url      : student/application
    * @param    : null
    * @data     : null,
    **/
	public function district(Type $var = null)
	{
		$district = $this->m_stdapplication->getDistrict();
		echo json_encode($district);
	}

	public function tallukget(Type $var = null)
	{
		$id = $this->input->get('id');
		$talluk = $this->m_stdapplication->getTalluk($id);
		echo json_encode($talluk);
	}

	public function schoolget(Type $var = null)
	{
		$id = $this->input->get('id');
		$School = $this->m_stdapplication->getSchool($id);
		echo json_encode($School);
	}


	public function industryget($value='')
	{
		$id = $this->input->get('id');
		$data = $this->m_stdapplication->getCompany();
		echo json_encode($data);
	}

	public function garduation($value='')
	{
		$data = $this->m_stdapplication->garduation();
		echo json_encode($data);
	}

	public function courseGet($value='')
	{
		$id = $this->input->get('id');
		$data = $this->m_stdapplication->courseGet($id);
		echo json_encode($data);
	}

	public function classGet($value='')
	{
		$id = $this->input->get('id');
		$data = $this->m_stdapplication->classGet($id);
		echo json_encode($data);
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

		if(($this->input->post('clow') == '') && ($this->input->post('pmarks') < 50)){ echo 'error'; die(); }
		if(($this->input->post('clow') != '') && ($this->input->post('pmarks') < 45)){ echo 'error'; die(); }
    	$apply = array(
    		'application_year' 	=> date('Y') , 
    		'Student_id' 		=> $this->sid , 
    		'school_id' 		=> $this->input->post('iname') , 
    		'company_id' 		=> $this->input->post('inname') , 
    		'uniq' 				=> random_string('alnum',10) , 
    		'application_state '=> '1', 
		);
		
		if (!empty($this->input->post('aid'))) {
			$apply['status'] = '0';
		}

		$result = $this->m_stdapplication->insertAppli($apply);

		
		$output = '';
    	if (!empty($result)) {
    		if($this->applicantBasic($this->input->post(),$result))
	    	{
				if($this->applicantAccount($this->input->post(),$result))
				{
					if($this->applicantCompany($this->input->post(),$result))
					{
						if($this->applicantSchool($this->input->post(),$result))
						{
							$this->studentMail($this->input->post(),$result);
							$this->studentSms($this->input->post(),$result);
							$output = 1;
						}
					}
				}
	    	}
		}
		echo $output;

    	


    }


    public function applicantBasic($data='',$apid='')
    {

    	$this->load->library('upload');
    	$files = $_FILES;
    	if (($this->input->post('clow') == '') &&  (empty($_FILES['cfile']['tmp_name'])) ) {
		}else{
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
		
		if (empty($_FILES['axerox']['tmp_name'])) {
		}else{
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
    		'adharcard_no' 	=> $this->input->post('anumber'), 
            'gender'        => $this->input->post('gender'),
            'cast_no'        => $this->input->post('cnumber'),
    	);
    	if (!empty($cast)) { $insert['cast_certificate'] = $cast; } 
		if (!empty($adhar)) { $insert['adharcard_file'] = $adhar; }

		if (!empty($insert['is_scst'])) {
			$insert['category'] = $this->input->post('tcat');
		}else{
			$insert['category'] = $this->input->post('gcat');
		}

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
    		'type' 			=> $this->input->post('btype'), 
    		'holder' 		=> $this->input->post('bholder'), 
		);
		
		if (empty($_FILES['bpassbook']['tmp_name'])) {
		}else{
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
    		'ins_pin' 		=> $this->input->post('ipin'), 
    		'ins_talluk' 	=> $this->input->post('italluk'), 
    		'ins_district' 	=> $this->input->post('idistrict'), 
    		'prv_class' 	=> $this->input->post('pclass'), 
    		'prv_marks' 	=> $this->input->post('pmarks'), 
    		'graduation' 	=> $this->input->post('igrad'), 
    		'course' 		=> $this->input->post('icourse'), 
		);

		if ($insert['graduation'] != '1') {
			$insert['class'] = $this->input->post('ipclass');
		}



		if (empty($_FILES['pcard']['tmp_name'])) {
		}else{
    		$config['upload_path'] = 'student-marks/';
    		$config['allowed_types'] = 'jpg|png|jpeg|pdf|doxc';
	        $config['max_width'] = 0;
	        $config['encrypt_name'] = true;
	        $this->upload->initialize($config);
	        if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
	        $this->upload->do_upload('pcard');
	        $upload_data = $this->upload->data();
			$pass = 'student-marks/'.$upload_data['file_name'];			
			$insert['prv_markcard'] = $pass;
		}

		$output = $this->m_stdapplication->applicantSchool($insert);
		if (!empty($output)) {
    		return true;
    	}else{
    		return false;
    	} 
	}


	public function studentMail($data='',$apid='')
	{
		
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
		$msg = $this->load->view('email/stdapplication', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($this->slmail);
        $this->email->subject('Application Confirmation'); 
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

	public function studentSms($data='', $apid='')
    {
		$phone = $this->input->post('sphone');
		$msg = 'You have been succesfully applied to the Karnataka Labour Welfare Board Scholarship, we will notify the status via sms';
        /* API URL */
        $url = 'http://trans.smsfresh.co/api/sendmsg.php';
        $param = 'user=5inewebsolutions&pass=5ine5ine&sender=PROPSB&phone=' . $phone . '&text=' . $msg . '&priority=ndnd&stype=normal';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }


    /**
    * student application - fetch the application detail
    * @url      : student/application-detail
    * @param    : null
    * @data     : student application data,
    **/
    public function getApplication($value='')
    {

    	if(empty($this->check)){
    		$this->session->set_flashdata('error', 'You have not applied the scholarship.');			
			redirect('student/application','refresh');

    	}else{
    		$data['title']  	= 'Student Application';
	  	 	$data['result'] = $this->m_stdapplication->getApplication($this->sid);
	   		$this->load->view('student/application-detail', $data, FALSE);
    	}
		
	}
	
	/**
    * student application - get the status
    * @url      : student/application-status
    * @param    : null
    * @data     : student application data,
	**/
	public function getStatus($var = null)
	{
		$data['title']  	= 'Student Application';
		$data['result'] = $this->m_stdapplication->getStatus($this->sid);
		$this->load->view('student/application-status', $data, FALSE);
	}


	   // taluk filter based on selected district
    public function talukFilter()
    {
        $district = $this->input->get('filter');
        $result = $this->m_stdapplication->getTalukFiletr($district);
        echo json_encode($result);
    }


}

/* End of file Std_application.php */
/* Location: ./application.php */