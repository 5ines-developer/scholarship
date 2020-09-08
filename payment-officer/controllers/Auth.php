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
        ////header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
    }
    

    public function index()
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);

        if($this->session->userdata('spmo_id') != ''){ redirect('dashboard','refresh'); }
        if(!empty($this->input->post())){

            $inputCaptcha = $this->input->post('captcha');
            $sessCaptcha = $this->session->userdata('captchaCode');
            if($sessCaptcha == $inputCaptcha){
                $this->security->xss_clean($_POST);
                $this->form_validation->set_rules('email', 'Email Id', 'required|valid_email');
                $this->form_validation->set_rules('psw', 'Password', 'trim|required|min_length[5]');
                if ($this->form_validation->run() == True){
                    $email = $this->input->post('email'); 
                    $password = $this->input->post('psw');
                    
                    if($result = $this->m_auth->can_login($email, $password)) 
                    {
                        $session_data = array(
                            'spmo_mail'      => $email,
                            'spmo_id'        => $result['id'],
                            'spmo_status'    => $result['status'],
                            'spmo_name'      => $result['name'],
                            'spmo_type'      => $result['type']
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
            'spmo_mail'      => $this->session->userdata('spmo_mail'),
            'spmo_id'        => $this->session->userdata('spmo_id'),
            'spmo_status'    => $this->session->userdata('spmo_status'),
            'spmo_name'      => $this->session->userdata('spmo_name'),
            'spmo_type'      => $this->session->userdata('spmo_type')
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

       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        }else{
            $this->session->set_flashdata('error', 'Some error occured, please try again!');
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $this->input->post('email');
            if($result = $this->m_auth->checkMail($email)){
                $this->sendForgot($result);
                $this->session->set_flashdata('success', 'We have sent a password reset link to your mail id, <br> Please check your mail inbox and do not forget to check your spam folder to reset your password.');
                redirect('forgot-password','refresh');
            }else{
                $this->session->set_flashdata('error', 'Invalid email address');
                redirect('forgot-password','refresh');
            }
        }else{
            $this->session->set_flashdata('error', 'Some error occured, please try again!');
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        }else{
            $this->session->set_flashdata('error', 'Some error occured, please try again!');
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



