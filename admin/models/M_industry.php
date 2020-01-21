<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_industry extends CI_Model {

	public function getIndustry($id='',$district='',$taluk='')
	{
        $this->get_query();  
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
            $this->db->order_by('ind.name', 'ASC');  
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
        $this->db->from('reg_schools ireg');
        return $this->db->count_all_results();
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
        $this->db->select('in.id as indId, in.name as indNAme, ir.name as director, ir.email, ir.mobile, in.reg_id,in.act,ir.talluk,ir.district, ir.register_doc,ir.gst_no,ir.pan_no, ir.pancard, ir.gst, ir.address, c.title as district, t.title as taluk,ir.date,ir.seal,ir.sign');
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

	

}

/* End of file M_industry.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/models/M_industry.php */