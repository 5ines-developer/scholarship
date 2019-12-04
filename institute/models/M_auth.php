<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

   public function getTaluk($var = null)
   {
      return $this->db->get('taluq')->result();
   }

   public function getDistrict($var = null)
   {
      return $this->db->get('city')->result();
   }

   // add school
   public function addSchoolDetail($data = null)
   {
      $this->db->insert('school', $data);
      return $this->db->insert_id();
   }

   // aut
   public function CreateAuth($data = null)
   {
      if($this->insertAuth($data['auth'])){
         $this->db->insert('school_address', $data['school_address']);
         if($this->db->affected_rows() > 0){
            return true;
         }else{
            return false;
         }
      }else{
         return false;
      }
   }

   public function insertAuth($data = null)
   {
      $this->db->insert('school_auth', $data);
      if($this->db->affected_rows() > 0){
         return true;
      }else{
         return false;
      }
   }

// activation
public function activateAccount($id = null)
{
   $this->db->where('ref_id', $id);
   $this->db->update('school_auth', array('status'=> 2));
   if($this->db->affected_rows() > 0){
      return true;
   }else{
      return false;
   }
}
// sett password
public function set_password($data, $key)
{
   $this->db->where('ref_id', $key);
   $this->db->update('school_auth', $data);
   if($this->db->affected_rows() > 0){
      return true;
   }else{
      return false;
   }
}


function can_login($username, $password)  
{

    $this->db->where('email', $username);  
    $this->db->where('status', '1');  
    $result = $this->getUsers($password);
    if (!empty($result)) {
      return $result;
    } 
    else {
        return null;
    }  
}

// check password
function getUsers($password) 
{
    $query = $this->db->get('school_auth');
    if ($query->num_rows() > 0) {

        $result = $query->row_array();
       
        if ($this->bcrypt->check_password($password, $result['psw'])) {
            return $result;
        } 
        else {
            return array();
        }
    } 
    else{
        return array();
    }
} 


}

/* End of file M_auth.php */


