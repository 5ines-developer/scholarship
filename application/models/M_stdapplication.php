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
    	return $this->db->order_by('id', 'asc')->select('id as districtId,title as district')->get('city')->result();
    }

    /**
    * inser student scholarship application
    * @data     : application data,
    **/
    public function insertAppli($apply='')
    {
        $query = $this->db->where('Student_id', $this->session->userdata('stlid'))
        ->where('application_year',date('Y'))
        ->where('status','2')
        ->get('application');

        if ($query->num_rows() > 0) {
            $this->db->where('Student_id', $this->session->userdata('stlid'))
            ->where('application_year',date('Y'))
            ->where('status','2')->update('application',$apply);
            return $query->row('id');
        }else{
            $this->db->insert('application',$apply);
            return $this->db->insert_id();
        }
    	
    	
    }

    public function aplliBasic($insert='')
    {
        $query = $this->db->where('application_id', $insert['application_id'])->get('applicant_basic_detail');
        if ($query->num_rows() > 0) {
            return $this->db->where('application_id', $insert['application_id'])->update('applicant_basic_detail',$insert);
        }else{
            return $this->db->insert('applicant_basic_detail',$insert);
        }
	
    }

    public function applicantAccount($insert = null)
    {
        $query = $this->db->where('application_id', $insert['application_id'])->get('applicant_account');
        if ($query->num_rows() > 0) {
            return $this->db->where('application_id', $insert['application_id'])->update('applicant_account',$insert);
        }else{
            return $this->db->insert('applicant_account',$insert);
        }
    }

    public function applicantCompany($insert = null)
    {
        $query = $this->db->where('application_id', $insert['application_id'])->get('applicant_comapny');
        if ($query->num_rows() > 0) {
            return $this->db->where('application_id', $insert['application_id'])->update('applicant_comapny',$insert);
        }else{
            return $this->db->insert('applicant_comapny',$insert);
        }

    }

    public function applicantSchool($insert = null)
    {
        $query = $this->db->where('application_id', $insert['application_id'])->get('applicant_marks');
        if ($query->num_rows() > 0) {
            return $this->db->where('application_id', $insert['application_id'])->update('applicant_marks',$insert);
        }else{
            return $this->db->insert('applicant_marks',$insert);
        }
    }

    /**
    * student application - fetch the application detail
    * @url      : student/application-detail
    * @param    : null
    * @data     : student application data,
    **/
    public function getApplication($id = null)
    {      
        return $this->db->where('a.Student_id', $id)->where('a.application_year',date('Y'))
        ->select('a.*,aa.*,am.*,ac.*,ab.*,ab.address as saddress, aa.name as bnkName,schl.name as schoolName,ind.name as indName,ac.pincode as indPincode, scad.address as sclAddrss,ac.name as pName,tq.title as talqName,cty.title as dstctName,st.title as stName')
        ->from('application a')        
        ->join('applicant_account aa', 'aa.application_id = a.id', 'left')
        ->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left')
        ->join('applicant_comapny ac', 'ac.application_id = a.id', 'left')
        ->join('applicant_marks am', 'am.application_id = a.id', 'left')
        ->join('school schl', 'schl.id = a.school_id', 'left')
        ->join('school_address scad', 'scad.school_id = a.school_id', 'left')
        ->join('industry ind', 'ind.id = a.company_id', 'left')
        ->join('state st', 'st.id = ind.state', 'left')
        ->join('city cty', 'cty.id = ac.district', 'left')
        ->join('taluq tq', 'tq.id = ac.talluk', 'left')
        ->get()->row();
    }

    /**
    * student application - get the status
    * @url      : student/application-status
    * @param    : null
    * @data     : student application data,
	**/
    public function getStatus($id = null)
    {   
       return $this->db->where('Student_id', $id)->where('application_year',date('Y'))->get('application')->row();  
    }

    public function checkApply($id = null)
    {
       return $this->db->where('Student_id', $id)->where('application_year',date('Y'))->get('application')->row(); 
    }

}

/* End of file m_stdapplication.php */
/* Location: ./application.php */