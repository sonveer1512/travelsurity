<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class City extends CI_Controller {





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



        $data['city'] = $this->WebModel->list_common('city');

        $data['state'] = $this->WebModel->list_common('state');

        $data['country'] = $this->WebModel->list_common('country');   

        $this->load->view('city.php',$data);           



    } 





    public function edit() {       



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $id = $this->uri->segment(3);

        $datas['item'] = $this->WebModel->list_common_where('city','city_id',$id);

        $datas['state'] = $this->WebModel->list_common('state'); 

        $data['city'] = $this->WebModel->list_common('city');

        $datas['country'] = $this->WebModel->list_common('country');   

        $this->load->view('city.php',$datas);          

    } 





    public function add() {        

        $city_name = $this->security->xss_clean($this->input->post('city_name'));

        $state_id = $this->security->xss_clean($this->input->post('state'));

        $country_id = $this->security->xss_clean($this->input->post('country_id'));

        $data = array('city_name' => $city_name, 'country_id' => $country_id, 'state_id' => $state_id);        

        $id = $this->security->xss_clean($this->input->post('id'));

        if(!empty($id)) {

            $saved = $this->WebModel->update_common('city',$data,'city_id',$id);            

        }else {

            $saved = $this->WebModel->insert_common('city',$data);                

        }           



        if(!empty($saved)) {

            $this->session->set_flashdata('message', 'Saved Successfully');

            redirect('City');    

        }else {

            $this->session->set_flashdata('error', 'Something Went Wrong! Try Again Later');

            redirect('City');

        }



    }



    public function delete(){        

        $id = $this->uri->segment(3);

        $this->WebModel->delete_common('city','city_id',$id);

        redirect('City'); 

    }









    public function get_state() {

        $country_id = $this->security->xss_clean($this->input->post('country_id'));



        $states = $this->WebModel->list_common_where3('state','country_id',$country_id);



        $output = '';

        foreach ($states as $value) {

            $output .= '<option value="'.$value['state_id'].'">'.$value['state_name'].'</option>';

        }



        $response = array('output' => $output);



        $this->output

            ->set_content_type('application/json')

            ->set_output(json_encode($response));



    }



}







?>