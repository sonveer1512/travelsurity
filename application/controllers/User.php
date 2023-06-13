<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class User extends CI_Controller {



    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->helper('url');

        $this->load->library('form_validation');

        $this->load->model('WebModel');

        $this->load->library('session');

    }



	public function index() {       



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index'); 

        }        



        $data['user'] = $this->WebModel->list_common('user');   

        $this->load->view('usermaster.php',$data);           

    } 





    public function new() {       



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index'); 

        }        



        $this->load->view('userregistration.php');           

    } 

 



    public function edit() {       

        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $id = $this->uri->segment(3);

        $datas['item'] = $this->WebModel->list_common_where('user','user_id',$id);

        $this->load->view('user_edit.php',$datas);          

    }





    public function changepassword() {       

        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $id = $this->uri->segment(3);

        $datas['item'] = $this->WebModel->list_common_where('user','user_id',$id);

        $this->load->view('user_changepassword.php',$datas);          

    } 





    public function add() {        
        $data['name'] = $this->security->xss_clean($this->input->post('myName'));
        $email = $data['email_id'] = $this->security->xss_clean($this->input->post('email'));
        $data['user_name'] = $this->security->xss_clean($this->input->post('user_name'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $confpassword = $this->security->xss_clean($this->input->post('confpassword'));
        $data['phone'] = $this->security->xss_clean($this->input->post('phone'));
        $data['user_type'] = 'employee';

        if($password == $confpassword) { 
            $data['password'] = md5($password);

            $user = $this->WebModel->list_common_where3('user','email_id',$email);

            if(!empty($user)) {
                $response = array('status' => true, 'exist' => true);
            }else {
                $this->WebModel->insert_common('user',$data);
                $response = array('status' => true, 'exist' => false);
            }
        }else {
            $response = array('status' => false);
        }    

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }





    public function updatepassword() {        

        $email = $this->security->xss_clean($this->input->post('email'));

        $password = $this->security->xss_clean($this->input->post('password'));

        $confpassword = $this->security->xss_clean($this->input->post('confpassword'));

        

        if($password == $confpassword) { 

            $data['password'] = md5($password);

            $this->WebModel->update_common('user',$data, 'email_id',$email);

            $response = array('status' => true);

        }else {

            $response = array('status' => false);

        }    



        $this->output

            ->set_content_type('application/json')

            ->set_output(json_encode($response));

    }





    public function updateuser() {        

        $data['name'] = $this->security->xss_clean($this->input->post('myName'));

        $email_id = $this->security->xss_clean($this->input->post('email'));

        $data['user_name'] = $this->security->xss_clean($this->input->post('user_name'));

        $data['phone'] = $this->security->xss_clean($this->input->post('phone'));

        if(!empty($user)) {
            $response = array('status' => true, 'exist' => true);
        }else {
            $this->WebModel->update_common('user',$data,'email_id',$email_id);
            $response = array('status' => true, 'exist' => false);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }







    public function delete(){        

        $id = $this->uri->segment(3);

        $this->WebModel->delete_common('user','user_id',$id);

        redirect('User'); 

    }





}







?>