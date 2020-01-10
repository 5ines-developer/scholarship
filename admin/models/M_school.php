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



	public function getSchool($id='')
	{
		if (!empty($id)) {
			$this->db->where('schl.name', $id);
		}
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


  	public function getTalluk()
    {
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
}