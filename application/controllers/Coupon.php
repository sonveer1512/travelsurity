<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Coupon extends CI_Controller {





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

        $this->load->view('addcoupon.php',$data);           



    } 





    public function issuedata() {       



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index'); 

        }        



        $data['issuecoupon'] = $this->WebModel->list_common('issuecoupon');   

        $this->load->view('issuedata.php',$data);           



    } 





    public function issue() {       



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $datas['coupon'] = $this->WebModel->list_common('coupon'); 

        $this->load->view('issuecoupon.php',$datas);          

    } 







    public function view() {       



        if(empty($session_id = $this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $id = $this->uri->segment(3);

        $datas['item'] = $this->WebModel->list_common_where('issuecoupon','id',$id);

        $datas['coupon'] = $this->WebModel->list_common('coupon'); 

        $this->load->view('issuecoupon.php',$datas);          

    } 









    public function add() {        

        $data['date'] = $this->security->xss_clean($this->input->post('coupon'));

        $data['date'] = $this->security->xss_clean($this->input->post('date'));

        $data['booklet'] = $this->security->xss_clean($this->input->post('noofbooklet'));

        

        $json = array();



        if(!empty($this->input->post('serialfrom'))) {

            $serialfrom = $this->input->post('serialfrom');

            $serialto = $this->input->post('serialto');



            for($i = 0; $i < count($serialfrom); $i++) {

                array_push($json, array('serialfrom' => $serialfrom[$i], 'serialto' => $serialto[$i]));

            }



            $data['bookletdata'] = json_encode($json); 

        }





        $saved = $this->WebModel->insert_common('coupon_booklet',$data);                

                   

        $response = array('status' => true);



        $this->output

            ->set_content_type('application/json')

            ->set_output(json_encode($response));

    }











    public function addissue() {        

        $data['date'] = $this->security->xss_clean($this->input->post('date'));

        $data['issue_to'] = $this->security->xss_clean($this->input->post('issue_to'));

        $data['phone'] = $this->security->xss_clean($this->input->post('phone'));

        $data['nagar'] = $this->security->xss_clean($this->input->post('nagar'));

        $data['manadal'] = $this->security->xss_clean($this->input->post('mandal'));

        $data['role'] = $this->security->xss_clean($this->input->post('role'));

        $data['address'] = $this->security->xss_clean($this->input->post('address'));

        

        $json = array();



        if(!empty($this->input->post('type'))) {

            $type = $this->input->post('type');

            $total = $this->input->post('total');

            $issued = $this->input->post('issued');

            $amount = $this->input->post('amount');



            for($i = 0; $i < count($type); $i++) {

               array_push($json, array('type' => $type[$i], 'total' => $total[$i], 'issued' => $issued[$i], 'amount' => $amount[$i]));



               $new = $total[$i] - $issued[$i];

               $datas = array('booklet' => $new);

               $this->WebModel->update_common('coupon_booklet',$datas,'coupontype',$type[$i]);

            }



            $data['detail'] = json_encode($json); 

        }





        $saved = $this->WebModel->insert_common('issuecoupon',$data);                

                   

        $response = array('status' => true);



        $this->output

            ->set_content_type('application/json')

            ->set_output(json_encode($response));

    }











    public function delete(){        

        $id = $this->uri->segment(3);

        $this->WebModel->delete_common('coupon_booklet','id',$id);

        redirect('Coupon'); 

    }









    public function changebooklet() {

        $total = $this->security->xss_clean($this->input->get('total'));



        $output = '';

        for($i = 0; $i < $total; $i++) {

            $output .= '<table class="table table-bordered table-hover" style="margin-top: 10px;"><tbody>';

            $output .= '<tr>

                        <td colspan="4" style="text-align: center;"><strong>Booklet Number '.($i+1).'</strong></td>

                    </tr>

                    <tr>

                        <td>Serial No. From </td>

                        <td><input type="text" class="form-control" name="serialfrom[]" required></td>

                        <td>Serial No. To</td>

                        <td><input type="text" class="form-control" name="serialto[]" required></td>

                    </tr>';

            $output .= '</tbody></table>';        

        }



        $response = array('output' => $output);



        $this->output

            ->set_content_type('application/json')

            ->set_output(json_encode($response));



    }









}







?>