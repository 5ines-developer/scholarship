<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stdapplication extends CI_Model {

	/**
    * get school
    * @data     : schhol data
    **/
    public function getSchool($value='')
    {
    	return $this->db->order_by('id', 'desc')->select('id as sId,name as sName')->where('status','1')->get('school')->result();
    }

	/**
    * get company
    * @data     : company data,
    **/
    public function getCompany($value='')
    {
    	return $this->db->order_by('id', 'desc')->select('id as iId,name as iName')->where('status','1')->get('industry')->result();
    }

    /**
    * get talluk
    * @data     : company data,
    **/
    public function getTalluk($value='')
    {
    	return $this->db->order_by('id', 'asc')->select('id as tallukId,title as talluk')->get('taluq')->result();
    }

    /**
    * get talluk
    * @data     : company data,
    **/
    public function getDistrict($value='')
    {
    	return $this->db->order_by('id', 'asc')->select('id as districtId,district')->get('district')->result();
    }

    /**
    * inser student scholarship application
    * @data     : application data,
    **/
    public function insertAppli($apply='')
    {
    	$this->db->where('uniq !=', $apply['uniq'])->insert('application',$apply);
    	if ($this->db->affected_rows() >0) {
    		return $this->db->insert_id();
    	}else{
    		return false;
    	}
    }

    public function aplliBasic($insert='')
    {
    	$this->db->where('application_id !=', $insert['application_id'])->insert('applicant_basic_detail',$insert);
    	if ($this->db->affected_rows() >0) {
    		return $this->db->insert_id();
    	}else{
    		return false;
    	}
    }

}

/* End of file m_stdapplication.php */
/* Location: ./application.php */