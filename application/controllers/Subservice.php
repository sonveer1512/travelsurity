<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Subservice extends CI_Controller {



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



        $data['subservice'] = $this->WebModel->list_common('subservicemaster');

        $data['service'] = $this->WebModel->list_common('service');   

        $this->load->view('subservice.php',$data);           



    } 





    public function edit() {       



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $id = $this->uri->segment(3);

        $datas['item'] = $this->WebModel->list_common_where('subservicemaster','subservice_id',$id);

        $datas['subservice'] = $this->WebModel->list_common('subservicemaster'); 

        $datas['service'] = $this->WebModel->list_common('service');   

        $this->load->view('subservice.php',$datas);          

    } 





    public function add() {        

        $subservice_name = $this->security->xss_clean($this->input->post('subservice_name'));

        $service_id = $this->security->xss_clean($this->input->post('service_id'));

        $data = array('subservice_name' => $subservice_name, 'service_id' => $service_id);        

        $id = $this->security->xss_clean($this->input->post('id'));

        if(!empty($id)) {

            $saved = $this->WebModel->update_common('subservicemaster',$data,'subservice_id',$id);            

        }else {

            $saved = $this->WebModel->insert_common('subservicemaster',$data);                

        }           



        if(!empty($saved)) {

            $this->session->set_flashdata('message', 'Saved Successfully');

            redirect('Subservice');    

        }else {

            $this->session->set_flashdata('error', 'Something Went Wrong! Try Again Later');

            redirect('Subservice');

        }



    }



    public function delete(){        

        $id = $this->uri->segment(3);

        $this->WebModel->delete_common('subservicemaster','subservice_id',$id);

        redirect('Subservice'); 

    }





}







?>