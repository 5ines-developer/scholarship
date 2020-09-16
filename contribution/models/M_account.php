<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_account extends CI_Model {

    public function getAccountDetails()
    {

        $this->db->select('in.id as indId, in.name as indNAme, ir.name as director, ir.email, ir.mobile, in.reg_id,ir.talluk,ir.district, ir.register_doc,ir.gst_no,ir.pan_no, ir.pancard, ir.gst, ir.address, c.title as district, t.title as taluk');
        $this->db->where('ir.industry_id', $this->session->userdata('pyComp'));
        $this->db->from('industry_register ir');
        $this->db->join('industry in', 'in.id = ir.industry_id', 'left');
        $this->db->join('city c', 'c.id = ir.district', 'left');
        $this->db->join('taluq t', 't.id = ir.talluk', 'left');
        return $this->db->get()->row();   
    }

// update  start
    public function update($data, $id)
    {        
        return $this->db->where('id', $id)->update('industry_register',$data);
    }

 


// check password
public function checkpsw($psw='')
{
   
    $query = $this->db->where('id', $this->session->userdata('pyId'))->get('industry_register');
    if ($query->num_rows() > 0) {
           if($this->bcrypt->check_password($psw,$query->row('password')))
           {
                return true;
            }else{
                return false;
            }
    } else {
        return false;
    }
}
// change password
public function changePassword($data ='')
{
    $this->db->where('id', $this->session->userdata('pyId'))->update('industry_register', $data);
    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false;
    }
}



}

/* End of file M_account.php */
