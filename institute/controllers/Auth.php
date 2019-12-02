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
            $this->load->view('auth/reg-thank', $data);
        }else{
            $this->session->set_flashdata('error', 'Server error  occurred😢.<br>  Please try agin later.');
            redirect('register');
        }
    }
    
}

/* End of file auth.php */
