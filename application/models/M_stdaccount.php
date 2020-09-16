<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stdaccount extends CI_Model {

	/**
    * studentchange password - check pasw
    * @url      : student/change-password
    * @param    : password
    **/
    public function checkpsw($psw='')
    {
        $query = $this->db->select('password')->where('id', $this->session->userdata('stlid'))->get('student')->row_array();
        if ($this->bcrypt->check_password($psw, $query['password'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
    * student change password
    * @url      : student/change-password
    * @param    : password
    **/
    public function changePassword($datas='')
    {
        $this->db->where('id', $this->session->userdata('stlid'))->update('student', $datas);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
    * student profile - get profile details
    * @url      : student/profile
    * @param    : student id
    **/
    public function getProfile($stdid='')
    {
    	return $this->db->select('email,phone,name,profile_pic')->where('id', $this->session->userdata('stlid'))
        ->get('student')->row_array(); 
    }

    /**
    * student profile - get profile details
    * @url      : student/profile
    * @param    : student id, update data, 
    **/
    public function addName($name='',$id='')
    {
       return $this->db->where('id', $id)->update('student',array('name' => $name));
    }

    public function addfile($file='',$id='')
    {
       return $this->db->where('id', $id)->update('student',array('profile_pic' => $file));
    }

    public function addPhone($phone='',$id='')
    {
        return $this->db->where('id', $id)->update('student',array('phone' => $phone));
    }

    public function updateProfile($email="",$name = "",$id="")
    {  
        $query = $this->db->where('id !=', $id)->where('email', $email)->get('student');
        if ($query->num_rows() > 0) {
            return false;
        }else{
            $this->db->where('id', $id)->update('student',array('email' =>$email,'name' =>$name));
            if ($this->db->affected_rows() > 0) {
                return true;
            }else{
                return false;
            } 
        }
    }

    public function email_check($email='')
    {
        $this->db->where('id !=', $this->session->userdata('stlid'));
       $this->db->where('email', $email);
            $result = $this->db->get('student');
               if($result->num_rows() > 0){
                return true;
            }else{
                return false;
            }
    }
	

}

/* End of file M_stdaccount.php */
/* Location: ./application/models/M_stdaccount.php */