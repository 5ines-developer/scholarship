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
    	return $this->db->select('email,phone,fname,lname')->where('id', $this->session->userdata('stlid'))->get('student')->row();
    }

    /**
    * student profile - get profile details
    * @url      : student/profile
    * @param    : student id, update data, 
    **/
    public function updateProfile($insert='',$sid='')
    {
    	return $this->db->where('id', $sid)->update('student',$insert);
    }

	

}

/* End of file M_stdaccount.php */
/* Location: ./application/models/M_stdaccount.php */