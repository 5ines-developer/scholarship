<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_school');
        if ($this->session->userdata('said') == '') { $this->session->set_flashdata('error','Please login and try again!'); }
    }

	public function index($id='')
	{
		$data['title']      = 'Institute Management';
		if(!empty($id)){
			$data['result']= $this->m_school->getSchool($id);
			$data['apply']= $this->m_school->getscholar($id);
			$this->load->view('school/detail.php', $data, FALSE);
		}else{
			$data['result']= $this->m_school->getSchool();
			$this->load->view('school/list.php', $data, FALSE);
		}
    }

    	public function block($value='')
    {
        $id = $this->input->post('id');
        $status = '3';
        if($this->m_school->stasChange($id,$status)){
             $data = array('status' => 1, 'msg' => '🙂 Institute Blocked Successfully ');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }

    public function unblock($value='')
    {
        $id = $this->input->post('id');
        $status = '1';
        if($this->m_school->stasChange($id,$status)){
             $data = array('status' => 1, 'msg' => '🙂 Institute Unblocked  Successfully ');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }
    

    public function add($value='')
    {
        $data['title']      = 'Institute Management';
        if(!empty($this->input->post())){

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
            $data['taluk'] = $this->m_school->getTalluk();
            $data['district'] = $this->m_school->getDistrict();
            $this->load->view('school/add', $data, FALSE);
        }
    }


    public function namecheck($value='')
    {
        $name = $this->input->post('name');
        $output = $this->db->where('school_address', $name)->get('reg_schools')->row();
        if(!empty($output)){
            $ret = 1;
        }else{
            $ret = '';
        }
        echo json_encode($ret);
    }

    public function regcheck($value='')
    {
        $regno = $this->input->post('regno');
        $output = $this->db->where('reg_no', $regno)->get('reg_schools')->row();
        if(!empty($output)){
            $ret = 1;
        }else{
            $ret = '';
        }
        echo json_encode($ret);
    }


    public function schoolGet($value='')
    {
        $data['title']    = 'Institutes';
        $this->load->view('school/all', $data, FALSE);
    }

    public function allschool($value='')
    {
        $fetch_data   = $this->m_school->make_datatables();
        $data = array();
        foreach($fetch_data as $row)  
        {  
            $edit = '<a href="'.base_url('institute-edit/').$row->id .'" class="vie-btn blue-text waves-effect waves-light"> Edit</a>';
            $sub_array = array();
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


    public function edit($id='')
    {
        $data['title']      = 'Institute Management';
        if(!empty($this->input->post())){

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
            if($this->m_school->update($id,$insert))
            {
                $this->session->set_flashdata('success','institute updated Successfully');
            }else{
                $this->session->set_flashdata('error','Please login and try again!');
            }
            redirect('institute-edit/'.$id,'refresh');
        }else{
            $data['taluk'] = $this->m_school->getTalluk();
            $data['district'] = $this->m_school->getDistrict();
            $data['result'] = $this->m_school->getedit($id);
            $this->load->view('school/edit', $data, FALSE);
        }
    }

}