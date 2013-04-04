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
			'userId' => array(
				'set_label:User Id',
				'NotEmpty',
				'Number',
			),
			'nameOfChild' => array(
				'set_label:Childs Name',
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

				if(!$query) {
	 
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

		// Retrieves unique id from database, and returns id
		$this->db->select('id'); 
		$this->db->where('userId', $data['userId']); 
		$this->db->where('nameOfChild', $data['nameOfChild']); 
		$query = $this->db->get('children');


			if(!$query) {
	 
		       	$msg = $this->db->_error_message();
		        $num = $this->db->_error_number();
		        $last_query = $this->db->last_query();
					
		        log_message('error', 'Problem retireving child id: ' . $msg . ' (' . $num . '), using this query: "' . $last_query . '"');
					
				$this->errors = array(
					'database'	=> 'Problem retireving child id.',
					);
					
		        return false;

	        }else{

	        	$result = $query->row_array();
				return $result['id'];
	        }

	}

	public function get_child($data) {
	  	
	  	$this->db->select(); 
		$this->db->where('userId', $data['userId']);
		$this->db->where('id', $data['childId']);
		$query=$this->db->get('children');
		
		if($query->num_rows() > 0){
			$row = $query->row();
			$data = array(
				'id'				=> $id,
				'userId'			=> $row->userId,
				'nameOfChild'		=> $row->nameOfChild,
				'totalRibbon'		=> $row->totalRibbon,
				'spentRibbon'		=> $row->spentRibbon,
				'netRibbon'			=> $row->netRibbon,
				'totalPlan'			=> $row->totalPlan,
			);
			return $data;
		}else{
			$this->errors = array(
				'database'	=> 'Could not find specified child.',
			);
			return false;
		}
	}

	public function delete_child($data) { //May not be required
  		
  		$this->db->where('userId', $data['userId'])
  		$this->db->where('id', $data['childId'])
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

		// Retrieves any rows from database with the particular userId 
  		$query = $this->db->get_where('children', array('userId' => $data['userId'])); 
  		$result = $query->result_array();

  		// Runs loop to search for particular value, if found returns that value
		foreach($result as $key => $values) {
			if ($values['nameOfChild'] == $data['nameOfCchild']) {
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