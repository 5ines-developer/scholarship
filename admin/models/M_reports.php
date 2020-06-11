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
            $this->db->group_start();
                $this->db->where('a.application_year', $year);
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


	public function amount($district='',$taluk='',$year='',$school='',$company='',$caste='',$item='')
	{
		if (!empty($year)) { 		$this->db->where('a.application_year', $year); 	 } 
		if (!empty($district)) { 	$this->db->where('am.ins_district', $district); } 
		if (!empty($taluk)) { 		$this->db->where('am.ins_talluk', $taluk); 	 } 
		if (!empty($school)) { 		$this->db->where('a.school_id', $school);   } 
		if (!empty($company)) { 	$this->db->where('a.company_id', $company);  } 
		if (!empty($caste)) { 	$this->db->where('ab.category', $caste);  } 
		$this->db->where('a.status', '1');
		$this->db->where('fs.date', $year);
		$this->db->where('a.application_state', 's4');
		$this->db->select_sum('fs.amount');
		$this->db->from('application a');
		$this->db->join('applicant_marks am', 'am.application_id = a.id', 'left');
		$this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
		$this->db->join('gradution gr', 'gr.id = am.graduation', 'left');
		$this->db->join('fees fs', 'fs.class = gr.id', 'left');
		return $this->db->get()->row();
	}


	public function getcontribution($year='')
	{
		if (!empty($year)) { 		$this->db->where('year', $year); 	 }
		return $this->db->select('year')
		->group_by('year')
		->get('payment')->result();

	}

	public function cont_completed($year='')
	{
		$this->db->where('p.year', $year);
		$this->db->from('payment p');
		return $this->db->get()->num_rows();
	}

	public function cont_pending($year='')
	{
		$companyId = array();
		$this->db->select('comp_reg_id');
		$this->db->where('year', $year);
		$this->db->from('payment');
		$query = $this->db->get()->result();
		if (!empty($query)) {
			foreach ($query as $key => $value) {
				$companyId[] = $value->comp_reg_id;
			}
		}
		if (!empty($companyId)) {
			$this->db->where_not_in('i.reg_id', $companyId);
		}
		$this->db->where('ir.type', 1);
		$this->db->from('industry i');
		$this->db->join('industry_register ir', 'ir.industry_id = i.id', 'left');
		return $this->db->get()->num_rows();
	}

	public function cont_amount($year='')
	{
		$this->db->select_sum('price');
		$this->db->where('year', $year);
		$query = $this->db->get('payment')->result();
		if (!empty($query)) {
			foreach ($query as $key => $value) {
				return $value->price;
			}
		}
	}

	public function tot_amount($value='')
	{
		$this->db->select_sum('price');
		$query = $this->db->get('payment')->result();
		if (!empty($query)) {
			foreach ($query as $key => $value) {
				return $value->price;
			}
		}
	}

	public function getordergraph($startdate)
    { 
        $newData  = array();
        $this->db->select('payed_on');
        $cyear    = date("Y");
        $this->db->where('year <=', $cyear);
        $this->db->where('year >=', $startdate);
        $query = $this->db->get('payment')->result();
        foreach ($query as $key => $value) {
            $newData[]= date("Y",strtotime($value->payed_on));
        }
        $vals = array_count_values($newData);
        $counts = array();
        for ($m=2019; $m<= $cyear; $m++) {
            if(!empty($vals[$m])){
                $counts[]= array("values"=>$vals[$m] , "year"=>$m);
            }else{
                $counts[]= array("values"=>0 , "year"=>$m);
            }        
        }
        return $counts;
    }

	




	

}

/* End of file M_reports.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/models/M_reports.php */