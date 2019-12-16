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
        if($this->session->userdata('scinds') != ''){ redirect('dashboard','refresh'); }
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
                            'sinmail'   => $email,
                            'scinds'    => $result['id'],
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



       /**
     * industry registration-> mobile number check exist
     * url : register
    **/
    public function mobile_check($value='')
    {
        $this->security->xss_clean($_POST);
        $mobile = $this->input->post('mobile');
        $output = $this->m_auth->mobile_check($mobile);
        echo  $output;
    }

    /**
     * industry registration-> email check exist
     * url : register
    **/
    public function emailcheck($value='')
    {
        $this->security->xss_clean($_POST);
        $email = $this->input->post('email');
        $output = $this->m_auth->email_check($email);
        echo  $output;
    }

    /**
     * industry registration-> fetch company register id
     * url : register
    **/
    public function companyChange($var = null)
    {
        $this->security->xss_clean($_POST);
        $company = $this->input->post('comp');
        $output = $this->m_auth->companyChange($company);
        echo  $output;
    }

    public function getCompany($var = null)
    {
       $act = $this->input->post('act');
       $data = $this->m_auth->getCompany($act);
       echo json_encode($data);       
    }

    /**
     * industry registration-> load view and insert data
     * url : register
    **/
    public function registration()
    {
        if($this->session->userdata('scinds') != ''){ redirect('dashboard','refresh'); }
        if($this->input->post()){
           $this->regSubmit();
        }else{
            $data['title'] = 'Industry Registration';
            $data['taluk'] = $this->m_auth->getTaluk();
            $data['district'] = $this->m_auth->getDistrict();            
            $this->load->view('auth/register', $data, FALSE);
        }
    }

 
    

    public function regSubmit(Type $var = null)
    { 

        $insert = array(
            'email'          => $this->input->post('email'),
            'mobile'         => $this->input->post('phone'),
            'talluk'          => $this->input->post('taluk'),
            'district'       => $this->input->post('district'),
            'password'       => $this->input->post('password'),
            'address'        => $this->input->post('address'),
            'ref_id'         => random_string('alnum',16),
            'industry_id'         => $this->input->post('c_comp'),
        );
        
        if ((empty($_FILES['reg_doc']['tmp_name']))) {
            $this->session->set_flashdata('error', 'Server error  occurred😢.<br>  Please try agin later.');
            redirect('register');
        }else{
            $config['upload_path'] = './reg-doc';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_width'] = 0;
            $config['encrypt_name'] = true;
            $this->load->library('upload');
            $this->upload->initialize($config);
            if (!is_dir($config['upload_path'])) {mkdir($config['upload_path'], 0777, true); }
            $this->upload->do_upload('reg_doc');
            $upload_data = $this->upload->data();
            $reg = 'reg-doc/'.$upload_data['file_name'];

            $insert['register_doc'] = $reg;

        }

        $output = $this->m_auth->addCompany($insert);

        
        if(!empty($output)){
            $this->sendActivation($insert);
            $this->load->view('auth/reg-thank', $insert);
        }else{
            $this->session->set_flashdata('error', 'Server error  occurred😢.<br>  Please try agin later.');
            redirect('register');
        }
    }


    // Send activation
    public function sendActivation($insert = null)
    {
        $data['email'] = $insert['email'];
        $data['regid'] = $insert['ref_id'];
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/reg-verify', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($data['email']);
        $this->email->subject('Industry Registration verification'); 
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
            $this->session->set_flashdata('success', 'Your account has been activated successfully <br> you can login now.');
            redirect('login','refresh');
        }else{
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

       /**
    * student forgot password - load view
    * @url      : student/forgot-password
    * @param    : null.
    **/
    public function forgot_pass($value='')
    {
        if ($this->session->userdata('scinds') == '') {
            $this->security->xss_clean($_POST);
            $data['title'] = 'Forgot password';
            $input = $this->input->post();
            if (count($input) > 0) {
                $insert['email'] = $this->input->post('email');
                $insert['ref_id'] = random_string('alnum', '16');
                if($this->m_auth->forgotPassword($insert['email'],$insert['ref_id']))
                {
                    if ($this->sendforgot($insert)) {
                        $this->session->set_flashdata('success', 'We have sent A password reset link to your mail id, <br> Please check your mail to reset your password');
                    }else{
                        $this->session->set_flashdata('error', 'Some error occured! Please contact our support team');
                    }
                    redirect('forgot-password','refresh');
                }else{
                    $this->session->set_flashdata('error', 'Some error occured! Please contact our support team');
                    redirect('forgot-password','refresh');
                }
            }else{
                $this->load->view('auth/forgot-password');
            }
        }else{
            redirect('profile','refresh');
        }
    }
    

        /**
    * company forgot password - load view
    * @url      : forgot-password
    * @param    : null.
    **/
    function sendforgot($insert='')
    {
        $data['email'] = $insert['email'];
        $data['regid'] = $insert['ref_id'];
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $data['regid'] = $insert['ref_id'];
        $msg = $this->load->view('mail/forgot', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($data['email']);
        $this->email->subject('Industry Reset Password'); 
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


       /**
    * company forgot password - verify 
    * @url      : forgot-password
    * @param    : null.
    **/
    public function forgot_verify($regid='')
    {
        if ($this->session->userdata('scinds') == '') {
            $data['title'] = 'Forgot password';
            $data['newRegid'] = random_string('alnum', 50);
               if($this->m_auth->forgotVerify($regid, $data['newRegid'])){
                $this->load->view('auth/reset-password', $data, FALSE);
            }else{
                $this->session->set_flashdata('error', 'Some error occured! Please contact our support team <br> if you are facing any issues on resetting the password');
                redirect('forgot-password','refresh');
            }
        }else{
            redirect('profile','refresh');
        }

    }

     /**
    * company forgot password - reset password 
    * @url      : forgot-password
    * @param    : null.
    **/
    public function reset_password($value='')
    {
        if ($this->session->userdata('stlid') == '') {
            $this->security->xss_clean($_POST);
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('cnpassword', 'Password Confirmation', 'trim|required|matches[password]');
            if ($this->form_validation->run() == true) {
                $ref_id = random_string('alnum', 16);
                $rid = $this->input->post('rid');
                $npass = $this->input->post('password');
                $datas = array(
                    'ref_id' => $ref_id,
                    'password' => $npass,
                );
                if ($this->m_auth->setPassword($datas, $rid)) {
                    $this->session->set_flashdata('success', 'Your password has been updated successfully, <br> you can login now with the new password!');
                    redirect('login');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, Please try again Later! <br> or use another method reset your password');
                    redirect('forgot-password');
                }
            }else{
                $error = validation_errors();
                $this->session->set_flashdata('error',  $error );
                redirect('forgot-password');
            }
        }else{
            redirect('dashboard','refresh');
        }
    }

}

/* End of file auth.php */
// matrixchange



