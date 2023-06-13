<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Followup extends CI_Controller {





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



        $data['followup'] = $this->WebModel->list_common('followup');   

        $this->load->view('followup.php',$data);           



    } 





    public function edit() {       



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $id = $this->uri->segment(3);

        $datas['item'] = $this->WebModel->list_common_where('followup','followup_id',$id);

        $datas['followup'] = $this->WebModel->list_common('followup'); 

        $this->load->view('followup.php',$datas);          

    } 





    public function add() {        

        $followup_name = $this->security->xss_clean($this->input->post('followup_name'));

        $data = array('followup_name' => $followup_name);        

        $id = $this->security->xss_clean($this->input->post('id'));

        if(!empty($id)) {

            $saved = $this->WebModel->update_common('followup',$data,'followup_id',$id);            

        }else {

            $saved = $this->WebModel->insert_common('followup',$data);                

        }           



        if(!empty($saved)) {

            $this->session->set_flashdata('message', 'Saved Successfully');

            redirect('Followup');    

        }else {

            $this->session->set_flashdata('error', 'Something Went Wrong! Try Again Later');

            redirect('Followup');

        }



    }



    public function delete(){        

        $id = $this->uri->segment(3);

        $this->WebModel->delete_common('followup','followup_id',$id);

        redirect('followup'); 

    }





}







?>