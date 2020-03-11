<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Encryption_url {

	// var $skey 	= "SuPerEncKey2010"; // you can change it
	protected $ci;

	public function __construct()
    {                              
        $this->ci =& get_instance();
    }
    public  function safe_b64encode($string) {
	
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        $rand  = random_string('alnum',5);
        $rand1  = random_string('alnum',3);
        $data = $rand.'@'.$data.'-'.$rand1;
        return $data;
    }
	public function safe_b64decode($string) {

		$datas = explode('-', $string);
		$datas = explode('@', $datas[0]);
		$data = $datas[1];
        $data = str_replace(array('-','_'),array('+','/'),$data);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
}

