<?php 

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {        
	public function __construct()    {        
		parent::__construct();        
		$this->load->database();        
		$this->load->helper('url');        
		$this->load->library('form_validation');        
		$this->load->model('WebModel');        
		$this->load->library('session');    
	}	

	public function index()	{	    		
		if(!empty($this->session->userdata('session_id'))) {            
			redirect('userpanel/dashboard');        
		}                 

		$this->load->view('user/index.php');	
	}		    

	public function login()    {        
		$this->form_validation->set_rules('email', 'Email', 'trim|required');        
		$this->form_validation->set_rules('password', 'Password', 'required');                
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');                

		if($this->form_validation->run() == false){    
			$this->session->set_flashdata('error', 'Enter Mandatory Fields');                  
			redirect('userpanel/Index');        
		}else {            
			$email = $this->security->xss_clean($this->input->post('email'));             
			$password = $this->security->xss_clean($this->input->post('password'));                       
			$user = $this->WebModel->login2($email, md5($password));                        

			if($user){                
				$userdata = array(                    
					'usersession_id' => $user->user_id,                    
					'useremail' => $user->email_id,                   
					'authenticated' => TRUE                
				);                                

				$this->session->set_userdata($userdata);                
				redirect('userpanel/Dashboard');            
			}            
			else {                                
				$this->session->set_flashdata('error', 'Invalid email or password');                
				redirect('userpanel/Index');            
			}       
		}    
	}

public function LogOut() {
    $this->session->sess_destroy();
    redirect('userpanel/Index');
}

}?>