<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patients extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();

		//login check
		$status = false;
		$status = $this->acl->login_check();
		if($status == false)redirect(site_url('home/login'));	
		
		$this->load->model('patients_model');
		$this->load->model('prescriptions_model');
		$this->load->model('pres_order_details_model');
		$this->load->model('frames_model');
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
		$this->load->view('patients_home');
	}
	

	
	public function add($from=null){
	
		$form_data = array();
		$form_data['gen_message'] = null;		
		$post = $this->input->post(null);
		$form_data['fields'] = $post;
		$form_data['from']=$from;
	
				
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
						
						if($from=='pres_form'){
							$this->redirect_home(site_url('prescriptions/add'));
						}else{
							$this->redirect_home(site_url('patients/index'));
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
	
		$this->load->view('add_patient',$form_data);
	
	
	}//end of function
	
	
	
	
	
	public function view($id){
	
		$this->output->enable_profiler(false);
	
		$form_data = array();
	
		$form_data['gen_message'] = null;
		$form_data['form_data_val'] = null;		
		$post = $this->input->post(null);
		$form_data['fields'] = $post;	
		$result_set = $this->prescriptions_model-> select_records('*',1000, 0, array('p_id'=>$id));
		$preses = $result_set['result_set'];
		$i=0;
		
		foreach($preses as $presc){
			$prsc_id = $presc['pre_id'];
			$order_result_set = $this->pres_order_details_model-> select_records('*',1000, 0, array('pre_id'=>$prsc_id));
			$orders_list = $order_result_set['result_set'];
			foreach($orders_list as $order){
				
					/* 'o_d_id' => string '121' (length=3)
					 'pre_id' => string '84' (length=2)
					 'item_id' => string '10' (length=2)
					 'qty' => string '1' (length=1)
					 'sub_total' => null
					 'added_by' => string '1' (length=1)
					 'updated_by' => string '1' (length=1)
					 'added_date' => string '2016-02-20' (length=10)
					 'updated_date' => string '2016-02-20' (length=10)
					 'prod_type' => string 'frame' (length=5)
					 'from' => string 'stock' (length=5)
					 'item_price' => string '40.44' (length=5)
					 'sup_id' => null*/
				$item_id = $order['item_id'];
				$item_price=$order['item_price'];
				$item_type=$order['prod_type'];
				$from=$order['from'];
				if($item_type=='frame'){
					$frame_str = $this->get_frame_by_id($item_id,false);
					$preses[$i]['orders'][] = $frame_str;
				}else if($item_type=='left_lens'){
					$left_lens_str = $this->get_lens_by_id($item_id,false);
					$preses[$i]['orders'][] = $left_lens_str;
				}else if($item_type=='right_lens'){
					$right_lens_str = $this->get_lens_by_id($item_id,false);
					$preses[$i]['orders'][] = $right_lens_str;
				}//endif												
					
			}//end foreach						 
		}//end foreach pres	
		
		
		
		$form_data['preses'] = $preses;
	
		//get record data
		$record_set = $this->patients_model->select_records('*',null,null,array('p_id'=>$id));
		$form_data['fields'] = $record_set['result_set'][0];
		$this->load->view('view_patient',$form_data);
			
	}//end of function
	

	public function get_frame_by_id($frame_id,$output=true){
	
		$record_set = $this->frames_model->select_records('*',null,null,array('frame_id'=>$frame_id));
		$result = $record_set['result_set'][0];
		$frm_str = $result['frame_id'].'::'.
				$result['frame_size'].'::'.
				$result['frame_material'].'::'.
				$result['frame_type'].'::'.
				$result['frame_brand'].'::'.
				$result['price'];
		if($output){
			echo $frm_str;
		}else{
			return $frm_str;
		}
	}
	
	
	public function get_lens_by_id($lens_id,$output=true){
	
		$record_set = $this->lenses_model->select_records('*',null,null,array('lens_id'=>$lens_id));
		$result = $record_set['result_set'][0];
	
		$cat_record_set = $this->category_model->select_records('*',1,0,array('cat_id' => $result['cat_id']));
		$cat = (empty($cat_record_set['result_set']))?'-':$cat_record_set['result_set'][0]['category'];
	
	
		$str = $result['lens_id'].'::'.
				$result['lens_power'].'::'.
				$cat.'::'.
				$result['lens_color'].'::'.
				$result['price'];
		if($output){
			echo $str;
		}else{
			return $str;
		}
	}
	
	
	
	public function edit($id){
	
		$this->output->enable_profiler(false);
	
		$form_data = array();
	
		$form_data['gen_message'] = null;
		$form_data['form_data_val'] = null;
		$post = $this->input->post(null);
		$form_data['fields'] = $post;
	
	
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
		$this->load->view('edit_patient',$form_data);
			
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
			$action = ' <a href="'.site_url('patients/View/'.$record['p_id'].'').'" onclick="">View</a>  |
						<a href="'.site_url('patients/edit/'.$record['p_id'].'').'" onclick="">Edit</a>  |
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