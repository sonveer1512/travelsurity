<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Inventory extends CI_Controller {





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



        $data['coupon'] = $this->WebModel->list_common('coupon');   

        $this->load->view('inventory.php',$data);           



    } 





    public function edit() {       



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $id = $this->uri->segment(3);

        $datas['item'] = $this->WebModel->list_common_where('coupon','id',$id);

        $datas['coupon'] = $this->WebModel->list_common('coupon'); 

        $this->load->view('inventory.php',$datas);          

    } 





    public function add() {        

        $type = $data['type'] = $this->security->xss_clean($this->input->post('type'));



        $id = $this->security->xss_clean($this->input->post('id'));



        if(!empty($id)) {

            $saved = $this->WebModel->update_common('coupon',$data,'id',$id);            

        }else {

            $data['total'] = $this->security->xss_clean($this->input->post('total'));

            $data['balance'] = $this->security->xss_clean($this->input->post('total'));

            $saved = $this->WebModel->insert_common('coupon',$data);                

        }           



        if(!empty($saved)) {

            $this->session->set_flashdata('message', 'Saved Successfully');

            redirect('Inventory');    

        }else {

            $this->session->set_flashdata('error', 'Something Went Wrong! Try Again Later');

            redirect('Inventory');

        }



    }











    public function update() {

        $id = $this->security->xss_clean($this->input->post('id'));

        $total = $this->security->xss_clean($this->input->post('total'));



        $bal = $this->WebModel->list_common_where3('coupon','id',$id);

        $data['balance'] = $bal[0]['balance'] + $total;

        $data['total'] = $bal[0]['total'] + $total;



        $saved = $this->WebModel->update_common('coupon',$data,'id',$id);   



        redirect('Inventory');

    }





}







?>  