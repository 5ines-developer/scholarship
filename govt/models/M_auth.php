<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

 


// activation
public function activateAccount($id = null)
{
   $this->db->where('ref_link', $id);
   $this->db->where('type !=',1);
   $this->db->update('admin', array('status'=> 2));      
   if($this->db->affected_rows() > 0){
      return true;
   }else{
      return false;
   }
}

function can_login($email, $password)  
{
    $this->db->where('email', $email);  
    $this->db->where('status', '1'); 
    $this->db->where('type !=',1); 
    $result = $this->db->get('admin')->row_array();
    
    if (!empty($result['id'])) {
      if ($this->bcrypt->check_password($password, $result['psw'])) {
        return $result;
      }else{
        return null;
      }
    } 
    else {
        return null;
    } 
}



    
  /**
    * company forgot password - check phone
    * @url      : forgot-password 
    * @param    : email
    **/
     public function setPassword($datas, $ref_id)
    {
        $this->db->where('ref_link', $ref_id);
        $query = $this->db->update('admin', $datas);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

}

/* End of file M_auth.php */


