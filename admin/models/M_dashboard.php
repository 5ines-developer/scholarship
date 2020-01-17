<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

	// get admin profile
	public function getProfile($id='')
	{
		return $this->db->
		select('name,email,phone,created_on')
		->where('id', $id)->get('admin')->row();
	}

	public function updateprofile($insert='')
	{
		return $this->db->where('id',$this->session->userdata('said'))->update('admin',$insert);
	}

	/**
    * admin change password - check pasw
    * @url      : admin/change-password
    * @param    : password
    **/
    public function checkpsw($psw='')
    {
        $query = $this->db->select('psw')->where('id', $this->session->userdata('said'))->get('admin')->row_array();
        if ($this->bcrypt->check_password($psw, $query['psw'])) {
            return true;
        } else {
            return false;
        }
    }


    /**
    * admin change password
    * @url      : admin/change-password
    * @param    : password
    **/
    public function changePassword($datas='')
    {
        $this->db->where('id', $this->session->userdata('said'))->update('admin', $datas);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
	

}

/* End of file M_dashboard.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/models/M_dashboard.php */