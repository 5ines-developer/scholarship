<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scholar extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_scholar');
        $this->load->model('m_school');
        if ($this->session->userdata('said') == '') { $this->session->set_flashdata('error','Please login and try again!');
        redirect('login','refresh'); }
        header_remove("X-Powered-By"); 
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("Strict-Transport-Security: max-age=31536000");
        header("Content-Security-Policy: frame-ancestors none");
        header("Referrer-Policy: no-referrer-when-downgrade");
        // ////header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
        
    }

    public function index($district='')
    {

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_GET);

        $dist = $this->input->get('district');
        if (!empty($dist)) {
            $district = $this->m_scholar->distGet($dist);
        }
        $data['title'] = 'Scholarship List';
        $data['district'] = $this->m_school->getDistrict();
        $data['taluk'] = $this->m_school->getTalluk($district);
        $data['count'] = $this->m_scholar->scholarcount();
        $this->load->view('scholar/list', $data, FALSE);        
    }

    public function allApplication($value='')
    {

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

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
            $btn = '<a href="'.base_url('applications/detail/').$this->encryption_url->safe_b64encode($row->id).'" class="vie-btn blue-text waves-effect waves-light"> View</a>';
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
            if (!empty($filt['item']) && $filt['item']=='pending') {
                $sub_array[] = '<label><input type="checkbox" class="filled-in indual" name="deleteid[]" value="'.$row->id.'" /><span style="font-size: 13px; font-weight: 600;" class="h5-para-p2"></span></label>';
            }
            $sub_array[] = $row->id;
            $sub_array[] = $row->name;
            $sub_array[] = character_limiter($row->school, 10);
            $sub_array[] = character_limiter($row->industry, 10);  
            $sub_array[] = $row->course.'-'.$row->clss;
            $sub_array[] = $row->application_year;  
            $sub_array[] = $row->adharcard_no;  
            $sub_array[] = $this->m_scholar->getamnt($row->application_year,$row->graduation);  
            $sub_array[] = date('d M, Y',strtotime($row->date));  
            $sub_array[] = $row->district;  
            $sub_array[] = $row->taluk;  
            $sub_array[] = $status;  
            $sub_array[] = $btn;  

            $data[] = $sub_array;  
        }

        $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>      $this->m_scholar->get_all_data($filt),  
            "recordsFiltered"     =>     $this->m_scholar->get_filtered_data($filt),  
            "data"                =>     $data  
        );
        echo json_encode($output);
    }


    // single student data
    public function singleGet($id = null)
    {
        $id = $this->encryption_url->safe_b64decode($id);
        $data['title'] = 'Scholarship Details';
        $data['result'] = $this->m_scholar->singleGet($id);
        $this->load->view('scholar/application', $data, FALSE);
    }

        // approve application
    public function approve($id = null,$msg='')
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

        }else{
            $this->output->set_status_header('400');
              $data = array('status' => 0, 'msg' => 'Server error occurred. Please try again');
        }
        echo json_encode($data);
    }

        // Reject 
    public function reject()
    {
        $this->sc_check->limitRequests();
        
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

       $id = $this->input->post('id');
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {

       $data = array(
           'reject_reason' => $this->input->post('reason'),
           'status' => 2,
        );
        if($this->m_scholar->reject($data, $id)){
            $this->session->set_flashdata('success', 'Application rejected Successfully');
            redirect('applications?item=rejected','refresh');
        }else{
            $this->session->set_flashdata('error', 'Server error occurred.<br> Please try agin later');
            redirect('applications/detail/'.$this->encryption_url->safe_b64encode($id),'refresh');
        }

        }else{
            $this->session->set_flashdata('error', 'Some error occured, please try again!');
            redirect('applications?item=rejected','refresh');
        }
    }




    public function approveSelect($value='')
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $id = $this->input->post('ids');
           $msg = 'Congratulations!, Your Scholarship  Application has been  approved by government .The Scholarship amount will be credited to your account shortly!';
           if(!empty($id)){
            for($i=0; $i<count($id); $i++){
                $output = $this->m_scholar->approveSelect($id[$i]);
                if(!empty($output)){
                    $this->approveMail($id[$i]);
                    $this->studentSms($msg,$id[$i]);
                }
                }
             }
            $data = 'Applications approved Successfully';
            echo json_encode($data);
        }else{
            echo null;
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
        $url = 'https://portal.mobtexting.com/api/v2/sms/send';
        $param = 'access_token=b341e9c84701f1b2df503c78135b9d36&message=' . $data . '&sender=RADTEL&to=' . $phone . '&service=T';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }

         // application generate
    public function applicationGenerate($id = null)
    {
        $id = $this->encryption_url->safe_b64decode($id);
        $data['result'] = $this->m_scholar->singleGet($id);
        // require_once $_SERVER['DOCUMENT_ROOT'].'vendor/autoload.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'tunga'
        ]);
        $html = $this->load->view('scholar/application-download', $data, TRUE);
        
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;    
    }



    public function csv()
    {

        $item = $this->input->get('item');
        $query = $this->m_scholar->csv_scholar($item);

        require_once( APPPATH . 'libraries/PHPExcel/IOFactory.php');
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $table_columns = array("SL NO.","Name","Institute","Industry","Present Class","Year","Adhaar No","Amount","Applied Date","District","Taluk","Status");
        $column = 0;
        foreach($table_columns as $field)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        $excel_row = 2;
        foreach($query as $row)
        {

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
            }else if ($row->status == 1) {
                $sttus = 'Approved By';
            }else{
                $sttus = 'Pending From';
            }
            $status =  $sttus.' '.$state;

            $amount = $this->m_scholar->getamnt($row->application_year,$row->graduation);

            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->id);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->school);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->industry);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->course.$row->clss);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->application_year);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->adharcard_no);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $amount);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, date('d M, Y',strtotime($row->date)));
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->district);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->taluk);
            $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $status);
            $excel_row++;

        }

        $filename = date('Ymdhis-')."scholarship ".$item."-list.xlsx";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        $objWriter->save('php://output'); 
    }


}