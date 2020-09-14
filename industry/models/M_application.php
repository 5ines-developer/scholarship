<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_application extends CI_Model {

    public function getScholarshipRequest($year='')
    {
        $in = array(1,2);
        if (!empty($year)) {
            $this->db->where('a.application_year', $year);
        }
        $sccomp = $this->session->userdata('sccomp');
        $this->db->where('a.company_id', $sccomp);
        $this->db->where('a.application_state',2);
        $this->db->group_by('a.application_year,a.Student_id');
        
        $this->db->group_start();
            $this->db->where_not_in('a.status',$in );
        $this->db->group_end();
        $this->db->order_by('a.id', 'desc');
        $this->db->from('application a');
        $this->db->join('student s', 's.id = a.Student_id', 'left');
        $this->db->join('applicant_marks m', 'm.application_id = a.id', 'left');
        $this->db->join('courses crs', 'crs.id = m.course', 'left');
        $this->db->join('class cls', 'cls.id = m.class', 'left')
        ->join('gradution grd', 'grd.id = m.graduation', 'left')
        ->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left')
        ->join('fees fs', 'fs.class = grd.id', 'left');
        $this->db->select('m.prv_marks as mark, cls.clss as class, ab.name, a.id,crs.course,fs.amount,m.graduation,a.application_year,a.date');
        return $this->db->get()->result();     
    }

    public function getScholarshipApproved($year='')
    {
        $in = array(3,4);
        if (!empty($year)) {
            $this->db->where('a.application_year', $year);
        }
        $sccomp = $this->session->userdata('sccomp');
        $this->db->select('m.prv_marks as mark, cls.clss as class, ab.name, a.id,crs.course,fs.amount,m.graduation,a.application_year,a.date');
        $this->db->from('application a');
        $this->db->where('a.company_id', $sccomp);        
        $this->db->order_by('id', 'desc');
        $this->db->group_start();
            $this->db->where_in('a.application_state',$in);
        $this->db->group_end();
        $this->db->group_by('a.application_year,a.Student_id');
        $this->db->join('student s', 's.id = a.Student_id', 'left');
        $this->db->join('applicant_marks m', 'm.application_id = a.id', 'left');
        $this->db->join('courses crs', 'crs.id = m.course', 'left');
        $this->db->join('class cls', 'cls.id = m.class', 'left')
        ->join('gradution grd', 'grd.id = m.graduation', 'left')
        ->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left')
        ->join('fees fs', 'fs.class = grd.id', 'left');
        return $this->db->get()->result();     
    }

    public function getScholarshipRejected($year='')
    {
        if (!empty($year)) {
            $this->db->where('a.application_year', $year);
        }
        $sccomp = $this->session->userdata('sccomp');
        $this->db->select('m.prv_marks as mark, cls.clss as class, ab.name, a.id,crs.course,fs.amount,m.graduation,a.application_year,a.date');
        $this->db->from('application a');
        $this->db->where('a.company_id', $sccomp);
        $this->db->where('a.application_state !=',1);
        $this->db->where('a.status', 2);
        $this->db->group_by('a.application_year,a.Student_id');
        $this->db->order_by('id', 'desc');
        $this->db->join('student s', 's.id = a.Student_id', 'left');
        $this->db->join('applicant_marks m', 'm.application_id = a.id', 'left');
        $this->db->join('courses crs', 'crs.id = m.course', 'left');
        $this->db->join('class cls', 'cls.id = m.class', 'left')
        ->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left')
        ->join('gradution grd', 'grd.id = m.graduation', 'left')
        ->join('fees fs', 'fs.class = grd.id', 'left');
        return $this->db->get()->result();     
    }

    // get student Detail
    public function singleStudent($id = null)
    {
        return $this->db->where('a.id', $id)            
        ->select('a.*,aa.*,am.*,ac.*,ab.*,a.id as aid, aa.name as bnkName,schl.name as schoolName,ind.name as indName,ac.pincode as indPincode, scad.address as sclAddrss,ac.name as pName,tq.title as talqName,cty.title as dstctName,st.title as stName,grd.title as gradutions,crs.course as corse,cls.clss as cLass,ind.name as indName,,ab.f_adhar, ab.f_adharfile, ab.m_adhar, ab.m_adharfile,a.comp_approve,ir.mobile as compPhone')
        ->from('application a')        
        ->join('applicant_account aa', 'aa.application_id = a.id', 'left')
        ->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left')
        ->join('applicant_comapny ac', 'ac.application_id = a.id', 'left')
        ->join('applicant_marks am', 'am.application_id = a.id', 'left')
        ->join('school schl', 'schl.name = a.school_id', 'left')
        ->join('school_address scad', 'scad.school_id = a.school_id', 'left')
        ->join('industry ind', 'ind.id = a.company_id', 'left')
        ->join('industry_register ir', 'ir.industry_id = ind.id', 'left')
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


    // approve the application
    public function approval($id = null)
    {
        $this->db->where('id', $id);
       return $this->db->update('application', array('application_state' => 3,'comp_approve'=>date('Y-m-d')));
        // if($this->db->affected_rows() > 0){
        //     return true;
        // }else{
        //     return false;
        // }
    }


    // Reject application
    public function reject($data, $id)
    {
        $this->db->where('id', $id);
       return  $this->db->update('application', $data);
        // if($this->db->affected_rows() > 0){
        //     return true;
        // }else{
        //     return false;
        // }
    }

    public function compDocs($id = null)
    {   
       return $this->db->select('name,seal,sign')->where('industry_id', $id)->where('type','1')->get('industry_register')->row();
        
    }

    public function emailGet($id='')
    {
        return $this->db->select('email')->where('id',$id)->get('student')->row('email');
    }

    public function phoneGet($id='')
    {
        return $this->db->select('phone')->where('id',$id)->get('student')->row('phone');
    }

    public function singphoneget($id='')
    {
        $result = $this->db->where('id', $id)->get('application')->row('Student_id');
        return $this->phoneGet($result);
    }


    public function getamnt($year='',$grd='')
    {
       $result =  $this->db->where('date', $year)->where('class',$grd)->get('fees')->result();
       if (!empty($result)) {
            foreach ($result as $key => $value) {
                return $value->amount;
            }
       }else{

            $stryr = strtotime($year.'-01-01 -1 year');
            $lastYear = date('Y', $stryr);
            $result1 = $this->db->where('date', $lastYear)->where('class',$grd)->get('fees')->result();
            if (!empty($result1)) {
                foreach ($result1 as $keys => $values) {
                    return $values->amount;
                }
           }else{
                $lastYears = strtotime($lastYear.'-01-01 -1 year');
                $lastYear1 = date('Y', $lastYears);
                $result2 = $this->db->where('date', $lastYear1)->where('class',$grd)->get('fees')->row('amount');
                if (!empty($result2)) {
                   return $result2;
               }else{
                return false;
               }
           }

       }
    }

    public function getPay($cmpid='',$apyear='')
    {
      $this->db->where('year', $apyear)->where('comp_reg_id',$cmpid);
      return $this->db->get('payment')->row();
    }


}

/* End of file ModelName.php */
