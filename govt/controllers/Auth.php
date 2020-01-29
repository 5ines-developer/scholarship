<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
        $this->load->library('form_validation');  
    }
    

    public function index()
    {
        if($this->session->userdata('sgt_id') != ''){ redirect('dashboard','refresh'); }
        if($this->input->post()){
                $this->security->xss_clean($_POST);
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
                        redirect('dashboard'); 
                    } 
                    else 
                    {
                        $this->session->set_flashdata('error', 'Invalid Username or Password'); 
                        redirect('/');
                    }

                }else{
                    $this->session->set_flashdata('error', 'Invalid Username or Password'); 
                    redirect('/');
                }
        }else{
            $this->load->view('auth/login');
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



}

/* End of file auth.php */
// matrixchange



