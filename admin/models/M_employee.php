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
        return $this->db->where('type !=','1')->get('admin')->result();
    }

    public function singleEmployee($id='')
    {
        
        return $this->db->where('id', $id)->where('type !=','1')->get('admin')->row();
    }

    public function stasChange($id='',$status='')
  {
    $this->db->where('id', $id)->where('type !=','1')->update('admin', array('status' => $status));
    if($this->db->affected_rows() > 0){
      return true;
    }
    else{
       return false;
    }
  }


    public function mobile_check($phone='',$id='')
    {
        $this->db->where('phone', $phone);
        $this->db->where('id !=', $id);
        $result = $this->db->get('admin');
           if($result->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function updateEmp($data='',$id='')
    {
        return $this->db->where('id', $id)->update('admin', $data);
    }

    public function delete($id='')
    {
        return $this->db->where('id', $id)->delete('admin');
    }



}
/* End of file M_employee.php */
