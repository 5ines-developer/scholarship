<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_scholar');
        $this->load->model('m_school');
        $this->load->model('m_reports');
        if ($this->session->userdata('said') == '') { $this->session->set_flashdata('error','Please login and try again!'); }
    }

    /*
    * Reports - Total Scholarship request
    * @url - reports
    **/ 
	public function index($district='',$taluk='')
	{
        $dist       = $this->input->get('district');
        $tal        = $this->input->get('taluk');
        $year       = $this->input->get('year');
        $school     = $this->input->get('school');
        $company    = $this->input->get('company');
		$caste       = $this->input->get('caste');

        if (!empty($dist)) {    $district = $this->m_scholar->distGet($dist); }
        if (!empty($tal)) {    $taluk = $this->m_scholar->talGet($tal);    }

		$data['title'] = 'Reports | Scholarship';
		$data['district'] = $this->m_school->getDistrict();
        $data['taluk'] = $this->m_school->getTalluk($district);
        $years = $this->m_reports->getScholar($district,$taluk,$year,$school,$company,$caste);

        if (!empty($years)) {
            foreach ($years as $key => $value) {
                $value->sc  = $this->m_reports->scGet($district,$taluk,$value->year,$school,$company,$caste);
                $value->st  = $this->m_reports->stGet($district,$taluk,$value->year,$school,$company,$caste);
                $value->obc = $this->m_reports->obcGet($district,$taluk,$value->year,$school,$company,$caste);
                $value->gen = $this->m_reports->genGet($district,$taluk,$value->year,$school,$company,$caste);
                $value->male = $this->m_reports->maleGet($district,$taluk,$value->year,$school,$company,$caste);
                $value->female = $this->m_reports->femaleGet($district,$taluk,$value->year,$school,$company,$caste);
                $value->approved = $this->m_reports->approved($district,$taluk,$value->year,$school,$company,$caste);
                $value->rejected = $this->m_reports->rejceted($district,$taluk,$value->year,$school,$company,$caste);
                $value->pending = $this->m_reports->pending($district,$taluk,$value->year,$school,$company,$caste);
            }
        }

        $data['result'] = $years;
		$this->load->view('reports/scholarship', $data, FALSE);
	}

}

/* End of file Reports.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/controllers/Reports.php */