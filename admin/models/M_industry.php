<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_industry extends CI_Model {

	public function getIndustry($id='',$district='',$taluk='')
	{
        $this->get_query();  
        $this->db->where('ireg.status', '1');
        if($_POST["length"] != -1)  
        {  
             $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get(); 
        return $query->result(); 
	}

	public function get_query($value='')
    {
        $select_column = array('ind.name','ind.id as industryId','ind.act','ind.reg_id','ireg.email','ireg.mobile','ireg.name as director','ireg.pancard','ireg.status','ireg.gst','ireg.date','ireg.address','ireg.pan_no','ireg.gst_no','ireg.seal','ireg.sign','tq.title','cty.title as district');
        $order_column = array("ind.name","ind.reg_id", "ind.act", "tq.title", "cty.title","ireg.status",null );  

        $this->db->select($select_column);
        $this->db->where('type',1);
        $this->db->from('industry_register ireg');
        $this->db->join('industry ind', 'ind.id = ireg.industry_id', 'left');
        $this->db->join('taluq tq', 'tq.id = ireg.talluk', 'left');
        $this->db->join('city cty', 'cty.id = ireg.district', 'left');
        $this->db->group_by('ind.id');

        if(isset($_POST["search"]["value"])){
        	$this->db->group_start();
            $this->db->like("ind.name", $_POST["search"]["value"]);  
            $this->db->or_like("ind.reg_id", $_POST["search"]["value"]);
            $this->db->or_like("ind.act", $_POST["search"]["value"]);
            $this->db->or_like("cty.title", $_POST["search"]["value"]);
            $this->db->or_like("tq.title", $_POST["search"]["value"]);
            $this->db->or_like("ireg.status", $_POST["search"]["value"]);
            $this->db->group_end();
        }

        if(isset($_POST["order"]))  
        {  
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
            $this->db->order_by('ind.id', 'ASC');  
        }  
    }

    function get_filtered_data(){  
        $this->get_query();  
        $query = $this->db->get();  
        return $query->num_rows();  
    } 

    function get_all_data()  
    {  
        $select_column = array('ireg.email','ireg.mobile','ireg.name as director','ireg.pancard','ireg.status','ireg.gst','ireg.date','ireg.address','ireg.pan_no','ireg.gst_no','ireg.seal','ireg.sign');
        $this->db->select($select_column);
        $this->db->where('type', 1);
       $this->db->from('industry_register ireg');
        return $this->db->count_all_results();
    }



    public function getnonRegister($value='')
    {
        $this->make_nonquery();  
        if($_POST["length"] != -1)  
        {  
             $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get(); 
        return $query->result();
    }

    public function make_nonquery($value='')
    {
       $industry_id = array();
        $this->db->group_start();
            $this->db->where('type', 1);
        $this->db->group_end();
        $this->db->select('industry_id');
        $query = $this->db->get('industry_register')->result();

        if (!empty($query)) {
            foreach ($query as $key => $value) {
                $industry_id[] = $value->industry_id;
            }
        }

        $order_column = array("name","reg_id", "act");  
        $select = array("id","created_on","name","reg_id", "act");
        $this->db->where_not_in('id', $industry_id);
        $this->db->from('industry');
        $this->db->select($select);

        if(isset($_POST["search"]["value"])){
            $this->db->group_start();
            $this->db->like("name", $_POST["search"]["value"]);  
            $this->db->or_like("reg_id", $_POST["search"]["value"]);
            $this->db->or_like("act", $_POST["search"]["value"]);
            $this->db->group_end();
        }

        if(isset($_POST["order"]))  
        {  
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
            $this->db->order_by('id', 'ASC');  
        }
    }


    public function get_all_non($value='')
    {
       $industry_id = array();
        $this->db->group_start();
            $this->db->where('type', 1);
        $this->db->group_end();
        $this->db->select('industry_id');
        $query = $this->db->get('industry_register')->result();

        if (!empty($query)) {
            foreach ($query as $key => $value) {
                $industry_id[] = $value->industry_id;
            }
        }

        $this->db->group_start();
            $this->db->where_not_in('id', $industry_id);
        $this->db->group_end();
       
        $query = $this->db->get('industry')->result();
        
        return count($query);
    }

    public function get_non_filtered($value='')
    {
       $this->make_nonquery();  
        $query = $this->db->get();  
        return $query->num_rows(); 
    }

    


    public function industrycount($year='')
    {
        $year = date('Y');
        $data['cr_scool']   = $this->thisy_count($year);
        $data['tot_app']    = $this->stscolar($year);
        $data['ac_ind']     = $this->active_ind($year);
        $data['tot']        = $this->db->get('industry')->num_rows();
        return $data;
    }

   public function thisy_count($year='')
    {
        $sdate = date('Y') . '-01-01';
        $edate = date('Y'). '-12-31';
        $this->db->where('date >=', $sdate);
        $this->db->where('date <=', $edate);
        $this->db->where('type', '1');
        return $this->db->get('industry_register')->num_rows();
    }

    public function stscolar($year='')
    {
        $this->db->group_by('application_year,school_id');
        return $this->db->get('application')->num_rows();
    }

    public function active_ind($year='')
    {
        $this->db->where('type', '1');
        return $this->db->get('industry_register')->num_rows();
    }


    public function getCompany($id='')
    {
        $this->db->select('in.id as indId, in.name as indNAme, ir.name as director, ir.email, ir.mobile, in.reg_id,in.act,ir.talluk,ir.district, ir.register_doc,ir.gst_no,ir.pan_no, ir.pancard, ir.gst, ir.address, c.title as district, t.title as taluk,ir.date,ir.seal,ir.sign,ir.status');
        $this->db->where('ir.industry_id', $id);
        $this->db->where('ir.type', '1');
        $this->db->from('industry_register ir');
        $this->db->join('industry in', 'in.id = ir.industry_id', 'left');
        $this->db->join('city c', 'c.id = ir.district', 'left');
        $this->db->join('taluq t', 't.id = ir.talluk', 'left');
        return $this->db->get()->result();   
    }

    public function getscholar($id='')
    {
        $this->db->select('m.prv_marks as mark, m.class, s.name, a.id,a.application_year');
        $this->db->from('application a');
        $this->db->where('a.company_id', $id);        
        $this->db->order_by('a.id', 'desc');
        $this->db->join('student s', 's.id = a.Student_id', 'left');
        $this->db->join('applicant_marks m', 'm.application_id = a.id', 'left');
        return $this->db->get()->result();     
    }

    public function getEmployee($id='')
    {
        return $this->db->where('type !=','1')->where('industry_id',$id)->get('industry_register')->result();
    }

    /******** fetch all industries ************/
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
        $select_column = array('ind.id','ind.reg_id','ind.name','ind.taluq','ind.act','ind.created_on');
        $order_column = array('ind.id','ind.reg_id','ind.name','ind.taluq','ind.act','ind.created_on',null );  

        $this->db->select($select_column);
        $this->db->from('industry ind');
        if(isset($_POST["search"]["value"])){
            $this->db->group_start();
            $this->db->like("ind.reg_id", $_POST["search"]["value"]);  
            $this->db->or_like("ind.name", $_POST["search"]["value"]);
            $this->db->or_like("ind.taluq", $_POST["search"]["value"]);
            $this->db->or_like("ind.act", $_POST["search"]["value"]);
            $this->db->or_like("ind.created_on", $_POST["search"]["value"]);
            $this->db->group_end();
        }

        if(isset($_POST["order"]))  
        {  
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
            $this->db->order_by('ind.id', 'ASC');  
        }  
    }


    function get_filtered(){  
        $this->make_query();  
        $query = $this->db->get();  
        return $query->num_rows();  
    } 

    function get_all()  
    {  
        $select_column = array('ind.id','ind.reg_id','ind.name','ind.taluq','ind.act','ind.created_on');
        $this->db->select($select_column);
        $this->db->from('industry ind');
        return $this->db->count_all_results();
    }

    public function requestLists($id='')
    {
        if(!empty($id)){
            $this->db->where('inad.id', $id);
        }
        $this->db->select('inad.id,inad.company,inad.email,inad.mobile,inad.act,inad.gst_no,inad.address,
            inad.register_doc,inad.date,tq.title as taluk,cty.title as district'); 
        $this->db->order_by('inad.id', 'desc');
        $this->db->from('industry_add inad');
        $this->db->join('taluq tq', 'tq.id = inad.talluk', 'left');
        $this->db->join('city cty', 'cty.id = inad.district', 'left');
        return $this->db->get()->result();
    }
	

    public function add($insert='')
    {
        return $this->db->where('reg_id !=', $insert['reg_id'])->insert('industry',$insert);
    }

    public function getedit($id='')
    {
        $this->db->select('ind.id,ind.reg_id,ind.name,ind.act');
        $this->db->where('ind.id', $id);
        $this->db->from('industry ind');
        return $this->db->get()->row();
    }

    public function update($id='',$update='')
    {
        return $this->db->where('id', $id)->update('industry',$update);
    }

    public function stasChange($id='',$status='')
    {
        $this->db->where('industry_id', $id)->update('industry_register', array('status' => $status));
        if($this->db->affected_rows() > 0){
          return true;
        }
        else{
           return false;
        }
    }

    public function empstasChange($id='',$stat='')
    {
        $query = $this->db->where('id', $id)->get('industry_register')->row();
        if (!empty($query)) {
            $this->db->where('id', $id);
            return $this->db->update('industry_register', array('status' => $stat));
        }else{
            return false;
        }
    }

    public function insertbulk($insert='')
    {
        $this->db->where('reg_id', $insert['reg_id']);
        $this->db->or_where('name', $insert['name']);
        $query = $this->db->get('industry');
        if ($query->num_rows() > 0) {
            return false;
        }else{
            return $this->db->insert('industry', $insert);
            
        }
    }

    public function delete($id='')
    {
        $this->db->where('industry_id', $id);
        if($this->db->delete('industry_register')){
            $this->db->where('company_id', $id);
            $this->db->delete('application');
            return true;
        }else{
            return false;
        }
    }

    public function csv_industry($value='')
    {
        $select_column = array('id','reg_id','name','taluq','act','created_on');
        $this->db->order_by('id', 'ASC');  
        return $this->db->get('industry')->result();
    }

    public function csv_regInd($value='')
    {
        $this->db->where('ireg.status', '1');
        $select_column = array('ind.name','ind.id as industryId','ind.act','ind.reg_id','ireg.email','ireg.mobile','ireg.name as director','ireg.pancard','ireg.status','ireg.gst','ireg.date','ireg.address','ireg.pan_no','ireg.gst_no','ireg.seal','ireg.sign','tq.title','cty.title as district');
        $this->db->select($select_column);
        $this->db->where('ireg.type',1);
        $this->db->from('industry_register ireg');
        $this->db->join('industry ind', 'ind.id = ireg.industry_id', 'left');
        $this->db->join('taluq tq', 'tq.id = ireg.talluk', 'left');
        $this->db->join('city cty', 'cty.id = ireg.district', 'left');
        $this->db->order_by('ind.id', 'ASC'); 
        $this->db->group_by('ind.id');
        $query = $this->db->get(); 
        return $query->result(); 
    }


    public function csv_nonreg($value='')
    {
        $this->db->group_start();
            $this->db->where('type', 1);
        $this->db->group_end();
        $this->db->select('industry_id');
        $query = $this->db->get('industry_register')->result();

        if (!empty($query)) {
            foreach ($query as $key => $value) {
                $industry_id[] = $value->industry_id;
            }
        }
        $select = array("id","created_on","name","reg_id", "act");
        $this->db->where_not_in('id', $industry_id);
        $this->db->from('industry');
        $this->db->select($select);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get(); 
        return $query->result();
    }



}

/* End of file M_industry.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/models/M_industry.php */