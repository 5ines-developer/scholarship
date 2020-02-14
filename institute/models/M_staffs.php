<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_staffs extends CI_Model {

    public function lists()
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

      public function stasChange($id='',$status='')
  {
    $this->db->where('id', $id)->update('school_auth', array('status' => $status));
    if($this->db->affected_rows() > 0){
      return true;
    }
    else{
       return false;
    }
  }

      //vue js phone check exist or not
    public function mobile_check($phone='')
    {
        $this->db->where('phone', $phone);
        $result = $this->db->get('school_auth');
           if($result->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    //vue js phone check exist or not
    public function email_check($email='')
    {
        $this->db->where('email', $email);
        $result = $this->db->get('school_auth');
        if($result->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

}

/* End of file M_staffs.php */
