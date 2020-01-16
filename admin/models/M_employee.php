<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_employee extends CI_Model {

    public function addEmp($data = null)
    {
        $this->db->insert('admin', $data);
        if( $this->db->affected_rows() > 0):
            return true;
        else:
            return false;
        endif;
    }

    public function getEmployee( $var = null)
    {
        // ->where('type !=','1')
        return $this->db->get('admin')->result();
    }

    public function singleEmployee($id='')
    {
        // ->where('type !=','1')
        return $this->db->where('id', $id)->get('admin')->result();
    }

}
/* End of file M_employee.php */
