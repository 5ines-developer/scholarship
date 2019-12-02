<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_student extends CI_Model {



    /**
    * student registartion
    * @url      : student/register 
    * @param    : null
    * @data     : schhol data, company data,
    **/
    public function register($insert = null)
    {
        $this->db->insert('student', $insert);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }        
    }


       //vue js phone check exist or not
    public function mobile_check($phone='')
    {
        $this->db->where('phone', $phone);
        $result = $this->db->get('student');
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
            $result = $this->db->get('student');
               if($result->num_rows() > 0){
                return true;
            }else{
                return false;
            }
        }

    /**
    * student registartion - verify
    * @url      : student/register 
    * @param    : null
    * @data     : schhol data, company data,
    **/
    public function activateAccount($regid='', $newRegid='')
    {
        $this->db->where('ref_id', $regid);
        $result = $this->db->get('student');
        if($result->num_rows() >= 1){
            $update =  array('ref_id' => $newRegid, 'status' => '1', 'updated_on' => date('Y-m-d H:i:s'));
            $this->db->where('ref_id', $regid)->update('student', $update);
            if($this->db->affected_rows() > 0){
                return true;
            }else{
                return false;
            }             
        }else{
            return false; 
        }
    }


 


    
    /**
    * student login - verify
    * @url      : student/login 
    * @param    : username,password
    **/
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
        $query = $this->db->get('student');
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            if ($this->bcrypt->check_password($password, $result['password'])) {
                //We're good
                return $result;
            } 
            else {
                //Wrong password
                return array();
            }
        } 
        else{
            return array();
        }
    } 


    /**
    * student forgot password - check phone
    * @url      : student/forgot-password 
    * @param    : phone
    **/
    public function forgotPassword($email='',$ref_id='')
    {
        $this->db->where('email', $email)->update('student',array('ref_id' =>$ref_id,'updated_on' => date('Y-m-d H:i:s')));
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    /**
    * student forgot password - verify otp
    * @url      : student/forgot-password 
    * @param    : phone
    **/
        public function forgotVerify($regid='', $newRegid='')
        {
            $this->db->where('ref_id', $regid)->update('student',array('ref_id' =>$newRegid,'updated_on' => date('Y-m-d H:i:s')));
            if ($this->db->affected_rows() > 0) {
                return true;
            }else{
                return false;
            }
        }


    

    /**
    * student forgot password - update new password
    * @url      : student/reset-password 
    * @param    : data, phone , otp
    **/
     public function setPassword($datas, $ref_id)
    {
        $this->db->where('ref_id', $ref_id);
        $query = $this->db->update('student', $datas);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
    * student login - security question update
    * @url      : student/security
    * @param    : question,answern, userid
    **/
    public function securityqstn($qstn='', $answer='', $stdid='')
    {
        $this->db->where('id', $stdid);
        $query = $this->db->update('student',array('qstn_status' => 1,'question' => $qstn,'answer'=>$answer));
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    

}

/* End of file ModelName.php */
