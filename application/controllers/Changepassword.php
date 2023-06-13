<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Changepassword extends CI_Controller {

    

    public function __construct()

    {

        parent::__construct();

        $this->load->database();

        $this->load->helper('url');

        $this->load->library('form_validation');

        $this->load->model('WebModel');

        $this->load->library('session');

    }



	public function index()

	{	    

		if(empty($this->session->userdata('lmssession_id'))) {

            redirect('admin/Index');

        }

         

        $this->load->view('admin/change_password.php');

	}	

	



    public function updatepassword()

    {

        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');

        $this->form_validation->set_rules('new_password', 'New Password', 'required');

        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');

        

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        

        if($this->form_validation->run() == false){

            $this->session->set_flashdata('message', 'Please enter required fields');

            redirect('admin/Index');

        } 

        else {

            $current_password = $this->security->xss_clean($this->input->post('current_password')); 

            $new_password = $this->security->xss_clean($this->input->post('new_password'));

            $confirm_password = $this->security->xss_clean($this->input->post('confirm_password'));





            if($confirm_password == $new_password) {       

                $user_id = $this->session->userdata('lmssession_id'); 

                $user = $this->WebModel->list_common_where('admin','id',$user_id);

                

                if(!empty($user)) {

                    

                    if($user['password'] == md5($current_password)) {

                        

                        $data = array('password' => md5($new_password));

                        $saved = $this->WebModel->update_common('admin',$data,'id',$user_id);   

                        

                        $this->session->set_flashdata('message', 'Password Updated Successfully');

                        redirect('admin/Index');

                    }else {

                        $this->session->set_flashdata('error', 'Current Password is not matched');

                        redirect('admin/Index');    

                    }

                }else {  

                    $this->session->set_flashdata('error', 'User not found');

                    redirect('admin/Index');

                }

            }else {

                $this->session->set_flashdata('error', 'New Password & Confirm Password is not matched');

                redirect('admin/Index'); 

            }

        }

    }





    public function LogOut() {

        $this->session->sess_destroy();

        redirect('admin/Index');

    }



}



?>