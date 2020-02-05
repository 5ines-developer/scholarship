<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_payments extends CI_Model {

    //get company act
    public function getAct($comp = null)
    {        
        $result = $this->db->where('id', $comp)->get('industry')->row('act');
        if($result == 1){
            return 'Labour Act';
        }else{
            return 'Factory Act';
        }
    }

    public function search($term = null)
    {
        return $this->db->like('name',$term,'both')->select('name,id')->get('industry')->result_array();
    }

    public function companyChange($id = null)
    {
      $query =  $this->db->where('industry_id', $id)->where('type','1')->get('industry_register');
        if($query->num_rows() > 0){
          return $query->row('industry_id');
        }else{
          return false;
        }
    }
    

}

/* End of file ModelName.php */
