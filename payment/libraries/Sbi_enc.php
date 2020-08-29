<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sbi_enc {

	// var $skey 	= "SuPerEncKey2010"; // you can change it
	protected $ci;

	public function __construct()
    {                              
        $this->ci =& get_instance();
    }

    public  function sbiEnc($data='') {
    	require_once APPPATH .'AES128_php.php'; 
    	$AESobj=new AESEncDec();
    	$key='fBc5628ybRQf88f/aqDUOQ==';
    	$cipherText = $AESobj->encrypt($data,$key);
    	return $cipherText; 
    }

    public  function sbiDec($data='') {
    	require_once APPPATH .'AES128_php.php'; 
    	$AESobj=new AESEncDec();
    	$key='fBc5628ybRQf88f/aqDUOQ==';
    	$plaintext = $AESobj->decrypt($cipherText,$key);
    	return $plaintext; 
    }

}