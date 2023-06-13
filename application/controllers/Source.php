<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Source extends CI_Controller {



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



        $data['source'] = $this->WebModel->list_common('source');   

        $this->load->view('source.php',$data);           

    } 





    public function edit() {       



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $id = $this->uri->segment(3);

        $datas['item'] = $this->WebModel->list_common_where('source','source_id',$id);

        $datas['source'] = $this->WebModel->list_common('source'); 

        $this->load->view('source.php',$datas);          

    } 





    public function add() {        

        $source_name = $this->security->xss_clean($this->input->post('source_name'));

        $data = array('source_name' => $source_name);        

        $id = $this->security->xss_clean($this->input->post('id'));

        if(!empty($id)) {

            $saved = $this->WebModel->update_common('source',$data,'source_id',$id);            

        }else {

            $saved = $this->WebModel->insert_common('source',$data);                

        }           



        if(!empty($saved)) {

            $this->session->set_flashdata('message', 'Saved Successfully');

            redirect('Source');    

        }else {

            $this->session->set_flashdata('error', 'Something Went Wrong! Try Again Later');

            redirect('Source');

        }



    }



    public function delete(){        

        $id = $this->uri->segment(3);

        $this->WebModel->delete_common('source','source_id',$id);

        redirect('Source'); 

    }





}







?>