<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index()
    {
        $data['title'] = 'Scholarship';
        $this->load->view('dashboard/request-list', $data, FALSE);
        
    }

}

/* End of file Dashboard.php */
