<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class State extends CI_Controller {





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



        $data['state'] = $this->WebModel->list_common('state');

        $data['country'] = $this->WebModel->list_common('country');   

        $this->load->view('state.php',$data);           



    } 





    public function edit() {       



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $id = $this->uri->segment(3);

        $datas['item'] = $this->WebModel->list_common_where('state','state_id',$id);

        $datas['state'] = $this->WebModel->list_common('state'); 

        $datas['country'] = $this->WebModel->list_common('country');   

        $this->load->view('state.php',$datas);          

    } 





    public function add() {        

        $state_name = $this->security->xss_clean($this->input->post('state_name'));

        $country_id = $this->security->xss_clean($this->input->post('country_id'));

        $data = array('state_name' => $state_name, 'country_id' => $country_id);        

        $id = $this->security->xss_clean($this->input->post('id'));

        if(!empty($id)) {

            $saved = $this->WebModel->update_common('state',$data,'state_id',$id);            

        }else {

            $saved = $this->WebModel->insert_common('state',$data);                

        }           



        if(!empty($saved)) {

            $this->session->set_flashdata('message', 'Saved Successfully');

            redirect('state');    

        }else {

            $this->session->set_flashdata('error', 'Something Went Wrong! Try Again Later');

            redirect('state');

        }



    }



    public function delete(){        

        $id = $this->uri->segment(3);

        $this->WebModel->delete_common('state','state_id',$id);

        redirect('state'); 

    }





}







?>