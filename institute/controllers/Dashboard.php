<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dashboard');
        if($this->session->userdata('scinst') == ''){ redirect('/','refresh'); }
    }
    

    public function index()
    {
        $data['title'] = 'Scholarship';
        $this->load->view('dashboard/request-list', $data, FALSE);
        
    }

    // scholarship request
    public function scholarship_request()
    {
        $result = $this->m_dashboard->getScholarshipRequest();
        echo json_encode($result);
    }

    // single student data
    public function singleStudent($id = null)
    {
        $data['result'] = $this->m_dashboard->singleStudent($id);
        $this->load->view('dashboard/student-detail', $data, FALSE);
    }



    // Reject 
    public function reject()
    {
       $id = $this->input->post('id');
       $data = array(
           'reject_reason' => $this->input->post('reason'),
           'status' => 2,
        );
        if($this->m_dashboard->reject($data, $id)){
            $this->session->set_flashdata('success', 'Application rejected');
            redirect('dashboard','refresh');
        }else{
            $this->session->set_flashdata('error', 'Server error occurred.<br> Please try agin later');
            redirect('student/'.$id,'refresh');
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
        $result = $this->m_dashboard->getScholarshipRejects();
        echo json_encode($result);
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
        $result = $this->m_dashboard->getScholarshipApproved();
        echo json_encode($result);
    }

    // approve application
    public function approval($var = null)
    {
        // $this->sendmailApplication($this->input->post('id'));
        if($this->m_dashboard->approval($this->input->post('id'))){
            $data = array('status' => 1, 'msg' => 'Approved successfully.');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => 'Server error occurred. Please try again');
        }
        echo json_encode($data);
    }

    // Send a application pdf file
    public function sendmailApplication($id = null)
    {
        $data['info'] = $this->m_dashboard->singleStudent($id);
        
        $this->load->library('pdf');
        $this->pdf->load_view('dashboard/pdf', $data);
        $this->pdf->setPaper('A5', 'portrait');
        $this->pdf->render();
        $output = $this->pdf->output();
        if (!file_exists('temp')) { mkdir('temp', 0777, true); }
        $created = file_put_contents('temp/application.pdf', $output);

        if(!empty($created)){
            $data['email'] = $data['info']->email;
            $this->load->config('email');
            $this->load->library('email');
            $from = $this->config->item('smtp_user');
            $msg = '
            <p>Hi ,</p>
            <p>Your Application approved from institute. More information please login your account and check from Scholarship website.</p>';
            $this->email->set_newline("\r\n");
            $this->email->from($from , 'Karnataka Labour Welfare Board');
            $this->email->attach( '/temp/application.pdf');
            $this->email->to($data['email']);
            $this->email->subject('Institute Registration verification'); 
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
        return true;
    }
    

}

/* End of file Dashboard.php */
