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


}

/* End of file M_account.php */
