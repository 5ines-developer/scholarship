<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    public function getScholarshipRequest()
    {
        $in = array(1,2);
        $school = $this->session->userdata('school');
        $this->db->from('application a');
        $this->db->where('a.school_id', $school);
        $this->db->where('a.application_state', 1);
        $this->db->group_start();
            $this->db->where_not_in('a.status',$in );
        $this->db->group_end();
        $this->db->order_by('id', 'desc');
        $this->db->join('student s', 's.id = a.Student_id', 'left');
        $this->db->join('applicant_marks m', 'm.application_id = a.id', 'left');
        $this->db->select('m.prv_marks as mark, m.class, s.name, a.id');
        return $this->db->get()->result();     
    }
    
    // get student Detail
    public function singleStudent($id = null)
    {
        return $this->db->where('a.id', $id)        
        ->select('a.*,aa.*,am.*,ac.*,ab.*,a.id as aid, aa.name as bnkName,schl.name as schoolName,ind.name as indName,ac.pincode as indPincode, scad.address as sclAddrss,ac.name as pName,tq.title as talqName,cty.title as dstctName,st.title as stName')
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

    // approve the application
    public function approval($id = null)
    {
        $this->db->where('id', $id);
        $this->db->update('application', array('application_state' => 2));
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    // Reject application
    public function reject($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('application', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    // rejected student list
    public function getScholarshipRejects()
    {
        $school = $this->session->userdata('school');
        $this->db->from('application a');
        $this->db->where('a.school_id', $school);
        $this->db->where('a.status ', 2);
        $this->db->order_by('id', 'desc');
        $this->db->join('student s', 's.id = a.Student_id', 'left');
        $this->db->join('applicant_marks m', 'm.application_id = a.id', 'left');
        $this->db->select('m.prv_marks as mark, m.class, s.name, a.id');
        return $this->db->get()->result();  
    }

    // Approved student list
    public function getScholarshipApproved()
    {
        $in = array(2,3,4);
        $school = $this->session->userdata('school');
        $this->db->from('application a');
        $this->db->where('a.school_id', $school);
        $this->db->group_start();
            $this->db->where_in('a.application_state',$in);
        $this->db->group_end();
        $this->db->order_by('id', 'desc');
        $this->db->join('student s', 's.id = a.Student_id', 'left');
        $this->db->join('applicant_marks m', 'm.application_id = a.id', 'left');
        $this->db->select('m.prv_marks as mark, m.class, s.name, a.id');
        return $this->db->get()->result();  
    }
    
}

/* End of file getScholarshipRequest.php */
