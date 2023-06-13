<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
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
            redirect('index');    
        }
        
        $data['user_details'] = $this->WebModel->list_common_where3("user","user_id",$this->session->userdata('lmssession_id'));
        $data['lead'] = $this->WebModel->list_common4('leadmaster','lead_id');  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
      	$this->load->view('dashboard.php',$data);          
    } 
	


    public function showquickfollowupdiv($id)
    {      
        $data['id'] = $id;    
        $data['followup'] = $this->WebModel->list_common('followup');
        $data['leadfollowup'] = $this->WebModel->list_common_where3('followupstatusmaster','lead_id',$id);
        $this->load->view('quickfollowup.php',$data);         
    } 


    public function showfiltereddatabyname($id = '') {      
        $data['lead'] = $this->WebModel->searchby('leadmaster','lead_id',$id, "");  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
        $this->load->view('changedresult.php',$data);         
    } 


    public function showfiltereddatabyemployee($id = '') {      
        $data['lead'] = $this->WebModel->searchbyemployee($id);  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
        $this->load->view('changedresult.php',$data);         
    } 


    public function showfiltereddatabyphone($id = '') {      
        $data['lead'] = $this->WebModel->searchby('leadmaster','lead_id',"",$id);  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
        $this->load->view('changedresult.php',$data);         
    } 


    public function showfiltereddatabylocation($id = '') {      
        $data['lead'] = $this->WebModel->searchbylocation('leadmaster','lead_id',$id);  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
        $this->load->view('changedresult.php',$data);         
    } 


    public function changedatadatewise() {      
        $fromdate = $this->input->post('fromdate');
        $todate = $this->input->post('todate');



        $data['lead'] = $this->WebModel->searchbydatefromto('leadmaster','lead_id',$id);  
        $data['user'] = $this->WebModel->list_common_where3('user','user_type','employee');
        $this->load->view('changedresult.php',$data);         
    } 



    public function updatelead() {
        $this->form_validation->set_rules('lead_id', "Lead Id", 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'lead_id' => form_error('lead_id')
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {

            date_default_timezone_set('Asia/Kolkata');
            $create_date = date('Y-m-d H:i:s'); 

            if(!empty($this->session->userdata('lmssession_id'))) {
                $session_id = $this->session->userdata('lmssession_id');
            }else if($this->session->userdata('usersession_id')) {
                $session_id = $this->session->userdata('usersession_id');
            }

            $savedata = array(
                'lead_id' => $this->input->post('lead_id'),
                'followup_id' => $this->input->post('followup'),
                'followup_date' => $this->input->post('date'),
                'followup_text' => $this->input->post('followup_dis'),
                'client_msg' => $this->input->post('followup_dis'),
                'created_by' => $session_id, 
                'create_date' => $create_date
            );
            $saved = $this->WebModel->insert_common('followupstatusmaster',$savedata);

            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'), 'followup' => $this->input->post('followup_dis'), 'id' => $this->input->post('lead_id'), 'followup_date' => $this->input->post('date'));
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($array));   
    }
  
  public function importcsv()
  {
  	require_once APPPATH . "./third_party/PHPExcel.php";
     	 $path = 'uploads/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('uploadFile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        if (!empty($data['upload_data']['file_name'])) {
            $import_xls_file = $data['upload_data']['file_name'];
        } else {
            $import_xls_file = 0;
        }

        $inputFileName = $path . $import_xls_file;
    
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $flag = true;
            $i=0;

            foreach ($allDataInSheet as $key => $value) {
              	
              	if($key > 1) {
                  	if(!empty($value['A'])) {
                        $inserdata['platform'] = $value['A'];
                        $inserdata['creservationDate'] = $value['B'];
                        $inserdata['cnotraveller'] = $value['C'];
                        $inserdata['cmobile'] = $value['D'];
                        $inserdata['cname'] = $value['E'];
                        $inserdata['cmobile'] = $value['F'];
                        $inserdata['cmail'] = $value['G'];
                        $inserdata['cfrom'] = $value['H'];
                      	$inserdata['cgoingTo'] = $value['I'];
                        $this->db->insert('leadmaster', $inserdata);
                    }  
                }
              
                $i++;                
            }
          
         redirect('Dashboard', 'refresh');


          
        } catch (Exception $e) {
           die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' .$e->getMessage());
        }

	
  
  
  
  }






}

?>