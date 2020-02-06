<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Std_account extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if ($this->session->userdata('stlid') == '') { $this->session->set_flashdata('error','Please login and try again!'); redirect('student/login','refresh'); } 
        $this->load->model('m_stdaccount');
        $this->sid = $this->session->userdata('stlid');
    }

    /**
    * student Profile setting - load view
    * @url      : student/profile
    * @param    : null
    * @data     : null,
    **/
    public function index($value='')
    {
    	$data['title']  = 'Student Profile';
		$this->load->view('student/profile', $data, FALSE);
	}
	
	public function getProfile($output = null)
	{
		$output = $this->m_stdaccount->getProfile($this->sid);
        if (!empty($output['profile_pic'])) {
            $output['profile'] = base_url().$output['profile_pic'];
        }else{
            $output['profile'] = '';
        }
        echo json_encode($output);

	}

    public function updateprofile($output='')
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $output = $this->m_stdaccount->updateProfile($email,$name,$this->sid);
        echo $output;           
    }




    public function addfile($output='')
    {
    		$files = $_FILES;
	        if (file_exists($_FILES['file']['tmp_name'])) {
	            $config['upload_path'] = 'student-profile/';
	            $config['allowed_types'] = 'jpg|png|jpeg';
	            $config['max_width'] = 0;
	            $config['encrypt_name'] = true;
	            $this->load->library('upload');
	            $this->upload->initialize($config);
	            if (!is_dir($config['upload_path'])) {
	                mkdir($config['upload_path'], 0777, true);
	            }
                    $this->upload->do_upload('file');	            
	                $upload_data = $this->upload->data();
	                $file_name = $upload_data['file_name'];
	                $imgpath = 'student-profile/'.$file_name;

                $output = $this->m_stdaccount->addfile($imgpath,$this->sid);
	        }
            echo $output;
    }

    /**
    * student Change password - load view
    * @url      : student/change-password
    * @param    : null
    * @data     : null,
    **/
	public function changePassword()
	{
		$data['title']  = 'Student Change Password';
		$this->load->view('student/change-password', $data, FALSE);
	}

    /**
    * student Change password - update password
    * @url      : student/update-password
    * @param    : null
    * @data     : new password,current and confirm password.
    **/
	public function update_pass($value='')
	{
		$data['title']  = 'Student Change password - Scholarship';
		$this->form_validation->set_rules('cpswd', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('npswd', 'Password', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('cn_pswd', 'Password Confirmation', 'trim|required|matches[npswd]');
        if ($this->form_validation->run() == true) {
        	$hash  = $this->bcrypt->hash_password($this->input->post('npswd'));
        	$datas = array('password' => $hash );
        	if ($this->m_stdaccount->changePassword($datas)) {
               	$this->session->set_flashdata('success', 'Your password has been updated successfully');
               	redirect('student/change-password', 'refresh');
            } else {
               	$this->session->set_flashdata('error', 'Something went wrong please try again later!');
               	redirect('student/change-password', 'refresh');
            }

        }else{

        	$error = validation_errors();
            $this->session->set_flashdata('error', $error);
            redirect('student/change-password','refresh');

        }
	}

	// psw check function
    public function checkpsw($psw='')
    {
        $output = $this->m_stdaccount->checkpsw($this->input->post('crpass'));
        echo $output;
    }




}

/* End of file S_account.php */
/* Location: ./application/controllers/S_account.php */