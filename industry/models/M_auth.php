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

   public function getCompany($act = null)
   {
      return $this->db->where('act',$act)->get('industry')->result();
   }

          //vue js phone check exist or not
    public function mobile_check($phone='')
    {
        $this->db->where('mobile', $phone);
        $result = $this->db->get('industry_register');
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
            $result = $this->db->get('industry_register');
            if($result->num_rows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function companyChange($id = null)
        {
            return $this->db->where('id', $id)->get('industry')->row('reg_id');
        }
        
   // add school
   public function addCompany($insert = null)
   {     
     $result = $this->db->where('industry_id',$insert['industry_id'])->get('industry_register');
     if ($result->num_rows() > 0) {
        return false;
     }else{         
        return $this->db->insert('industry_register', $insert);
     }
     
   }


// activation
public function activateAccount($id = null)
{
   $this->db->where('ref_id', $id);
   $this->db->update('industry_register', array('status'=> 1,'ref_id' => random_string('alnum',10)));
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
    $this->db->where('password', $password);  
    $result = $this->db->get('industry_register')->row_array();
    if (!empty($result)) {
      return $result;
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
    public function forgotPassword($email='',$ref_id='')
    {
        $this->db->where('email', $email)->update('industry_register',array('ref_id' =>$ref_id));
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

  /**
    * company forgot password - check phone
    * @url      : forgot-password 
    * @param    : email
    **/
        public function forgotVerify($regid='', $newRegid='')
        {
            $this->db->where('ref_id', $regid)->update('industry_register',array('ref_id' =>$newRegid));
            if ($this->db->affected_rows() > 0) {
                return true;
            }else{
                return false;
            }
        }


    
  /**
    * company forgot password - check phone
    * @url      : forgot-password 
    * @param    : email
    **/
     public function setPassword($datas, $ref_id)
    {
        $this->db->where('ref_id', $ref_id);
        $query = $this->db->update('industry_register', $datas);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

}

/* End of file M_auth.php */


