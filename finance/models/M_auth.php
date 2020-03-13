<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

 


// activation
public function activateAccount($id = null)
{
   $this->db->where('ref_link', $id);
   $this->db->where('type',3);
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
    $this->db->where('type',3); 
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