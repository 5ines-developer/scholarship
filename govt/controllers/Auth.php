<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
        $this->load->library('form_validation');  
        $this->load->library('sc_check');
        $this->load->helper('captcha');
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
    

    public function index()
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        if($this->session->userdata('sgt_id') != ''){ redirect('dashboard','refresh'); }
        if($this->input->post()){

            $inputCaptcha = $this->input->post('captcha');
            $sessCaptcha = $this->session->userdata('captchaCode');
            if($sessCaptcha == $inputCaptcha){

                $this->form_validation->set_rules('email', 'Email Id', 'required');
                $this->form_validation->set_rules('psw', 'Password', 'trim|required|min_length[5]');
                if ($this->form_validation->run() == True){
                    $email = $this->input->post('email'); 
                    $password = $this->input->post('psw');
                    
                    if($result = $this->m_auth->can_login($email, $password)) 
                    {
                        $session_data = array(
                            'sgt_mail'      => $email,
                            'sgt_id'        => $result['id'],
                            'sgt_status'    => $result['status'],
                            'sgt_name'      => $result['name'],
                            'sgt_type'      => $result['type']
                        ); 
                        $this->session->set_userdata($session_data); 
                        $this->sc_check->loginSuccess();
                        redirect('dashboard'); 
                    } 
                    else 
                    {
                        $this->sc_check->loginError($email);
                        $this->session->set_flashdata('error', 'Invalid Username or Password'); 
                        redirect('/');
                    }

                }else{
                    $this->session->set_flashdata('error', 'Invalid Username or Password'); 
                    redirect('/');
                }

            }else{
                $this->session->set_flashdata('error', 'Please Enter the Correct captcha text');
                redirect('/');

            }
        }else{
            $data['captchaImg'] = $this->sc_check->img_catcha();
            $this->load->view('auth/login',$data);
        }
    }

    // logout
    public function logout()
    {
        $session_data = array(
            'sgt_mail'      => $this->session->userdata('sgt_mail'),
            'sgt_id'        => $this->session->userdata('sgt_id'),
            'sgt_status'    => $this->session->userdata('sgt_status'),
            'sgt_name'      => $this->session->userdata('sgt_name'),
            'sgt_type'      => $this->session->userdata('sgt_type')
        ); 

        $this->session->unset_userdata($session_data);
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'You are Logged Out successfully');
        redirect('/');
    }


    // Account activation
    public function account_activation($refId = null)
    {        
        if($this->m_auth->activateAccount($refId)){
            $data['key'] = $refId;
            $this->load->view('auth/set-password', $data);
        }else{
            $this->session->set_flashdata('error', 'Activation link has been expired, <br> please contact admin for further!');
            redirect('login','refresh');
        }
    }




   // Set password
    public function set_password($var = null)
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

       $password = $this->bcrypt->hash_password($this->input->post('psw'));
       $key = $this->input->post('key');
       $this->load->helper('string');

        $data = array(
           'psw'    => $password, 
           'ref_link' => random_string('alnum', 30), 
           'status' => 1, 
        );
        if($this->m_auth->set_password($data, $key)){
            $this->session->set_flashdata('success', 'Email verification successfully completed.<br> Now you can login.');
            redirect('/','refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Activation link has been expired, <br> please contact admin for further!');
            redirect('login','refresh');
        }
    }


    // Forgot password
    public function forgotPassword()
    {
        $data['title'] = 'Forgot password | Scholarship';
        $this->load->view('auth/forgot-password', $data, FALSE);   
    }

    // check mail
    public function checkEmail()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('mail', 'mail', 'required|is_unique[admin.email]');
        if($this->form_validation->run() === false){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

     // check forgot password
    public function forgot_password_check(Type $var = null)
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        $email = $this->input->post('email');
        if($result = $this->m_auth->checkMail($email)){
            $this->sendForgot($result);
            $this->session->set_flashdata('success', 'We have sent A password reset link to your mail id, <br> Please check your mail to reset your password');
            redirect('forgot-password','refresh');
        }else{
            $this->session->set_flashdata('error', 'Invalid email address');
            redirect('forgot-password','refresh');
        }
    }  

    function sendForgot($insert='')
    {
        $data['email'] = $insert->email;
        $data['regid'] = $insert->ref_link;
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/forgot', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($data['email']);
        $this->email->subject('Verification Officer - Forgot password Password'); 
        $this->email->message($msg);
        if($this->email->send())  
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    public function verification($id = null)
    {
        if($this->m_auth->verification($id)){
            $data['refid'] = $id;
            $this->load->view('auth/new-password', $data);
        }else{
            $this->session->set_flashdata('error', 'forgot password link has been expired <br> Please tru again');
            redirect('/','refresh');
        }
    }

    public function set_new_password()
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);
    
        $password = $this->bcrypt->hash_password($this->input->post('psw'));
        $key = $this->input->post('key');
        $this->load->helper('string');
       
       $data = array(
           'psw'    => $password, 
           'ref_link' => random_string('alnum', 30), 
           'status' => 1, 
        );
        if($this->m_auth->set_password($data, $key)){
            $this->session->set_flashdata('success', 'Successfully password changed.');
            redirect('/','refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Activation link has been expired');
            redirect('/','refresh');
        }
    }

    public function refresh(){
        $captcha['image'] = $this->sc_check->cap_refresh();
        echo $captcha['image'];
    }



}

/* End of file auth.php */
// matrixchange



