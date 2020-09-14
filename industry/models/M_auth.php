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

   // taluk filter
  public function getTalukFiletr($id = null)
  {
     return $this->db->where('city_id', $id)
     ->get('taluq')->result();
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
            $query =  $this->db->where('industry_id', $id)->where('type','1')->get('industry_register');
            if($query->num_rows() > 0){
              return 'exist';
            }else{
              return $this->db->where('id', $id)->get('industry')->row('reg_id');
            }
        }


        public function search($term = null)
        {
            return $this->db->like('name',$term,'both')->select('name,id')->get('industry')->result_array();
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
   $this->db->update('industry_register', array('status'=> 2));
   if($this->checkLinkExist($id)){
      return true;
   }else{
      return false;
   }
}

public function checkLinkExist($id = null)
{
   $this->db->where('ref_id',$id);
   $query = $this->db->get('industry_register');
   if ($query->num_rows() > 0){
     return true;
   }
   else{
     return false;
   }
}

function can_login($email, $password)  
{
    $this->db->where('email', $email);  
    $this->db->where('status', '1');  
    $result = $this->db->get('industry_register')->row_array();
    if (!empty($result)) {
      if ($this->bcrypt->check_password($password, $result['password'])) {
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

    public function addRequest($insert = null)
    {
        $result = $this->db->where('company',$insert['company'])->get('industry_add');
        if ($result->num_rows() > 0) {
           return false;
        }else{         
           return $this->db->insert('industry_add', $insert);
        }
    }


      public function throttle_insert($insert='')
    {
        $this->db->where('ip', $insert['ip'])->where('created_at',$insert['created_at']);
        $result = $this->db->get('throttles')->row();
        if (!empty($result)) {
            $this->db->where('ip', $insert['ip'])->where('created_at',$insert['created_at']);
            $this->db->update('throttles',array('type' => '1'));
            if ($this->db->affected_rows() > 0) {
                return $result->type;
            }else{
                return false;
            }

        }else{
            $this->db->insert('throttles', $insert);
            if ($this->db->affected_rows() > 0) {
                return true;
            }else{
                return false;
            }
        }

    }

    public function throttle_update($ips='',$up='')
    {
        $today = date('Y-m-d');
        $this->db->where('ip', $ips)->where('created_at',$today);
        $this->db->update('throttles', array('type' => $up));
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function throttle_get($ips='',$current_time='')
    {
        $today = date('Y-m-d');
        $this->db->where('ip', $ips)->where('created_at',$today);
        $result = $this->db->get('throttles')->row();
        if (!empty($result)) {
            $date1  = date_create($current_time);  
            $date2  = date_create($result->updated_at);
            $diff   = date_diff($date1,$date2);
            $days   = $diff->format("%R%a");
            $min    = $diff->format('%i');
            if($min <= 1){ 
                return $result->type;
            }else{
                $this->db->where('ip', $ips)->where('created_at',$today);
                $this->db->update('throttles',array('type' => '1'));
               if ($this->db->affected_rows() > 0) {
                return $result->type;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }


}

/* End of file M_auth.php */


