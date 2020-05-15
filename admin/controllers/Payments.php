<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

		public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_school');
        $this->load->model('m_payments');
        if ($this->session->userdata('said') == '') { 
            $this->session->set_flashdata('error','Please login and try again!');
        redirect('login','refresh'); }
       	header_remove("X-Powered-By"); 
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("Strict-Transport-Security: max-age=31536000");
        header("Content-Security-Policy: frame-ancestors none");
        header("Referrer-Policy: no-referrer-when-downgrade");
    }


	public function index($value='')
    {
    	$year = $this->input->get('year');
        $data['result'] = $this->m_payments->paymenttLists($year);
        $this->load->view('industry/payment.php', $data, FALSE);
    }

    public function pend_payment($year='')
    {
        $year = $this->input->get('year');
        $data['result'] = $this->m_payments->pend_payment($year);
        $this->load->view('industry/pend_payment.php', $data, FALSE);
    }

}

/* End of file Payments.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/controllers/Payments.php */