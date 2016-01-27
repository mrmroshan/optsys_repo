<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prescriptions extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();	
		$this->load->model('prescriptions_model');
		$this->load->model('suppliers_model');
		$this->load->model('prescriptions_model');
		$this->load->model('category_model');
		$this->load->model('patients_model');
		$this->load->model('frames_model');
		$this->load->model('lenses_model');
	}//end of function

	/**
	 * index()	 
	 * This function will handle default calls
	 */
	public function index()
	{
		$this->output->enable_profiler(false);
		$this->load->view('prescriptions_home');
	}
	

	
	public function add(){
	
		$form_data = array();
		$form_data['gen_message'] = null;		
		$post = $this->input->post(null);
		$form_data['fields'] = $post;
		
		//patients
		$record_set = $this->patients_model->select_records('p_id,title,full_name',1000,null,null);
		$form_data['patlist'] = $record_set['result_set'];
						
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
					
				if(!$this->prescriptions_model->is_exist($save_data)){
						
					$result = $this->prescriptions_model->save($post);
						
					if($result>0){
						$form_data['gen_message'] = array(
								'type' => 'success',
								'text' => 'Data saved!');
						$this->redirect_home(site_url('lenses/index'));
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
	
		$this->load->view('add_prescription',$form_data);
	
	
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
				
	
				$result = $this->prescriptions_model->update_record($save_data,array('pre_id'=>$id));
	
				if($result>0){
					$form_data['gen_message'] = array(
							'type' => 'success',
							'text' => 'Data updated!');
	
					$this->redirect_home(site_url('lenses/index'));
	
				}else{
					$form_data['gen_message'] = array(
							'type' => 'error',
							'text' => 'Data not updated!');
				}//end if
					
			}//end if check
				
		}//end if submit check
	
		//get record data
		$record_set = $this->prescriptions_model->select_records('*',null,null,array('pre_id'=>$id));
		$form_data['fields'] = $record_set['result_set'][0];
		$this->load->view('edit_lens',$form_data);
			
	}//end of function
	
	
	
	
	
	
	private function validate_form($edit = false){	
		
		//do validation here
		$this->form_validation->set_rules('sup_id', 'Supplier', 'required');
		$this->form_validation->set_rules('cat_id', 'Category', 'required');
		$this->form_validation->set_rules('lens_power', 'Lense Power', 'required');
		$this->form_validation->set_rules('lens_color', 'Lens Color', 'required');
		$this->form_validation->set_rules('qty', 'Qty', 'required|integer');		
		$this->form_validation->set_rules('price', 'Lens Price', 'required|decimal');
		$this->form_validation->set_rules('cost', 'Lens Cost', 'required|decimal');		
		$this->form_validation->set_rules('re_order_qty', 'Re order qty', 'required|integer');		
		
		if($edit == false){
				
		}else{
				
		}
		return $this->form_validation->run();
	
	}//end of function
	
	
	
	public function select_products($product_type){

		$form_data['product_type'] = $product_type;
		if($product_type == 'frame'){
			$this->load->view('prescribe_frames',$form_data);
		}else if($product_type == 'r_lens'){						
			$this->load->view('prescribe_lens_right',$form_data);
		}else if($product_type == 'l_lens'){						
			$this->load->view('prescribe_lens_left',$form_data);
		}
		
	}
	
	
	public function get_frame_by_id($frame_id){
		
		$record_set = $this->frames_model->select_records('*',null,null,array('frame_id'=>$frame_id));
		$result = $record_set['result_set'][0];
		$frm_str = $result['frame_id'].'::'.
				$result['frame_size'].'::'.
				$result['frame_material'].'::'.
				$result['frame_type'].'::'.
				$result['frame_brand'].'::'.
				$result['price'];
		echo $frm_str;
	}
	
	
	public function get_lens_by_id($lens_id){
		
		$record_set = $this->lenses_model->select_records('*',null,null,array('lens_id'=>$lens_id));
		$result = $record_set['result_set'][0];
		
		$cat_record_set = $this->category_model->select_records('*',1,0,array('cat_id' => $result['cat_id']));
		$cat = (empty($cat_record_set['result_set']))?'-':$cat_record_set['result_set'][0]['category'];
		
		
		$str = $result['lens_id'].'::'.
				$result['lens_power'].'::'.
				$cat.'::'.
				$result['lens_color'].'::'.				
				$result['price'];
		echo $str;
	}
	
	/**
	 * This function is to produce dhtmlx grid
	 * @param string $feed_type
	 */
	public function produce_grid_feed($limit=25,$offset=0){
	
	
		$record_set = $this->prescriptions_model->select_records('*',$limit,$offset);
	
		// init xml writer
		$xml = new Xml_writer();
	
		$xml->setRootName('rows');
		$xml->initiate();
	
		foreach($record_set['result_set'] as $record ){

			//Pres id   ,Visited Date ,Patione Name ,Due re visit date,Order Status, Bill Total, Paid Amount, Attended By
			
			$xml->startBranch('row',array('id' =>$record['pre_id']));
			$action = '<a href="'.site_url('lenses/edit/'.$record['pre_id'].'').'" onclick="">Edit</a>  |
					   <a href="javascript:void(0);" onclick="delete_record('.$record['pre_id'].')">Delete</a> ';
			$xml->addNode('cell',$action,null, true);
			$xml->addNode('cell',$record['pre_id'],null, true);			
 			$xml->addNode('cell',$record['visited_date'],null, true);
 			$xml->addNode('cell',$record['p_id'],null, true); 			
 			$xml->addNode('cell',$record['revisit_due_date'],null, true); 			 			
 			$xml->addNode('cell',$record['order_status'],null, true);
 			$xml->addNode('cell',$record['priscript_total'],null, true);
 			$xml->addNode('cell',$record['amount_paid'],null, true);
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
	
		$record_set = $this->prescriptions_model->select_records('*',null,null,array('pre_id'=>$id));
		$form_data['form_data_val'] = $record_set['result_set'][0];
	
		$data = array('pre_id' => $id);
		$status = $this->prescriptions_model->delete($data);
		echo $status;	
	
	}//end of delete
	
	
	
	
	public function createDropdown(){
			
		$myParams = count($_POST)>0? $_POST:$_GET;
	
		$selectByValue = isset($myParams['sbv'])? $myParams['sbv']:null ;
		$selectByValue = (!empty($selectByValue))?$selectByValue:null; // set default values if not supplied.
	
		$optionsOnly = isset($myParams['optionsonly'])? $myParams['optionsonly']:false;
		$optionsOnly = ($optionsOnly == 'true')? true:false;
	
		$dataset = $this->prescriptions_model->select_records();
			
		$wrapped_data['data'] = $dataset['result_set'];
		$wrapped_data['selectByValue'] = $selectByValue;
		$wrapped_data['optionsOnly'] = $optionsOnly;
	
		$this->load->view('departments/departments_dropdown',$wrapped_data);
			
	
	
	}
	
	
	
	
}//end of class