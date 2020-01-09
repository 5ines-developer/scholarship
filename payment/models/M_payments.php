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
    

}

/* End of file ModelName.php */
