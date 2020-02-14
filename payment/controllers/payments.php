<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_payments');
        $this->load->model('m_auth');
        $this->load->model('M_account');
        $this->inId = $this->session->userdata('pyComp');
        $this->reg = $this->session->userdata('pyId');
        $this->load->helper('text');
    }

    // make payment
    public function index()
    {
        $data['title']  = 'Make Payment | Scholarship';
        if($this->session->userdata('pyId') != ''){
            $data['info']   = $this->M_account->getAccountDetails();
            $data['act']    = $this->m_payments->getAct($data['info']->indId);
            $this->load->view('payment/make-payment', $data, FALSE);
        }else{
            $data['title'] = 'Industry Registration';
            $data['taluk'] = $this->m_auth->getTaluk();
            $data['district'] = $this->m_auth->getDistrict();            
            $this->load->view('payment/payment', $data, FALSE);

        }
    }

    public function search($var = null)
    {
        $term = $this->input->get('q[term]');
        $output = $this->m_payments->search($term);
        $result = [];

        foreach ($output as $key => $value) {
            $json[] = ['id'=>$value['id'], 'text'=>$value['name']];
        }
        echo json_encode($json);
    }

    public function companyChange($var = null)
    {
        $this->security->xss_clean($_POST);
        $company = $this->input->post('comp');
        $output = $this->m_payments->companyChange($company);
        echo  $output;
    }

    public function payList($value='')
    {
        $data['title']  = 'Payment List | Scholarship';
        $this->load->view('payment/payment-list.php', $data, FALSE);
    }

    public function receipt($value='')
    {
        $this->load->view('payment/formd');
    }

    public function formd($value='')
    {
        $this->load->view('payment/reciept');
    }





}

/* End of file Controllername.php */
