<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

class Home extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Scholarship | Karnataka Labour Welfare Board';
		$this->load->view('site/index', $data, FALSE);
		
	}

         function show_image($folder='',$file='') {

                if ($this->session->userdata('stlid') != '' || $this->session->userdata('scinst') != '' || $this->session->userdata('scinds')!='' || $this->session->userdata('sgt_id') != '' || $this->session->userdata('sfn_id') != '' || $this->session->userdata('said') != '') {
                $img_path = $folder.'/'.$file;
                $fp = fopen($img_path,'rb');
                header('Content-Type: image/png');
                header('Content-length: ' . filesize($img_path));
                fpassthru($fp);
                }else{
                redirect('/','refresh');

                }

               
        }

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */