<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_applidate extends CI_Model {

	public function getDate($value='')
	{
		$this->db->order_by('fromdate', 'desc');
		$query = $this->db->get('application_date');
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function add($date='')
	{

		$fromdate 	= 	date("Y", strtotime($date['fromdate']));
		$todate 	= 	date("Y",strtotime($date['todate']));
		$this->db->where('fromdate >=', $fromdate.'-01-01');
		$this->db->where('todate <=', 	$todate.'-12-31');
		$query = $this->db->get('application_date');
		if ($query->num_rows() > 0 ) {
			$this->db->where('fromdate >=', $fromdate.'-01-01');
			$this->db->where('todate <=', 	$todate.'-12-31');
			return $this->db->update('application_date',$date);
		}else{
			return $this->db->insert('application_date',$date);
		}
	}

	public function delete($id='')
	{
		$this->db->where('id', $id);
		return $this->db->delete('application_date');
	}
	

}

/* End of file M_applidate.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/models/M_applidate.php */
