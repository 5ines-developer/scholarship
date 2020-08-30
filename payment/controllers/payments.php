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
        ////header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
        $this->load->library('form_validation');
    }

    // make payment
    public function index()
    {

        

        // EncryptTrans = AES128EnDc.encrypt(requestparameter, 'fBc5628ybRQf88f/aqDUOQ==');
        // $requestparameter ="1000112|DOM|IN|INR|2|Other|https://test.sbiepay.com/secure/sucess.jsp|https://test.sbiepay.com/secure/fail.jsp|SBIEPAY|2|2|NB|ONLINE|ONLINE";
        // $aggregatorId = "SBIEPAY";
        // $merchantId = "1000003";
        // $refundRequestId = "eRqa7";
        // $atrn = "4457657898141";
        // $refundAmount = "1";
        // $refundAmountCurrency = "INR";
        // $merchantOrderNo = "55LYN";
        // $requestparameter = $aggregatorId."|".$merchantId."|".$refundRequestId."|".$atrn."|".$refundAmount."|".$refundAmountCurrency."|".$merchantOrderNo;
        // $refundRequest =$aggregatorId."|".$merchantId."|".$refundRequestId."|".$atrn."|".$refundAmount."|".$refundAmountCurrency."|".$merchantOrderNo;
        // $post_param = "refundRequest=".$refundRequest."&aggregatorId=".$aggregatorId."&merchantId=".$merchantId;
        // $post_param = "requestparameter=".$requestparameter;

        // $service_url = "https://test.sbiepay.com/secure/AggregatorHostedListener";

        // $ch = curl_init();
        // curl_setopt($ch,CURLOPT_URL,$service_url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS,$post_param);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $result = curl_exec($ch);
        // var_dump($result);
        // curl_close($ch);

        // echo "<pre>";
        // print_r ($result);
        // echo "</pre>";

        // $aggregatorId = "SBIEPAY";
        // $merchantId = "1000003";
        // $refundRequestId = "eRqa7";
        // $atrn = "4457657898141";
        // $refundAmount = "1";
        // $refundAmountCurrency = "INR";
        // $merchantOrderNo = "55LYN";
        // $refundRequest =$aggregatorId."|".$merchantId."|".$refundRequestId."|".$atrn."|".$refundAmount."|".$refundAmountCurrency."|".$merchantOrderNo;
        // $service_url = "https://sbiepay.com/payagg/orderRefundCancellation/bookRefundCancellation";
        // $post_param = "refundRequest=".$refundRequest."&aggregatorId=".$aggregatorId."&merchantId=".$merchantId;

        // $ch = curl_init();
        // curl_setopt($ch,CURLOPT_URL,$service_url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS,$post_param);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $result = curl_exec($ch);
        // var_dump($result);
        // curl_close($ch);


        // $data['title']  = 'Make Payment | Scholarship';
        // if($this->session->userdata('pyId') != ''){
            // $data['info']   = $this->M_account->getAccountDetails();
            // $data['act']    = $this->m_payments->getAct($data['info']->indId);
            // $this->load->view('payment/make-payment', $data, FALSE);
        // }else{
            $data['title'] = 'Industry Registration';
            $data['taluk'] = $this->m_auth->getTaluk();
            $data['district'] = $this->m_auth->getDistrict();            
            $this->load->view('payment/payment', $data, FALSE);
        // }
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
        $data['result'] = $this->m_payments->payList($this->inId);
        $this->load->view('payment/payment-list.php', $data, FALSE);
    }

    public function receipt($id='')
    {
        $id = $this->encryption_url->safe_b64decode($id);
        $data['result'] = $this->m_payments->singlepay($id,$this->inId);
        $this->load->view('payment/reciept',$data);
    }

         // application generate
    public function receipts($id = null)
    {
        $id = $this->encryption_url->safe_b64decode($id);
        $data['result'] = $this->m_payments->singlepay($id,$this->inId);
        require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
        // require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'tunga'
        ]);
        $html = $this->load->view('payment/reciept_download.php',$data, TRUE);
        
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;    
    }


    public function formd($value='')
    {
        $this->load->view('payment/formd');
    }

         // application generate
    public function formds($id = null)
    {
        $id = $this->encryption_url->safe_b64decode($id);
        $data['result'] = $this->m_payments->singlepay($id,$this->inId);
        require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
        // require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'tunga'
        ]);
        $html = $this->load->view('payment/formd_download.php',$data, TRUE);
        
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;    
    }

    

    public function checkpayment($value='')
    {

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reg_no = $this->input->post('reg_no');
            $year   = $this->input->post('year');
            $output = $this->m_payments->checkpayment($reg_no,$year);
            echo $output;
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
    }

    public function submit_pay($value='')
    {

        
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

         if ($_SERVER['REQUEST_METHOD'] != 'POST') { $this->session->set_flashdata('error', 'Some error occured, please try again!');redirect('make-payment'); }

        $this->form_validation->set_rules('category', 'Category', 'trim|requiredalpha_numeric_spaces');
        $this->form_validation->set_rules('p_cfemale', 'Female Employees', 'trim|requiredalpha_numeric_spaces');
        $this->form_validation->set_rules('p_cmale', 'Male Employees',  'trim|requiredalpha_numeric_spaces');
        $this->form_validation->set_rules('p_year', 'Year', 'trim|requiredalpha_numeric_spaces');
        $this->form_validation->set_rules('reg_no', 'Register Number', 'trim|requiredalpha_numeric_spaces');
        $this->form_validation->set_rules('prices', 'Price', 'trim|requiredalpha_numeric_spaces');
        $this->form_validation->set_rules('interests', 'Interest', 'trim|requiredalpha_numeric_spaces');
        if ($this->form_validation->run() == TRUE) {

           $female      =  $this->input->post('p_cfemale');
           $male        =  $this->input->post('p_cmale');
           $reg_no      =  $this->input->post('reg_no');
           $year        =  $this->input->post('p_year');
           $pay_id      =  $this->input->post('razorpay_payment_id');
           $price       =  $this->input->post('prices');
           $interest    =  $this->input->post('interests');
           $emails      =  $this->input->post('emails');
           $phones      =  $this->input->post('phones');
           $company     =  $this->input->post('company');

           $insert = array(
                'female'        => $female, 
                'male'          => $male, 
                'comp_reg_id'   => $reg_no, 
                'year'          => $year, 
                'pay_id'        => $pay_id, 
                'price'         => $price, 
                'interest'      => $interest,  
            );

           $result = $this->m_payments->submit_pay($insert);


           if (!empty($result)) {
            $insert['insert_id'] = $result;
            $emails='';
            $phones='';
            $company='';
                $ind = $this->m_payments->getind($reg_no);
               if (!empty($ind)) {
                   $emails = $ind->email;
                   $phones = $ind->mobile;
                   $company = $ind->name;
               }

                $this->sendmail($insert,$emails,$phones,$company);
                $this->sendadmin($insert,$emails,$phones,$company);
                $this->session->set_flashdata('success', 'Your contribution has been paid successfully');
                redirect('make-payment','refresh');
            }else{
                $this->session->set_flashdata('error', 'Something Went wrong, please try again later!');
                redirect('make-payment','refresh');
            }
        }else{
            $this->form_validation->set_error_delimiters('', '<br>');
            $this->session->set_flashdata('error', str_replace(array("\n", "\r"), '', validation_errors()));
            redirect('make-payment','refresh');
        }
    }

    public function sendmail($insert='',$emails='',$phone='',$company='')
    {

        $data['result'] = $this->m_payments->singlepay($insert['insert_id'],$this->inId);
        require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
        // require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'tunga'
        ]);
        $html = $this->load->view('payment/reciept_download.php',$data, TRUE);
        
        $mpdf->WriteHTML($html);
        $content = $mpdf->Output('', 'S');
        $filename = "Contribution-reciept.pdf";

        
        $data['result'] = $insert;
        $data['company'] = $company;
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/payment', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($emails);
        $this->email->subject('Contribution Success');
        $this->email->attach($content, 'attachment', $filename, 'application/pdf'); 
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

    public function sendadmin($insert='',$emails='',$phone='',$company='')
    {
        
        $data['result'] = $insert;
        $data['company'] = $company;
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/admin-payment', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to('prathwi@5ine.in');
        $this->email->subject('Industry Contribution Success'); 
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

    public function reminder($value='')
    {
        $today  = date('Y-m-d');
        $due    = date('Y')."-01-15";
        $your_date = strtotime($today);
        $datediff = strtotime($due) - $your_date;
        $diffr = round($datediff / (60 * 60 * 24));

        if ($today < $due) {
            if ($diffr == '30') {
                $this->sendreminder($diffr);
            }elseif ($diffr == '15') {
                $this->sendreminder($diffr);
            }elseif ($diffr == '1') {
                $this->sendreminder($diffr);
            }
        }
    }

    public function sendreminder($diffr='')
    {
        $result = $this->m_payments->getemail();
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $noti = $this->m_payments->insertreminder($value->reg_id,$diffr);
                if (!empty($noti)) {
                    $this->load->config('email');
                    $this->load->library('email');
                    $from = $this->config->item('smtp_user');
                    $msg = $this->load->view('mail/reminder',$result, true);
                    $this->email->set_newline("\r\n");
                    $this->email->from($from , 'Karnataka Labour Welfare Board');
                    $this->email->to($value->email);
                    $this->email->subject('Contribution reminder'); 
                    $this->email->message($msg);
                    $this->email->send();
                }
            }
        }
    }


    public function send_due($value='')
    {
        $today      = date('Y-m-d');
        $due        = date('Y')."-01-15";
        $your_date  = strtotime($today);
        $datediff   = strtotime($due) - $your_date;
        $diffr      = round($datediff / (60 * 60 * 24));

        if ($today > $due) {
            $this->send_duemail($diffr);
        }
    }

    public function send_duemail($diffr='')
    {
        $result = $this->m_payments->getemail();
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $noti = $this->m_payments->insertreminder($value->reg_id,$diffr);
                if (!empty($noti)) {
                    $this->load->config('email');
                    $this->load->library('email');
                    $from = $this->config->item('smtp_user');
                    $msg = $this->load->view('mail/due_noti',$result, true);
                    $this->email->set_newline("\r\n");
                    $this->email->from($from , 'Karnataka Labour Welfare Board');
                    $this->email->to($value->email);
                    $this->email->subject('Contribution Due Notification'); 
                    $this->email->message($msg);
                    $this->email->send();
                }
            }
        }
    }


    public function notification($value='')
    {
        $data['title'] = 'Payment Reminder';
        $this->m_payments->changeSeen($this->inId);
        $data['result'] = $this->m_payments->pay_reminders($this->inId);
        $this->load->view('payment/notification', $data, FALSE);
    }





}

/* End of file Controllername.php */
