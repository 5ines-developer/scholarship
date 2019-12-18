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


// check mail id is exist
public function checkMail($email = null)
{
   $this->db->select('email, ref_id');
   $query = $this->db->where('email', $email)->get('school_auth');
   if($query->num_rows() > 0){
      return $query->row();
   }else{
      return false;
   }
}

// verify forgot password link
public function verification($id = null)
{
   $this->db->where('ref_id', $id);
   $query = $this->db->get('school_auth');
   if($query->num_rows() > 0){
      return $query->row();
   }else{
      return false;
   }
   
}

// taluk filter
public function getTalukFiletr($id = null)
{
   return $this->db->where('city_id', $id)
   ->get('taluq')->result();
}

// institute filter
public function instituteFilter($id = null)
{
   return $this->db->where('taluk', $id)
   ->select('id, school_address as title, reg_no')
   ->get('reg_schools')->result();
}

// check institute exist or not
public function checkInstituteExist($id = null)
{
   $this->db->where('name',$id);
   $query = $this->db->get('school');
   if ($query->num_rows() > 0){
     return false;
   }
   else{
     return true;
   }
}

public function checkEmailExist($id = null)
{
   $this->db->where('email',$id);
   $query = $this->db->get('school');
   if ($query->num_rows() > 0){
     return false;
   }
   else{
     return true;
   }
}


public function checkPhoneExist($id = null)
{
   $this->db->where('phone',$id);
   $query = $this->db->get('school');
   if ($query->num_rows() > 0){
     return false;
   }
   else{
     return true;
   }
}



}

/* End of file M_auth.php */


