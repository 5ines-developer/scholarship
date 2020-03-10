<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
        $this->load->library('sc_check');
    }
    

    public function index()
    {
        $data['title'] = 'Scholarship | Admin';
        $this->load->view('auth/login', $data);
    }

    public function login()
    {

            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        if($this->session->userdata('said') != ''){ redirect('dashboard','refresh'); }
        $this->load->library('form_validation');
        if ($this->session->userdata('said') == '') { 
            $this->security->xss_clean($_POST);
            $this->form_validation->set_rules('email', 'Email Id', 'required');
            $this->form_validation->set_rules('pswd', 'Password', 'trim|required|min_length[6]');
            if ($this->form_validation->run() == True){
                $email = $this->input->post('email'); 
                $password = $this->input->post('pswd');
                
                if($result = $this->M_auth->can_login($email, $password)) 
                {
                    $session_data = array(
                        'samail'    => $email,
                        'said'      => $result['id'],
                        'sastatus'  => $result['status'],
                        'saname'    => $result['name'],
                        'type'      => $result['type']
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
            redirect('dashboard');
        }
    }

    // logout
    public function logout()
    {
        $this->session->unset_userdata($this->session->userdata());
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'You are Logged Out successfully');
        redirect('/');
    }
     // Forgot password
    public function forgotPassword()
    {
        if($this->session->userdata('said') != ''){ redirect('dashboard','refresh'); }else{
        $data['title'] = 'Forgot password | Scholarship';
        $this->load->view('auth/forgot-password', $data, FALSE); }   
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
        if($result = $this->M_auth->checkMail($email)){
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
        $this->email->subject('Admin Forgot password Password'); 
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
        if($this->M_auth->verification($id)){
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
        if($this->M_auth->set_password($data, $key)){
            $this->session->set_flashdata('success', 'Successfully password changed.');
            redirect('/','refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Activation link has been expired');
            redirect('/','refresh');
        }
    }

     // Account activation
     public function account_activation($refId = null)
     {
         if($this->M_auth->activateAccount($refId)){
             $data['key'] = $refId;
             $this->load->view('auth/set-password', $data);
         }else{
             $this->session->set_flashdata('error', 'Activation link has been expired');
             redirect('register','refresh');
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
         if($this->M_auth->set_password($data, $key)){
             $this->session->set_flashdata('success', 'Email verification successfully completed.<br> Now you can login.');
             redirect('/','refresh');
         }
         else{
             $this->session->set_flashdata('error', 'Activation link has been expired');
             redirect('/','refresh');
         }
     }


    public function dbine($var = null)
    {
        $this->loginmodel->dbine();
    }







}

/* End of file auth.php */
