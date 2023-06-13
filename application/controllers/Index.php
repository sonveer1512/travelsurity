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
	       		
		if(!empty($this->session->userdata('lmssession_id'))) {            
			redirect('dashboard');          
		}                 
		
		$this->load->view('index.php');	
	}		    

	public function login()    {  
		$this->form_validation->set_rules('email', 'Email', 'trim|required');        
		$this->form_validation->set_rules('password', 'Password', 'required');                
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');                

		if($this->form_validation->run() == false){    
			$this->session->set_flashdata('error', 'Enter Mandatory Fields');                  
			redirect('Index');        
		}else {            
			$email = $this->security->xss_clean($this->input->post('email'));             
			$password = $this->security->xss_clean($this->input->post('password'));                       
			$user = $this->WebModel->login($email, md5($password));                        

			if($user){    
                
				$userdata = array(                    
					'lmssession_id' => $user->user_id,  
					'user_type' => $user->user_type,                     
					'email' => $user->email_id,                   
					'authenticated' => TRUE                
				);                                

				$this->session->set_userdata($userdata);                
				redirect('Dashboard');            
			}            
			else {                                
				$this->session->set_flashdata('error', 'Invalid email or password');                
				redirect('Index');            
			}       
		}    
	}

public function LogOut() {
    $this->session->sess_destroy();
    redirect('Index');
}



public function exportresult() {
    $id = $this->input->get('id');
    $data['custDtaData'] = $this->WebModel->list_common2('leadmaster','lead_id');

    $this->load->view('excel',$data);
}
  
  
  public function getdata() {
  	$data = $this->WebModel->list_common_where3('leadmaster','trip_id','');
    foreach($data as $value) {
      	$details['trip_id'] = "TS".str_pad($value['lead_id'],"7","0",STR_PAD_LEFT);
      	
    	$this->WebModel->update_common('leadmaster',$details,'lead_id',$value['lead_id']);
    }
    
  }
  
  

}?>