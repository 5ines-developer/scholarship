<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_reports extends CI_Model {

	public function getScholar($district='',$taluk='',$year='',$school='',$company='',$caste='',$item='')
	{
		return $this->yearGet($district,$taluk,$year,$school,$company,$caste,$item);
	}

	public function yearGet($district='',$taluk='',$year='',$school='',$company='',$caste='',$item='')
	{

		if (!empty($year)) {
            $date  = explode("-",$year);
            $sdate = $date[0];
            $edate = $date[1];
            $this->db->group_start();
                $this->db->where('a.application_year >=', $sdate);
                $this->db->where('a.application_year <=', $edate); 
            $this->db->group_end();
        }
		if (!empty($district)) { 	$this->db->where('am.ins_district', $district); } 
		if (!empty($taluk)) { 		$this->db->where('am.ins_talluk', $taluk); 	 } 
		if (!empty($school)) { 		$this->db->where('a.school_id', $school);   } 
		if (!empty($company)) { 	$this->db->where('a.company_id', $company);  }
		if (!empty($caste)) { 	$this->db->where('ab.category', $caste);  } 
		if ($item != 'nothing') { 	$this->db->where('a.status', $item);  }
		$this->db->select('a.application_year as year');
		$this->db->group_by('year');
		$this->db->from('application a');
		$this->db->join('applicant_marks am', 'am.application_id = a.id', 'left');
		$this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
		return  $this->db->get()->result();
	}

	public function scGet($district='',$taluk='',$year='',$school='',$company='',$caste='',$item='')
	{
		if (!empty($year)) { 		$this->db->where('a.application_year', $year); 	 } 
		if (!empty($district)) { 	$this->db->where('am.ins_district', $district); } 
		if (!empty($taluk)) { 		$this->db->where('am.ins_talluk', $taluk); 	 } 
		if (!empty($school)) { 		$this->db->where('a.school_id', $school);   } 
		if (!empty($company)) { 	$this->db->where('a.company_id', $company);  } 
		if (!empty($caste)) { 	$this->db->where('ab.category', $caste);  } 
		if ($item != 'nothing') { 	$this->db->where('a.status', $item);  }
		$this->db->where('ab.category', 'sc');
		$this->db->select('ab.category');
		$this->db->from('application a');
		$this->db->join('applicant_marks am', 'am.application_id = a.id', 'left');
		$this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
		return $this->db->get()->num_rows();
	}

	public function stGet($district='',$taluk='',$year='',$school='',$company='',$caste='',$item='')
	{
		if (!empty($year)) { 		$this->db->where('a.application_year', $year); 	 } 
		if (!empty($district)) { 	$this->db->where('am.ins_district', $district); } 
		if (!empty($taluk)) { 		$this->db->where('am.ins_talluk', $taluk); 	 } 
		if (!empty($school)) { 		$this->db->where('a.school_id', $school);   } 
		if (!empty($company)) { 	$this->db->where('a.company_id', $company);  } 
		if (!empty($caste)) { 	$this->db->where('ab.category', $caste);  } 
		if ($item != 'nothing') { 	$this->db->where('a.status', $item);  }
		$this->db->where('ab.category', 'st');
		$this->db->select('ab.category');
		$this->db->from('application a');
		$this->db->join('applicant_marks am', 'am.application_id = a.id', 'left');
		$this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
		return $this->db->get()->num_rows();
	}

	

	public function obcGet($district='',$taluk='',$year='',$school='',$company='',$caste='',$item='')
	{
		if (!empty($year)) { 		$this->db->where('a.application_year', $year); 	 } 
		if (!empty($district)) { 	$this->db->where('am.ins_district', $district); } 
		if (!empty($taluk)) { 		$this->db->where('am.ins_talluk', $taluk); 	 } 
		if (!empty($school)) { 		$this->db->where('a.school_id', $school);   } 
		if (!empty($company)) { 	$this->db->where('a.company_id', $company);  } 
		if (!empty($caste)) { 	$this->db->where('ab.category', $caste);  } 
		if ($item != 'nothing') { 	$this->db->where('a.status', $item);  }
		$this->db->where('ab.category', 'obc');
		$this->db->select('ab.category');
		$this->db->from('application a');
		$this->db->join('applicant_marks am', 'am.application_id = a.id', 'left');
		$this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
		return $this->db->get()->num_rows();
	}

	public function genGet($district='',$taluk='',$year='',$school='',$company='',$caste='',$item='')
	{
		if (!empty($year)) { 		$this->db->where('a.application_year', $year); 	 } 
		if (!empty($district)) { 	$this->db->where('am.ins_district', $district); } 
		if (!empty($taluk)) { 		$this->db->where('am.ins_talluk', $taluk); 	 } 
		if (!empty($school)) { 		$this->db->where('a.school_id', $school);   } 
		if (!empty($company)) { 	$this->db->where('a.company_id', $company);  }
		if (!empty($caste)) { 	$this->db->where('ab.category', $caste);  } 
		if ($item != 'nothing') { 	$this->db->where('a.status', $item);  } 
		$this->db->where('ab.category', 'general');
		$this->db->select('ab.category');
		$this->db->from('application a');
		$this->db->join('applicant_marks am', 'am.application_id = a.id', 'left');
		$this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
		return $this->db->get()->num_rows();
	}

	public function maleGet($district='',$taluk='',$year='',$school='',$company='',$caste='',$item='')
	{
		if (!empty($year)) { 		$this->db->where('a.application_year', $year); 	 } 
		if (!empty($district)) { 	$this->db->where('am.ins_district', $district); } 
		if (!empty($taluk)) { 		$this->db->where('am.ins_talluk', $taluk); 	 } 
		if (!empty($school)) { 		$this->db->where('a.school_id', $school);   } 
		if (!empty($company)) { 	$this->db->where('a.company_id', $company);  } 
		if (!empty($caste)) { 	$this->db->where('ab.category', $caste);  } 
		if ($item != 'nothing') { 	$this->db->where('a.status', $item);  }
		$this->db->where('ab.gender', 'male');
		$this->db->select('ab.category');
		$this->db->from('application a');
		$this->db->join('applicant_marks am', 'am.application_id = a.id', 'left');
		$this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
		return $this->db->get()->num_rows();
	}

	public function femaleGet($district='',$taluk='',$year='',$school='',$company='',$caste='',$item='')
	{
		if (!empty($year)) { 		$this->db->where('a.application_year', $year); 	 } 
		if (!empty($district)) { 	$this->db->where('am.ins_district', $district); } 
		if (!empty($taluk)) { 		$this->db->where('am.ins_talluk', $taluk); 	 } 
		if (!empty($school)) { 		$this->db->where('a.school_id', $school);   } 
		if (!empty($company)) { 	$this->db->where('a.company_id', $company);  } 
		if (!empty($caste)) { 	$this->db->where('ab.category', $caste);  } 
		if ($item != 'nothing') { 	$this->db->where('a.status', $item);  }
		$this->db->where('ab.gender', 'female');
		$this->db->select('ab.category');
		$this->db->from('application a');
		$this->db->join('applicant_marks am', 'am.application_id = a.id', 'left');
		$this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
		return $this->db->get()->num_rows();
	}


	public function approved($district='',$taluk='',$year='',$school='',$company='',$caste='',$item='')
	{
		if (!empty($year)) { 		$this->db->where('a.application_year', $year); 	 } 
		if (!empty($district)) { 	$this->db->where('am.ins_district', $district); } 
		if (!empty($taluk)) { 		$this->db->where('am.ins_talluk', $taluk); 	 } 
		if (!empty($school)) { 		$this->db->where('a.school_id', $school);   } 
		if (!empty($company)) { 	$this->db->where('a.company_id', $company);  } 
		if (!empty($caste)) { 	$this->db->where('ab.category', $caste);  } 
		$this->db->where('a.application_state', '4');
		$this->db->where('a.status', '1');
		$this->db->select('ab.category');
		$this->db->from('application a');
		$this->db->join('applicant_marks am', 'am.application_id = a.id', 'left');
		$this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
		return $this->db->get()->num_rows();
	}

	public function rejceted($district='',$taluk='',$year='',$school='',$company='',$caste='',$item='')
	{
		if (!empty($year)) { 		$this->db->where('a.application_year', $year); 	 } 
		if (!empty($district)) { 	$this->db->where('am.ins_district', $district); } 
		if (!empty($taluk)) { 		$this->db->where('am.ins_talluk', $taluk); 	 } 
		if (!empty($school)) { 		$this->db->where('a.school_id', $school);   } 
		if (!empty($company)) { 	$this->db->where('a.company_id', $company);  } 
		if (!empty($caste)) { 	$this->db->where('ab.category', $caste);  } 
		$this->db->where('a.status', '2');
		$this->db->select('ab.category');
		$this->db->from('application a');
		$this->db->join('applicant_marks am', 'am.application_id = a.id', 'left');
		$this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
		return $this->db->get()->num_rows();
	}

	public function pending($district='',$taluk='',$year='',$school='',$company='',$caste='',$item='')
	{
		if (!empty($year)) { 		$this->db->where('a.application_year', $year); 	 } 
		if (!empty($district)) { 	$this->db->where('am.ins_district', $district); } 
		if (!empty($taluk)) { 		$this->db->where('am.ins_talluk', $taluk); 	 } 
		if (!empty($school)) { 		$this->db->where('a.school_id', $school);   } 
		if (!empty($company)) { 	$this->db->where('a.company_id', $company);  } 
		if (!empty($caste)) { 	$this->db->where('ab.category', $caste);  } 
		$this->db->where('a.status', '0');
		$this->db->select('ab.category');
		$this->db->from('application a');
		$this->db->join('applicant_marks am', 'am.application_id = a.id', 'left');
		$this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
		return $this->db->get()->num_rows();
	}

	




	

}

/* End of file M_reports.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/models/M_reports.php */