<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dashboard');
        if($this->session->userdata('scinst') == ''){ redirect('/','refresh'); }
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
    

    public function index()
    {
        $data['title'] = 'Scholarship';
        $this->load->view('dashboard/request-list', $data, FALSE);
        
    }

    // scholarship request
    public function scholarship_request()
    {
        $year = $this->input->get('year');
        $results = $this->m_dashboard->getScholarshipRequest($year);
        if (!empty($results)) {
            foreach ($results as $key => $value) {
                $value->amount = $this->m_dashboard->getamnt($value->application_year,$value->graduation);
            }
        }
        echo json_encode($results);
    }

    // single student data
    public function singleStudent($id = null)
    {
        $id = base64_decode($id);
        $data['result'] = $this->m_dashboard->singleStudent($id);
        $this->load->view('dashboard/student-detail', $data, FALSE);
    }



    // Reject 
    public function reject()
    {
        $this->sc_check->limitRequests();
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);
        $id = $this->input->post('id');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $data = array(
               'reject_reason' => $this->input->post('reason'),
               'status' => 2,
            );
            if($this->m_dashboard->reject($data, $id)){
                $this->sendReject($id);
                $this->session->set_flashdata('success', 'Application rejected');
                redirect('reject-list','refresh');
            }else{
                $this->session->set_flashdata('error', 'Server error occurred.<br> Please try agin later');
                redirect('student/'.$id,'refresh');
            }
        }else{
            $this->session->set_flashdata('error', 'Server error occurred.<br> Please try agin later');
            redirect('student/'.$id,'refresh');
        }
    }



    // Send a application pdf file
    public function sendReject($id='')
    {
        $data['info'] = $this->m_dashboard->singleStudent($id);
        $data['email'] = $data['info']->email;
        $msg = 'Dear '. $data['info']->name.',
        Your Karnataka Labour Welfare Board Scholarship has been rejected from institute due to '.$data['info']->reject_reason.', More information login to your account and check the Scholarship status';
        $this->studentSms($msg,$id);
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/reject', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($data['email']);
        $this->email->subject('Scholarship application Rejected from institute'); 
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


    // rejected list
    public function reject_list()
    {
        $data['title'] = 'Scholarship | Rejected list';
        $this->load->view('dashboard/rejects', $data, FALSE);
    }

    // rejected list
    public function student_rejects()
    {
        $year = $this->input->get('year');
        $results = $this->m_dashboard->getScholarshipRejects($year);
        if (!empty($results)) {
            foreach ($results as $key => $value) {
                $value->amount = $this->m_dashboard->getamnt($value->application_year,$value->graduation);
            }
        }
        echo json_encode($results);
    }

    // approve list
    public function approve_list(Type $var = null)
    {
        $data['title'] = 'Scholarship | Rejected list';
        $this->load->view('dashboard/approve', $data, FALSE);
    }

    // Approved list
    public function student_approved()
    {
        $year = $this->input->get('year');
        $results = $this->m_dashboard->getScholarshipApproved($year);
        if (!empty($results)) {
            foreach ($results as $key => $value) {
                $value->amount = $this->m_dashboard->getamnt($value->application_year,$value->graduation);
            }
        }
        echo json_encode($results);
    }

    // approve application
    public function approval($var = null)
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            if($this->m_dashboard->approval($this->input->post('id'))){
                $data = array('status' => 1, 'msg' => 'Approved successfully.');
            }else{
                $this->output->set_status_header('400');
                $data = array('status' => 0, 'msg' => 'Server error occurred. Please try again');
            }
           
                $this->sendmailApplication($this->input->post('id'));
                $msg = 'Your Karnataka Labour Welfare Board Scholarship has been succesfully moved to industry for verification, we will notify the status via sms';
                $this->studentSms($msg,$this->input->post('id'));

        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => 'Server error occurred. Please try again');
        }

        echo json_encode($data);
    }

    // Send a application pdf file
    public function sendmailApplication($id = '')
    {
        $data['info'] = $this->m_dashboard->singleStudent($id);
        $data['img'] =$this->m_dashboard->compDocs($data['info']->school_id);
        $data['email'] = $data['info']->email;


        require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'tunga'
        ]);
        $html = $this->load->view('dashboard/pdf', $data, TRUE);
        
        $mpdf->WriteHTML($html);
        $content = $mpdf->Output('', 'S');
        $filename = "Scholarship-institute-approval.pdf";

        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/approve', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($data['email']);
        $this->email->attach($content, 'attachment', $filename, 'application/pdf');
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
        
    }

    public function studentSms($data='', $apid='')
    {
        $phone = $this->m_dashboard->singphoneget($apid);
        /* API URL */
        // $url = 'https://portal.mobtexting.com/api/v2/sms/send';
        // $param = 'access_token=b341e9c84701f1b2df503c78135b9d36&message=' . $data . '&sender=RADTEL&to=' . $phone . '&service=T';
        
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

/* End of file Dashboard.php email*/
