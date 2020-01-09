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
        if($this->session->userdata('pyId') != ''){ redirect('dashboard','refresh'); }
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
                            'pyMal'   => $email, //email
                            'pyId'    => $result['id'], //director or staff id
                            'pyComp'    => $result['industry_id'], //company id
                            'pyType'    => $result['type'], // account type
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
        $this->session->unset_userdata($this->session->userdata());
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'You are Logged Out successfully');
        redirect('/');
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


    public function search($var = null)
    {
        $term = $this->input->get('q[term]');
        $output = $this->m_auth->search($term);
        $result = [];

        foreach ($output as $key => $value) {
            $json[] = ['id'=>$value['id'], 'text'=>$value['name']];
        }
        echo json_encode($json);
    }

    /**
     * industry registration-> load view and insert data
     * url : register
    **/
    public function registration()
    {
        if($this->session->userdata('pyId') != ''){ redirect('dashboard','refresh'); }
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
            'address'        => $this->input->post('address'),
            'ref_id'         => random_string('alnum',16),
            'industry_id'    => $this->input->post('company'),
            'type'          => 1,
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
           'password'    => $password, 
           'ref_id' => random_string('alnum', 30), 
           'status' => 1, 
        );
        if($this->m_auth->setPassword($data, $key)){
            $this->session->set_flashdata('success', 'Email verification successfully completed.<br> Now you can login.');
            redirect('/','refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Activation link has been expired');
            redirect('register','refresh');
        }
    }

       /**
    * student forgot password - load view
    * @url      : student/forgot-password
    * @param    : null.
    **/
    public function forgot_pass($value='')
    {
        if ($this->session->userdata('pyId') == '') {
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
        if ($this->session->userdata('pyId') == '') {
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
                    'password' => $this->bcrypt->hash_password($npass),
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


    /**
    * company add request - loasd-view
    * @url      : add-request
    * @param    : null.
    **/
    public function requestAdd(Type $var = null)
    {

        if($this->session->userdata('pyId') != ''){ redirect('dashboard','refresh'); }
        if($this->input->post()){
           $this->submitRequest();
        }else{
            $data['title'] = 'Industry Add Request';
            $data['taluk'] = $this->m_auth->getTaluk();
            $data['district'] = $this->m_auth->getDistrict(); 
            $this->load->view('auth/company-request', $data, FALSE);  
        }
    }

    public function submitRequest($var = null)
    {
        $insert = array(
            'email'          => $this->input->post('email'),
            'mobile'         => $this->input->post('phone'),
            'talluk'         => $this->input->post('taluk'),
            'district'       => $this->input->post('district'),
            'address'        => $this->input->post('address'),
            'company'    => $this->input->post('company'),
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
        $output = $this->m_auth->addRequest($insert);

        
        if(!empty($output)){
            $this->sendRequest($insert);
        }else{
            $this->session->set_flashdata('error', 'Server error  occurred😢.<br>  Please try agin later.');
        }

        redirect('company-request');

    }

    public function sendRequest($insert = null)
    {
        $data['result'] = $insert;
        $this->load->config('email');
        $this->load->library('email');
        $from = $this->config->item('smtp_user');
        $msg = $this->load->view('mail/request', $data, true);
        $this->email->set_newline("\r\n");
        $this->email->from($from , 'Karnataka Labour Welfare Board');
        $this->email->to('prathwi@5ine.in');
        $this->email->subject('Industry Add Requset'); 
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

    // application generate
    public function applicationGenerate($id = null)
    {
        $ids =  urldecode($id);
        $apid = base64_decode($ids);
        $this->load->model('m_application');
        $data['info'] = $this->m_application->singleStudent($apid);
        $data['img'] =$this->m_application->compDocs($data['info']->company_id);
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'tunga'
        ]);
        $html = $this->load->view('account/pdf', $data, TRUE);
        
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;    
    }



}

/* End of file auth.php */
// matrixchange



