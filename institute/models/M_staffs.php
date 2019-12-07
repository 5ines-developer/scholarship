<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class M_staffs extends CI_Model {

    public function list()
    {
        return $this->db->where('school_id', $this->session->userdata('school'))
        ->where('created_by <>', null)
        ->get('school_auth')->result();
    }

    public function addEmp($data = null)
    {
        $this->db->insert('school_auth', $data);
        if( $this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

}

/* End of file M_staffs.php */
