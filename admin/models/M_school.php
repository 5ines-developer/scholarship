<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_school extends CI_Model {

    function make_datatables(){  
        $this->make_query();  
        if($_POST["length"] != -1)  
        {  
             $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get(); 
        return $query->result();  
    }




    public function make_query($value='')
    {
        $select_column = array('reg.id','reg.reg_no','reg.school_address','reg.management_type','reg.school_category','reg.school_type','reg.urban_rural','reg.taluk','reg.status','tq.title','cty.title as district');
        $order_column = array("reg.school_address","reg.reg_no", "reg.management_type", "tq.title", "cty.title","reg.status",null );  

        $this->db->select($select_column);
        $this->db->from('reg_schools reg');
        $this->db->join('taluq tq', 'tq.id = reg.taluk', 'left');
        $this->db->join('city cty', 'cty.id = tq.city_id', 'left');

        if(isset($_POST["search"]["value"])){
            $this->db->like("reg.reg_no", $_POST["search"]["value"]);  
            $this->db->or_like("reg.school_address", $_POST["search"]["value"]);
            $this->db->or_like("reg.management_type", $_POST["search"]["value"]);
            $this->db->or_like("reg.school_category", $_POST["search"]["value"]);
            $this->db->or_like("reg.school_type", $_POST["search"]["value"]);
            $this->db->or_like("tq.title", $_POST["search"]["value"]);
            $this->db->or_like("reg.urban_rural", $_POST["search"]["value"]);
            $this->db->or_like("reg.status", $_POST["search"]["value"]);
        }

        if(isset($_POST["order"]))  
        {  
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
            $this->db->order_by('reg.school_address', 'ASC');  
        }  
    }


    function get_filtered_data(){  
        $this->make_query();  
        $query = $this->db->get();  
        return $query->num_rows();  
    } 

    function get_all_data()  
    {  
        $select_column = array('reg.id','reg.reg_no','reg.school_address','reg.management_type','reg.school_category','reg.school_type','reg.urban_rural','reg.taluk','reg.status');
        $this->db->select($select_column);
        $this->db->from('reg_schools reg');
        return $this->db->count_all_results();
    }



	public function getSchool($id='',$district='',$taluk='')
	{
        if (!empty($id)) {  $this->db->where('schl.name', $id); } 
		if (!empty($taluk)) { $this->db->where('rs.taluk', $taluk); } 
        return $this->db->select('schl.name as id,rs.reg_no,rs.school_address,rs.management_type,rs.school_category,rs.school_type,rs.urban_rural,tq.title,cty.title as district,sca.status,schl.reg_certification,schl.principal,schl.priciple_signature,schl.seal,schl.created_on')
		->from('school schl')
		->join('reg_schools rs', 'rs.id = schl.name', 'left')
		->join('school_auth sca', 'sca.school_id = schl.id', 'left')
		->join('taluq tq', 'tq.id = rs.taluk', 'left')
		->join('city cty', 'cty.id = tq.city_id', 'left')		
		->get()->result();
	}


	public function getscholar($id='')
    {
        $this->db->select('m.prv_marks as mark, m.class, s.name, a.id,a.application_year');
        $this->db->from('application a');
        $this->db->where('a.school_id', $id);        
        $this->db->order_by('a.id', 'desc');
        $this->db->join('student s', 's.id = a.Student_id', 'left');
        $this->db->join('applicant_marks m', 'm.application_id = a.id', 'left');
        return $this->db->get()->result();     
    }

    public function stasChange($id='',$status='')
  	{
	    $this->db->where('school_id', $id)->update('school_auth', array('status' => $status));
	    if($this->db->affected_rows() > 0){
	      return true;
	    }
	    else{
	       return false;
    	}
  	}


  	public function getTalluk($dist='')
    {
        if(!empty($dist)){ $this->db->where('city_id', $dist); }
    	return $this->db->order_by('id', 'asc')->select('id as tallukId,title as talluk')->get('taluq')->result();
    }

     public function getDistrict($value='')
    {
    	return $this->db->order_by('id', 'asc')->select('id as districtId,title as district')->get('city')->result();
    }

    public function add($insert='')
    {
    	return $this->db->where('reg_no !=', $insert['reg_no'])->insert('reg_schools',$insert);
    }

    public function update($id='',$update='')
    {
        return $this->db->where('id', $id)->update('reg_schools',$update);
    }

    public function getedit($id='')
    {
        $this->db->select('reg.id,reg.reg_no,reg.school_address,reg.management_type,reg.school_category,reg.school_type,reg.urban_rural,reg.taluk,reg.status,cty.id as district');
         $this->db->where('reg.id', $id);
        $this->db->from('reg_schools reg');
        $this->db->join('taluq tq', 'tq.id = reg.taluk', 'left');
        $this->db->join('city cty', 'cty.id = tq.city_id', 'left');
        return $this->db->get()->row();
    }


    public function requestLists($id='')
    {
        if(!empty($id)){
            $this->db->where('sca.id', $id);
        }
        $this->db->select('sca.id,sca.name,sca.email,sca.mobile,sca.pincode,sca.address,sca.register_doc,sca.date,tq.title as taluk,cty.title as district');
        $this->db->order_by('sca.id', 'desc');
        $this->db->from('school_add sca');
        $this->db->join('taluq tq', 'tq.id = sca.taluk', 'left');
        $this->db->join('city cty', 'cty.id = sca.district', 'left');
        return $this->db->get('school_add')->result();
    }

    public function getEmployee($id='')
    {
        return $this->db->where('name',$id)->get('school_auth')->result();
    }

    public function schoolcount($year='')
    {
        $year = date('Y');
        $data['cr_scool']   = $this->thisy_count($year);
        $data['tot_app']   = $this->stscolar($year);
        $data['ac_inst']   = $this->active_inst($year);
        $data['tot']        = $this->db->get('reg_schools')->num_rows();
        return $data;
    }

    public function thisy_count($year='')
    {
        $sdate = date('Y') . '-01-01';
        $edate = date('Y'). '-12-31';
        $this->db->where('created_on >=', $sdate);
        $this->db->where('created_on <=', $edate);
        return $this->db->get('school')->num_rows();
    }

    public function stscolar($year='')
    {
        $this->db->group_by('application_year,school_id');
        return $this->db->get('application')->num_rows();
    }

    public function active_inst($year='')
    {
        return $this->db->get('school')->num_rows();
    }

    public function imptalluk($taluk='')
    {
       return $this->db->where('title', $taluk)->get('taluq')->row();
    }

    public function insertbulk($insert='')
    {
        $query = $this->db->where('reg_no', $insert['reg_no'])->or_where('school_address', $insert['school_address'])->get('reg_schools');
        if ($query->num_rows() > 0) {
            return false;
        }else{
            return $this->db->insert('reg_schools', $insert);
        }
    }


}