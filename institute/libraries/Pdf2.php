<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
    
    function load($param = NULL) {
        require_once APPPATH .'third_party/mpdf/mpdf.php';

        if ($param == NULL) {
            $param = '"en-GB-x","A5","","",10,10,10,10,6,3';
        }
        return new mPDF($param);
    }
    

}

/* End of file LibraryName.php */
