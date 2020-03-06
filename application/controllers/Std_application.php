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
		$this->load->library('sc_check'); 
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
			$data['scholls'] = $this->m_stdapplication->getscholls($item); //get current institution details
			$this->load->view('student/re_application', $data, FALSE);
		}else if(!empty($this->check)  ){
			$this->session->set_flashdata('error', 'You have already applied to the scholarship this year.');			
			redirect('student/application-status','refresh');
		}else{
			$this->load->view('student/application', $data, FALSE);
		}
	}

	public function lastData($value='')
	{
		$data = $this->m_stdapplication->getlastData($this->sid);
		echo json_encode($data);
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

	public function schoolget($var = null)
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

	public function adharcheck($value='')
	{
		$adhar = $this->input->get('adhar');
		$data = $this->m_stdapplication->adharcheck($adhar);
		echo json_encode($data);
	}

	public function adharcheckf($value='')
	{
		$adhar = $this->input->get('adharf');
		$data = $this->m_stdapplication->adharcheckf($adhar);
		echo json_encode($data);
	}


	public function adharcheckm($value='')
	{
		$adhar = $this->input->get('adharm');
		$data = $this->m_stdapplication->adharcheckm($adhar);
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
    	foreach ($_FILES as $key => $value) {
           $fl =  explode('.', $value['name']);
           if($fl[1] !='png' && $fl[1] !='pdf' && $fl[1] !='jpg' && $fl[1] !='jpeg'){
                $this->sc_check->sus_mail($this->session->userdata('slmail'));
                die();
           }
        }

		$input = $this->input->post();
		if(($this->input->post('clow') == '') && ($this->input->post('pmarks') < 50)){ echo 'error'; die(); }
		if(($this->input->post('clow') != '') && ($this->input->post('pmarks') < 45)){ echo 'error'; die(); }
    	$apply = array(
    		'application_year' 	=> date('Y') , 
    		'Student_id' 		=> $this->sid , 
    		'uniq' 				=> random_string('alnum',10) , 
    		'application_state '=> '1', 
		);
		
		if (!empty($this->input->post('aid'))) {
			$apply['status'] = '0';
		}

		if ($this->input->post('iname') != 'undefined') {
			$apply['school_id'] =$this->input->post('iname');
		}

		if ($this->input->post('inname') != 'undefined') {
			$apply['company_id'] =$this->input->post('inname');
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

	    if (empty($_FILES['axeroxm']['tmp_name'])) {
		}else{
    		$config['upload_path'] = 'father-adhar/';
    		$config['allowed_types'] = 'jpg|png|jpeg|pdf|doxc';
	        $config['max_width'] = 0;
	        $config['encrypt_name'] = true;
	        $this->upload->initialize($config);
	        if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
	        $this->upload->do_upload('axeroxm');
	        $upload_data = $this->upload->data();
	        $adharm = 'father-adhar/'.$upload_data['file_name'];
	    }

	    if (empty($_FILES['axeroxf']['tmp_name'])) {
		}else{
    		$config['upload_path'] = 'mother-adhar/';
    		$config['allowed_types'] = 'jpg|png|jpeg|pdf|doxc';
	        $config['max_width'] = 0;
	        $config['encrypt_name'] = true;
	        $this->upload->initialize($config);
	        if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
	        $this->upload->do_upload('axeroxf');
	        $upload_data = $this->upload->data();
	        $adharf = 'mother-adhar/'.$upload_data['file_name'];
	    }

    	$insert = array(
    		'application_id'=> $apid, 
    		'name ' 		=> $this->input->post('sname'), 
    		'father_name' 	=> $this->input->post('sfather'), 
    		'mothor_name' 	=> $this->input->post('smother'), 
    		'address' 		=> $this->input->post('saddress'), 
    		'parent_phone' 	=> $this->input->post('sphone'), 
    		'is_scst' 		=> $this->input->post('clow'), 
    		'adharcard_no' 	=> trim($this->input->post('anumber')), 
    		'f_adhar' 		=> trim($this->input->post('anumberf')), 
    		'm_adhar' 		=> trim($this->input->post('anumberm')), 
            'gender'        => $this->input->post('gender'),
            'cast_no'       => $this->input->post('cnumber'),
    	);
    	if (!empty($cast)) { $insert['cast_certificate'] = $cast; } 
		if (!empty($adhar)) { $insert['adharcard_file'] = $adhar; }
		if (!empty($adharf)) { $insert['f_adharfile'] = $adharf; }
		if (!empty($adharm)) { $insert['m_adharfile'] = $adharm; }

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
		);

		if ($this->input->post('intalluk') != 'undefined') {
			$insert['talluk'] = $this->input->post('intalluk');
		}
		if ($this->input->post('indistrict') != 'undefined') {
			$insert['district'] = $this->input->post('indistrict');
		}

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
    		'ins_district' 	=> $this->input->post('idistrict'), 
    		'prv_class' 	=> $this->input->post('pclass'), 
    		'prv_marks' 	=> $this->input->post('pmarks'), 
		);

		if ($this->input->post('igrad') != 'undefined') {
			$insert['graduation'] = $this->input->post('igrad');
		}

		if ($this->input->post('igrad') != '1') {
			if ($this->input->post('ipclass') != 'undefined') {
				$insert['class'] = $this->input->post('ipclass');
			}
		}

		if ($this->input->post('italluk') != 'undefined') {
			$insert['ins_talluk'] = $this->input->post('italluk');
		}

		if ($this->input->post('icourse') != 'undefined') {
			$insert['course'] = $this->input->post('icourse');
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
    		$this->session->set_flashdata('error', 'You have not applied to the scholarship.');			
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


    //application list
    public function list($id = '')
    {
    	if(!empty($id)){
    		$data['result'] = $this->m_stdapplication->getDeatil($this->sid,$id);
    		$this->load->view('student/application-detail', $data, FALSE);

    	}else{
    		$year = $this->input->get('year');
    		$data['result'] = $this->m_stdapplication->getList($this->sid,$year);
    		$this->load->view('student/application-list', $data, FALSE);
    	}
    }


        // application generate
    public function applicationGenerate($id = null)
    {
        $data['result'] = $this->m_stdapplication->getApplication($this->sid);
        require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
	        'default_font' => 'tunga'
        ]);
        $html = $this->load->view('site/download-apply', $data, TRUE);
        
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;    
    }


}

/* End of file Std_application.php */
/* Location: ./application.php */