<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industry extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_school');
        $this->load->model('m_industry');
        if ($this->session->userdata('said') == '') { $this->session->set_flashdata('error','Please login and try again!');redirect('login','refresh'); }
        $this->load->library(array('email', 'upload', 'MY_Upload', 'excel'));
    }

    /** industry- get registered industry
    *   @param  - url, year for filters
    *   @url    - industry/id (id for detail)
    **/
	public function index($id='',$year='')
	{
		$data['title']      = 'Industry Management';
        if(!empty($id)){
            $data['result']= $this->m_industry->getCompany($id);
            $data['apply']= $this->m_industry->getscholar($id);
            $data['emp']= $this->m_industry->getEmployee($id);
            $this->load->view('industry/detail.php', $data, FALSE);
        }else{
            $data['count'] = $this->m_industry->industrycount($year);
            $data['taluk'] = $this->m_school->getTalluk();
            $data['district'] = $this->m_school->getDistrict();
            $this->load->view('industry/list.php', $data, FALSE);
        }
        
    }

    /** industry- get registered industry for datatables
    *   @param  - url, year for filters
    *   @url    - industry/id (id for detail)
    **/
    public function getIndustry($value='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);
    
    	$fetch_data   = $this->m_industry->getIndustry();
        $data = array();
        foreach($fetch_data as $row)  
        {  

        	if ($row->act == '1') {
        		$act = 'Labour Act';
        	}else{
        		$act = 'Factory Act';
        	}

            if ($row->status == '1') {
                $status = '<p class="status green darken-2">Active</p>';
            }else if ($row->status == '2') {
                $status = '<p class="status red darken-2">Blocked</p>';
            }else{
                $status = '<p class="status blue darken-2">Inactive</p>';
            }

            $detail = '<a href="'.base_url('industry/detail/').$row->industryId .'" class="vie-btn blue-text waves-effect waves-light"> View</a>';
            $sub_array = array();
            $sub_array[] = character_limiter($row->name, 9);
            $sub_array[] = $row->reg_id;  
            $sub_array[] = $act;
            $sub_array[] = $row->district;  
            $sub_array[] = $row->title;  
            $sub_array[] = $status;  
            $sub_array[] = $detail; 

            $data[] = $sub_array;  
        }

        $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>      $this->m_industry->get_all_data(),  
            "recordsFiltered"     =>     $this->m_industry->get_filtered_data(),  
            "data"                =>     $data  
        );
        echo json_encode($output);
    }

    /** industry- get registered industry counts for industry dashboard
    *   @param  - url, year for filters
    *   @url    - industry/id (id for detail)
    **/
    public function industryGet($year='')
    {
        $data['title']     = 'Industries';
        $data['count']     = $this->m_industry->industrycount($year);
        $this->load->view('industry/all', $data, FALSE);
    }


    /** industry- get all industry dropdowns
    *   @url    - industries
    **/
    public function allindustry($value='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        $fetch_data   = $this->m_industry->make_datatables();
        $data = array();
        foreach($fetch_data as $row)  
        {  
            $edit = '<a href="'.base_url('industry-edit/').$row->id .'" class="vie-btn blue-text waves-effect waves-light"> Edit</a>';

            if($row->act == '1'){
                $act = 'Labour Act';
            }else{
                $act = 'Factory Act';
            }

            $sub_array = array();
            $sub_array[] = character_limiter($row->name, 12);
            $sub_array[] = $row->reg_id;  
            $sub_array[] = $act;
            $sub_array[] = date('d M, Y',strtotime($row->created_on));  
            $sub_array[] = $edit;
            $data[] = $sub_array;  
        }

        $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>      $this->m_industry->get_all(),  
            "recordsFiltered"     =>     $this->m_industry->get_filtered(),  
            "data"                =>     $data  
        );
        echo json_encode($output);
    }

    /** industry- get company add request list
    *   @param  - id
    *   @url    - industry-request/id (id for detail)
    **/
    public function requestLists($id='')
    {
        $data['title']      = 'Industry Management';
        if(!empty($id)){
            $data['result']= $this->m_industry->requestLists($id);
            $this->load->view('industry/request-detail.php', $data, FALSE);
        }else{
            $data['result']= $this->m_industry->requestLists();
            $this->load->view('industry/request-list.php', $data, FALSE);
        }
    }

    /** industry- add ompany
    *   @url    - industry-add
    **/
    public function add($value='')
    {

            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        $data['title']      = 'Industry Management';
        if(!empty($this->input->post())){
            $insert = array(
                'name'   => $this->input->post('name'), 
                'reg_id' => $this->input->post('rno'), 
                'act'    => $this->input->post('act'), 
               
            );
            if($this->m_industry->add($insert))
            {
                $this->session->set_flashdata('success','industry added Successfully');
                redirect('industries','refresh');
            }else{
                $this->session->set_flashdata('error','Please login and try again!');
                redirect('industry-add','refresh');
            }
        }else{
            $data['taluk'] = $this->m_school->getTalluk();
            $data['district'] = $this->m_school->getDistrict();
            $this->load->view('industry/add', $data, FALSE);
        }
    }

    /** industry- add ompany - check name already exist
    *   @url    - industry-add
    **/
    public function namecheck($value='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        $name = $this->input->post('name');
        $output = $this->db->where('name', $name)->get('industry')->row();
        if(!empty($output)){
            $ret = 1;
        }else{
            $ret = '';
        }
        echo json_encode($ret);
    }


    /** industry- add ompany - check register number already exist
    *   @url    - industry-add
    **/
    public function regcheck($value='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        $regno = $this->input->post('regno');
        $output = $this->db->where('reg_id', $regno)->get('industry')->row();
        if(!empty($output)){
            $ret = 1;
        }else{
            $ret = '';
        }
        echo json_encode($ret);
    }

    /** industry- edit ompany 
    *   @url    - industry-edit/id
    **/
    public function edit($id='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        $data['title']      = 'Industry Management';
        if(!empty($this->input->post())){

            $insert = array(
                'name'   => $this->input->post('name'), 
                'reg_id' => $this->input->post('rno'), 
                'act'    => $this->input->post('act'),
            );
            if($this->m_industry->update($id,$insert))
            {
                $this->session->set_flashdata('success','Industry updated Successfully');
            }else{
                $this->session->set_flashdata('error','Please login and try again!');
            }
            redirect('industry-edit/'.$id,'refresh');
        }else{
            $data['taluk'] = $this->m_school->getTalluk();
            $data['district'] = $this->m_school->getDistrict();
            $data['result'] = $this->m_industry->getedit($id);
            $this->load->view('industry/edit', $data, FALSE);
        }
    }


    /** industry- block the industry - director
    *   @url    - industry-edit/id
    **/
    public function block($value='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        $id = $this->input->post('id');
        $status = '2';
        if($this->m_industry->stasChange($id,$status)){
             $data = array('status' => 1, 'msg' => '🙂 Industry Blocked Successfully ');
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

        $id = $this->input->post('id');
        $status = '1';
        if($this->m_industry->stasChange($id,$status)){
             $data = array('status' => 1, 'msg' => '🙂 Institute Unblocked  Successfully ');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }


    /** industry- block the industry - director
    *   @url    - industry-edit/id
    **/
    public function empblock($value='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_GET);

        $id = $this->input->get('id');
        $ind = $this->input->get('ind');
        $stat = '2';
        if($this->m_industry->empstasChange($id,$stat)){
             $this->session->set_flashdata('success','🙂 HR Blocked Successfully');
        }else{
            $this->session->set_flashdata('error','🙂 Server error occurred. Please try again later');
        }
       redirect('industry/detail/'.$ind,'refresh');
    }

    public function empunblock($value='')
    {

            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_GET);

        $id = $this->input->get('id');
        $ind = $this->input->get('ind');
        $stat = '1';
        if($this->m_industry->empstasChange($id,$stat)){
             $this->session->set_flashdata('success','🙂 HR Un blocked Successfully');
        }else{
            $this->session->set_flashdata('error','🙂 Server error occurred. Please try again later');
        }
       redirect('industry/detail/'.$ind,'refresh');
    }


        /**
     * industry -> Bulk upload
     * url : upload-industry
     * @param : id
    **/
    public function import_excel()
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
                    $comapny = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $regno  = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $act  = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

                    if($act == 'Labour Act' || $act == 'labour act' || $act == 'Labour act'){
                        $acts = '1';
                    }else{
                        $acts = '2';
                    }
                    
                    $insert = array(
                        'name'              => $comapny,
                        'reg_id'              => $regno,
                        'act'               =>  $acts,

                    );
                    

                    $output[] = $this->m_industry->insertbulk($insert);

                    if (empty($output[$i])) {
                        $out .= $row.',';
                    }

                    
                }
            }


            if(!empty($out)){
                $out1 = rtrim($out);
                
                $this->session->set_flashdata('error', 'Unable to insert the row '.$out1.'<br> please try again');
            }else{
                $this->session->set_flashdata('success', 'Industry added  Successfully');
            }
            redirect('industry-add', 'refresh');


        }

    }



}

/* End of file Industry.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/controllers/Industry.php */