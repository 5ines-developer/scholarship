<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dashboard');
        
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

}

/* End of file Dashboard.php */
