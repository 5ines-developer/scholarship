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
        $this->db->where('status', '1'); 
        $this->db->group_start();
            $this->db->where('email', $username);  
            $this->db->or_where('phone', $username);  
        $this->db->group_end();
        $query = $this->db->get('student')->row_array();
        if ($this->bcrypt->check_password($password, $query['password'])) {
            return $query;
        } else {
            return false;
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

    /**
    * student login - security question get
    * @url      : student/security
    * @param    : question,answern, userid
    **/
    public function getQuestion($var = null)
    {  
        return $this->db->get('security_question')->result();   
    }

    /**
    * student login - security question verify
    * @url      : student/reset-pass
    * @param    : question,answern, userid
    **/
    public function verifyQstns($qstn='',$email='',$ans='',$password='')
    {       
      $query = $this->db->where('email', $email)->where('question',$qstn)->where('answer',$ans)->get('student'); 
      if ($query->num_rows() > 0) {
        $this->db->where('email', $email)->where('question',$qstn)->where('answer',$ans)->update('student',array('password' => $password));
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
      }else{
        return false;
      }      
    }

    public function otpVerify($refid='',$phone='',$otp='')
    {
        $this->db->where('phone', $phone)->where('ref_id',$refid)->where('otp',$otp)->update('student',array('status'=>1,'otp'=> random_string('nozero',6)));
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    public function resendOtp($refid='',$phone='',$otp='')
    {
        $this->db->where('phone', $phone)->where('ref_id',$refid)->update('student',array('otp'=> random_string('nozero',6)));
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }





    

}

/* End of file ModelName.php */
