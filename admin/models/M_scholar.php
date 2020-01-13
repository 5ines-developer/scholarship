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


    public function make_datatables($value='')
    {
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

        $select_column = array('s.name','rs.school_address as school', 'ind.name as industry','a.id','crs.course','a.application_year','a.application_state','a.status','cls.clss','a.date','tq.title as taluk','cty.title as district');
        $order_column = array("s.name","a.school_id", "ind.name",null,"crs.course","a.application_year","a.application_state","a.status");  

        $this->db->select($select_column)
        ->order_by('a.id', 'desc')
        ->from('application a')
        ->join('applicant_marks m', 'm.application_id = a.id', 'left')
        ->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left')
        ->join('applicant_comapny ac', 'ac.application_id = a.id', 'left')
        ->join('applicant_marks am', 'am.application_id = a.id', 'left')
        ->join('student s', 's.id = a.Student_id', 'left')
        ->join('school schl', 'schl.id = a.school_id', 'left')
        ->join('school_address scad', 'scad.school_id = a.school_id', 'left')
        ->join('reg_schools rs', 'rs.id = a.school_id', 'left')
        ->join('industry ind', 'ind.id = a.company_id', 'left')
        ->join('state st', 'st.id = ind.state', 'left')
        ->join('city cty', 'cty.id = am.ins_district', 'left')
        ->join('taluq tq', 'tq.id = am.ins_talluk', 'left')
        ->join('courses crs', 'crs.id = m.course', 'left')
        ->join('class cls', 'cls.id = m.class', 'left');

        if(isset($_POST["search"]["value"])){
            $this->db->like("s.name", $_POST["search"]["value"]);  
            $this->db->or_like("rs.school_address", $_POST["search"]["value"]);
            $this->db->or_like("ind.name", $_POST["search"]["value"]);
            $this->db->or_like("cls.clss", $_POST["search"]["value"]);
            $this->db->or_like("crs.course", $_POST["search"]["value"]);
            $this->db->or_like("cls.clss", $_POST["search"]["value"]);
            $this->db->or_like("tq.title", $_POST["search"]["value"]);
            $this->db->or_like("cty.title", $_POST["search"]["value"]);
            $this->db->or_like("a.application_year", $_POST["search"]["value"]);
            $this->db->or_like("a.date", $_POST["search"]["value"]);
        }

        if(isset($_POST["order"]))  
        {  
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
            $this->db->order_by('a.id', 'DESC');  
        }  
    }


    function get_filtered_data(){  
        $this->make_query();  
        $query = $this->db->get();  
        return $query->num_rows();  
    } 

    function get_all_data()  
    {  
        $this->db->from('application');
        return $this->db->count_all_results();
    }

    public function emailGet($id='')
    {
        return $this->db->select('email')->where('id',$id)->get('student')->row('email');
    }

    public function phoneGet($id='')
    {
        return $this->db->select('phone')->where('id',$id)->get('student')->row('phone');
    }

        // approve the application
    public function approval($id = null)
    {
        $this->db->where('id', $id);
        return $this->db->update('application', array('status' => 1));
    }

    
    // Reject application
    public function reject($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('application', $data);
    }

    

}

/* End of file ModelName.php */
