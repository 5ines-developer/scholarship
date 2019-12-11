<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_account extends CI_Model {

    public function getAccountDetails()
    {
      
        
        $this->db->select('s.id as schoolId, s.name, s.principal, s.email, s.phone, s.reg_no, s.reg_certification, s.priciple_signature, s.seal, a.address, c.title as district, a.pin, t.title as taluk');
        $this->db->where('s.id', $this->session->userdata('school'));
        $this->db->from('school s');
        $this->db->join('school_address a', 'a.school_id = s.id', 'left');
        $this->db->join('city c', 'c.id = a.city', 'left');
        $this->db->join('taluq t', 't.id = a.taluq', 'left');
        return $this->db->get()->row();   
    }

// update  start
    public function update($data, $id)
    {
       $this->updateAddress($data['school_address'], $id);
       $this->updateSchool($data['schoolDetail'], $id);
       return true;
    }

    public function updateAddress($data, $id)
    {
        $this->db->where('school_id', $id);
        $this->db->update('school_address', $data);
        return true;
    }

    public function updateSchool($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('school', $data);
        return true;
    }

// update  End

// check password
public function checkpsw($psw='')
{
    $query = $this->db->select('psw')->where('id', $this->session->userdata('scinst'))->get('school_auth')->row_array();
    if ($this->bcrypt->check_password($psw, $query['psw'])) {
        return true;
    } else {
        return false;
    }
}
// change password
public function changePassword($data ='')
{
    $this->db->where('id', $this->session->userdata('scinst'))->update('school_auth', $data);
    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false;
    }
}

}

/* End of file M_account.php */
