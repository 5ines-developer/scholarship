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

}

/* End of file M_account.php */
