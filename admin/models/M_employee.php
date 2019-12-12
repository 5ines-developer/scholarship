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

}
/* End of file M_employee.php */
