<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_payments');
        $this->load->model('M_account');
        if($this->session->userdata('pyId') == ''){ redirect('/','refresh'); }
        $this->inId = $this->session->userdata('pyComp');
        $this->reg = $this->session->userdata('pyId');
        $this->load->helper('text');
    }

    // make payment
    public function index()
    {
        $data['title']  = 'Make Payment | Scholarship';
        $data['info']   = $this->M_account->getAccountDetails();
        $data['act']    = $this->m_payments->getAct($data['info']->indId);
        $this->load->view('payment/make-payment', $data, FALSE);
    }


}

/* End of file Controllername.php */
