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
        if ($this->session->userdata('said') == '') { $this->session->set_flashdata('error','Please login and try again!');
        redirect('login','refresh'); }
        header_remove("X-Powered-By"); 
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("Strict-Transport-Security: max-age=31536000");
        header("Content-Security-Policy: frame-ancestors none");
        header("Referrer-Policy: no-referrer-when-downgrade");
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
        $caste      = $this->input->get('caste');
		$item       = $this->input->get('item');

        switch ($item) {
            case 'pending':
                $items = '0';
                break;
            case 'approved':
                $items = '1';
                break;   
            case 'rejected':
                $items = '2';
                break;
            default:
                $items = 'nothing';
                break;
        }

        if (!empty($dist)) {    $district = $this->m_scholar->distGet($dist); }
        if (!empty($tal)) {    $taluk = $this->m_scholar->talGet($tal);    }

		$data['title'] = 'Reports | Scholarship';
		$data['district'] = $this->m_school->getDistrict();
        $data['taluk'] = $this->m_school->getTalluk($district);
        $years = $this->m_reports->getScholar($district,$taluk,$year,$school,$company,$caste,$items);
        if (!empty($years)) {
            foreach ($years as $key => $value) {
                $value->sc          = $this->m_reports->scGet($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->st          = $this->m_reports->stGet($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->obc         = $this->m_reports->obcGet($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->gen         = $this->m_reports->genGet($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->male        = $this->m_reports->maleGet($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->female      = $this->m_reports->femaleGet($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->approved    = $this->m_reports->approved($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->rejected    = $this->m_reports->rejceted($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->pending     = $this->m_reports->pending($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->amount      = $this->m_reports->amount($district,$taluk,$value->year,$school,$company,$caste,$items);
            }
        }
        $data['result'] = $years;
		$this->load->view('reports/scholarship', $data, FALSE);
	}


    public function contribution($year='')
    {
        $year = $this->input->get('year');
        $data['title'] = 'Reports | Scholarship';
        $years = $this->m_reports->getcontribution($year);
        if (!empty($years)) {
            foreach ($years as $key => $value) {
                $value->completed   = $this->m_reports->cont_completed($value->year);
                $value->pending     = $this->m_reports->cont_pending($value->year);
                $value->amount      = $this->m_reports->cont_amount($value->year);
            }
        }
        $data['result'] = $years;
        $this->load->view('reports/contribution', $data, FALSE);
    }

    // contribution dashboard
    public function dashboard($value='')
    {
        $year = $this->input->get('year');
        if (!empty($year)) {
            $data['years']       = $year;
        }else{
            $data['years']       = date('Y');
        }
        
        $data['title']      = 'Contribution | Scholarship';
        $data['completed']  = $this->m_reports->cont_completed($data['years']);
        $data['pending']    = $this->m_reports->cont_pending($data['years']);
        $data['amount']     = $this->m_reports->cont_amount($data['years']);
        $data['total']      = $this->m_reports->tot_amount();
        $this->load->view('dashboard/contribution-dashboard.php', $data, FALSE);
    }

    public function getordergraph($value='')
    {
        $startdate  = '2019'; //start date of the year (jan first)
        $result     = $this->m_reports->getordergraph($startdate);
        echo json_encode($result);
    }

}

/* End of file Reports.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/controllers/Reports.php */