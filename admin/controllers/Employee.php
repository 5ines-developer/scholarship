<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function index()
    {
        $data['title'] = 'Employee List | Scholarship';
        $this->load->view('employee/list', $data, FALSE);
    }

    public function add($var = null)
    {
        if($this->input->post()){

        }else{
            $data['title'] = 'Employee Add | Scholarship';
            $this->load->view('employee/add', $data, FALSE);
        }
    }

}

/* End of file Employee.php */
