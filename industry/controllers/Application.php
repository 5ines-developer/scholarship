<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Application extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_application');
        if($this->session->userdata('scinds') == ''){ redirect('/','refresh'); }
        $this->inId = $this->session->userdata('sccomp');
        header_remove("X-Powered-By"); 
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("Strict-Transport-Security: max-age=31536000");
        header("Content-Security-Policy: frame-ancestors none");
        header("Referrer-Policy: no-referrer-when-downgrade");
        // header("Content-Security-Policy: default-src 'none'; script-src 'self' https://www.google.com/recaptcha/api.js https://www.gstatic.com/recaptcha/releases/v1QHzzN92WdopzN_oD7bUO2P/recaptcha__en.js https://www.google.com/recaptcha/api2/anchor?ar=1&k=6Le6xNYUAAAAADAt0rhHLL9xenJyAFeYn5dFb2Xe&co=aHR0cHM6Ly9oaXJld2l0LmNvbTo0NDM.&hl=en&v=v1QHzzN92WdopzN_oD7bUO2P&size=normal&cb=k5uv282rs3x8; connect-src 'self'; img-src 'self'; style-src 'self';");
        // header("Referrer-Policy: origin-when-cross-origin");
        // header("Expect-CT: max-age=7776000, enforce");
        // header('Public-Key-Pins: pin-sha256="d6qzRu9zOECb90Uez27xWltNsj0e1Md7GkYYkVoZWmM="; pin-sha256="E9CZ9INDbd+2eRQozYqqbQ2yXLVKB9+xcprMF+44U1g="; max-age=604800; includeSubDomains; report-uri="https://example.net/pkp-report"');
        ////header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
        
    }
    

    public function index($year=null)
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_GET);

        $data['title'] = 'Scholarship';
        $year = $this->input->get('year');
        $data['result'] = $this->m_application->getScholarshipRequest($year);
        $this->load->view('application/request-list', $data, FALSE);        
    }

    // approve list
    public function approve_list($year = null)
    {

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_GET);
        $data['title'] = 'Scholarship | Approved list';
        $year = $this->input->get('year');
        $data['result'] = $this->m_application->getScholarshipApproved($year);
        $this->load->view('application/approved', $data, FALSE);
    }

    // rejected list
    public function reject_list($year=null)
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_GET);
        $data['title'] = 'Scholarship | Rejected list';
        $year = $this->input->get('year');
        $data['result'] = $this->m_application->getScholarshipRejected($year);
        $this->load->view('application/rejected', $data, FALSE);
    }

        // single student data
        public function singleStudent($id = null)
        {

            $id = $this->encryption_url->safe_b64decode($id);

            $data['title'] = 'Scholarship | Request list';
            $data['result'] = $this->m_application->singleStudent($id);
            $data['paySte'] = $this->m_application->getPay($data['result']->company_id,$data['result']->application_year);
            $this->load->view('application/student-detail', $data, FALSE);
        }
        
    // approve application
    public function approve($id = null,$msg='')
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $msg = 'Your Karnataka Labour Welfare Board Scholarship has been succesfully moved to Labour Welfare Board for verification, we will notify the status via sms';
            $id = $this->input->post('id');
            if($this->m_application->approval($id)){
                $this->approveMail($id);
                $this->studentSms($msg,$id);
                $data = array('status' => 1, 'msg' => 'Approved successfully.');
            }else{
                $this->output->set_status_header('400');
                $data = array('status' => 0, 'msg' => 'Server error occurred. Please try again');
            }
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
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($this->m_application->reject($data, $id)){
                $this->sendReject($id);
                $this->session->set_flashdata('success', 'Application rejected Successfully');
                redirect('application-rejected','refresh');
            }else{
                $this->session->set_flashdata('error', 'Server error occurred.<br> Please try agin later');
                redirect('application/'.$id,'refresh');
            }
         }else{
            $this->session->set_flashdata('error', 'Some error occured, please try again!');
            redirect('application/'.$id,'refresh');
        }
    }

        // Send a application pdf file
    public function sendReject($id='')
    {
        $data['info'] = $this->m_application->singleStudent($id);
        $email = $this->m_application->emailGet($data['info']->Student_id);
        $msg = 'Dear '. $data['info']->name.',
        Your Karnataka Labour Welfare Board Scholarship has been rejected from Industry due to '.$data['info']->reject_reason.', More information login to your account and check the Scholarship status';
        $this->studentSms($msg,$id);
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/reject', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($email);
        $this->email->subject('Scholarship application Rejected from industry'); 
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


    public function approveMail($id='')
	{
        $this->load->model('m_application');
        $data['info'] = $this->m_application->singleStudent($id);
        $data['img'] =$this->m_application->compDocs($data['info']->company_id);
        $data['pays'] = $this->m_application->getPay($data['info']->company_id,$data['info']->application_year);
        $email = $this->m_application->emailGet($data['info']->Student_id);

        require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'tunga'
        ]);
        $html = $this->load->view('account/pdf', $data, TRUE);
        
        $mpdf->WriteHTML($html);
        $content = $mpdf->Output('', 'S');
        $filename = "Scholarship-industry-approval.pdf";


        

        if (!empty($email)) {
            $this->load->config('email');
            $this->load->library('email');
            $from = $this->config->item('smtp_user');
            $msg = $this->load->view('mail/approve', $data, true);
            $this->email->set_newline("\r\n");
            $this->email->from($from , 'Karnataka Labour Welfare Board');
            $this->email->to($email);
            $this->email->subject('Scholarship application Approved'); 
            $this->email->attach($content, 'attachment', $filename, 'application/pdf');
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
		$phone = $this->m_application->singphoneget($apid);
		
        /* API URL */
       
        $url = 'http://txt.bdsent.co.in/api/v2/sms/send';
		$param = 'message=' . $data . '&sender=KLWBAP&to=91'.$phone.'&service=T&access_token=1d53d3c2e26408ccd824dd264b642239';
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
