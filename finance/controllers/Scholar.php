<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scholar extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_scholar');
        $this->load->model('m_scholar');
        if ($this->session->userdata('sfn_id') == '') { $this->session->set_flashdata('error','Please login and try again!'); }
        $this->load->library(array('email', 'upload', 'MY_Upload', 'excel'));
    }



    public function index($district='')
    {
        $dist = $this->input->get('district');
        if (!empty($dist)) {
            $district = $this->m_scholar->distGet($dist);
        }
        $data['title'] = 'Scholarship List';
        $data['district'] = $this->m_scholar->getDistrict();
        $data['taluk'] = $this->m_scholar->getTalluk($district);
        $data['count'] = $this->m_scholar->scholarcount();
        $this->load->view('scholar/list', $data, FALSE);        
    }

    public function allApplication($value='')
    {
        $filt['year']   = $this->input->post('year');
        $dist           = $this->input->post('district');
        $tal            = $this->input->post('taluk');
        $filt['caste']  = $this->input->post('caste');
        $filt['item']  = $this->input->post('item');

        if (!empty($dist)) {
            $filt['district'] = $this->m_scholar->distGet($dist);
        }

        if (!empty($tal)) {
            $filt['taluk'] = $this->m_scholar->talGet($tal);
        }
        
        $fetch_data   = $this->m_scholar->make_datatables($filt);

        $data = array();
        foreach($fetch_data as $row)  
        {  
            $btn = '<a href="'.base_url('applications/detail/').$row->id.'" class="vie-btn blue-text waves-effect waves-light"> View</a>';

            if($row->application_state == 3){
                $state = 'Verification Officer';
            }else if ($row->application_state == 2) {
                $state = 'Industry';
            }else if ($row->application_state == 1) {
                $state = 'Institute';
            }else{
                $state = 'Admin';
            }

            if ($row->status == 2) {
                $sttus = 'Rejected By';
                $color = 'red';
            }else if ($row->status == 1) {
                $sttus = 'Approved By';
                $color = 'green';
            }else{
                $sttus = 'Pending From';
                 $color = 'blue';
            }
            $status =  '<p class="status '.$color.' darken-2">'.$sttus.' '.$state.'</p>';

            $sub_array = array();
            $sub_array[] = $row->name;
            $sub_array[] = character_limiter($row->school, 10);
            $sub_array[] = character_limiter($row->industry, 10);  
            $sub_array[] = $row->course.'-'.$row->clss;
            $sub_array[] = $row->application_year;  
            $sub_array[] = $row->adharcard_no;  
            $sub_array[] = date('d M, Y',strtotime($row->date));  
            $sub_array[] = $row->district;  
            $sub_array[] = $row->taluk;  
            $sub_array[] = $status;  
            $sub_array[] = '&#8377; &nbsp;'.$row->amount;  
            $sub_array[] = $btn;  

            $data[] = $sub_array;  
        }

        $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>      $this->m_scholar->get_all_data(),  
            "recordsFiltered"     =>     $this->m_scholar->get_filtered_data(),  
            "data"                =>     $data  
        );
        echo json_encode($output);
    }


    // single student data
    public function singleGet($id = null)
    {
        $data['title'] = 'Scholarship Details';
        $data['result'] = $this->m_scholar->singleGet($id);
        $this->load->view('scholar/application', $data, FALSE);
    }

        // approve application
    public function approve($id = null,$msg='')
    {
        
        $msg = 'Congratulations!, Your Scholarship  Application has been  approved by government .The Scholarship amount will be credited to your account shortly!';
        $id = $this->input->post('id');
        if($this->m_scholar->approval($id)){
            $this->approveMail($id);
            $this->studentSms($msg,$id);
            $data = array('status' => 1, 'msg' => 'Scholarship Approved successfully.');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => 'Server error occurred. Please try again');
        }
        echo json_encode($data);
    }

        // Reject 
    public function reject()
    {
       $id = $this->input->post('id');
       $data = array(
           'reject_reason' => $this->input->post('reason'),
           'status' => 2,
        );
        if($this->m_scholar->reject($data, $id)){
            $this->session->set_flashdata('success', 'Application rejected Successfully');
            redirect('applications?item=rejected','refresh');
        }else{
            $this->session->set_flashdata('error', 'Server error occurred.<br> Please try agin later');
            redirect('applications/detail/'.$id,'refresh');
        }
    }


    public function approveMail($id='')
    {
        $data['info'] = $this->m_scholar->singleGet($id);
        $email = $this->m_scholar->emailGet($data['info']->Student_id);

        if (!empty($email)) {
            $this->load->config('email');
            $this->load->library('email');
            $from = $this->config->item('smtp_user');
            $msg = $this->load->view('mail/approve', $data, true);
            $this->email->set_newline("\r\n");
            $this->email->from($from , 'Karnataka Labour Welfare Board');
            $this->email->to($email);
            $this->email->subject('Scholarship application Approved'); 
            $this->email->message($msg);
            if($this->email->send())  
            {
                return true;
            } 
            else
            {
                return false;
            }
        }else{
            return true;
        }
        
    }

    public function studentSms($data='', $apid='')
    {
        $output['info'] = $this->m_scholar->singleGet($apid);
        $phone = $this->m_scholar->phoneGet($output['info']->Student_id);
        
        /* API URL */
        $url = 'http://trans.smsfresh.co/api/sendmsg.php';
        $param = 'user=5inewebsolutions&pass=5ine5ine&sender=PROPSB&phone=' . $phone . '&text=' . $data . '&priority=ndnd&stype=normal';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }

    public function payStatus($value='')
    {
       $pay_stats = $this->input->post('pay_stats');
       $id = $this->input->post('payid');
       $data = array(
        'pay_status' =>  $pay_stats 
        );

       if($pay_stats == '2'){
            $data['pay_freason'] = $this->input->post('failreason');
       }
       

       $output = $this->m_scholar->payStatus($data, $id);
       if(!empty($output)){
            $this->paymail($output,$data);
            $this->paysms($output,$data);
            $this->session->set_flashdata('success', 'Payment status updated Successfully');
        }else{
            $this->session->set_flashdata('error', 'Server error occurred.<br> Please try agin later');
        }
        redirect('applications/detail/'.$id,'refresh');
    }

    public function importPaystatus($value='')
    {
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();

                $i = -1;
                $out = '';
                for ($row = 2; $row <= $highestRow; $row++) {
                    $i++;
                    $adhar = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $status  = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $reason  = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

                    if($status=='success' || $status=='Success'){
                        $stat = '1';
                    }else{
                        $stat = '2';
                    }

                    $insert = array(
                        'pay_status'    => $stat,
                        'pay_freason'    => $reason,
                    );
                    $output[] = $this->m_scholar->importPaystatus($insert,$adhar);
                    
                    if (empty($output[$i])) {
                        $out .= $row.',';
                    }
                    $this->paymail($output[$i],$insert);
                    $this->paysms($output[$i],$insert);
                }
            }
            if(!empty($out)){
                $out1 = rtrim($out);
                
                $this->session->set_flashdata('error', 'Unable to insert the row '.$out1.'<br> please try again');
            }else{
                
                $this->session->set_flashdata('success', 'Payment Status Updated  Successfully');
            }
            redirect('applications?item=approved', 'refresh');
        }
    }

    public function paysms($output='',$insert='')
    {

        if($insert['pay_status'] == '1'){
            $msg = 'Congratulations!, Your Karnataka Labour Welfare Board Scholarship  Amount has been Successfully transfered to your account!';
        }else{
            $msg = 'Sorry!, Your Karnataka Labour Welfare Board Scholarship  Amount has been Failed due to '.$insert['pay_freason'];
        }
        /* API URL */
        $url = 'http://trans.smsfresh.co/api/sendmsg.php';
        $param = 'user=5inewebsolutions&pass=5ine5ine&sender=PROPSB&phone=' . $output->phone . '&text=' . $msg . '&priority=ndnd&stype=normal';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }

    public function paymail($output='',$insert='')
    {
        $data['output'] = $output;
        $data['insert'] = $insert;

        if($insert['pay_status'] == '1'){
           $data['msg'] = 'Congratulations!, Your Karnataka Labour Welfare Board Scholarship  Amount has been Successfully transfered to your account!';
        }else{
            $data['msg'] = 'Sorry!, Your Karnataka Labour Welfare Board Scholarship  Amount has been Failed due to '.$insert['pay_freason'];
        }

        if (!empty($output->email)) {
            $this->load->config('email');
            $this->load->library('email');
            $from = $this->config->item('smtp_user');
            $msg = $this->load->view('mail/paystatus', $data, true);
            $this->email->set_newline("\r\n");
            $this->email->from($from , 'Karnataka Labour Welfare Board');
            $this->email->to($output->email);
            $this->email->subject('Scholarship Payment Status'); 
            $this->email->message($msg);
            if($this->email->send())  
            {
                return true;
            } 
            else
            {
                return false;
            }
        }else{
            return true;
        }
    }


}