<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_school');
        if ($this->session->userdata('said') == '') { $this->session->set_flashdata('error','Please login and try again!');
        redirect('login','refresh'); }
        $this->load->library(array('email', 'upload', 'MY_Upload', 'excel'));
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
        // ////header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
        
    }

	public function index($id='',$year='')
	{

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_GET);

        $district = $this->input->get('district');
        $taluk    = $this->input->get('taluk');
		$data['title']      = 'Institute Management';
		if(!empty($id)){
            $id = $this->encryption_url->safe_b64decode($id);
			$data['result']= $this->m_school->getSchool($id);
            $data['apply']= $this->m_school->getscholar($id);
			$data['emp']= $this->m_school->getEmployee($id);
			$this->load->view('school/detail.php', $data, FALSE);
		}else{
			$data['result']= $this->m_school->getSchool($year,$district,$taluk);
            $data['count'] = $this->m_school->schoolcount($year);
            $data['taluk'] = $this->m_school->getTalluk($district);
            $data['district'] = $this->m_school->getDistrict();
			$this->load->view('school/list.php', $data, FALSE);
		}
    }



    public function block($value='')
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $this->input->post('id');
            $status = '3';
            if($this->m_school->stasChange($id,$status)){
                 $data = array('status' => 1, 'msg' => '🙂 Institute Blocked Successfully ');
            }else{
                $this->output->set_status_header('400');
                $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
            }
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }

    public function unblock($value='')
    {

            $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $this->input->post('id');
            $status = '1';
            if($this->m_school->stasChange($id,$status)){
                 $data = array('status' => 1, 'msg' => '🙂 Institute Unblocked  Successfully ');
            }else{
                $this->output->set_status_header('400');
                $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
            }
        }else{
                $this->output->set_status_header('400');
                $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }
    

    public function add($value='')
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        $data['title']      = 'Institute Management';
        if(!empty($this->input->post())){
            $this->sc_check->limitRequests();


            $this->load->library('form_validation');
            $this->form_validation->set_rules('rno', 'Reg No.', 'required|alpha_numeric_spaces');
            $this->form_validation->set_rules('school_address', 'Address', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('management_type', 'Management Type', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('school_category', 'school category', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('school_type', 'school type', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('urban_rural', 'urban rural type', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('taluk', 'taluk', 'trim|alpha_numeric_spaces');
            if ($this->form_validation->run() == True){
                $insert = array(
                    'reg_no'            => $this->input->post('rno'), 
                    'school_address'    => $this->input->post('name'), 
                    'management_type'   => $this->input->post('mtype'), 
                    'school_category'   => $this->input->post('sccat'), 
                    'school_type'       => $this->input->post('sctype'), 
                    'urban_rural'       => $this->input->post('rural'), 
                    'taluk'             => $this->input->post('taluk'), 
                    'status'            => '1' , 
                );
                if($this->m_school->add($insert))
                {
                    $this->session->set_flashdata('success','institute added Successfully');
                    redirect('institutes','refresh');
                }else{
                    $this->session->set_flashdata('error','Please login and try again!');
                    redirect('institute-add','refresh');
                }

            }else{
                $this->form_validation->set_error_delimiters('', '<br>');
                $this->session->set_flashdata('error', str_replace(array("\n", "\r"), '', validation_errors()));
                redirect('institute-add','refresh');
            }
        }else{
            
            $data['districts'] = $this->m_school->getDistricts();
            $this->load->view('school/add', $data, FALSE);
        }
    }

    public function talukFilter($id='')
    {
       $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        $district = $this->input->post('filter');
        $result = $this->m_school->talukFilter($district);
        echo json_encode($result);

    }


    public function namecheck($value='')
    {

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $this->input->post('name');
            $output = $this->db->where('school_address', $name)->get('reg_schools')->row();
            if(!empty($output)){
                $ret = 1;
            }else{
                $ret = '';
            }
        }else{
            $ret = '';
        }
        echo json_encode($ret);
    }

    public function regcheck($value='')
    {

            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $regno = $this->input->post('regno');
        $output = $this->db->where('reg_no', $regno)->get('reg_schools')->row();
        if(!empty($output)){
            $ret = 1;
        }else{
            $ret = '';
        }

        }else{
            $ret = '';
        }
        
        echo json_encode($ret);
    }


    public function schoolGet($year='')
    {
        $data['title']    = 'Institutes';
        $data['count'] = $this->m_school->schoolcount($year);
        $this->load->view('school/all', $data, FALSE);
    }

    public function allschool($value='')
    {
        $fetch_data   = $this->m_school->make_datatables();
        $data = array();
        foreach($fetch_data as $row)  
        {  
            $edit = '<a href="'.base_url('institute-edit/').$this->encryption_url->safe_b64encode($row->id) .'" class="vie-btn blue-text waves-effect waves-light"> Edit</a>';
            $sub_array = array();
            $sub_array[] = $row->id;  
            $sub_array[] = character_limiter($row->school_address, 9);
            $sub_array[] = $row->reg_no;  
            $sub_array[] = $row->management_type;
            $sub_array[] = $row->school_category;  
            $sub_array[] = $row->district;  
            $sub_array[] = $row->title;  
            $sub_array[] = $edit; 

            $data[] = $sub_array;  
        }
        $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>      $this->m_school->get_all_data(),  
            "recordsFiltered"     =>     $this->m_school->get_filtered_data(),  
            "data"                =>     $data  
        );
        echo json_encode($output);
    }


    public function nonRegister($year='')
    {
        $district = $this->input->get('district');
        $taluk    = $this->input->get('taluk');
        $data['count'] = $this->m_school->schoolcount($year);
        $data['taluk'] = $this->m_school->getTalluk($district);
        $data['district'] = $this->m_school->getDistrict();
        $this->load->view('school/non-register.php', $data, FALSE);
    }

    public function getnonRegister($value='')
    {
        $fetch_data   = $this->m_school->getnonRegister();
        $data = array();
        foreach($fetch_data as $row)  
        {  
            $sub_array = array();
            $sub_array[] = $row->id;  
            $sub_array[] = character_limiter($row->school_address, 9);
            $sub_array[] = $row->reg_no;  
            $sub_array[] = $row->management_type;
            $sub_array[] = $row->school_category;  
            $sub_array[] = $row->district;  
            $sub_array[] = $row->title;  
            $data[] = $sub_array;  
        }
        $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>      $this->m_school->get_all_non(),  
            "recordsFiltered"     =>     $this->m_school->get_filtered_non(),  
            "data"                =>     $data  
        );
        echo json_encode($output);
    }


    public function edit($id='')
    {
        $id = $this->encryption_url->safe_b64decode($id);

            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->security->xss_clean($_POST);
    
        $data['title']      = 'Institute Management';
        if(!empty($this->input->post())){
            $this->sc_check->limitRequests();

            

            $this->load->library('form_validation');
            $this->form_validation->set_rules('rno', 'Reg No.', 'required|alpha_numeric_spaces');
            $this->form_validation->set_rules('school_address', 'Address', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('management_type', 'Management Type', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('school_category', 'school category', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('school_type', 'school type', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('urban_rural', 'urban rural type', 'trim|alpha_numeric_spaces');
            $this->form_validation->set_rules('taluk', 'taluk', 'trim|alpha_numeric_spaces');
            if ($this->form_validation->run() == True){


                $insert = array(
                    'reg_no'            => $this->input->post('rno'), 
                    'school_address'    => $this->input->post('name'), 
                    'management_type'   => $this->input->post('mtype'), 
                    'school_category'   => $this->input->post('sccat'), 
                    'school_type'       => $this->input->post('sctype'), 
                    'urban_rural'       => $this->input->post('rural'), 
                    'status'            => '1' , 
                );

                if (!empty($this->input->post('taluk'))) {
                    $insert = ['taluk' => $this->input->post('taluk')];
                }

                if($this->m_school->update($id,$insert))
                {
                    $this->session->set_flashdata('success','institute updated Successfully');
                }else{
                    $this->session->set_flashdata('error','Please login and try again!');
                }

        }else{
            $this->form_validation->set_error_delimiters('', '<br>');
            $this->session->set_flashdata('error', str_replace(array("\n", "\r"), '', validation_errors()));

        }

            redirect('institute-edit/'.$this->encryption_url->safe_b64encode($id),'refresh');

        }else{
            $data['districts'] = $this->m_school->getDistricts();
            $data['result'] = $this->m_school->getedit($id);
            $this->load->view('school/edit', $data, FALSE);
        }
    }

    public function getedit($id='')
    {
        $id = $this->encryption_url->safe_b64decode($id);
        $output = $this->m_school->getedit($id);
        echo json_encode($output);
    }


    public function requestLists($id='')
    {
        $data['title']      = 'Institute Management';
        if(!empty($id)){
            $id = $this->encryption_url->safe_b64decode($id);
            $data['result']= $this->m_school->requestLists($id);
            $this->load->view('school/request-detail.php', $data, FALSE);
        }else{
            $data['result']= $this->m_school->requestLists();
            $this->load->view('school/request-list.php', $data, FALSE);
        }
    }


    /**
     * Institute -> Bulk upload
     * url : upload-institute
     * @param : id
    **/
    public function import_excel()
    {

        foreach ($_FILES as $key => $value) {
            $pos = strrpos($value['name'], '.');
            $fl = substr($value['name'], $pos+1);
            if($fl !='csv' && $fl !='xsl' && $fl!='xlsx' && $fl !='xlsm' && $fl !='xltm' && $fl !='xltx'){
                $this->session->set_flashdata('error', 'Please Upload the excel file');
                redirect('institute-add', 'refresh');
                die();
           }
        }

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
                    $regno  = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $school = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $mtype  = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $scat   = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $stype   = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $rtype  = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $taluk  = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $talluk = $this->m_school->imptalluk($taluk);
                    $insert = array(
                        'reg_no'            => $regno, 
                        'school_address'    => $school, 
                        'management_type'   => $mtype, 
                        'school_category'   => $scat, 
                        'school_type'       => $stype, 
                        'urban_rural'       => $rtype, 
                        'taluk'             => $talluk->id,
                        'status'            => '1',
                    );

                    $output[] = $this->m_school->insertbulk($insert);
                    
                    if (empty($output[$i])) {
                        $out .= $row.',';
                    }

                    
                }
            }

            if(!empty($out)){
                $out1 = rtrim($out);
                
                $this->session->set_flashdata('error', 'Unable to insert the row '.$out1.'<br> please try again');
            }else{
                $this->session->set_flashdata('success', 'Institute added  Successfully');
            }
            redirect('institute-add', 'refresh');


        }

    }


    public function delete($id='')
    {
        if($this->m_school->delete($id))
            {
                $this->session->set_flashdata('success','institute deleted Successfully');
            }else{
                $this->session->set_flashdata('error','Some error occured <br> please try again.');
            }
        redirect('institute','refresh');
    }


    public function csv()
    {

     $item = $this->input->get('item');

     if ($item == 'all') {
        $query = $this->m_school->csv_school($item);  // fetch Data from table
     }else if($item == 'non'){
        $query = $this->m_school->csv_nonreg($item);
     }

        require_once( APPPATH . 'libraries/PHPExcel/IOFactory.php');
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $table_columns = array("SL NO.","Institiute Name","Register Number","Management Type","School Category","School Type","District","Taluk");
        $column = 0;
        foreach($table_columns as $field)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        $excel_row = 2;
        foreach($query as $row)
        {

            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->id);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->school_address);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->reg_no);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->management_type);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->school_category);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->school_type);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->district);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->title);
            $excel_row++;
        }

        $filename = date('Ymdhis-')."school-list.xlsx";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        $objWriter->save('php://output');
    }


}