<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sc_check {

	protected $ci;

	public function __construct()
    {
        $this->ci =& get_instance();
    }

	public function loginSuccess($value='')
	{
		$ip = $this->ci->input->ip_address();
		$sess = $this->ci->session->userdata();
		$msg = '---------------------Success -- Finance officer Logged in with '.$sess['sfn_mail'].' and IP aaddress '.$ip.' --------------';
		log_message('info', ''.$msg.'');
	}

	public function loginError($mail='')
	{
		$ip = $this->ci->input->ip_address();
		$msg = '---------------------Failed -- Finance officer Log in Failed and tried login with '.$mail.' password and IP aaddress '.$ip.' --------------';
		log_message('error', ''.$msg.'');
	}

	 public function img_catcha($value='')
    {
        // Captcha configuration
       $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => $this->ci->config->item('web_url').'system/fonts/texb.ttf',
            'img_width'     => '350',
            'img_height'    => 80,
            'word_length'   => 6,
            'font_size'     => 28,
            'colors'        => array(
                'background' => array(100, 100, 100),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and set new captcha word
        $this->ci->session->unset_userdata('captchaCode');
        $this->ci->session->set_userdata('captchaCode', $captcha['word']);
        
        // Pass captcha image to view
         $data['captchaImg'] = $captcha['image'];

         return $data['captchaImg'];
    }

    public function cap_refresh($value='')
    {
          // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => base_url().'system/fonts/texb.ttf',
            'img_width'     => '350',
            'img_height'    => 70,
            'word_length'   => 6,
            'font_size'     => 28,
            'colors'        => array(
                'background' => array(100, 100, 100),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and set new captcha word
        $this->ci->session->unset_userdata('captchaCode');
        $this->ci->session->set_userdata('captchaCode', $captcha['word']);
        
        // Display captcha image
        return $captcha['image'];
    }


    function limitRequests($ip='', $max_requests = 2, $sec = 5)
    {
        $ips = $this->ci->input->ip_address();
        $current_time = date("Y-m-d H:i:s");
        $this->ci->load->model('m_auth');
        $exist = $this->ci->m_auth->throttle_get($ips,$current_time);
        if(!empty($exist)){
            if($exist > 10){
                header("HTTP/1.0 429 Too Many Requests");
                exit();
            }else{
                $exist = (int)$exist;
                $up = $exist + 1;
                $this->ci->m_auth->throttle_update($ips,$up);
            }
        }else{
            $insert = array('ip' => $ips,'type'=>1,'created_at'=>date('Y-m-d'));
            $this->ci->m_auth->throttle_insert($insert);
        }
    }


}