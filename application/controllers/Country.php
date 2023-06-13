<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Country extends CI_Controller {





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



        $data['country'] = $this->WebModel->list_common('country');   

        $this->load->view('country.php',$data);           



    } 





    public function edit() {       



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $id = $this->uri->segment(3);

        $datas['item'] = $this->WebModel->list_common_where('country','country_id',$id);

        $datas['country'] = $this->WebModel->list_common('country'); 

        $this->load->view('country.php',$datas);          

    } 





    public function add() {        

        $country_name = $this->security->xss_clean($this->input->post('country_name'));

        $data = array('country_name' => $country_name);        

        $id = $this->security->xss_clean($this->input->post('id'));

        if(!empty($id)) {

            $saved = $this->WebModel->update_common('country',$data,'country_id',$id);            

        }else {

            $saved = $this->WebModel->insert_common('country',$data);                

        }           



        if(!empty($saved)) {

            $this->session->set_flashdata('message', 'Saved Successfully');

            redirect('Country');    

        }else {

            $this->session->set_flashdata('error', 'Something Went Wrong! Try Again Later');

            redirect('Country');

        }



    }



    public function delete(){        

        $id = $this->uri->segment(3);

        $this->WebModel->delete_common('country','country_id',$id);

        redirect('Country'); 

    }





}







?>