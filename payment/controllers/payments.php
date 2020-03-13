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
        // header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
        
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
        $this->security->xss_clean($_GET);
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

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
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

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
