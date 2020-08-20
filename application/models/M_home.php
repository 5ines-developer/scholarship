<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

	public function getordergraph($year='',$lyear='')
	{
		$last = $lyear.'-01-01 00:01:00';
    	$crnt = $year.'-12-31 23:59:00';

        $data['application']    = $this->appliCount($year,$lyear);
        $data['institute']      = $this->instCount($crnt,$last);
        $data['industry']       = $this->indstryCount($crnt,$last);
        $data['student']       	= $this->stdCount($crnt,$last);
        $data['male']       	= $this->maleCount($crnt,$last);
        $data['female']       	= $this->femaleCount($crnt,$last);
        $data['sc']       		= $this->scCount($year,$lyear);
        $data['st']       		= $this->stCount($year,$lyear);
        return $data;
	}

    public function appliCount($year = '',$lyear='')
    {
        $this->db->where('application_year >=', $lyear);
        $this->db->where('application_year <=', $year);
        return $this->db->get('application')->num_rows();
    }

    public function instCount($crnt='',$last='')
    {
    	$this->db->where('created_on >=', $last);
        $this->db->where('created_on <=', $crnt);
        return $this->db->get('school')->num_rows();        
    }

    public function indstryCount($crnt='',$last='')
    {
        $this->db->where('date >=', $last);
        $this->db->where('date <=', $crnt);
        return $this->db->get('industry_register')->num_rows();
    }

    public function stdCount($crnt='',$last='')
    {
        $this->db->where('date >=', $last);
        $this->db->where('date <=', $crnt);
        return $this->db->get('student')->num_rows();        
    }

    public function maleCount($crnt='',$last='')
    {
    	$this->db->where('s.date >=', $last);
        $this->db->where('s.date <=', $crnt);
        $this->db->where('ab.gender', 'male');
        $this->db->from('student s');
        $this->db->join('application a', 'a.Student_id = s.id', 'left');
        $this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
        return $this->db->get()->num_rows();
    }

    public function femaleCount($crnt='',$last='')
    {
        $this->db->where('s.date >=', $last);
        $this->db->where('s.date <=', $crnt);
        $this->db->where('ab.gender', 'female');
        $this->db->from('student s');
        $this->db->join('application a', 'a.Student_id = s.id', 'left');
        $this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
        return $this->db->get()->num_rows();    
    }

    public function scCount($crnt='',$last='')
    {
        $this->db->where('s.date >=', $last);
        $this->db->where('s.date <=', $crnt);
        $this->db->where('ab.category', 'sc');
        $this->db->from('student s');
        $this->db->join('application a', 'a.Student_id = s.id', 'left');
        $this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
        return $this->db->get()->num_rows();        
    }

    public function stCount($crnt='',$last='')
    {
        $this->db->where('s.date >=', $last);
        $this->db->where('s.date <=', $crnt);
        $this->db->where('ab.category', 'st');
        $this->db->from('student s');
        $this->db->join('application a', 'a.Student_id = s.id', 'left');
        $this->db->join('applicant_basic_detail ab', 'ab.application_id = a.id', 'left');
        return $this->db->get()->num_rows();          
    }

    



	

}

/* End of file M_home.php */
/* Location: ./application/models/M_home.php */