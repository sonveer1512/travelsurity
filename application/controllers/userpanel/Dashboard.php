<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('WebModel');
        $this->load->library('session');
    }

	public function index()
    {       
        if(empty($this->session->userdata('usersession_id'))) {
            redirect('userpanel/index');    
        }
        
        $data['user_details'] = $this->WebModel->list_common_where3("user","user_id",$this->session->userdata('usersession_id'));
        $data['lead'] = $this->WebModel->list_common_leads('leadmaster','assign_user_id',$this->session->userdata('usersession_id'));  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
        $this->load->view('user/dashboard.php',$data);          
    } 
	


    public function showfiltereddatabyname($id) {      
        $user_id = $this->session->userdata('usersession_id');
        $data['lead'] = $this->WebModel->searchbyuser('leadmaster','lead_id',$id, "", $user_id);  
        $this->load->view('user/changedresult.php',$data);         
    } 


    public function showfiltereddatabyphone($id) {      
        $user_id = $this->session->userdata('usersession_id');
        $data['lead'] = $this->WebModel->searchbyuser('leadmaster','lead_id',"",$id, $user_id);  
        $this->load->view('user/changedresult.php',$data);         
    } 


    public function showfiltereddatabylocation($id) {      
        $user_id = $this->session->userdata('usersession_id');
        $data['lead'] = $this->WebModel->searchbylocationuser('leadmaster','lead_id',$id, $user_id);  
        $this->load->view('user/changedresult.php',$data);         
    } 


}

?>