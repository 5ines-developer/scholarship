<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_school extends CI_Model {

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
    	$query  = $this->db->where('insert', $insert['reg_no'])->get('reg_schools');
    	if ($query->num_rows() > 0) {
    		return false;
    	}else{
    		
    	}

    }
}