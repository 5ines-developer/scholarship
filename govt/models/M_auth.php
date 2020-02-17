<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

// activation
public function activateAccount($id = null)
{
   $this->db->where('ref_link', $id);
   $this->db->where('type',2);
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
    $this->db->where('type',2); 
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



  
  // check mail id is exist
  public function checkMail($email = null)
  {
      $this->db->select('email, ref_link');
      $query = $this->db->where('email', $email)->get('admin');
      if($query->num_rows() > 0){
          return $query->row();
      }else{
          return false;
      }
  }
  // verify forgot password link
  public function verification($id = null)
  {
      $this->db->where('ref_link', $id);
      $query = $this->db->get('admin');
      if($query->num_rows() > 0){
          return $query->row();
      }else{
          return false;
      }
  
  }
  
  // sett password
  public function set_password($data, $key)
  {
  $this->db->where('ref_link', $key);
  $this->db->update('admin', $data);
  if($this->db->affected_rows() > 0){
      return true;
  }else{
      return false;
  }
  }


  public function checkLogin($id='')
  {
    return $this->db->where('id', $id)->where('status',1)->get('admin')->row();
  }
 

}

/* End of file M_auth.php */