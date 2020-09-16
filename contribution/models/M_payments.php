<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_payments extends CI_Model {

    //get company act
    public function getAct($comp = null)
    {        
        $result = $this->db->where('id', $comp)->get('industry')->row('act');
        if($result == 1){
            return 'Labour Act';
        }else{
            return 'Factory Act';
        }
    }

    public function search($term = null)
    {
        return $this->db->like('name',$term,'both')->select('name,id')->limit(200)->get('industry')->result_array();
    }

    public function companyChange($id = null)
    {
        $query =  $this->db->where('industry_id', $id)->where('type','1')->get('industry_register');
        if($query->num_rows() > 0){
          return $query->row('industry_id');
        }else{
          return false;
        }
    }

    public function checkpayment($reg_no='',$year='')
    {
        return $this->db->where('comp_reg_id', $reg_no)
        ->where('year', $year)
        ->get('payment')->row();
    }

    public function submit_pay($insert='')
    {
        $query = $this->db->where('comp_reg_id', $insert['comp_reg_id'])
        ->where('year', $insert['year'])
        ->get('payment')->row();
        if (!empty($query)) {
            return false;
        }else{
            $this->db->insert('payment', $insert);
            $insert_id = $this->db->insert_id(); 
            return  $insert_id;
        }
    }

    public function getind($reg_no='')
    {
        $this->db->select('ir.email,ir.mobile,i.name');
        $this->db->where('ir.type', 1);
        $this->db->where('i.reg_id', $reg_no);
        $this->db->from('industry i');
        $this->db->join('industry_register ir', 'ir.industry_id = i.id', 'left');
        return $this->db->get()->row();
    }

    public function payList($regId='')
    {
        $this->db->select('i.*,i.name as comp,ir.*,ir.name as Names,p.*');
        $this->db->where('i.reg_id', $regId);
        $this->db->where('ir.type', 1);
        $this->db->from('payment p');
        $this->db->join('industry i', 'i.reg_id = p.comp_reg_id', 'inner');
        $this->db->join('industry_register ir', 'ir.industry_id = i.id', 'inner');
        return $this->db->get()->result();
    }

    public function singlepay($id='',$regId='')
    {
        $this->db->select('i.*,i.name as comp,ir.*,ir.name as Names,p.*');
        if (!empty($regId)) {
            $this->db->where('i.reg_id', $regId);
        }
        $this->db->where('p.id', $id);
        $this->db->where('ir.type', 1);
        $this->db->from('payment p');
        $this->db->join('industry i', 'i.reg_id = p.comp_reg_id', 'inner');
        $this->db->join('industry_register ir', 'ir.industry_id = i.id', 'inner');
        return $this->db->get()->row();
    }

    public function getemail($value='')
    {
        $this->db->select('i.reg_id,ir.email');
        $this->db->where('ir.type', 1);
        $this->db->from('industry_register ir');
        $this->db->group_by('email');
        $this->db->join('industry i', 'i.reg_id = ir.industry_id', 'left');
        return $this->db->get()->result();
    }

    public function insertreminder($reg_id='',$diffr='')
    {
        $this->db->where('reg_id', $reg_id);
        $this->db->where('difference', $diffr);
        $this->db->where('year', date('Y'));
        $result = $this->db->get('reminder_noti')->row();
        if (!empty($result)) {
            return false;
        }else{

            $insert = array('reg_id' => $reg_id,'difference' => $diffr ,'year'=>date('Y'));
            return $this->db->insert('reminder_noti', $insert);
        }
    }

    public function pay_reminder($regId='')
    {
        $this->db->where('reg_id', $regId);
        $this->db->where('seen', 0);
        return $this->db->get('reminder_noti')->result();
    }

    public function pay_reminders($regId='')
    {
        $this->db->where('reg_id', $regId);
        return $this->db->get('reminder_noti')->result();
    }

    public function changeSeen($regid='')
    {
        $this->db->where('reg_id', $regid);
        return $this->db->update('reminder_noti', array('seen' => 1));
    }

    public function getPy($pay_id='',$atrn='')
    {
        $this->db->where('pay_id', $pay_id);
        $query =  $this->db->get('payment');
        if($query->num_rows() > 0){
            $this->db->where('pay_id', $pay_id)->update('payment',array('atrn' => $atrn,'status' =>'1'));
            return $query->row();
        }else{
            return false;
        }

    }
    

}

/* End of file ModelName.php */
