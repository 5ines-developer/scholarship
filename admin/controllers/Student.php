<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_student');
        if ($this->session->userdata('said') == '') { 
        $this->session->set_flashdata('error','Please login and try again!'); 
        redirect('login','refresh'); }
        header_remove("X-Powered-By"); 
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("Strict-Transport-Security: max-age=31536000");
        header("Content-Security-Policy: frame-ancestors none");
        // header("Content-Security-Policy: default-src 'none'; script-src 'self' https://www.google.com/recaptcha/api.js https://www.gstatic.com/recaptcha/releases/v1QHzzN92WdopzN_oD7bUO2P/recaptcha__en.js https://www.google.com/recaptcha/api2/anchor?ar=1&k=6Le6xNYUAAAAADAt0rhHLL9xenJyAFeYn5dFb2Xe&co=aHR0cHM6Ly9oaXJld2l0LmNvbTo0NDM.&hl=en&v=v1QHzzN92WdopzN_oD7bUO2P&size=normal&cb=k5uv282rs3x8; connect-src 'self'; img-src 'self'; style-src 'self';");
        // header("Referrer-Policy: origin-when-cross-origin");
        header("Referrer-Policy: no-referrer-when-downgrade");
        header("Expect-CT: max-age=7776000, enforce");
        header('Public-Key-Pins: pin-sha256="d6qzRu9zOECb90Uez27xWltNsj0e1Md7GkYYkVoZWmM="; pin-sha256="E9CZ9INDbd+2eRQozYqqbQ2yXLVKB9+xcprMF+44U1g="; max-age=604800; includeSubDomains; report-uri="https://example.net/pkp-report"');
        header("Set-Cookie: key=value; path=/; domain=www.hirewit.com; HttpOnly; Secure; SameSite=Strict");
    }


	public function index($id='')
	{
        $this->security->xss_clean($_GET);
		$data['title']      = 'Student Management';
		$year = $this->input->get('year');
		if(!empty($id)){
			$data['result']= $this->m_student->getStudent($year,$id);
			$data['apply']= $this->m_student->getscholar($id);
			$this->load->view('student/detail.php', $data, FALSE);
		}else{
			$data['result']= $this->m_student->getStudent($year);
            $data['count'] = $this->m_student->stdcount();
			$this->load->view('student/list.php', $data, FALSE);
		}
	}

	public function block($value='')
    {

            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        $id = $this->input->post('id');
        $status = '2';
        if($this->m_student->stasChange($id,$status)){
             $data = array('status' => 1, 'msg' => '🙂 Student Blocked Successfully ');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }

    public function unblock($value='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        $id = $this->input->post('id');
        $status = '1';
        if($this->m_student->stasChange($id,$status)){
             $data = array('status' => 1, 'msg' => '🙂 Student Unblocked  Successfully ');
        }else{
            $this->output->set_status_header('400');
            $data = array('status' => 0, 'msg' => '😕 Server error occurred. Please try again later ');
        }
        echo json_encode($data);
    }

    public function add($value='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        $data['title'] = 'Add Student';
        if(!empty($this->input->post())){
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            $password =$this->input->post('password');
            $hash = $this->bcrypt->hash_password($password);
            $insert = array(
                'email' => $email, 
                'phone' => $phone, 
                'password' => $hash, 
                'status' => 1, 
                'name' => $name,
            );
            if($this->m_student->add($insert)){
                $this->session->set_flashdata('success', 'Student added Successfully');
                redirect('student','refresh');
            }
            else{
                $this->session->set_flashdata('error', 'Some error occured. <br>Please try agin later');
                redirect('student-add','refresh');
            }

        }else{
            $this->load->view('student/add', $data, FALSE);
        }
    }


    /**
     * user registration-> mobile number check exist
     * url : register
    **/
    public function mobile_check($value='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);

        $this->security->xss_clean($_POST);
        $mobile = $this->input->post('phone');
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

        $this->security->xss_clean($_POST);
        $email = $this->input->post('email');
        $output = $this->m_student->email_check($email);
        echo  $output;
    }

    public function edit($id='',$year='')
    {
            $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    $this->security->xss_clean($_POST);
    
        $data['title'] = 'Add Student';
        if(!empty($this->input->post())){
            $id     = $this->input->post('id');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            $password =$this->input->post('password');
            $hash = $this->bcrypt->hash_password($password);
            $insert = array(
                'email' => $email, 
                'phone' => $phone, 
                'password' => $hash, 
                'status' => 1,
                'name' => $name, 
            );
            if($this->m_student->update($insert,$id)){
                $this->session->set_flashdata('success', 'Student updated Successfully');
                redirect('student-edit/'.$id,'refresh');
            }
            else{
                $this->session->set_flashdata('error', 'Some error occured. <br>Please try agin later');
                redirect('student-edit/'.$id,'refresh');
            }
        }else{
            $data['result']= $this->m_student->edit($id);
            $this->load->view('student/edit.php', $data, FALSE);
        }
    }

    public function delete($id='')
    {
        if($this->m_student->delete($id)){
            $this->session->set_flashdata('success', 'Student Deleted Successfully <br> here we are blocking the student instead of deleting.<br>For fetch the all old data of perticular student');
        }
        else{
            $this->session->set_flashdata('error', 'Some error occured. <br>Please try agin later');
        }
        redirect('student','refresh');
    }

}

/* End of file Student.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/controllers/Student.php */