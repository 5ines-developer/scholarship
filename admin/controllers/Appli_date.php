<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appli_date extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_applidate');
        if($this->session->userdata('said') == ''){ redirect('/','refresh'); }
        $this->adid = $this->session->userdata('said'); 
        header_remove("X-Powered-By"); 
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("Strict-Transport-Security: max-age=31536000");
        header("Content-Security-Policy: frame-ancestors none");
        header("Referrer-Policy: no-referrer-when-downgrade");
        // header("Content-Security-Policy: default-src 'none'; script-src 'self' https://www.google.com/recaptcha/api.js https://www.gstatic.com/recaptcha/releases/v1QHzzN92WdopzN_oD7bUO2P/recaptcha__en.js https://www.google.com/recaptcha/api2/anchor?ar=1&k=6Le6xNYUAAAAADAt0rhHLL9xenJyAFeYn5dFb2Xe&co=aHR0cHM6Ly9oaXJld2l0LmNvbTo0NDM.&hl=en&v=v1QHzzN92WdopzN_oD7bUO2P&size=normal&cb=k5uv282rs3x8; connect-src 'self'; img-src 'self'; style-src 'self';");
        // header("Referrer-Policy: origin-when-cross-origin");
        // header("Expect-CT: max-age=7776000, enforce");
        // header('Public-Key-Pins: pin-sha256="d6qzRu9zOECb90Uez27xWltNsj0e1Md7GkYYkVoZWmM="; pin-sha256="E9CZ9INDbd+2eRQozYqqbQ2yXLVKB9+xcprMF+44U1g="; max-age=604800; includeSubDomains; report-uri="https://example.net/pkp-report"');
        ////header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
        
    }

	public function index()
	{
        $data['result'] = $this->m_applidate->getDate();
        $this->load->view('applidate/add', $data, FALSE);
	}


	public function add($value='')
	{
		if(!empty($this->input->post())){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
            $this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
            if ($this->form_validation->run() == True){


                $start_date = $this->input->post('start_date', true);
                $end_date  	= $this->input->post('end_date', true);
                $data   = array(
                    'fromdate' => $this->input->post('start_date'), 
                    'todate'   => $this->input->post('end_date'),
                    'status'   => 1,
                );
                if($this->m_applidate->add($data)){
                    $this->session->set_flashdata('success', 'Application Date added Successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Some error occured. <br>Please try agin later');
                }
                redirect('application-date','refresh');
            }else{
                $this->form_validation->set_error_delimiters('', '<br>');
                $this->session->set_flashdata('error', str_replace(array("\n", "\r"), '', validation_errors()));
                redirect('application-date','refresh');
            }
        }else{
        	$this->session->set_flashdata('error', 'Some error occured. <br>Please try agin later');
        	redirect('application-date','refresh');
        }
	}

	public function delete($id='')
	{
		if($this->m_applidate->delete($id)){
            $this->session->set_flashdata('success', 'Application Date Deleted Successfully');
        }
        else{
            $this->session->set_flashdata('error', 'Some error occured. <br>Please try agin later');
        }
        redirect('application-date','refresh');
	}

}

/* End of file Appli_date.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/controllers/Appli_date.php */