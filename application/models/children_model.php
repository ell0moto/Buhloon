<?php

use Polycademy\Validation\Validator;
//Active records: Keys as column's => Values as data
class Children_model extends CI_Model {

	protected $validator;
	protected $errors;

	public function __construct() {
	
		parent::__construct();
		$this->validator = new Validator;
		
	}

	public function add_child($data) {

		$this->validator->setup_rules(array(
			'user_id' => array(
				'set_label:User Id',
				'NotEmpty',
				'Number',
			),
			'name' => array(
				'set_label:Name',
				'NotEmpty',
				'AlphaNumericSpace',
				'MinLength:3',
				'MaxLength:40',
			),
		));


		if(!$this->validator->is_valid($data)) {
		
		//returns array of key for data and value
		$this->errors = $this->validator->get_errors();
		return false;
			
		}

		// If child name does not already exists, insert child name & user id to create unique id. 
		if (!$this->name_check($data)) {

			$query = $this->db->insert('children', $data);

				if(!$query){
	 
		            $msg = $this->db->_error_message();
		            $num = $this->db->_error_number();
		            $last_query = $this->db->last_query();
					
		            log_message('error', 'Problem inserting to children table: ' . $msg . ' (' . $num . '), using this query: "' . $last_query . '"');
					
					$this->errors = array(
						'database'	=> 'Problem inserting data to children table.',
					);
					
		            return false;
	        	}

	        return $this->db->insert_id();
		}

		// Retireves unique id from database, and returns id
		$this->db->select('id'); 
		$this->db->where('user_id', $data['user_id']); 
		$this->db->where('name', $data['name']); 
		$query = $this->db->get('children');
		$result = $query->row_array();
		return $result['id'];

	}

	public function get_child_name($data) {

		$result = $this->get_children($data);

		foreach($result as $key => $values) {
			if ($values['id'] == $data['child_id']) {
			return $values['name']; //Will need to return as an array
			}else{
				return false;
			}
		}
	}

	public function get_child($data) {

		$result = $this->get_children($data);

		foreach($result as $key => $values) {
			if ($values['id'] == $data['child_id']) {
			return $values; //Will need to return as an array
			}else{
				return false;
			}
		}
	}

	public function get_children($data) {
	  	
	  	$this->db->select(); 
		$this->db->where('user_id', $data['user_id']);
		// $this->db->where('id', $data['child_id']);
		$query=$this->db->get('children');
		
		if($query->num_rows() > 0){
			$row = $query->row();
			$data = array(
				'id'				=> $id,
				'user_id'			=> $row->user_id,
				'name'				=> $row->name,
				'total_ribbon'		=> $row->total_ribbon,
				'spent_ribbon'		=> $row->spent_ribbon,
				'net_ribbon'		=> $row->net_ribbon,
				'total_plan'		=> $row->total_plan,
			);
			return $data;
		}else{
			$this->errors = array(
				'database'	=> 'Could not find specified child.',
			);
			return false;
		}
	}

	public function delete_child($data) {
  		
  		$this->db->where('user_id', $data['user_id'])
  		$this->db->where('id', $data['child_id'])
  		$this->db->delete('children');
  		
  		if($this->db->affected_rows() > 0){
			return true;
		}else{
			$this->errors = array(
				'database'	=> 'Nothing to delete.',
			);
            return false;
		}
	}


	public function name_check($data) { // Helper function 	

		// Retrieves any rows from database with the particular user_id 
  		$query = $this->db->get_where('children', array('user_id' => $data['user_id'])); 
  		$result = $query->result_array();

  		// Runs loop to search for particular value, if found returns that value
		foreach($result as $key => $values) {
			if ($values['name'] == $data['name']) {
			return true;
			}else{
				return false;
			}
		}
	}

	public function get_errors(){
		return $this->errors;
	}

}