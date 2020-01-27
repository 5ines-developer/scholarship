<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Application extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_application');
        if($this->session->userdata('sgt_id') == ''){ redirect('/','refresh'); }
        $this->inId = $this->session->userdata('sccomp');
    }
    

    public function index($year=null)
    {
        $data['title'] = 'Scholarship';
        $year = $this->input->get('year');
        $data['result'] = $this->m_application->getScholarshipRequest($year);
        $this->load->view('application/request-list', $data, FALSE);        
    }

    // approve list
    public function approve_list($year = null)
    {
        $data['title'] = 'Scholarship | Approved list';
        $year = $this->input->get('year');
        $data['result'] = $this->m_application->getScholarshipApproved($year);
        $this->load->view('application/approved', $data, FALSE);
    }

    // rejected list
    public function reject_list($year=null)
    {
        $data['title'] = 'Scholarship | Rejected list';
        $year = $this->input->get('year');
        $data['result'] = $this->m_application->getScholarshipRejected($year);
        $this->load->view('application/rejected', $data, FALSE);
    }

        // single student data
        public function singleStudent($id = null)
        {
            $data['title'] = 'Scholarship | Request list';
            $data['result'] = $this->m_application->singleStudent($id);
            $this->load->view('application/student-detail', $data, FALSE);
        }
        
    // approve application
    public function approve($id = null,$msg='')
    {
        $msg = 'Your Karnataka Labour Welfare Board Scholarship has been succesfully moved to government for verification, we will notify the status via sms';
        $id = $this->input->post('id');
        if($this->m_application->approval($id)){
            $this->approveMail($id);
            $this->studentSms($msg,$id);
            $data = array('status' => 1, 'msg' => 'Approved successfully.');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => 'Server error occurred. Please try again');
        }
        echo json_encode($data);
    }

    // Reject 
    public function reject()
    {
       $id = $this->input->post('id');
       $data = array(
           'reject_reason' => $this->input->post('reason'),
           'status' => 2,
        );
        if($this->m_application->reject($data, $id)){
            $this->session->set_flashdata('success', 'Application rejected Successfully');
            redirect('application-rejected','refresh');
        }else{
            $this->session->set_flashdata('error', 'Server error occurred.<br> Please try agin later');
            redirect('application/'.$id,'refresh');
        }
    }

    public function approveMail($id='')
	{
        $data['info'] = $this->m_application->singleStudent($id);
        $email = $this->m_application->emailGet($data['info']->Student_id);

        if (!empty($email)) {
            $this->load->config('email');
            $this->load->library('email');
            $from = $this->config->item('smtp_user');
            $msg = $this->load->view('mail/approve', $data, true);
            $this->email->set_newline("\r\n");
            $this->email->from($from , 'Karnataka Labour Welfare Board');
            $this->email->to($email);
            $this->email->subject('Scholarship application Approved'); 
            $this->email->message($msg);
            if($this->email->send())  
            {
                return true;
            } 
            else
            {
                return false;
            }
        }else{
            return true;
        }
        
	}

    public function studentSms($data='', $apid='')
    {
		$data['info'] = $this->m_application->singleGet($id);
        $phone = $this->m_application->phoneGet($data['info']->Student_id);
		
        /* API URL */
        $url = 'http://trans.smsfresh.co/api/sendmsg.php';
        $param = 'user=5inewebsolutions&pass=5ine5ine&sender=PROPSB&phone=' . $phone . '&text=' . $data . '&priority=ndnd&stype=normal';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }



}

/* End of file Dashboard.php */
