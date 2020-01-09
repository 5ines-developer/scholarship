<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scholar extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_scholar');
        if ($this->session->userdata('said') == '') { $this->session->set_flashdata('error','Please login and try again!'); }
    }


        // single student data
        public function singleGet($id = null)
        {
            $data['title'] = 'Scholarship | Request list';
            $data['result'] = $this->m_scholar->singleGet($id);
            $this->load->view('scholar/application', $data, FALSE);
        }
}