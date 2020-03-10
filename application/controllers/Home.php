<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		header("Access-Control-Allow-Origin: *");
		$data['title'] = 'Scholarship | Karnataka Labour Welfare Board';
		$this->load->view('site/index', $data, FALSE);
		
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */