<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Lead extends CI_Controller {



    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->helper('url');

        $this->load->library('form_validation');

        $this->load->model('WebModel');

        $this->load->library('session');

    }



	public function index() {       



        if(empty($this->session->userdata('usersession_id'))) {

            redirect('userpanel/index'); 

        }        


        $session_id = $this->session->userdata('usersession_id');
        $data['lead'] = $this->WebModel->list_common_where3('leadmaster','assign_user_id',$session_id);  

        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');

        $this->load->view('user/lead_list.php',$data);           



    } 





    public function new() {       



        if(empty($session_id = $this->session->userdata('usersession_id'))) {

            redirect('userpanel/index');

        }       



        $datas['followup'] = $this->WebModel->list_common('followup');

        $datas['user_details'] = $this->WebModel->list_common_where('user','user_id',$session_id);

        $this->load->view('user/leadmaster.php',$datas);          

    } 



    public function edit() {       



        if(empty($session_id = $this->session->userdata('usersession_id'))) {

            redirect('userpanel/index');

        }       



        $id = $this->uri->segment(4);

        $datas['followup'] = $this->WebModel->list_common('followup');

        $datas['item'] = $this->WebModel->list_common_where('leadmaster','lead_id',$id);

        $datas['user_details'] = $this->WebModel->list_common_where('user','user_id',$session_id);

        $this->load->view('user/leadmaster.php',$datas);          

    } 







    public function view() {       



        if(empty($session_id = $this->session->userdata('usersession_id'))) {

            redirect('userpanel/index');

        }       



        $id = $this->uri->segment(4);

        $datas['item'] = $this->WebModel->list_common_where('leadmaster','lead_id',$id);

        $datas['followup'] = $this->WebModel->list_common_where3('followupstatusmaster','lead_id',$id);

        $datas['user_details'] = $this->WebModel->list_common_where('user','user_id',$session_id);

        $this->load->view('user/leadmaster.php',$datas);          

    } 





    public function add() {        

        $data['cname'] = $this->security->xss_clean($this->input->post('cname'));

        $data['cgoingTo'] = $this->security->xss_clean($this->input->post('cgoingTo'));

        $data['cmobile'] = $this->security->xss_clean($this->input->post('cmobile'));

        $data['cmail'] = $this->security->xss_clean($this->input->post('cmail'));

        $data['creservationDate'] = $this->security->xss_clean($this->input->post('creservationDate'));

        $data['cnoDays'] = $this->security->xss_clean($this->input->post('cnoDays'));

        $data['cfrom'] = $this->security->xss_clean($this->input->post('cfrom'));

   

        $id = $this->security->xss_clean($this->input->post('lead_id'));



        if(!empty($id)) {

            $this->WebModel->update_common('leadmaster',$data,'lead_id',$id);            

            $saved = $id;

        }else {

            $saved = $this->WebModel->insert_common('leadmaster',$data);  

        }           



        $followup = $this->security->xss_clean($this->input->post('followup'));

        $date = $this->security->xss_clean($this->input->post('date'));

        $followup_dis = $this->security->xss_clean($this->input->post('followup_dis'));



        if(!empty($client_msg)) {

            $this->security->xss_clean($this->input->post('client_msg'));

        }else {

            $client_msg = '';

        }



        date_default_timezone_set('Asia/Kolkata');

        $create_date = date('Y-m-d H:i:s');

        if(!empty($followup)) {

            $session_id = $this->session->userdata('usersession_id');

            $datas = array('lead_id' => $saved, 'followup_id' => $followup, 'followup_text' => $followup_dis, 'client_msg' => $client_msg, 'followup_date' => $date, 'created_by' => $session_id, 'create_date' => $create_date);

            $saved = $this->WebModel->insert_common('followupstatusmaster',$datas);

        }    



        $response = array('status' => true);



        $this->output

            ->set_content_type('application/json')

            ->set_output(json_encode($response));



    }









    public function assigned() {

        $checkbox = $this->input->post('checkbox');

        $user_id = $this->input->post('user_id');



        $data = array('assign_user_id' => $user_id);



        for($i = 0; $i < count($checkbox); $i++) {

            $this->WebModel->update_common('leadmaster',$data,'lead_id',$checkbox[$i]);

        }



        redirect('userpanel/Lead'); 

    }













    public function delete(){        

        $id = $this->uri->segment(3);

        $this->WebModel->delete_lead($id);

        redirect('userpanel/Lead'); 

    }





    public function fixed() {      
        if(empty($this->session->userdata('usersession_id'))) {
            redirect('userpanel'); 
        }        

        $data['client_fixed'] = $this->WebModel->list_common_where3('followupstatusmaster','followup_id','22');  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
        $this->load->view('user/clent_fixed.php',$data);           
    } 



    public function hot() {      
        if(empty($this->session->userdata('usersession_id'))) {
            redirect('userpanel'); 
        }        

        $data['client_fixed'] = $this->WebModel->list_common_hotleads();  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
        $this->load->view('user/clent_fixed.php',$data);           
    } 



    public function notinterested() {      
        if(empty($this->session->userdata('usersession_id'))) {
            redirect('userpanel'); 
        }        

        $data['client_fixed'] = $this->WebModel->list_common_where3('followupstatusmaster','followup_id','3');  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
        $this->load->view('user/clent_fixed.php',$data);           
    } 



}







?>