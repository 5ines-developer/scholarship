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

/* End of file M_staffs.php */
