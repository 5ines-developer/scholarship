<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_student extends CI_Model {

	public function getStudent($year='',$id='')
	{
		if (!empty($year)) {
			$date  = explode("-",$year);
			$sdate = $date[0] . '-01-01';
			$edate = $date[1] . '-01-01';
			$this->db->where('date >=', $sdate);
			$this->db->where('date <=', $edate);
		}
		if (!empty($id)) {$this->db->where('id', $id); }
		return $this->db->select('date,status,id,email,phone,name,profile_pic')->get('student')->result();
	}


	public function getscholar($id='')
    {
        $this->db->select('m.prv_marks as mark, m.class, s.name, a.id,a.application_year');
        $this->db->from('application a');
        $this->db->where('a.Student_id', $id);        
        $this->db->order_by('a.id', 'desc');
        $this->db->join('student s', 's.id = a.Student_id', 'left');
        $this->db->join('applicant_marks m', 'm.application_id = a.id', 'left');
        return $this->db->get()->result();     
    }

     public function stasChange($id='',$status='')
  	{
	    $this->db->where('id', $id)->update('student', array('status' => $status));
	    if($this->db->affected_rows() > 0){
	      return true;
	    }
	    else{
	       return false;
    	}
  	}
	

}

/* End of file M_student.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/models/M_student.php */