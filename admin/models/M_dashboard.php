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


    /**
    * get total orders by month to display in graph
    * @url : Admin/getordergraph
    *
    */
    public function getordergraph($startdate)
    { 
        $newData  = array();
        $this->db->select('date');
        $cyear    = date("Y");
        $this->db->where('application_year <=', $cyear);
        $this->db->where('application_year >=', $startdate);
        $query = $this->db->get('application')->result();
        foreach ($query as $key => $value) {
            $newData[]= date("Y",strtotime($value->date));
        }
        $vals = array_count_values($newData);
        $counts = array();
        for ($m=2019; $m<= $cyear; $m++) {
            if(!empty($vals[$m])){
                $counts[]= array("values"=>$vals[$m] , "year"=>$m);
            }else{
                $counts[]= array("values"=>0 , "year"=>$m);
            }        
        }
        return $counts;
    }

    /**
    * admin change password
    * @url      : dashboard
    * @param    :null
    **/
    public function dashcounts($year = '')
    {
        $data['tot_app']        = $this->tot_app($year);
        $data['cr_count']       = $this->thisy_count($year);
        $data['acti_inst']      = $this->active_inst($year);
        $data['ac_inds']        = $this->active_indstry($year);
        $data['pay_comp']       = $this->pay_completed($year);
        $data['pay_pend']       = $this->pay_pending($year);
        return $data;
    }

    public function pay_pending($year='')
    {
        if (!empty($year)) {
            $this->db->where('application_year', $year);
        }else{
            $year = date('Y');
            $this->db->where('application_year', $year);
        }
       $this->db->where('pay_status', 0);
       $this->db->where('application_state', 4);
       $this->db->where('status', 1);
       return $this->db->get('application')->num_rows();
    }

    public function pay_completed($year='')
    {
        if (!empty($year)) {
            $this->db->where('application_year', $year);
        }else{
            $year = date('Y');
            $this->db->where('application_year', $year);
        }
       $this->db->where('pay_status', 1);
       $this->db->where('application_state', 4);
       $this->db->where('status', 1);
       return $this->db->get('application')->num_rows();
    }

    public function tot_app($var = null)
    {
        return $this->db->get('application')->num_rows();
    }

    public function thisy_count($year = null)
    {

        if (!empty($year)) {
            $this->db->where('application_year', $year);
        }else{
            $year = date('Y');
            $this->db->where('application_year', $year);
        }
        
        return $this->db->get('application')->num_rows();
    }

    public function active_inst($year = null)
    {
        if (!empty($year)) {
            $this->db->where('created_on >=', date($year.'-01-01 00:01:00'));
            $this->db->where('created_on <=', date($year.'-12-31 23:59:00'));
        }else{
            $year = date('Y');
            $this->db->where('created_on >=', date($year.'-01-01 00:01:00'));
            $this->db->where('created_on <=', date($year.'-12-31 23:59:00'));
        }
        return $this->db->get('school')->num_rows();
    }

    public function active_indstry($year = null)
    {
        if (!empty($year)) {
            $this->db->where('type', '1');  
            $this->db->where('date >=', date($year.'-01-01 00:01:00'));
            $this->db->where('date <=', date($year.'-12-31 23:59:00'));
        }else{
            $year = date('Y');
            $this->db->where('type', '1');
            $this->db->where('date >=', date($year.'-01-01 00:01:00'));
            $this->db->where('date <=', date($year.'-12-31 23:59:00'));
        }

        $this->db->where('type', '1');
        return $this->db->get('industry_register')->num_rows();
    }


    public function industry_counts($var = null)
    {
        $data['ac_inds']  = $this->active_indstry();
        $data['tot_ind']  = $this->tot_ind();
        return $data;
    }

    public function tot_ind($var = null)
    {
        return $this->db->get('industry')->num_rows();        
    }

    public function insti_counts($var = null)
    {
        $data['acti_inst']      = $this->active_inst();
        $data['tot_insti']      = $this->tot_insti();
        return $data;
    }

    public function tot_insti($var = null)
    {
        return $this->db->get('reg_schools')->num_rows();        
    }


    

	

}

/* End of file M_dashboard.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/models/M_dashboard.php */