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
        if ($this->session->userdata('sgt_id') == '') { $this->session->set_flashdata('error','Please login and try again!'); redirect('/','refresh'); }
        $this->load->library('sess_log');
        $this->sess_log->check_auth($this->session->userdata('sgt_id'));
        header_remove("X-Powered-By"); 
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("Strict-Transport-Security: max-age=31536000");
        header("Content-Security-Policy: frame-ancestors none");
        // header("Content-Security-Policy: default-src 'none'; script-src 'self' https://www.google.com/recaptcha/api.js https://www.gstatic.com/recaptcha/releases/v1QHzzN92WdopzN_oD7bUO2P/recaptcha__en.js https://www.google.com/recaptcha/api2/anchor?ar=1&k=6Le6xNYUAAAAADAt0rhHLL9xenJyAFeYn5dFb2Xe&co=aHR0cHM6Ly9oaXJld2l0LmNvbTo0NDM.&hl=en&v=v1QHzzN92WdopzN_oD7bUO2P&size=normal&cb=k5uv282rs3x8; connect-src 'self'; img-src 'self'; style-src 'self';");
        // header("Referrer-Policy: origin-when-cross-origin");
        header("Referrer-Policy: no-referrer-when-downgrade");
        header("Expect-CT: max-age=7776000, enforce");
        header('Public-Key-Pins: pin-sha256="d6qzRu9zOECb90Uez27xWltNsj0e1Md7GkYYkVoZWmM="; pin-sha256="E9CZ9INDbd+2eRQozYqqbQ2yXLVKB9+xcprMF+44U1g="; max-age=604800; includeSubDomains; report-uri="https://example.net/pkp-report"');
        header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
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
                $value->sc  = $this->m_reports->scGet($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->st  = $this->m_reports->stGet($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->obc = $this->m_reports->obcGet($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->gen = $this->m_reports->genGet($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->male = $this->m_reports->maleGet($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->female = $this->m_reports->femaleGet($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->approved = $this->m_reports->approved($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->rejected = $this->m_reports->rejceted($district,$taluk,$value->year,$school,$company,$caste,$items);
                $value->pending = $this->m_reports->pending($district,$taluk,$value->year,$school,$company,$caste,$items);
            }
        }

        $data['result'] = $years;
		$this->load->view('reports/scholarship', $data, FALSE);
	}

}

/* End of file Reports.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/controllers/Reports.php */