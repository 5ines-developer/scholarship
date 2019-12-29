<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stdapplication extends CI_Model {

	/**
    * get school
    * @data     : schhol data
    **/
    public function getSchool($id='')
    {

        if (!empty($id)) {           
            $this->db->where('rs.taluk', $id);           
        }
        return $this->db->select('sc.name as sId,rs.school_address as sName')
        ->order_by('sc.id', 'desc')
        ->distinct()
        ->from('school sc')
        ->join('reg_schools rs', 'rs.reg_no = sc.reg_no', 'inner')
        ->get()->result();
    }

	/**
    * get company
    * @data     : company data,
    **/
    public function getCompany($value='')
    {
        // return $this->db->select('irg.id as iId,ind.name as iName')
        // ->order_by('irg.id', 'desc')
        // ->distinct()
        // ->group_by('ind.name')
        // ->from('industry_register irg')
        // ->join('industry ind', 'ind.id = irg.industry_id', 'left')
        // ->get()->result();

    	return $this->db->order_by('id', 'desc')->select('id as iId,name as iName')->get('industry')->result();
    }

    /**
    * get talluk
    * @data     : company data,
    **/
    public function getTalluk($id='')
    {
        if (!empty($id)) {           
           $this->db->where('city_id', $id);           
        }
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
        ->select('a.*,aa.*,am.*,ac.*,ab.*,ab.address as saddress, aa.name as bnkName,schl.id as schID,schl.name as schoolName,ac.pincode as indPincode, scad.address as sclAddrss,ac.name as pName,tq.title as talqName,cty.title as dstctName,st.title as stName,grd.title as gradutions,crs.course as corse,cls.clss as cLass,ind.name as indName,ac.talluk as indtalluk,ac.district as inddistrict,ac.pincode as indpincode,ac.relationship as relationship,ac.msalary as msalary,ac.name as indpname,tq.title as instalq,a.id as aId')
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
        ->join('courses crs', 'crs.id = am.course', 'left')
        ->join('gradution grd', 'grd.id = am.graduation', 'left')
        ->join('class cls', 'cls.id = am.class', 'left')

        ->get()->row();
    }

    public function schlName($id='')
    {
       return $this->db->where('id', $id)->get('reg_schools')->row('school_address');
    }

    public function schlAddress($id='')
    {
        $this->db->where('rs.id', $id);
        $this->db->select('rs.school_address,cty.title as district,tl.title as taluku');
        $this->db->from('reg_schools rs');
        $this->db->join('taluq tl', 'tl.id = rs.taluk', 'left');
        $this->db->join('city cty', 'cty.id = tl.city_id', 'left');
        $this->db->distinct();
        $result = $this->db->get()->row();

        if (!empty($result)) {
            return $result->school_address.', '.$result->taluku.', '.$result->district;
        }else{
            return false;
        }
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



    public function garduation($value='')
    {
         return $this->db->distinct()->get('gradution')->result(); 
    }

    public function courseGet($id='')
    {
        return $this->db->distinct()->where('graduation_id',$id)->get('courses')->result();
    }

    public function classGet($id='')
    {
        return $this->db->distinct()->where('course_id',$id)->get('class')->result();
    }

    public function getscholls($aid='')
    {
        $aid = base64_decode($aid);
        $aid = urldecode($aid);
        $school = $this->getScholid($aid);
        return $this->db->where('rs.id', $school)
        ->select('rs.school_address,tq.title as talluk,cty.title as districtname')
        ->from('reg_schools rs')
        ->join('taluq tq', 'tq.id = rs.taluk', 'left')
        ->join('city cty', 'cty.id = tq.city_id', 'left')
        ->get()->row();
    }

    public function getScholid($aid='')
    {
        return $this->db->where('id', $aid)->get('application')->row('school_id');
    }

}

/* End of file m_stdapplication.php */
/* Location: ./application.php */