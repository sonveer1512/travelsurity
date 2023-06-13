<?php

defined('BASEPATH') OR exit('No direct script access allowed');



Class WebModel extends CI_model {



	public function list_common($table){
		$this->db->select('*');
 		$this->db->from($table);	
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}


	public function list_common2($table,$order_by){
		$this->db->select('*');
 		$this->db->from($table);
 		$this->db->order_by($order_by,'desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function list_common3($table){
		$this->db->select('*');
 		$this->db->from($table);
 		$this->db->where('flag','0');		
 		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function list_common4($table,$order_by){
		$this->db->select('*');
 		$this->db->from($table);
 		$this->db->order_by($order_by,'desc');
 		//$this->db->limit(200);
      	$this->db->where('flag ','0');
 		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function calculate_sum($id) {
		$this->db->select_sum('booklet');
        $this->db->from('coupon_booklet');
        $this->db->where('id',$id);	
        $query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	

	public function list_common_where($table,$where,$id){

		$this->db->select('*');

		$this->db->where($where,$id);

 		$this->db->from($table);	

		$query = $this->db->get();

		$query = $query->result_array();

		foreach ($query as $row)

		 {

			$ads = $row;

		 }

		return $ads;

	}   

	

	public function list_common_where2($table,$where,$id){

		$this->db->select('*');

		$this->db->where($where,$id);

 		$this->db->from($table);	

 		$this->db->where('flag','0');

		$query = $this->db->get();

		$result = $query->result_array();

		return $result;

	}  





	public function list_common_where3($table,$where,$id){
		$this->db->select('*');
		$this->db->where($where,$id);
 		$this->db->from($table);	
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}  



	public function list_common_hotleads(){
		$this->db->select('*');
		$this->db->where('followup_id','4');
		$this->db->or_where('followup_id','7');
		$this->db->or_where('followup_id','8');
		$this->db->or_where('followup_id','9');
 		$this->db->from('followupstatusmaster');	
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}  



	public function leadfollowup($table,$where,$id){
		$this->db->select('*');
		$this->db->where($where,$id);
		$this->db->order_by('followupstatus_id','desc');
 		$this->db->from($table);	
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	} 


	public function leadfollowup2($table,$where,$id){
		$this->db->select('*');
		$this->db->where($where,$id);
		$this->db->order_by('followupstatus_id','desc');
		$this->db->limit(1);
 		$this->db->from($table);	
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}  

	public function list_common_leads($table,$where,$id) {
		$this->db->select('*');
		$this->db->where($where,$id);
 		$this->db->from($table);	
 		$this->db->limit(200);
 		$this->db->order_by('lead_id','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}



	public function list_common_last($id) {
		$this->db->select('*');
		$this->db->where('lead_id',$id);
 		$this->db->from('followupstatusmaster');
 		$this->db->order_by('followupstatus_id','desc');	
 		$this->db->limit(1);	
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}



	public function insert_common($table,$data){
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}


	public function update_common($table,$data,$where,$id){
		$this->db->where($where,$id);
		$this->db->update($table,$data);
		return true;
	}


	public function update_common_order($table,$data,$where,$id){
		$this->db->where($where,$id);
		$this->db->update($table,$data);
		$this->db->where('flag','0');
		return true;
	}

	

	public function update_common2($table,$data){
		$this->db->update($table,$data);
		return true;
	}
	

	public function delete_common($table,$where,$id){		
		$this->db->where($where,$id);
		$this->db->delete($table);
	}


	public function delete_lead($id) {
		$this->db->where('lead_id',$id);
      	$this->db->set('flag','2');
		$this->db->update('leadmaster');

		$this->db->where('lead_id',$id);
      	$this->db->set('flag','2');
		$this->db->update('followupstatusmaster');
	}


	public function login($email, $password)
    {
        $this->db->where('email_id', $email);
        $this->db->where('password', $password);
        $this->db->where('user_type !=','employee');
        $query = $this->db->get('user');
        if($query->num_rows() == 1) {
            return $query->row();
        }
        return false;
    }


    public function login2($email, $password)
    {
        $this->db->where('email_id', $email);
        $this->db->where('password', $password);
        $this->db->where('user_type', 'employee');
        $query = $this->db->get('user');
        if($query->num_rows() == 1) {
            return $query->row();
        }
        return false;
    }


    
    public function countrow($table) {
		$query = $this->db->query('SELECT * FROM '.$table);
		return $query->num_rows();
	}
	
	public function countrow1($table) {
		$query = $this->db->query('SELECT * FROM '.$table.' GROUP BY order_id');
		return $query->num_rows();
	}

	public function countrow2($category,$type) {
		if($type == 'all') {
			$query = $this->db->query('SELECT * FROM products WHERE category = '.$category.'');	
		}
		
		return $query->num_rows();
	}



	public function searchby($table,$order_by, $name = '', $phone = ''){
		$this->db->select('*');
 		$this->db->from($table);
 		$this->db->order_by($order_by,'desc');

 		if(!empty($name)) {
 			$this->db->where("cname LIKE '%$name%'");
 		}

 		if(!empty($phone)) {
 			$this->db->where("cmobile LIKE '%$phone%'");
 		}

 		$this->db->limit(200);	
 		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}


	public function searchbyemployee($id = ''){
		$this->db->select('*');
 		$this->db->from('leadmaster');
 		$this->db->order_by('lead_id','desc');
 		$this->db->where('assign_user_id',$id);
 		$this->db->limit(200);	
 		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}


	public function searchbylocation($table,$order_by, $location = ''){
		$this->db->select('*');
 		$this->db->from($table);
 		$this->db->order_by($order_by,'desc');

 		if(!empty($location)) {
 			$this->db->where("cgoingTo", $location);
 		}

 		$this->db->limit(200);	
 		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}



	public function searchbyuser($table,$order_by, $name = '', $phone = '',$user = ''){
		$this->db->select('*');
 		$this->db->from($table);
 		$this->db->order_by($order_by,'desc');

 		if(!empty($name)) {
 			$this->db->where("cname LIKE '%$name%'");
 		}

 		if(!empty($phone)) {
 			$this->db->where("cmobile LIKE '%$phone%'");
 		}

 		$this->db->where("assign_user_id",$user);
 		$this->db->limit(200);	
 		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}


	public function searchbylocationuser($table,$order_by, $location = '', $user = ''){
		$this->db->select('*');
 		$this->db->from($table);
 		$this->db->order_by($order_by,'desc');

 		if(!empty($location)) {
 			$this->db->where("cgoingTo", $location);
 		}

 		$this->db->where("assign_user_id",$user);
 		$this->db->limit(200);	
 		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}



	public function searchbydatefromto($table,$order_by, $fromdate, $todate){
		$this->db->select('*');
 		$this->db->from($table);
 		$this->db->order_by($order_by,'desc');

 		if(!empty($fromdate)) {
 			$this->db->where("cname LIKE '%$name%'");
 		}

 		if(!empty($todate)) {
 			$this->db->where("cmobile LIKE '%$phone%'");
 		}

 		$this->db->where("assign_user_id",$user);
 		$this->db->limit(200);	
 		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function deactivate($id) {
		$this->db->where_in('lead_id',$id);
       	$this->db->set('flag', '1');
		$this->db->update('leadmaster');
	}
  public function activate($id){
  		$this->db->where('lead_id',$id);
       	$this->db->set('flag', '0');
		$this->db->update('leadmaster');
  }
  
  public function hidedata($table){
  	$this->db->select('*');
 	$this->db->from($table);
    $this->db->where('flag','1');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
    
  }
  public function hotlist($id){
  		$this->db->where_in('lead_id',$id);
       	$this->db->set('flag', '3');
		$this->db->update('leadmaster');
  }
  public function list_common_hotlist(){
  	$this->db->select('*');
 	$this->db->from('leadmaster');
    $this->db->where('flag','3');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
	public function NotInterested($id){
    	$this->db->where_in('lead_id',$id);
       	$this->db->set('flag', '4');
		$this->db->update('leadmaster');
    }
  public function list_common_NotInterested(){
  	$this->db->select('*');
 	$this->db->from('leadmaster');
    $this->db->where('flag','4');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function selecteed_checkbox_delete($check_id){
  		$this->db->where_in('lead_id',$check_id);
    	$this->db->set('flag','2');
    	$this->db->update('leadmaster');
  }

}



?>