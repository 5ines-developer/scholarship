<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_payments extends CI_Model {

	public function paymenttLists($year='')
    {
        if (!empty($year)) {
           $this->db->where('year', $year);
        }else{
             $this->db->where('year', date('Y'));
        }
        $this->db->from('payment p');
        $this->db->join('industry i', 'i.reg_id = p.comp_reg_id', 'inner');
        return $this->db->get()->result();
    }

    public function pend_payment($year='')
    {
        if (empty($year)) {
           $year = date('Y');
        }
        $paid = $this->getpaid($year);

        $this->db->select('i.name, i.reg_id,i.act');
        $this->db->where_not_in('i.reg_id', $paid);
        $this->db->where('ir.type', 1);
        $this->db->from('industry i');
        $this->db->join('industry_register ir', 'ir.industry_id = i.id', 'left');
        return $this->db->get()->result();
    }

    public function getpaid($year='')
    {
        $this->db->select('comp_reg_id');
        $this->db->where('year', $year);
        $result = $this->db->get('payment')->result();
        foreach ($result as $key => $value) {
            $output[] = $value->comp_reg_id;
        }
        return $output;
    }

	

}

/* End of file M_payments.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/models/M_payments.php */