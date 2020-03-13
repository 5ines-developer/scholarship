<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_student');
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


       /**
    * student login - load view page
    * @url      : student/login
    * @param    : null
    **/
    public function index($value='')
    {
        if ($this->session->userdata('stlid') == '') {
            $data['title']      = 'Student Login';
            $data['captchaImg'] = $this->sc_check->img_catcha();
            $this->load->view('student/student-login.php', $data, FALSE);
        }else{
            redirect('student/profile','refresh');
        }
    }

    /**
    * student registartion
    * @url      : student/register 
    * @param    : null
    * @data     : school data, company data,
    **/ 
    public function register($var = null)
    {
        if ($this->session->userdata('stlid') == '') {
            $data['title']      = 'Student Register';
            $this->load->view('student/student-registration.php', $data, FALSE);
        }else{
            redirect('student/profile','refresh');
        }
        
    }

    /**
     * user registration-> mobile number check exist
     * url : register
    **/
    public function mobile_check($value='')
    {
        $this->security->xss_clean($_POST);
        $mobile = $this->input->post('mobile');
        $output = $this->m_student->mobile_check($mobile);
        echo  $output;
    }

    /**
     * user registration-> email check exist
     * url : register
    **/
    public function emailcheck($value='')
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);
        $email = $this->input->post('email');
        $output = $this->m_student->email_check($email);
        echo  $output;
    }
    
    
    /**
    * student registartion - insert student detail
    * @url      : student/submit-register
    * @param    : null
    * @data     : student data,
    **/
    public function registerInsert()
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);
        if ($this->session->userdata('stlid') == '') {
        $this->form_validation->set_rules('email', 'Email', 'is_unique[student.email]',array('is_unique' => 'This %s is already exist'));
        $this->form_validation->set_rules('mobile', 'Mobile No.', 'required|is_unique[student.phone]',array('is_unique' => 'This %s is already exist'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('cnpassword', 'Password Confirmation', 'trim|required|matches[password]');
        if ($this->form_validation->run() == false) {
            $error = validation_errors();
            $this->session->set_flashdata('error', $error);
            redirect('student/register','refresh');
        }else{

            $insert = array(
                'email'     =>  $this->input->post('email'), 
                'phone'     =>  $this->input->post('mobile'),
                'password'  =>  $this->bcrypt->hash_password($this->input->post('password')),
                'otp'       =>  random_string('nozero',6), 
                'ref_id'    =>  random_string('alnum',20),
            );

           $verifyMethod = $this->input->post('verify');
            if(!empty($insert['email'])){
                $name = explode("@",$insert['email']);
                $insert['name'] =  $name[0];
            }

            if ($this->m_student->register($insert)) {
                if ($verifyMethod == '1') {
                    if($this->studentOtp($insert))
                    {
                        $this->session->set_flashdata('success', 'We have sent a OTP to your mobile number '.$insert['phone'].' <br> Enter the OTP and activate your account.');
                        $this->load->view('student/otp-verify',$insert);
                    }else{
                        $this->db->where('ref_id', $insert['ref_id'])->delete('student');
                        $this->session->set_flashdata('error', 'Some error occurred! Please contact our support team');
                        redirect('student/register','refresh');
                    }
                }else{
                    if($this->sendregister($insert))
                    {
                        $this->session->set_flashdata('success', 'We have sent a activation link to your mail id <br> please verify and activate your account');
                    }else{
                        $this->db->where('ref_id', $insert['ref_id'])->delete('student');
                        $this->session->set_flashdata('error', 'Some error occurred! Please contact our support team');
                    }
                    redirect('student/register','refresh');
                }
            }else{
                $this->session->set_flashdata('error', 'Some error occurred! Please contact our support team');
                redirect('student/register','refresh');
            }
            
           
        }
        }else{
            redirect('student/profile','refresh');
        }
    }

    public function otpVerify($value='')
    {
        $refid = $this->input->post('refid');
        $phone = $this->input->post('phone');
        $otp = $this->input->post('otp');
        $output = $this->m_student->otpVerify($refid,$phone,$otp);
        echo $output;
    }


    public function resendOtp($value='')
    {
        $refid  = $this->input->post('refid');
        $phone  = $this->input->post('phone');
        $otp    = random_string('nozero',6);
        $output = $this->m_student->resendOtp($refid,$phone,$otp);
        echo $output;
    }


    public function studentOtp($data='', $apid='')
    {
        
        $msg = 'Your One time Password For Karnataka Labour Welfare Board Scholarship registration is ' . $data['otp'] . ' . Do not share with anyone';
        /* API URL */
        $url = 'http://trans.smsfresh.co/api/sendmsg.php';
        $param = 'user=5inewebsolutions&pass=5ine5ine&sender=PROPSB&phone=' . $data['phone'] . '&text=' . $msg . '&priority=ndnd&stype=normal';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }

    /**
     * user registration-> email send
     * 
    **/
    function sendregister($insert='')
    {
        $data['email'] = $insert['email'];
        $data['regid'] = $insert['ref_id'];
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $data['regid'] = $insert['ref_id'];
        $msg = $this->load->view('email/registration', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($data['email']);
        $this->email->subject('Student Registration verification'); 
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


    public function email_verification($var = null)
    {
        
        if ($this->session->userdata('stlid') == '') {
            $this->security->xss_clean($_GET);
           $regid = $this->input->get('rid');
           $newRegid = random_string('alnum', 50);
           if($this->m_student->activateAccount($regid, $newRegid)){
            $this->session->set_flashdata('success', 'Your account has been activated successfully. You can  login now. ');
            redirect('student/login','refresh');
           }else{
            $this->session->set_flashdata('error', 'Activation link expired!,please contact our support team <br> if you are facing any issue on registration');
            redirect('student/login','refresh');
           }
        }else{
            redirect('student/profile','refresh');
        }
    }



 

    /**
    * student login - verify the credentials
    * @url      : student/login-check
    * @param    : email or phone and password.
    **/
    public function login_submit($value='')
    {

        $this->security->xss_clean($_POST);
        $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
        );
        if(!empty($this->input->post())){

            $inputCaptcha = $this->input->post('captcha');
            $sessCaptcha = $this->session->userdata('captchaCode');

            if($sessCaptcha == $inputCaptcha){
                if ($this->session->userdata('stlid') == '') {
                $this->form_validation->set_rules('email', 'Email Id', 'required');
                $this->form_validation->set_rules('pswd', 'Password', 'trim|required|min_length[5]');
                    if ($this->form_validation->run() == True){
                        $email = $this->input->post('email'); 
                        $password = $this->input->post('pswd');
                        if($result = $this->m_student->can_login($email, $password)) 
                        {
                            $session_data = array(
                                'slmail' => $email,
                                'stlid'  => $result['id'],
                                'stqstn' => $result['qstn_status'],
                            );
                            $this->session->set_userdata($session_data);
                            $this->sc_check->loginSuccess();
                            redirect('student/dashboard'); 
                        } 
                        else 
                        {
                            $this->sc_check->loginError($email);
                            $this->session->set_flashdata('error', 'Invalid Username or Password'); 
                            redirect('student/login');
                        }
                    }else{
                        $error = validation_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('student/login','refresh');
                    }

                }else{
                    redirect('student/profile','refresh');
                }
            }else{
                $this->session->set_flashdata('error', 'Please Enter the Correct captcha text');
                redirect('student/login','refresh');
            }
        }else{
            redirect('student/login','refresh');
        }
    }

    /**
    * student dashboard - enter the dashboard if login succes
    * @url      : student/dashboard
    * @param    : null.
    **/
    public function dashboard()
    {
        if ($this->session->userdata('stqstn') != 1) {
            $data['title']      = 'Security Question';
            $data['question'] = $this->m_student->getQuestion();
            $this->load->view('student/security-questions', $data, FALSE);
        }else{
            redirect('student/profile','refresh'); 
        }
    }

    public function security($value='')
    {
        $this->security->xss_clean($_POST);
        $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
        );
        if(!empty($this->input->post())){
            $qstn   = $this->input->post('qstn');
            $answer = $this->input->post('answer');
            $stdid  = $this->session->userdata('stlid');
            
            if($this->m_student->securityqstn($qstn, $answer, $stdid)){
                redirect('student/profile','refresh');
           }else{
            $this->session->set_flashdata('error', 'Something error occured, please try again!');
            redirect('student/dashboard','refresh');
           }
        }else{
            $this->session->set_flashdata('error', 'Something error occured, please try again!');
            redirect('student/dashboard','refresh');
        }


        
    }

    /**
    * student logout
    * @url      : student/logout
    * @param    : null.
    **/
    public function logout($value='')
    {
        $session_data = array('slmail' => $this->session->userdata('slmail'),'qstn_status'=>$this->session->userdata('stqstn'), 'stlid'  => $this->session->userdata('stlid') );
        $this->session->unset_userdata($session_data);
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'You are Logged Out successfully');
        redirect('student/login');
    }


    /**
    * student forgot password - load view
    * @url      : student/forgot-password
    * @param    : null.
    **/
    public function forgot_pass($value='')
    {
        $this->security->xss_clean($_POST);
        $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
        );
        if ($this->session->userdata('stlid') == '') {
            $data['title'] = 'Forgot password';
            $input = $this->input->post();
            if (count($input) > 0) {
                $insert['email'] = $this->input->post('email');
                $insert['ref_id'] = random_string('alnum', '16');
                
                if($this->m_student->forgotPassword($insert['email'],$insert['ref_id']))
                {
                    if ($this->sendforgot($insert)) {
                        $this->session->set_flashdata('success', 'We have sent A password reset link to your mail id, <br> Please check your mail to reset your password');
                    }else{
                        $this->session->set_flashdata('error', 'Some error occured! Please contact our support team');
                    }
                    redirect('student/forgot-password','refresh');
                }else{
                    $this->session->set_flashdata('error', 'Some error occured! Please contact our support team');
                    redirect('student/forgot-password','refresh');
                }
            }else{
                $data['question'] = $this->m_student->getQuestion();
                $this->load->view('student/student-forgot', $data, FALSE);
            }
        }else{
            redirect('student/profile','refresh');
        }
    }

    /**
    * student forgot password - load view
    * @url      : student/forgot-password
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
        $msg = $this->load->view('email/forgot', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to($data['email']);
        $this->email->subject('Student Reset Password'); 
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
    * student forgot password - verify 
    * @url      : student/forgot-password
    * @param    : null.
    **/
    public function forgot_verify()
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_GET);
        if ($this->session->userdata('stlid') == '') {
            $data['title'] = 'Forgot password';
            $regid = $this->input->get('rid');
            $data['newRegid'] = random_string('alnum', 50);
               if($this->m_student->forgotVerify($regid, $data['newRegid'])){
                $this->load->view('student/reset-password', $data, FALSE);
            }else{
                $this->session->set_flashdata('error', 'Some error occured! Please contact our support team <br> if you are facing any issues on resetting the password');
                redirect('student/forgot-password','refresh');
            }
        }else{
            redirect('student/profile','refresh');
        }

    }


   /**
    * student forgot password - reset password 
    * @url      : student/forgot-password
    * @param    : null.
    **/
    public function reset_password($value='')
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->security->xss_clean($_POST);
        if ($this->session->userdata('stlid') == '') {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('cnpassword', 'Password Confirmation', 'trim|required|matches[password]');
            if ($this->form_validation->run() == true) {
                $ref_id = random_string('alnum', 16);
                $rid = $this->input->post('rid');
                $npass = $this->bcrypt->hash_password($this->input->post('password'));
                $datas = array(
                    'ref_id' => $ref_id,
                    'password' => $npass,
                );

                if ($this->m_student->setPassword($datas, $rid)) {
                    $this->session->set_flashdata('success', 'Your password has been updated successfully, <br> you can login now with the new password!');
                    redirect('student/login');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, Please try again Later! <br> or use another method reset your password');
                    redirect('student/forgot-password');
                }
            }else{
                $error = validation_errors();
                $this->session->set_flashdata('error',  $error );
                redirect('student/forgot-password');
            }
        }else{
            redirect('student/profile','refresh');
        }
    }

    /**
    * student forgot password - get question
    * @url      : student/forgot-password
    * @param    : null.
    **/
    public function forgot_validate(Type $var = null)
    {
        
        $this->security->xss_clean($_POST);
        $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
        );
        if(!empty($this->input->post())){
            $data['qstn']    =  $this->input->post('qstn');
            $data['ans']     =  $this->input->post('ans');
            $data['mobile']  =  $this->input->post('mobile');
            if($this->m_student->verifyQstns($data['qstn'],$data['mobile'],$data['ans']))
            {
                $this->load->view('student/qstn-resetpass', $data, FALSE);
            }else{
                $this->session->set_flashdata('error', 'Something went wrong, Please try again Later! <br> or use another method to get a reset link on your mail');
                redirect('student/forgot-password');
            }
        }else{
           redirect('student/forgot-password');
        }
    }

    public function qst_resetpass($var = null)
    {

        $this->security->xss_clean($_POST);
        $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
        );
        if(!empty($this->input->post())){
            $phone      = $this->input->post('phone');
            $password   = $this->bcrypt->hash_password($this->input->post('password'));
            $qstn       = $this->input->post('qstn');
            $ans        = $this->input->post('ans');
            $output = $this->m_student->qst_resetpass($phone,$password);
            if (!empty($output)) {
                $this->session->set_flashdata('success', 'Your password has been updated successfully, <br> you can login now with the new password!');
                redirect('student/login');
            }else{
                $this->session->set_flashdata('error', 'Something went wrong, Please try again Later! <br> or use another method to get a reset link on your mail');
                redirect('student/forgot-password');
            }
        }else{
           redirect('student/forgot-password');
        }
    }


    public function refresh(){
        $captcha['image'] = $this->sc_check->cap_refresh();
        echo $captcha['image'];
    }




}

/* End of file Controllername.php */
