<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scholar extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_scholar');
        $this->load->model('m_scholar');
        if ($this->session->userdata('sgt_id') == '') { $this->session->set_flashdata('error','Please login and try again!'); redirect('/','refresh'); }
        $this->load->library('sess_log');
        $this->sess_log->check_auth($this->session->userdata('sgt_id'));
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
        ////header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
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
        // $id =urldecode(base64_decode($id));
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
            $id = $this->input->post('id');
            if($this->m_scholar->approval($id)){
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
                    $this->sendReject($id);
                    $this->session->set_flashdata('success', 'Application rejected Successfully');
                    redirect('applications?item=rejected','refresh');
                }else{
                    $this->session->set_flashdata('error', 'Server error occurred.<br> Please try agin later');
                    redirect('applications/detail/'.$id,'refresh');
                }
        }else{
            $this->session->set_flashdata('error', 'Server error occurred.<br> Please try agin later');
            redirect('applications/detail/'.$id,'refresh');
        }
    }


            // Send a application pdf file
    public function sendReject($id='')
    {
        $data['info'] = $this->m_scholar->singleGet($id);
        $email = $this->m_scholar->emailGet($data['info']->Student_id);
        $msg = 'Dear '. $data['info']->name.',
        Your Karnataka Labour Welfare Board Scholarship has been rejected from Govt Verification Officer due to '.$data['info']->reject_reason.', More information login to your account and check the Scholarship status';
        $this->studentSms($msg,$id);
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/reject', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($email);
        $this->email->subject('Scholarship application Rejected from Govt Verification Officer'); 
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

    public function studentSms($data='', $apid='')
    {
         $output['info'] = $this->m_scholar->singleGet($apid);
        $phone = $this->m_scholar->phoneGet($output['info']->Student_id);
        
        /* API URL */
        // $url = 'https://portal.mobtexting.com/api/v2/sms/send';
        // $param = 'access_token=b341e9c84701f1b2df503c78135b9d36&message=' . $data . '&sender=RADTEL&to=' . $phone . '&service=T';

        $url = 'http://txt.bdsent.co.in/api/v2/sms/send';
        $param = 'message=' . $data . '&sender=KLWBAP&to=91'.$phone.'&service=T&access_token=1d53d3c2e26408ccd824dd264b642239';
        
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

        require_once $_SERVER['DOCUMENT_ROOT'].'/admin/libraries/PHPExcel/IOFactory.php';

       
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



    //     public function csv()
    // {

    //     $item = $this->input->get('item');
    //     $query = $this->m_scholar->csv_scholar($item);

    //    // this will return all data into array
    //     $dataToExports = [];
    //     foreach ($query as $row) {
    //         if($row->application_state == 3){
    //             $state = 'Verification Officer';
    //         }else if ($row->application_state == 2) {
    //             $state = 'Industry';
    //         }else if ($row->application_state == 1) {
    //             $state = 'Institute';
    //         }else{
    //             $state = 'Admin';
    //         }

    //         if ($row->status == 2) {
    //             $sttus = 'Rejected By';
    //         }else if ($row->status == 1) {
    //             $sttus = 'Approved By';
    //         }else{
    //             $sttus = 'Pending From';
    //         }
    //         $status =  $sttus.' '.$state;

    //         $arrangeData['SL NO.'] = $row->id;
    //         $arrangeData['Name'] = $row->name;
    //         $arrangeData['Institute'] = $row->school;
    //         $arrangeData['Industry'] = $row->industry;
    //         $arrangeData['Present Class'] = $row->course.$row->clss;
    //         $arrangeData['Year'] = $row->application_year;
    //         $arrangeData['Adhaar No'] = $row->adharcard_no;
    //         $arrangeData['Amount'] = $this->m_scholar->getamnt($row->application_year,$row->graduation);
    //         $arrangeData['Applied Date'] = date('d M, Y',strtotime($row->date));
    //         $arrangeData['District'] = $row->district;
    //         $arrangeData['Taluk'] = $row->taluk;
    //         $arrangeData['Status'] = $status;
    //       $dataToExports[] = $arrangeData;
    //      }

    //      // set header
    //      $filename = date('Ymdhis-')."scholarship ".$item."-list.xls";
    //             header("Content-Type: application/vnd.ms-excel");
    //             header("Content-Disposition: attachment; filename=\"$filename\"");
    //      $this->exportExcelData($dataToExports);
    // }


    // public function exportExcelData($records)
    // {
    //     $heading = false;
    //     if (!empty($records))
    //     foreach ($records as $row) {
    //         if (!$heading) {
    //             // display field/column names as a first row
    //             echo implode("\t", array_keys($row)) . "\n";
    //             $heading = true;
    //         }
    //         echo implode("\t", ($row)) . "\n";
    //     }
    // }
    
}