<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Service extends CI_Controller {





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



        $data['service'] = $this->WebModel->list_common('service');   

        $this->load->view('service.php',$data);           



    } 





    public function edit() {       



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $id = $this->uri->segment(3);

        $datas['item'] = $this->WebModel->list_common_where('service','service_id',$id);

        $datas['service'] = $this->WebModel->list_common('service'); 

        $this->load->view('service.php',$datas);          

    } 





    public function add() {        

        $service_name = $this->security->xss_clean($this->input->post('service_name'));

        $data = array('service_name' => $service_name);        

        $id = $this->security->xss_clean($this->input->post('id'));

        if(!empty($id)) {

            $saved = $this->WebModel->update_common('service',$data,'service_id',$id);            

        }else {

            $saved = $this->WebModel->insert_common('service',$data);                

        }           



        if(!empty($saved)) {

            $this->session->set_flashdata('message', 'Saved Successfully');

            redirect('Service');    

        }else {

            $this->session->set_flashdata('error', 'Something Went Wrong! Try Again Later');

            redirect('Service');

        }



    }



    public function delete(){        

        $id = $this->uri->segment(3);

        $this->WebModel->delete_common('service','service_id',$id);

        redirect('Service'); 

    }





}







?>