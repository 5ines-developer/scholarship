<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_scholar extends CI_Model {

    // get student Detail
    public function singleGet($id = null)
    {
        return $this->db->where('a.id', $id)            
        ->select('a.*,aa.*,am.*,ac.*,ab.*,a.id as aid, aa.name as bnkName,schl.name as schoolName,ind.name as indName,ac.pincode as indPincode, scad.address as sclAddrss,ac.name as pName,tq.title as talqName,cty.title as dstctName,st.title as stName,grd.title as gradutions,crs.course as corse,cls.clss as cLass,ind.name as indName,ab.f_adhar, ab.f_adharfile, ab.m_adhar, ab.m_adharfile')
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


    public function make_datatables($filter='')
    {
        $this->make_query($filter);  
        if($_POST["length"] != -1)  
        {  
             $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get(); 
        return $query->result();  
    }

    public function make_query($filter='')
    {

        $select_column = array('ab.name','rs.school_address as school', 'ind.name as industry','a.id','crs.course','a.application_year','ab.adharcard_no','a.application_state','a.status','cls.clss','a.date','tq.title as taluk','cty.title as district','m.graduation');
        $order_column = array("ab.name","a.school_id", "ind.name",null,"crs.course","a.application_year","a.application_state","a.status"); 


        $this->db->select($select_column);

        if (!empty($filter['item'])) {
            if($filter['item'] =='approved'){
                $stss = '1';
            }else if($filter['item'] =='rejected'){
                $stss = '2';
            }else if($filter['item'] =='pending'){
                $stss = '0';
                 $this->db->where('a.application_state', 4);
            }else{
                $stss = '0';
            }
            $this->db->group_start();
             $this->db->where('a.status', $stss);
            $this->db->group_end();
        }


        if (!empty($filter['year'])) {
            $this->db->group_start();
                $this->db->where('a.application_year', $filter['year']);
            $this->db->group_end();
        }

        if (!empty($filter['caste'])) { 
            $this->db->group_start();
            $this->db->where('ab.category', $filter['caste']); 
            $this->db->group_end();
        }

        if (!empty($filter['district'])) {
            $this->db->group_start();
                $this->db->where('am.ins_district', $filter['district']);
            $this->db->group_end();
        }

        if (!empty($filter['taluk'])) {
            $this->db->group_start();
                $this->db->where('am.ins_talluk', $filter['taluk']);
            $this->db->group_end();
        }
        $this->db->group_by('a.application_year,a.Student_id');
        $this->db->order_by('a.id', 'desc')
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
        ->join('class cls', 'cls.id = m.class', 'left')
        ->join('gradution grd', 'grd.id = am.graduation', 'left')
        ->join('fees fs', 'fs.class = grd.id', 'left');
        if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("ab.name", $_POST["search"]["value"]);  
                $this->db->or_like("rs.school_address", $_POST["search"]["value"]);
                $this->db->or_like("ind.name", $_POST["search"]["value"]);
                $this->db->or_like("cls.clss", $_POST["search"]["value"]);
                $this->db->or_like("crs.course", $_POST["search"]["value"]);
                $this->db->or_like("cls.clss", $_POST["search"]["value"]);
                $this->db->or_like("tq.title", $_POST["search"]["value"]);
                $this->db->or_like("cty.title", $_POST["search"]["value"]);
                $this->db->or_like("a.application_year", $_POST["search"]["value"]);
                $this->db->or_like("a.date", $_POST["search"]["value"]);
                $this->db->or_like("ab.adharcard_no", $_POST["search"]["value"]);
            $this->db->group_end();
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


    function get_filtered_data($filter){  
        $this->make_query($filter);  
        $query = $this->db->get();  
        return $query->num_rows();  
    } 

    function get_all_data($filter)  
    {  
        $this->make_query($filter);  
        $this->db->from('application');
        return $this->db->count_all_results();
    }

    public function distGet($dist='')
    {
        return $this->db->where('title', $dist)->get('city')->row('id');
    }

    public function talGet($tal='')
    {
        return $this->db->where('title', $tal)->get('taluq')->row('id');
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

    public function approveSelect($id='')
    {
        $this->db->where('id', $id);
        $this->db->where('application_state', 4);
        $this->db->update('application', array('status' => 1));
        if($this->db->affected_rows() > 0){
            return $id;
        }else{
            return false;
        }
        
    }

    
    // Reject application
    public function reject($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('application', $data);
    }

    public function scholarcount($year='')
    {
        $year = date('Y');
        $data['approved']   = $this->approved();
        $data['rejected']   = $this->rejected($year);
        $data['ap_this']   = $this->apl_this($year);
        $data['tot']        = $this->db->get('application')->num_rows();
        return $data;
    }

    public function approved()
    {
        $this->db->where('status', 1);
        $this->db->where('application_state', 4);
        return $this->db->get('application')->num_rows();
    }

    public function rejected($year='')
    {
        $this->db->where('status', 2);
        return $this->db->get('application')->num_rows();
    }

    public function apl_this($year='')
    {
        $this->db->where('application_year', $year);
        return $this->db->get('application')->num_rows();
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

    public function getamnt($year='',$grd='')
    {
       return $this->db->where('date', $year)->where('class',$grd)->get('fees')->row('amount');
    }

    

}

/* End of file ModelName.php */
