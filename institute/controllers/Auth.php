<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
        
    }
    

    public function index()
    {
        if($this->session->userdata('scinst') != ''){ redirect('dashboard','refresh'); }
        if($this->input->post()){
            $this->load->library('form_validation');
            if ($this->session->userdata('scinst') == '') { 
                $this->security->xss_clean($_POST);
                $this->form_validation->set_rules('email', 'Email Id', 'required');
                $this->form_validation->set_rules('pswd', 'Password', 'trim|required|min_length[6]');
                if ($this->form_validation->run() == True){
                    $email = $this->input->post('email'); 
                    $password = $this->input->post('pswd');
                    
                    if($result = $this->m_auth->can_login($email, $password)) 
                    {
                       
                        $session_data = array(
                            'scmail'    => $email,
                            'scinst'    => $result['id'],
                            'scqstn'    => $result['status'],
                            'school'    => $result['school_id'],
                            'type'      => $result['created_by'],
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
                redirect('dashboard');
            }
        }else{
            $this->load->view('auth/login');
        }
    }

    public function registration()
    {
        if($this->session->userdata('scinst') != ''){ redirect('dashboard','refresh'); }
        if($this->input->post()){
           $this->regSubmit();
        }else{
            $data['title'] = 'Institute Registration';
            $data['taluk'] = $this->m_auth->getTaluk();
            $data['district'] = $this->m_auth->getDistrict();
            $this->load->view('auth/register', $data, FALSE);
        }
    }

    public function regSubmit(Type $var = null)
    {
        
        
        foreach ($_FILES as $key => $value) {
            if (!empty($value)) {
                $config['upload_path'] = './'.$key;
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_width'] = 0;
                $config['encrypt_name'] = true;

                $this->load->library('upload');
                $this->upload->initialize($config);

                if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
                if (!$this->upload->do_upload($key)) {
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);exit();
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('register');
                } else {

                    $upload_data = $this->upload->data();
                    if($key == 'regfile'){
                        $regfile = $key.'/'.$upload_data['file_name'];
                    }elseif($key == 'signature') {
                        $signature = $key.'/'.$upload_data['file_name'];
                    }else{
                        $seal = $key.'/'.$upload_data['file_name'];
                    }

                }
                
            }
        }

        $data['schoolDetail'] = array(
            'name'              => $this->input->post('iname'),
            'principal'         => $this->input->post('prname'),
            'email'             => $this->input->post('email'),
            'phone'             => $this->input->post('number'),
            'reg_no'            => $this->input->post('regno'),
            'reg_certification' => $regfile,
            'priciple_signature'=> $signature,
            'seal'              => $seal,
            'status'            => '0',
        );

        $schoolId = $this->m_auth->addSchoolDetail($data['schoolDetail']);

        $this->load->helper('string');
        $data['auth'] = array(
            'email'         => $this->input->post('email'),
            'phone'         => $this->input->post('number'),
            'school_id'     => $schoolId,
            'ref_id'        => random_string('alnum', 50),
            'otp'           => date('is'),
            'name'          => $this->input->post('iname'),
        );

        $data['school_address'] = array(
            'school_id' => $schoolId,
            'address'   => $this->input->post('address'),
            'city'      => $this->input->post('district'),
            'taluq'     => $this->input->post('taluk'),
            'pin'       => $this->input->post('pin'),
        );
        
        if($this->m_auth->CreateAuth($data)){
            $this->sendActivation($data);
            $this->load->view('auth/reg-thank', $data);
        }else{
            $this->session->set_flashdata('error', 'Server error  occurred😢.<br>  Please try agin later.');
            redirect('register');
        }
    }


    // Send activation
    public function sendActivation($insert = null)
    {
        $data['email'] = $insert['auth']['email'];
        $data['regid'] = $insert['auth']['ref_id'];
        $data['team'] = 'Principal';
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $data['regid'] = $insert['auth']['ref_id'];
        $msg = $this->load->view('mail/reg-verify', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($data['email']);
        $this->email->subject('Institute Registration verification'); 
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

    // Account activation
    public function account_activation($refId = null)
    {
        if($this->m_auth->activateAccount($refId)){
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
       $password = $this->bcrypt->hash_password($this->input->post('psw'));
       $key = $this->input->post('key');
       $this->load->helper('string');
       
       $data = array(
           'psw'    => $password, 
           'ref_id' => random_string('alnum', 30), 
           'status' => 1, 
        );
        if($this->m_auth->set_password($data, $key)){
            $this->session->set_flashdata('success', 'Email verification successfully completed.<br> Now you can login.');
            redirect('/','refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Activation link has been expired');
            redirect('register','refresh');
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
        $data['title'] = 'Forgot password | Scholarship';
        $this->load->view('auth/forgot-password', $data, FALSE);   
    }

    // check mail
    public function checkEmail()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('mail', 'mail', 'required|is_unique[school_auth.email]');
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
        $data['regid'] = $insert->ref_id;
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/forgot', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($data['email']);
        $this->email->subject('Institute Forgot password Password'); 
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
           'ref_id' => random_string('alnum', 30), 
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

    // taluk filter based on selected district
    public function talukFilter()
    {
        $district = $this->input->get('filter');
        $result = $this->m_auth->getTalukFiletr($district);
        echo json_encode($result);
    }

    // institute filter
    public function instituteFilter()
    {
        $taluk = $this->input->get('filter');
        $result = $this->m_auth->instituteFilter($taluk);
        echo json_encode($result);
    }
    
}

/* End of file auth.php */
// matrixchange



