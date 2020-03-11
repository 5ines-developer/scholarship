<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Fees extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_fees');
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
        // header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
    }

    public function add($value='')
    {

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

    	$data['title'] = 'Add Fees';
        $this->load->helper('string');
        if($this->input->post()){
        	$grad   = $this->input->post('graduation', true);
            $fees  = $this->input->post('fees_am', true);
            $data   = array(
                'class'         => $grad, 
                'amount'        => $fees,
                'added_by' 		=> $this->adid,
                'date'          => date('Y'),
            );
            if($this->m_fees->add($data)){
                $this->session->set_flashdata('success', 'Fees Amount added Successfully');
            }
            else{
                $this->session->set_flashdata('error', 'Some error occured. <br>Please try agin later');
            }

            redirect('fees/manage','refresh');

        }else{
        	$data['grad'] = $this->m_fees->getGrad();
    		$this->load->view('fees/add', $data, FALSE);
        }
    }

    public function manage($id='')
    {
        $year = $this->input->get('year');
    	$data['title'] = 'Fees';
    	$data['result'] = $this->m_fees->feesGet($id,$year);
    	$this->load->view('fees/list', $data, FALSE);
    }

    public function edit($id='')
    {
        $id= $this->encryption_url->safe_b64decode($id);
    	$data['title'] = 'Fees';
    	$data['result'] = $this->m_fees->feesGet($id);
    	$data['grad'] = $this->m_fees->getGrad();
    	$this->load->view('fees/edit', $data, FALSE);
    }

    public function update($value='')
    {

        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);


    		$grad   = $this->input->post('graduation', true);
            $fees  = $this->input->post('fees_am', true);
            $id  = $this->input->post('id', true);
            $data   = array(
                'class'         => $grad, 
                'amount'        => $fees,
                'added_by' 		=> $this->adid,
            );
            if($this->m_fees->update($data,$id)){
                $this->session->set_flashdata('success', 'Fees Amount Updated Successfully');
            }
            else{
                $this->session->set_flashdata('error', 'Some error occured. <br>Please try agin later');
            }

            redirect('fees/edit/'.$this->encryption_url->safe_b64encode($id),'refresh');
    }

    public function delete($id='')
    {
    	 if($this->m_fees->delete($id)){
                $this->session->set_flashdata('success', 'Fees Amount Deleted Successfully');
            }
            else{
                $this->session->set_flashdata('error', 'Some error occured. <br>Please try agin later');
            }
            redirect('fees/manage','refresh');
    }

}