<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_student extends CI_Model {

	public function getStudent($value='')
	{
		return $this->db->select('email,phone,name,profile_pic')->get('student')->result();
	}
	

}

/* End of file M_student.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/models/M_student.php */