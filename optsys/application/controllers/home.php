<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct(){

		parent::__construct();
		$this->load->model('patients_model');
		$this->load->model('prescriptions_model');
		$this->load->model('pres_order_details_model');
		$this->load->model('frames_model');
		$this->load->model('lenses_model');
		$this->load->model('category_model');
		$this->load->model('suppliers_model');
	}
	
		
	public function login(){
		$status = false;
		$status = $this->acl->log_in();
		if($status) redirect(site_url('home/index'));
	}
	
	public function logout(){
		$this->acl->log_out();
		redirect(site_url('home/login'));
	}
	
	/**
	 * index()	 
	 * This function will handle default calls
	 */
	public function index()
	{
		$status = false;
		$status = $this->acl->login_check();	
		if($status == false)redirect(site_url('home/login'));
		
		$prescriptions = $this->prescriptions_model->select_records('pre_id',9000, 0 );
		$patients = $this->patients_model->select_records('p_id',9000, 0 );
		$frames = $this->frames_model->select_records('qty',9000, 0 );
		$frame_tot = 0;
		foreach($frames['result_set'] as $frame){
			$frame_tot += $frame['qty'];
		}
		$lenses = $this->lenses_model->select_records('qty',9000, 0 );		
		$lens_tot = 0;
		foreach($lenses['result_set'] as $lens){
			$lens_tot += $lens['qty'];
		}
		
		$categories = $this->category_model->select_records('cat_id',9000, 0 );
		$suppliers = $this->suppliers_model->select_records('sup_id',9000, 0 );
		
		$form_data['no_of_presc'] = $prescriptions['total_records'];
		$form_data['no_of_patients'] = $patients['total_records'];
		$form_data['no_of_frames'] = $frame_tot;
		$form_data['no_of_lenses'] = $lens_tot;
		$form_data['no_of_categories'] =$categories['total_records'];
		$form_data['no_of_suppliers'] = $suppliers['total_records'];
		
		$this->load->view('home',$form_data);		
	}//end of function
		
}//end of class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */