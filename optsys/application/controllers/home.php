<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * index()	 
	 * This function will handle default calls
	 */
	public function index()
	{
		$this->load->view('home');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */