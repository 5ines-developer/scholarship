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
        if($this->input->post()){
            $this->load->library('form_validation');
            if ($this->session->userdata('sclinst') == '') { 
                $this->security->xss_clean($_POST);
                $this->form_validation->set_rules('email', 'Email Id', 'required');
                $this->form_validation->set_rules('pswd', 'Password', 'trim|required|min_length[6]');
                if ($this->form_validation->run() == True){
                    echo $email = $this->input->post('email'); 
                    echo $password = $this->input->post('pswd');
                    
                    if($result = $this->m_auth->can_login($email, $password)) 
                    {
                        $session_data = array(
                            'scmail'    => $email,
                            'scinst'    => $result['id'],
                            'scqstn'    => $result['status'],
                            'school'    => $result['status'],
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

                }
            }else{
                echo 'loggd in';
            }
        }else{
            $this->load->view('auth/login');
        }
    }

    public function registration()
    {
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
                $config['allowed_types'] = 'jpg|png|jpeg|pdf';
                $config['max_width'] = 0;
                $config['encrypt_name'] = true;

                $this->load->library('upload');
                $this->upload->initialize($config);

                if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
                $this->upload->do_upload($key);
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
    
}

/* End of file auth.php */
