<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class ACL{
	
	protected $CI;
	 
	function __construct(){	
		
		$this->CI =& get_instance();
		$this->CI->load->library('session');
	}

	public function log_in()
	{
		$debug = false;
		$form_data = array();
		$post = $this->CI->input->post(null);
		
		if($debug)var_dump($post);
		
		if(isset($post['login'])){			
			
			$username = $post['username'];
			$password = $post['password'];
			
			//verify user
			if($username =='admin' && $password == 'admin'){
								
				//create sessions					
				$this->CI->session->set_userdata('username', $username);
				$this->CI->session->set_userdata('name', 'Admin');
				$this->CI->session->set_userdata('role', 'Admin');	
				return true;			
			}else{
				$form_data['msg'] = 'Invalid username or password';
				$this->CI->load->view('login',$form_data);
			}			
		}else{		
			$this->CI->load->view('login',$form_data);
			//exit;
		}			
	}//end of function
	
	
	public function log_out(){
		
		$this->CI->session->unset_userdata('username');
		$this->CI->session->unset_userdata('role');
		$this->CI->session->unset_userdata('name');
		
	}
	
	
	public function login_check(){
	
		$debug = false;
		$username = $this->CI->session->userdata('username');
		$role = $this->CI->session->userdata('role');
	
		if($debug)var_dump($username,$role);
	
		if(!$username  && !$role ){
			return false;
		}else{
			return true;
		}
	}
	
	
	
}
/* End of file acl.php */