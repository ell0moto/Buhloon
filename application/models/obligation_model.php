<?php

use Polycademy\Validation\Validator; //READ UP ON NAMESPACES
//Active records: Keys as column's => Values as data
class Obligation_model extends CI_Model {

	protected $validator;
	protected $errors;

	public function __construct() {
	
		parent::__construct();
		$this->validator = new Validator;
		
	}

	public function add_obligation($data) {
		
		$this->validator->setup_rules(array(
			'id' => array(
				'set_label:Id',
				'NotEmpty',
				'Number',
			),
			'userId' => array(
				'set_label:User Id',
				'NotEmpty',
				'Number',
			),
			'childId' => array(
				'set_label:Child Id',
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
			'reward' => array(
				'set_label:Reward',
				'AlphaNumericSpace',
				'MinLength:3',
				'MaxLength:40',
			),
			'active' => array(
				'set_label:Active',
				'NotEmpty',
				'Number',
				'NumRange:0,1',
			),
		));

		if(!$this->validator->is_valid($data)) {
		
		//returns array of key for data and value
		$this->errors = $this->validator->get_errors();
		return false;
			
		}
			
		$query = $this->db->insert('obligation', $data);

			if(!$query) {
	 
		        $msg = $this->db->_error_message();
		        $num = $this->db->_error_number();
		        $last_query = $this->db->last_query();
					
		        log_message('error', 'Problem inserting to obligation table: ' . $msg . ' (' . $num . '), using this query: "' . $last_query . '"');
					
				$this->errors = array(
						'database'	=> 'Problem inserting data to obligation table.',
				);
					
		            return false;
	        }

	    return $this->db->insert_id();
	}

	public function get_obligations($data) {
	  	
	  	$this->db->select(); 
		$this->db->where('userId', $data['userId']);
		// $this->db->where('active'), 1);
		$query=$this->db->get('obligation');

		if($query->num_rows() > 0){
			$row = $query->row();
			$data = array(
				'id'				=> $row->id,
				'userId'			=> $row->userId,
				'childId'			=> $row->childId,
				'nameOfChild'		=> $row->nameOfChild,
				'reward'			=> $row->reward,
				'active'			=> $row->active,
			);
			return $data;
		}else{
			$this->errors = array(
				'database'	=> 'Could not find specified obligation.',
			);
			return false;
		}
	}


	public function soft_delete_obligation($data) { //Update obligation to be no longer active

		$this->validator->setup_rules(array(
			'id' => array(
				'set_label:Id',
				'NotEmpty',
				'Number',
			),
			'userId' => array(
				'set_label:User Id',
				'NotEmpty',
				'Number',
			),
			'childId' => array(
				'set_label:Child Id',
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
			'reward' => array(
				'set_label:Reward',
				'AlphaNumericSpace',
				'MinLength:3',
				'MaxLength:40',
			),
			'active' => array(
				'set_label:Active',
				'NotEmpty',
				'Number',
				'NumRange:0,1',
			),
		));
		
		if(!$this->validator->is_valid($data)){
		
			$this->errors = $this->validator->get_errors();
			return false;
			
		}
  		
  		$this->db->where('id', $data['id']);
  		// $this->db->where('userId', $data['userId']);
  		// $this->db->where('childId', $data['childId']);
		$this->db->update('obligation', $data);
  		
  		if($this->db->affected_rows() > 0){
			return true;
		}else{
			$this->errors = array(
				'database'	=> 'Nothing to delete.',
			);
            return false;
		}
	}

	public function get_errors(){
		return $this->errors;
	}

}