<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frames extends CI_Controller {

	/**
	 * index()	 
	 * This function will handle default calls
	 */
	public function index()
	{
		$this->load->view('frameshome');
	}
	
	public function add()
	{
		$this->load->view('addframe');
	}
	
}//end of class