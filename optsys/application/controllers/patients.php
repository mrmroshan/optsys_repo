<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patients extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();	
		$this->load->model('patients_model');
	}//end of function

	/**
	 * index()	 
	 * This function will handle default calls
	 */
	public function index()
	{
		$this->output->enable_profiler(false);
		$this->load->view('patients_home');
	}
	

	
	public function add(){
	
		$form_data = array();
		$form_data['gen_message'] = null;		
		$post = $this->input->post(null);
		$form_data['fields'] = $post;
	
				
		if(isset($post['btnSave'])){
				
			$validation = $this->validate_form();
			
			if($validation){
				//remove submit button from the array
				foreach($post as $k => $v){
					if($k == 'btnSave')unset($post[$k]);
				}
				
				$save_data =$post;
				$post['added_date'] = date('Y-m-d');
				$post['added_by'] = '1';
					
				if(!$this->patients_model->is_exist($save_data)){
						
					$result = $this->patients_model->save($post);
						
					if($result>0){
						$form_data['gen_message'] = array(
								'type' => 'success',
								'text' => 'Data saved!');
						$this->redirect_home(site_url('patients/index'));
					}else{
	
						$form_data['gen_message'] = array(
								'type' => 'error',
								'text' => 'Data not saved!');
					}
				}else{
					$form_data['gen_message'] = array(
							'type' => 'error',
							'text' => 'Given data already existing!');
					$form_data['form_data_val'] = $post;
						
				}//end if datacheck
					
			}else{
				$form_data['gen_message'] = array(
						'type' => 'warning',
						'text' => 'Please correct following errors.'
				);
				$form_data['fields'] = $post;
			}//end of validation check
	
		}//end if submit check
	
		$this->load->view('add_patient',$form_data);
	
	
	}//end of function
	
	
	
	
	
	public function edit($id){
	
		$this->output->enable_profiler(false);
	
		$form_data = array();
	
		$form_data['gen_message'] = null;
		$form_data['form_data_val'] = null;		
		$post = $this->input->post(null);
		$form_data['fields'] = $post;
		
		//suplist
		$record_set = $this->suppliers_model->select_records('*',200,null,null);
		$form_data['suplist'] = $record_set['result_set'];
		
		//cat
		$cat_record_set = $this->category_model->select_records('*',1000,null,null);
		$form_data['catlist'] = $cat_record_set['result_set'];
		
		
		if(isset($post['btnSave'])){
	
			$form_data['fields'] = $post;
			$validation = $this->validate_form(true);
				
			if($validation){
					
				//remove submit button from the array
				foreach($post as $k => $v){
					if($k == 'btnSave')unset($post[$k]);
				}
	
				//if form data is valid
				$save_data['updated_date'] = date('Y-m-d');
				$save_data['updated_by'] = '1';
				$save_data =$post;
				
	
				$result = $this->patients_model->update_record($save_data,array('p_id'=>$id));
	
				if($result>0){
					$form_data['gen_message'] = array(
							'type' => 'success',
							'text' => 'Data updated!');
	
					$this->redirect_home(site_url('patients/index'));
	
				}else{
					$form_data['gen_message'] = array(
							'type' => 'error',
							'text' => 'Data not updated!');
				}//end if
					
			}//end if check
				
		}//end if submit check
	
		//get record data
		$record_set = $this->patients_model->select_records('*',null,null,array('p_id'=>$id));
		$form_data['fields'] = $record_set['result_set'][0];
		$this->load->view('edit_lens',$form_data);
			
	}//end of function
	
	
	
	
	
	
	private function validate_form($edit = false){	
		
		//do validation here
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('nic_no', 'NIC No', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('home_tp_no', 'Land Line', 'required');		
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'required');
		$this->form_validation->set_rules('dob', 'Date of birth', 'date');		
				
		
		if($edit == false){
				
		}else{
				
		}
		return $this->form_validation->run();
	
	}//end of function
		
	
	
	/**
	 * This function is to produce dhtmlx grid
	 * @param string $feed_type
	 */
	public function produce_grid_feed($limit=25,$offset=0){
	
	
		$record_set = $this->patients_model->select_records('*',$limit,$offset);
	
		// init xml writer
		$xml = new Xml_writer();
	
		$xml->setRootName('rows');
		$xml->initiate();
	
		foreach($record_set['result_set'] as $record ){

			//"Lens Id,Categor,Color,Power,Price,Qty,Supplier,Details,Bill No,Added Date,Added by"
			$xml->startBranch('row',array('id' =>$record['p_id']));
			$action = '<a href="'.site_url('patients/edit/'.$record['p_id'].'').'" onclick="">Edit</a>  |
					   <a href="javascript:void(0);" onclick="delete_record('.$record['p_id'].')">Delete</a> ';
			$xml->addNode('cell',$action,null, true);
			$xml->addNode('cell',$record['p_id'],null, true);			
 			$xml->addNode('cell',$record['title'].$record['full_name'],null, true);
 			$xml->addNode('cell',$record['nic_no'],null, true); 			
 			$xml->addNode('cell',$record['email'],null, true); 			
 			$xml->addNode('cell',$record['address'],null, true);
 			$xml->addNode('cell',$record['home_tp_no'],null, true);
 			$xml->addNode('cell',$record['mobile_no'],null, true);
 			$xml->addNode('cell',$record['profession'],null, true);
 			$xml->addNode('cell',$record['dob'],null, true);
 			$xml->addNode('cell',$record['health_issues'],null, true);
 			$xml->addNode('cell',$record['added_date'],null, true);
 			$xml->addNode('cell',$record['added_by'],null, true);
			$xml->endBranch();	
		}
	
		$data = array();
		$xml->getXml(true);
	
	
	}//end of index()
	
	private function redirect_home($url){
	
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header('refresh:3; url='.$url);
	
	}//end of function
	
	
	
	/**
	 * common delete() is used to delete a record. Takes record id as parameter.
	 */
	public function delete($id=null){
	
		$record_set = $this->patients_model->select_records('*',null,null,array('p_id'=>$id));
		$form_data['form_data_val'] = $record_set['result_set'][0];
	
		$data = array('p_id' => $id);
		$status = $this->patients_model->delete($data);
		echo $status;	
	
	}//end of delete
	
	
	
	
	public function createDropdown(){
			
		$myParams = count($_POST)>0? $_POST:$_GET;
	
		$selectByValue = isset($myParams['sbv'])? $myParams['sbv']:null ;
		$selectByValue = (!empty($selectByValue))?$selectByValue:null; // set default values if not supplied.
	
		$optionsOnly = isset($myParams['optionsonly'])? $myParams['optionsonly']:false;
		$optionsOnly = ($optionsOnly == 'true')? true:false;
	
		$dataset = $this->patients_model->select_records();
			
		$wrapped_data['data'] = $dataset['result_set'];
		$wrapped_data['selectByValue'] = $selectByValue;
		$wrapped_data['optionsOnly'] = $optionsOnly;
	
		$this->load->view('departments/departments_dropdown',$wrapped_data);
			
	
	
	}
	
	
	
	
}//end of class