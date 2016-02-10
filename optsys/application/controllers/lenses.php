<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lenses extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();	
		$this->load->model('lenses_model');
		$this->load->model('suppliers_model');
		$this->load->model('lenses_model');
		$this->load->model('category_model');
	}//end of function

	/**
	 * index()	 
	 * This function will handle default calls
	 */
	public function index()
	{
		$this->output->enable_profiler(false);
		$this->load->view('lenses_home');
	}
	

	
	public function add($from=null){
	
		$form_data = array();
		$form_data['gen_message'] = null;		
		$post = $this->input->post(null);
		$form_data['fields'] = $post;
		$form_data['from']=$from;
		
		//suplist
		$record_set = $this->suppliers_model->select_records('*',1000,null,null);
		$form_data['suplist'] = $record_set['result_set'];
		
		//cat
		$cat_record_set = $this->category_model->select_records('*',1000,null,null);
		$form_data['catlist'] = $cat_record_set['result_set'];
				
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
					
				if(!$this->lenses_model->is_exist($save_data)){
						
					$result = $this->lenses_model->save($post);
						
					if($result>0){
						$form_data['gen_message'] = array(
								'type' => 'success',
								'text' => 'Data saved!');
						
						if($from=='pres_form'){
							$this->redirect_home(site_url('prescriptions/add'));
							
						}else{
							$this->redirect_home(site_url('lenses/index'));
						}	
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
	
		$this->load->view('add_lense',$form_data);
	
	
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
				
	
				$result = $this->lenses_model->update_record($save_data,array('lens_id'=>$id));
	
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
		$record_set = $this->lenses_model->select_records('*',null,null,array('lens_id'=>$id));
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
	
	
	
	/*
	
	public function index($fields_list = "*", $limit = 25 , $offset = 0){
	
	$this->output->enable_profiler(false);
	$form_data = array(); 
	$record_set = $this->Category_Model->select_records('*',$limit,$offset);
	$form_data['record_set'] = $record_set;
	$form_data['limit'] = $limit;
	$form_data['offset'] = $offset;
	$this->load->view('AdminLTE-master/categories/index',$form_data);
	
	}//end of function
	
	*/
	
	
	
	/**
	 * This function is to produce dhtmlx grid
	 * @param string $feed_type
	 */
	public function produce_grid_feed($limit=25,$offset=0,$reason=null){
	
	
		$record_set = $this->lenses_model->select_records('*',$limit,$offset);
	
		// init xml writer
		$xml = new Xml_writer();
	
		$xml->setRootName('rows');
		$xml->initiate();
	
		foreach($record_set['result_set'] as $record ){

			//"Lens Id,Categor,Color,Power,Price,Qty,Supplier,Details,Bill No,Added Date,Added by"
			$xml->startBranch('row',array('id' =>$record['lens_id']));
			if(empty($reason)){
				$action = '<a href="'.site_url('lenses/edit/'.$record['lens_id'].'').'" onclick="">Edit</a>  |
					   <a href="javascript:void(0);" onclick="delete_record('.$record['lens_id'].')">Delete</a> ';
			}else if($reason =='for-prescribe'){
				if($record['qty'] >= 1){
					$action = '<a href="javascript:void(0);" onclick="add_to_cart('.$record['lens_id'].')">Add</a>';
				}else{
					$action = 'Not Available';
				}				
			}
			
			$xml->addNode('cell',$action,null, true);
			$xml->addNode('cell',$record['lens_id'],null, true);
			$cat_record_set = $this->category_model->select_records('*',1,0,array('cat_id' => $record['cat_id']));
			$cat = (empty($cat_record_set['result_set']))?'-':$cat_record_set['result_set'][0]['category'];
			$xml->addNode('cell',$cat,null, true);
 			$xml->addNode('cell',$record['lens_color'],null, true);
 			$xml->addNode('cell',$record['lens_power'],null, true);
 			$price = 'Rs.'.number_format($record['price'], 2, '.', ',');
 			$xml->addNode('cell',$price,null, true);
 			$xml->addNode('cell',$record['qty'],null, true); 			
 			$sup_record_set = $this->suppliers_model->select_records('*',1,0,array('sup_id' => $record['sup_id']));
 			$sup_name = (empty($sup_record_set['result_set']))?'-':$sup_record_set['result_set'][0]['company_name'];
 			$xml->addNode('cell',$sup_name ,null, true); 			
 			$xml->addNode('cell',$record['details'],null, true);
 			$xml->addNode('cell',$record['bill_no'],null, true);
 			$xml->addNode('cell',$record['added_date'],null, true); 			

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
	
		$record_set = $this->lenses_model->select_records('*',null,null,array('lens_id'=>$id));
		$form_data['form_data_val'] = $record_set['result_set'][0];
	
		$data = array('lens_id' => $id);
		$status = $this->lenses_model->delete($data);
		echo $status;	
	
	}//end of delete
	
	
	
	
	public function createDropdown(){
			
		$myParams = count($_POST)>0? $_POST:$_GET;
	
		$selectByValue = isset($myParams['sbv'])? $myParams['sbv']:null ;
		$selectByValue = (!empty($selectByValue))?$selectByValue:null; // set default values if not supplied.
	
		$optionsOnly = isset($myParams['optionsonly'])? $myParams['optionsonly']:false;
		$optionsOnly = ($optionsOnly == 'true')? true:false;
	
		$dataset = $this->lenses_model->select_records();
			
		$wrapped_data['data'] = $dataset['result_set'];
		$wrapped_data['selectByValue'] = $selectByValue;
		$wrapped_data['optionsOnly'] = $optionsOnly;
	
		$this->load->view('departments/departments_dropdown',$wrapped_data);
			
	
	
	}
	
	
	
	
}//end of class