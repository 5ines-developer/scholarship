<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_scholar extends CI_Model {

        // get student Detail
        public function singleGet($id = null)
        {
            return $this->db->where('a.id', $id)            
            ->select('a.*,aa.*,am.*,ac.*,ab.*,a.id as aid, aa.name as bnkName,schl.name as schoolName,ind.name as indName,ac.pincode as indPincode, scad.address as sclAddrss,ac.name as pName,tq.title as talqName,cty.title as dstctName,st.title as stName,grd.title as gradutions,crs.course as corse,cls.clss as cLass,ind.name as indName')
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
    

}

/* End of file ModelName.php */
