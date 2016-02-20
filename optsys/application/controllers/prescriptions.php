<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prescriptions extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();	
		$this->load->model('prescriptions_model');
		$this->load->model('suppliers_model');
		$this->load->model('pres_order_details_model');
		$this->load->model('category_model');
		$this->load->model('patients_model');
		$this->load->model('frames_model');
		$this->load->model('lenses_model');
		$this->load->model('po_model');
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
				
			//var_dump($post);exit;
						
			$validation = $this->validate_form();
			
			if($validation){
				
				//1 add to prescription table
				$save_data = array(
						'p_id' => $post['p_id'],
						'visited_date'=>$post['visited_date'],
						'order_status'=>'new',
						'priscript_total'=>$post['total'],
						'amount_paid'=>$post['amount_paid'],
						'paid_by'=>$post['paid_by'],
						'details'=>$post['details'],
						'added_date'=>date('Y-m-d'),
						'added_by'=>1							
				); 
					
				if(!$this->prescriptions_model->is_exist($save_data)){

					$this->db->trans_start();
					$result = $this->prescriptions_model->save($save_data);
					$prs_id = $this->prescriptions_model->get_last_insert_id();
					$this->db->trans_complete();
					$this->db->trans_strict(FALSE);
					$this->db->trans_commit();
					
					if($result>0){
						
						//2 add orderd product data into opt_pres_details
						
						$order_details=array();
						$new_po_details=array();
						$item_id = null;
						$lens_chk_flag=false;
						
						
						if(!empty($post['frame'])){						
							
								//'frame' => string '10::55::Titanium and Stainless Steel::Rimless Frames::test::40.44' 
								$string =explode('::',$post['frame']);
								$item_id=$string[0];
								$price = $string[5];
								$order_details = array(
										'pre_id'=>$prs_id,
										'item_id'=> $item_id,
										'qty'=>1,
										'item_price'=>$price,
										'prod_type'=>'frame',
										'from'=>$post['frame_from'],
										'added_date'=>date("Y-m-d"),
										'added_by'=>1
								);
								$result2 = $this->pres_order_details_model->save($order_details);
								
								//get frame info to deduct from stock then update stock
								$item_qty = 0 ;
								$new_item_qty =0;
								$item_record_set = $this->frames_model->select_records('*',null,null,array('frame_id'=>$item_id));
								$item_result = $item_record_set['result_set'][0];
								$item_qty = $item_result['qty'];
								$new_item_qty = $item_qty-1;								 
								$this->frames_model->update_record(array('qty'=>$new_item_qty),array('frame_id'=>$item_id));

								//if its an order then add to pb tables
								if($post['frame_from'] == 'order'){
								
									$new_po_details= array(
											'pre_id'=>$prs_id,
											'sup_id' => $post['frame_sup_id'],
											'item_id'=> $item_id,
											'details'=>$post['frame_order_det'],
											'added_date'=>date('Y-m-d'),
											'added_by'=>1,
											'po_status'=>'new',
											'product_type'=>'frame'											
									);
									$po_result = $this->po_model->save($new_po_details);
								
								}
								
							
						}//if end frame											
						
						if(!empty($post['left_lens'])){
							
								
								//'left_lens' => string '2::+56::CR39 - Normal - Clear::Greenish red::3500'
								$string =explode('::',$post['left_lens']);
								$item_id=$string[0];
								$price = $string[4];
								$order_details = array(
										'pre_id'=>$prs_id,
										'item_id'=> $item_id,
										'from'=>$post['left_lens_from'],
										'qty'=>1,
										'item_price'=>$price,
										'prod_type'=>'left_lens',
										'added_date'=>date("Y-m-d"),
										'added_by'=>1
								);
								$result2 = $this->pres_order_details_model->save($order_details);
								
								//get lense info to deduct from stock then update stock
								$item_qty = 0 ;
								$new_item_qty =0;
								$item_record_set = $this->lenses_model->select_records('*',null,null,array('lens_id'=>$item_id));
								$item_result = $item_record_set['result_set'][0];								
								$item_qty = $item_result['qty'];
								$new_item_qty = $item_qty-1;						
					
								$result4 = $this->lenses_model->update_record(array('qty'=>$new_item_qty),array('lens_id'=>$item_id));
								
								if($post['left_lens_from'] == 'order'){
									
									$new_po_details= array(
										'pre_id'=>$prs_id,
										'sup_id' => $post['left_lens_sup_id'],
										'item_id'=> $item_id,
										'details'=>$post['left_lens_order_det'],
										'added_date'=>date('Y-m-d'),
										'added_by'=>1,
										'po_status'=>'new',
										'product_type'=>'left_lens'
									);
									$po_result = $this->po_model->save($new_po_details);
								}
						}//left lens
						
						
						if(!empty($post['right_lens'])){
							
							
								//''right_lens' => string '6::+20::CR39 - Photo Cromic::Red::4000' (length=38)
								$string =explode('::',$post['right_lens']);
								$item_id=$string[0];
								$price = $string[4];
								$order_details= array(
										'pre_id'=>$prs_id,
										'item_id'=> $item_id,
										'from'=>$post['right_lens_from'],
										'qty'=>1,
										'item_price'=>$price,
										'prod_type'=>'right_lens',
										'added_date'=>date("Y-m-d"),
										'added_by'=>1										
								);
								$result2 = $this->pres_order_details_model->save($order_details);
									
								//get lense info to deduct from stock then update stock
								$item_qty = 0 ;
								$new_item_qty =0;
								$item_record_set = $this->lenses_model->select_records('*',null,null,array('lens_id'=>$item_id));
								$item_result = $item_record_set['result_set'][0];
								$item_qty = $item_result['qty'];
								$new_item_qty = $item_qty-1;
								
								$result4 = $this->lenses_model->update_record(array('qty'=>$new_item_qty),array('lens_id'=>$item_id));
								
								if($post['right_lens_from'] == 'order'){
									
									$new_po_details= array(
										'pre_id'=>$prs_id,
										'sup_id' => $post['right_lens_sup_id'],
										'details'=>$post['right_lens_order_det'],
										'added_date'=>date('Y-m-d'),
										'added_by'=>1,
										'item_id'=> $item_id,
										'po_status'=>'new',
											'product_type'=>'right_lens'
									);
									$po_result = $this->po_model->save($new_po_details);								
								}							
						}//end if right lens
						

						$form_data['gen_message'] = array(
									'type' => 'success',
									'text' => 'Data saved!');
						$this->redirect_home(site_url('prescriptions/index'));								
						
					}else{
						
						//$this->db->trans_rollback();
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
	
		$debug = false;
		
		$this->output->enable_profiler(true);
	
		$form_data = array();
	
		$form_data['gen_message'] = null;
		$form_data['form_data_val'] = null;		
		$post = $this->input->post(null);
		$form_data['fields'] = null;//$post;
		$form_data['right_eye_lens_strings'] = null;
		$form_data['left_eye_lens_strings'] = null;
		$form_data['frame_strings'] = null;
			
		if(isset($post['btnSave'])){
			
		
			if($debug)var_dump($post);
			
			$validation = $this->validate_form();
				
			if($validation){
			
				//1 add to prescription table
				$save_data = array(
						'p_id' => $post['p_id'],
						'visited_date'=>$post['visited_date'],
						'order_status'=>'new',
						'priscript_total'=>$post['total'],
						'amount_paid'=>$post['amount_paid'],
						'paid_by'=>$post['paid_by'],
						'details'=>$post['details'],
						'updated_date'=>date('Y-m-d'),
						'updated_by'=>1
				);
				
				$result = $this->prescriptions_model->update_record($save_data,array('pre_id'=>$id));
				$prs_id = $id;
				
				//if($result>0){				
					
					$order_details=array();
					$new_po_details=array();
					$item_id = null;
					$lens_chk_flag=false;
				
				
					if(!empty($post['frame'])){
						
						$prev_frame_id = $post['prev_frame_id'];
												
						//var_dump($post['frame']);	
						//'frame' => string '10::55::Titanium and Stainless Steel::Rimless Frames::test::40.44'
						$string =explode('::',$post['frame']);
						$item_id=$string[0];
						$price = $string[5];
						$order_details = array(
								'pre_id'=>$prs_id,
								'item_id'=> $item_id,
								'qty'=>1,
								'item_price'=>$price,
								'prod_type'=>'frame',
								'from'=>$post['frame_from'],
								'updated_date'=>date("Y-m-d"),
								'updated_by'=>1
						);
						$result2 = $this->pres_order_details_model->update_record(
								$order_details,
								array(
										'pre_id'=>$prs_id,
										'item_id'=>$prev_frame_id,
										'prod_type'=>'frame'
								));
				
					if($post['frame_from'] == 'stock'){

						if($prev_frame_id != $item_id){
							
							//get frame info to deduct from stock then update stock qty
							$item_qty = 0 ;
							$new_item_qty =0;
							$prev_item_qty =0;
							$item_record_set = $this->frames_model->select_records('*',null,null,array('frame_id'=>$item_id));
							$item_result = $item_record_set['result_set'][0];
							$item_qty = $item_result['qty'];
							$new_item_qty = $item_qty-1;
							$this->frames_model->update_record(array('qty'=>$new_item_qty),array('frame_id'=>$item_id));
							
							//now reset previous item qty							
							$prev_item_record_set = $this->frames_model->select_records('*',null,null,array('frame_id'=>$prev_frame_id));
							$prev_item_result = $prev_item_record_set['result_set'][0];
							$prev_item_qty = $prev_item_result['qty'];
							$new_item_qty = $prev_item_qty+1;
							$this->frames_model->update_record(array('qty'=>$new_item_qty),array('frame_id'=>$prev_frame_id));
						}
				
						//of an order is turned into stock then delete previous entries from po table
						$this->po_model->delete(array('pre_id'=>$prs_id,'product_type'=>'frame'));
						
							
						//if its an order then add to pb tables
					}else if($post['frame_from'] == 'order'){
							
							//first delete existing order
							$this->po_model->delete(array('pre_id'=>$prs_id,'product_type'=>'frame'));
							
							$new_po_details= array(
									'pre_id'=>$prs_id,
									'sup_id' => $post['frame_sup_id'],
									'item_id'=> $item_id,
									'details'=>$post['frame_order_det'],
									'added_date'=>date('Y-m-d'),
									'added_by'=>1,
									'po_status'=>'new',
									'product_type'=>'frame'
							);
							$po_result = $this->po_model->save($new_po_details);							
						}						
					}//if end frame
					
					
					///////////////
					if(!empty($post['left_lens'])){
					
						$prev_left_lens_id = $post['prev_left_lens_id'];
						
						//var_dump($post['left_lens']);
						//'left_lens' => string '8::+45::CR39 - Normal - Tinted::Green::500' (length=42)
						$string =explode('::',$post['left_lens']);
						$item_id=$string[0];
						$price = $string[4];
						$order_details = array(
								'pre_id'=>$prs_id,
								'item_id'=> $item_id,
								'qty'=>1,
								'item_price'=>$price,
								'prod_type'=>'left_lens',
								'from'=>$post['left_lens_from'],
								'updated_date'=>date("Y-m-d"),
								'updated_by'=>1
						);
						$result3 = $this->pres_order_details_model->update_record(
								$order_details,
								array(
										'pre_id'=>$prs_id,
										'item_id'=>$prev_left_lens_id,
										'prod_type'=>'left_lens'
								));
					
						if($post['left_lens_from'] == 'stock'){
					
							if($prev_left_lens_id != $item_id){

								//get left info to deduct from stock then update stock qty
								$item_qty = 0 ;
								$new_item_qty =0;
								$prev_item_qty =0;
								$item_record_set = $this->lenses_model->select_records('*',null,null,array('lens_id'=>$item_id));
								$item_result = $item_record_set['result_set'][0];
								$item_qty = $item_result['qty'];
								$new_item_qty = $item_qty-1;
								$this->lenses_model->update_record(array('qty'=>$new_item_qty),array('lens_id'=>$item_id));
									
								
								//now reset previous item qty
								$prev_item_record_set = $this->lenses_model->select_records('*',null,null,array('lens_id'=>$prev_left_lens_id));
								$prev_item_result = $prev_item_record_set['result_set'][0];
								$prev_item_qty = $prev_item_result['qty'];
								$new_item_qty = $prev_item_qty+1;
								$this->lenses_model->update_record(array('qty'=>$new_item_qty),array('lens_id'=>$prev_left_lens_id));
							}
					
							//of an order is turned into stock then delete previous entries from po table
							$this->po_model->delete(array('pre_id'=>$prs_id,'product_type'=>'left_lens'));
					
								
							//if its an order then add to pb tables
						}else if($post['left_lens_from'] == 'order'){
								
							//first delete existing order
							$this->po_model->delete(array('pre_id'=>$prs_id,'product_type'=>'left_lens'));
								
							$new_po_details= array(
									'pre_id'=>$prs_id,
									'sup_id' => $post['left_lens_sup_id'],
									'item_id'=> $item_id,
									'details'=>$post['left_lens_order_det'],
									'added_date'=>date('Y-m-d'),
									'added_by'=>1,
									'po_status'=>'new',
									'product_type'=>'left_lens'
							);
							$po_result = $this->po_model->save($new_po_details);
						}
					}//if end left lens
					////////////

					//for right lens
					///////////////
					if(!empty($post['right_lens'])){
							
						$prev_left_lens_id = $post['prev_right_lens_id'];
					
						//var_dump($post['right_lens']);
						//'right_lens' => string '8::+45::CR39 - Normal - Tinted::Green::500' (length=42)
						$string =explode('::',$post['right_lens']);
						$item_id=$string[0];
						$price = $string[4];
						$order_details = array(
								'pre_id'=>$prs_id,
								'item_id'=> $item_id,
								'qty'=>1,
								'item_price'=>$price,
								'prod_type'=>'right_lens',
								'from'=>$post['right_lens_from'],
								'updated_date'=>date("Y-m-d"),
								'updated_by'=>1
						);
						$result3 = $this->pres_order_details_model->update_record(
								$order_details,
								array(
										'pre_id'=>$prs_id,
										'item_id'=>$prev_right_lens_id,
										'prod_type'=>'right_lens'
								));
							
						if($post['right_lens_from'] == 'stock'){
								
							if($prev_right_lens_id != $item_id){
					
								//get left info to deduct from stock then update stock qty
								$item_qty = 0 ;
								$new_item_qty =0;
								$prev_item_qty =0;
								$item_record_set = $this->lenses_model->select_records('*',null,null,array('lens_id'=>$item_id));
								$item_result = $item_record_set['result_set'][0];
								$item_qty = $item_result['qty'];
								$new_item_qty = $item_qty-1;
								$this->lenses_model->update_record(array('qty'=>$new_item_qty),array('lens_id'=>$item_id));
									
					
								//now reset previous item qty
								$prev_item_record_set = $this->lenses_model->select_records('*',null,null,array('lens_id'=>$prev_left_lens_id));
								$prev_item_result = $prev_item_record_set['result_set'][0];
								$prev_item_qty = $prev_item_result['qty'];
								$new_item_qty = $prev_item_qty+1;
								$this->lenses_model->update_record(array('qty'=>$new_item_qty),array('lens_id'=>$prev_left_lens_id));
							}
								
							//of an order is turned into stock then delete previous entries from po table
							$this->po_model->delete(array('pre_id'=>$prs_id,'product_type'=>'right_lens'));
								
					
							//if its an order then add to pb tables
						}else if($post['right_lens_from'] == 'order'){
					
							//first delete existing order
							$this->po_model->delete(array('pre_id'=>$prs_id,'product_type'=>'right_lens'));
					
							$new_po_details= array(
									'pre_id'=>$prs_id,
									'sup_id' => $post['right_lens_sup_id'],
									'item_id'=> $item_id,
									'details'=>$post['right_lens_order_det'],
									'added_date'=>date('Y-m-d'),
									'added_by'=>1,
									'po_status'=>'new',
									'product_type'=>'right_lens'
							);
							$po_result = $this->po_model->save($new_po_details);
						}
					}//if end left lens
					////////////
								
					
					
				//}//end if result check
				
				
				
			}//end if validation	
				
		}//end if submit check
		
		//get record data
		$pre_record_set = $this->prescriptions_model->select_records('*',null,null,array('pre_id'=>$id));
				
		//patients
		$record_set = $this->patients_model->select_records('*',1000,null,null);
		$form_data['patlist'] = $record_set['result_set'];
		
		//suplist
		$record_set = $this->suppliers_model->select_records('*',200,null,null);
		$form_data['suplist'] = $record_set['result_set'];		
		
		//prescription order details
		$o_record_set = $this->pres_order_details_model->select_records('*',1000,null,array('pre_id'=>$id));
		$form_data['orders'] = $o_record_set['result_set'];
		$total=null;
		
		if($debug)var_dump($form_data['orders']);
		
		foreach($o_record_set['result_set'] as $item){
				
			if($item['prod_type'] == 'frame'){
		
				//$this->session->set_userdata('prev_frame_id', $item['item_id']);
				$form_data['prev_frame_id'] = $item['item_id'];
				$form_data['frame_strings'] = $this->get_frame_by_id($item['item_id'],false);
				$form_data['frame_from'] = $item['from'];
				$form_data['frame_price'] = $item['item_price'];
				$total = $item['item_price'];
		
				if($item['from']=='order'){
						
					//get product order details from po table
					$po_record_set = $this->po_model->select_records('*',1000,null,array('pre_id'=>$id,'item_id'=>$item['item_id']));
					$po_det = $po_record_set['result_set'][0];
					$form_data['frame_sup_id'] = $po_det['sup_id'];
					$form_data['frame_order_det'] = $po_det['details'];
		
				}
			}else if($item['prod_type'] == 'left_lens'){
		
				//$this->session->set_userdata('prev_left_lens_id', $item['item_id']);
				$form_data['prev_left_lens_id'] = $item['item_id'];
				$form_data['left_eye_lens_strings'] = $this->get_lens_by_id($item['item_id'],false);
				$form_data['left_lens_from'] = $item['from'];
				$form_data['left_lens_price'] = $item['item_price'];
				$total += $item['item_price'];
				
				if($item['from']=='order'){
					//get product order details from po table
					$po_record_set = $this->po_model->select_records('*',1000,null,array('pre_id'=>$id,'item_id'=>$item['item_id']));
					$po_det = $po_record_set['result_set'][0];
					$form_data['left_lens_sup_id'] = $po_det['sup_id'];
					$form_data['left_lens_order_det'] = $po_det['details'];
				}
		
			}else 	if($item['prod_type'] == 'right_lens'){
		
				//$this->session->set_userdata('prev_right_lens_id', $item['item_id']);
				$form_data['prev_right_lens_id'] = $item['item_id'];
				$form_data['right_eye_lens_strings'] = $this->get_lens_by_id($item['item_id'],false);
				$form_data['right_lens_from'] = $item['from'];
				$form_data['right_lens_price'] = $item['item_price'];
				$total += $item['item_price'];
				
				if($item['from']=='order'){
					//get product order details from po table
					$po_record_set = $this->po_model->select_records('*',1000,null,array('pre_id'=>$id,'item_id'=>$item['item_id']));
					$po_det = $po_record_set['result_set'][0];
					$form_data['right_lens_sup_id'] = $po_det['sup_id'];
					$form_data['right_lens_order_det'] = $po_det['details'];
				}
		
			}
		
		}
				
		$form_data['total'] = number_format($total,2,'.','');

		$form_data['fields'] = $pre_record_set['result_set'][0];
		$this->load->view('edit_prescription',$form_data);
			
	}//end of function
	
	
	
	
	
	
	private function validate_form($edit = false){	
		
		//do validation here
		$this->form_validation->set_rules('visited_date', 'Date', 'required');
		$this->form_validation->set_rules('p_id', 'Patient name', 'required');
		$this->form_validation->set_rules('amount_paid', 'Amount Paid', 'required|float');
		$this->form_validation->set_rules('total', 'Total', 'required|float');
				
		if($edit == false){
				
		}else{
				
		}
		return $this->form_validation->run();
	
	}//end of function
	
	
	
	public function select_products($product_type){

		
		$sup_record_set = $this->suppliers_model->select_records('*',1000,0);
		$form_data['sup_list'] = $sup_record_set['result_set'];

		//lens cat
		$cat_record_set = $this->category_model->select_records('*',1000,0);
		$form_data['cat_list'] = $cat_record_set['result_set'];
		
		//lens
		$lens_record_set = $this->lenses_model->select_records('*',1000,0);
		$form_data['lens_list'] = $lens_record_set['result_set'];

		//frames
		$frames_record_set = $this->frames_model->select_records('*',1000,0);
		$form_data['frames_list'] = $frames_record_set['result_set'];
		
		
		$form_data['product_type'] = $product_type;
		
		
		if($product_type == 'frame'){
			$this->load->view('prescribe_frames',$form_data);
		}else if($product_type == 'r_lens'){						
			$this->load->view('prescribe_lens_right',$form_data);
		}else if($product_type == 'l_lens'){						
			$this->load->view('prescribe_lens_left',$form_data);
		}
		
	}
	
	
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
	
	
	public function get_patient_by_id($p_id){
	
		$record_set = $this->patients_model->select_records('*',null,null,array('p_id'=>$p_id));
		$result = $record_set['result_set'][0];
	
		
		$str = $result['p_id'].'::'.
				$result['mobile_no'].'::'.				
				$result['home_tp_no'].'::'.
				$result['address'].'::'.
				$result['nic_no'].'::'.
				$result['dob'];
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
			
			$xml->startBranch('row',array('id' =>$record['pre_id']));
			$action = '<a href="'.site_url('prescriptions/edit/'.$record['pre_id'].'').'" onclick="">Edit</a>  |
					   <a href="javascript:void(0);" onclick="delete_record('.$record['pre_id'].')">Delete</a> ';
			$xml->addNode('cell',$action,null, true);
			$xml->addNode('cell',$record['pre_id'],null, true);			
 			$xml->addNode('cell',$record['visited_date'],null, true);
 			
 			$p_record_set = $this->patients_model->select_records('*',1,0,array('p_id' => $record['p_id']));
 			$patient = (empty($p_record_set['result_set']))?'-':$p_record_set['result_set'][0]['title'].$p_record_set['result_set'][0]['full_name']; 			
 			$xml->addNode('cell',$patient,null, true);
 			 			
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