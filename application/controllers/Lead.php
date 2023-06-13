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



        if(empty($this->session->userdata('lmssession_id'))) {

            redirect('index'); 

        }        



        $data['lead'] = $this->WebModel->list_common2('leadmaster','lead_id');  

        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');

        $this->load->view('lead_list.php',$data);           



    } 







  public function fixed() {      
        if(empty($this->session->userdata('lmssession_id'))) {
            redirect('index'); 
        }        

        $data['client_fixed'] = $this->WebModel->list_common_where3('followupstatusmaster','followup_id','22');  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
        $this->load->view('clent_fixed.php',$data);           
    } 



    public function hot() {      
        if(empty($this->session->userdata('lmssession_id'))) {
            redirect('index'); 
        }        

        $data['client_fixed'] = $this->WebModel->list_common_hotleads();  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
        $this->load->view('clent_fixed.php',$data);           
    } 



    public function notinterested() {      
        if(empty($this->session->userdata('lmssession_id'))) {
            redirect('index'); 
        }        

        $data['client_fixed'] = $this->WebModel->list_common_where3('followupstatusmaster','followup_id','3');  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
        $this->load->view('clent_fixed.php',$data);           
    } 





    public function new() {       



        if(empty($session_id = $this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $datas['followup'] = $this->WebModel->list_common('followup');

        $datas['user_details'] = $this->WebModel->list_common_where('user','user_id',$session_id);

        $this->load->view('leadmaster.php',$datas);          

    } 



    public function edit() {       

        if(empty($session_id = $this->session->userdata('lmssession_id'))) {
            redirect('index');
        }

        $id = $this->uri->segment(3);

        $datas['followup'] = $this->WebModel->list_common('followup');
        $datas['item'] = $this->WebModel->list_common_where('leadmaster','lead_id',$id);
        $datas['user_details'] = $this->WebModel->list_common_where('user','user_id',$session_id);

        $this->load->view('leadmaster.php',$datas);          
    } 







    public function view() {       



        if(empty($session_id = $this->session->userdata('lmssession_id'))) {

            redirect('index');

        }       



        $id = $this->uri->segment(3);

        $datas['item'] = $this->WebModel->list_common_where('leadmaster','lead_id',$id);

        $datas['followup'] = $this->WebModel->list_common_where3('followupstatusmaster','lead_id',$id);

        $datas['user_details'] = $this->WebModel->list_common_where('user','user_id',$session_id);

        $this->load->view('leadmaster.php',$datas);          

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

        if(!empty($this->input->post('followup_dis'))) {
            $client_msg = $this->security->xss_clean($this->input->post('followup_dis'));
        }else {
            $client_msg = '';
        }

        date_default_timezone_set('Asia/Kolkata');
        $create_date = date('Y-m-d H:i:s');

        if(!empty($followup)) {
            if(!empty($this->session->userdata('lmssession_id'))) {
                $session_id = $this->session->userdata('lmssession_id');
            }else if($this->session->userdata('usersession_id')) {
                $session_id = $this->session->userdata('usersession_id');
            }
            
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

        redirect('dashboard'); 
    }
	public function selectedDelete(){
      if(isset($_POST['Deletesubmit'])) {
			 echo 'Deletesubmit';exit;
            if(!empty($this->input->post('checkbox'))) {
                        $check = $this->input->post('checkbox');
                        $check_id = [];
                        foreach($check as $row) {
                              array_push($check_id, $row);
                        }
                        $this->WebModel->selecteed_checkbox_delete($check_id);
                        redirect('dashboard');
                   } 
                  
      } if(isset($_POST['Hidesubmit'])) {
            
              if(!empty($this->input->post('checkbox'))) {
                        $check = $this->input->post('checkbox');
                        $check_id = [];
                        foreach($check as $row) {
                              array_push($check_id, $row);
                        }
                        $this->WebModel->deactivate($check_id);
                        redirect('dashboard');
                   } 
              
      }  if(isset($_POST['Not_Interestedsubmit'])) {
            
               if(!empty($this->input->post('checkbox'))) {
                        $check = $this->input->post('checkbox');
                        $check_id = [];
                        foreach($check as $row) {
                              array_push($check_id, $row);
                        }
                        $this->WebModel->NotInterested($check_id);
                        redirect('dashboard');
                   }
      } if(isset($_POST['hotsubmit'])) {
            
              if(!empty($this->input->post('checkbox'))) {
                        $check = $this->input->post('checkbox');
                        $check_id = [];
                        foreach($check as $row) {
                              array_push($check_id, $row);
                        }
                        $this->WebModel->hotlist($check_id);
                        redirect('dashboard');
                   }
      } 
}
    public function delete(){        

        $id = $this->uri->segment(3);

        $this->WebModel->delete_lead($id);

        redirect('Lead'); 

    }



    public function assignuser() {
        $checkbox = $this->input->get('id');
        $user_id = $this->input->get('user');
        $data = array('assign_user_id' => $user_id);
        $this->WebModel->update_common('leadmaster',$data,'lead_id',$checkbox);

        $response = array('status' => true);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }


    public function deletefollowup() {
        $delete = $this->input->get('id');
        $this->WebModel->delete_common('followupstatusmaster','followupstatus_id',$delete);

        $response = array('status' => true);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }





    public function showleads() {
        echo "hi";exit;
        $text2 = 'Regards TravelSurity';
        $text2 .= '%0Ahttps://www.travelsurity.com';
        $lead = $this->WebModel->list_common4('leadmaster','lead_id');  
        $user = $this->WebModel->list_common_where3('user','user_type','employee');

        $output = '';
        $i=0; foreach ($lead as $result) { $i++; 
          $text = 'Name : ' .$result['cname'].'';
          $text .= '%0AGoing to :   ' .$result['cgoingTo'].'';
          $text .= '%0ALeaving from :   '.$result['cfrom'].'';
          $text .= '%0ADeparture date :   '.$result['creservationDate'].'';
          $text .= '%0ANo. of days  :   '.$result['cnoDays'].'';
          $text .= '%0AEmail :   '.$result['cmail'].'';
          $text .= '%0AMobile no. :   '.$result['cmobile'].'';

        $output .='<tr>
            <td>
              <input type="checkbox" name="checkbox[]" value="'.$result['lead_id'].'">
            </td>
            <td>'.$i.'</td>
            <td>'.$result['cname'].' </td>
            <td>'.$result['cgoingTo'].'</td>
            <td><a href="tel: +91'.$result['cmobile'].'">'.$result['cmobile'].'</a></td>';

              $assign_id=$result['assign_user_id'];
              $resu = $this->WebModel->list_common_where3('user','user_id',$assign_id);
                        
        $output .='<td>
                <select class="form-control" name="user_id" id="assignuser" data-id="'.$result['lead_id'].'">
                  <option>select user</option>';

                  foreach($user as $value) { 
            $output .= '<option value="'.$value['user_id'].'"'; if(!empty($result['assign_user_id'])) { if($result['assign_user_id'] == $value['user_id']) { $output .= "selected"; } } 
            $output .= '>'.$value['user_name'].'</option>';
                   }
            $output .= '</select>
                <span id="assignerr_'.$result['lead_id'].'" style="display: none; color: green">User Assigned Successfully</span>
            </td>
            <td>'.$result['create_on'].'</td>
            <td>
              <a class="btn btn-success" href="<?=base_url()?>Lead/view/'.$result['lead_id'].'"><i class="fa fa-search-plus"></i></a>
              <a class="btn btn-info" href="<?=base_url()?>Lead/edit/'.$result['lead_id'].'"><i class="fa fa-edit"></i></a>  
              <a class="btn btn-danger" href="<?=base_url()?>Lead/delete/'.$result['lead_id'].'"><i class="fa fa-trash-o"></i></a> 
            </td>
            <td>
              <div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-plus"></i></a>
                <div class="dropdown-menu dropdown-menu-right" style="padding: 5px;">
                  <a class="btn btn-success" href="https://wa.me/?text=<?=$text?>" target="_blank"><i class="fa fa-whatsapp"></i> To Agent</a>
                  <br><br>
                  <a class="btn btn-success" href="https://wa.me/+91'.$result['cmobile'].'?text='.$text2.'" target="_blank"><i class="fa fa-whatsapp"></i> To Client</a>
                </div>
              </div>
            </td>
          </tr>';
        }  

        $response = array('status' => true, 'output' => $output);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }






    /*public function msg() {

 

        $chatApiToken = ""; // Get it from https://www.phphive.info/255/get-whatsapp-password/

         

        $number = "918826269838"; // Number

        $message = "Hello :)"; // Message

         

        $curl = curl_init();

        curl_setopt_array($curl, array(

          CURLOPT_URL => 'http://chat-api.phphive.info/message/send/text',

          CURLOPT_RETURNTRANSFER => true,

          CURLOPT_ENCODING => '',

          CURLOPT_MAXREDIRS => 10,

          CURLOPT_TIMEOUT => 0,

          CURLOPT_FOLLOWLOCATION => true,

          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

          CURLOPT_CUSTOMREQUEST => 'POST',

          CURLOPT_POSTFIELDS =>json_encode(array("jid"=> $number."@s.whatsapp.net", "message" => $message)),

          CURLOPT_HTTPHEADER => array(

            'Authorization: Bearer '.$chatApiToken,

            'Content-Type: application/json'

          ),

        ));

         

        $response = curl_exec($curl);

        curl_close($curl);

        echo $response;

    }*/

	public function deactivate($id){
    	
        $this->WebModel->deactivate($id);

        redirect('dashboard');
    }
	public function hidedata(){
    
        $data['lead'] = $this->WebModel->hidedata('leadmaster');
      	$this->load->view('hidedata.php',$data); 
      
    }
  public function activate($id){
    
  	 	$this->WebModel->activate($id);
		redirect('dashboard');
  }
  
  public function hotlist($id){
  		$this->WebModel->hotlist($id);
		redirect('dashboard');
  }
	public function hotLead(){
    	
        $data['hotlist'] = $this->WebModel->list_common_hotlist();
        $this->load->view('hotLead.php',$data);
    }
  public function Not_Interested_Leads(){
      $data['Not_Interested_Leads'] = $this->WebModel->list_common_NotInterested();
      $this->load->view('Not_Interested_Leads.php',$data);
  }
  public function Not_Interested($id){
  		$this->WebModel->NotInterested($id);
		redirect('dashboard');
  }











}







?>