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

    public function getIndustry($value='')
    {
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


}

/* End of file Industry.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/controllers/Industry.php */