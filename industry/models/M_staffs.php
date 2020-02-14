<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_staffs extends CI_Model {

    public function lists()
    {
        return $this->db->where('industry_id', $this->session->userdata('sccomp'))
        ->where('created_by <>', null)
        ->get('industry_register')->result();
    }

    public function addEmp($data = null)
    {
        $result = $this->db->where('email',$data['email'])->get('industry_register')->result();
        if(!empty($result)){
            return false;
        }else{
            $this->db->insert('industry_register', $data);
            if( $this->db->affected_rows() > 0){
                return true;
            }else{
                return false;
            }
        }
        
    }

    //vue js phone check exist or not
    public function mobile_check($phone='')
    {
        $this->db->where('phone', $phone);
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


    // activation
    public function activateAccount($id = null,$regid ='')
    {
       $this->db->where('ref_id', $id);
       $this->db->update('industry_register', array('status'=> 1,'ref_id' => $regid));
       if($this->db->affected_rows() > 0){
          return true;
       }else{
          return false;
       }
    }

    // sett password
    public function set_password($data, $key)
    {
       $this->db->where('ref_id', $key);
       $this->db->update('industry_register', $data);

       if($this->db->affected_rows() > 0){
          return true;
       }else{
          return false;
       }
    }

  public function stasChange($id='',$status='')
  {
    $this->db->where('id', $id)->update('industry_register', array('status' => $status));
    if($this->db->affected_rows() > 0){
      return true;
    }
    else{
       return false;
    }
  }

  public function delete($id='')
  {
    $this->db->where('id', $id);
    $this->db->delete('industry_register');
    if($this->db->affected_rows() > 0){
      return true;
    }
    else{
       return false;
    }
  }
}

/* End of file M_staffs.php */
