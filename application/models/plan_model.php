<?php

use Polycademy\Validation\Validator; //READ UP ON NAMESPACES
//Active records: Keys as column's => Values as data
class Plan_model extends CI_Model {

	protected $validator;
	protected $errors;

	public function __construct() {
	
		parent::__construct();
		$this->validator = new Validator;
		
	}

	public function add_plan($data) {
		
		$this->validator->setup_rules(array(
			'user_id' => array(
				'set_label:User Id',
				'NotEmpty',
				'Number',
			),
			'child_id' => array(
				'set_label:Child Id',
				'NotEmpty',
				'Number',
			),
			'title' => array(
				'set_label:Title',
				'NotEmpty',
				'AlphaNumericSpace',
				'MinLength:3',
				'MaxLength:50',
			),
			'description' => array(
				'set_label:Description',
				'NotEmpty',
				'AlphaNumericSpace',
				'MinLength:3',
				'MaxLength:140',
			),
			'iteration' => array(
				'set_label:Iteration',
				'NotEmpty',
				'Number',
				'NumRange:0,20',
			),
			'specific_reward' => array(
				'set_label:Specific Reward',
				'AlphaNumericSpace',
				'MinLength:3',
				'MaxLength:20',
			),
			'no_ribbon' => array(
				'set_label:Number of Ribbons',
				'NotEmpty',
				'Number',
				'NumRange:0,20',
			),
		));

		if(!$this->validator->is_valid($data)) {
		
		//returns array of key for data and value
		$this->errors = $this->validator->get_errors();
		return false;
			
		}
			
		$query = $this->db->insert('plan', $data);

			if(!$query) {
	 
		        $msg = $this->db->_error_message();
		        $num = $this->db->_error_number();
		        $last_query = $this->db->last_query();
					
		        log_message('error', 'Problem inserting to plan table: ' . $msg . ' (' . $num . '), using this query: "' . $last_query . '"');
					
				$this->errors = array(
						'database'	=> 'Problem inserting data to plan table.',
				);
					
		            return false;
	        }

	    return $this->db->insert_id();
	}

	public function get_plan($data) {
	  	
	  	$this->db->select(); 
		$this->db->where('user_id', $data['user_id']);
		$this->db->where('child_id', $data['child_id']);
		$query=$this->db->get('plan');

		if($query->num_rows() > 0){
			$row = $query->row();
			$data = array(
				'id'				=> $id,
				'user_id'			=> $row->user_id,
				'child_id'			=> $row->child_id,
				'title'				=> $row->title,
				'description'		=> $row->description,
				'iteration'			=> $row->iteration,
				'progress'			=> $row->progress,
				'specific_reward'	=> $row->specific_reward,
				'no_ribbon'			=> $row->no_ribbon,
			);
			return $data;
		}else{
			$this->errors = array(
				'database'	=> 'Could not find specified plan.',
			);
			return false;
		}
	}

	public function delete_plan($data) {
  		
  		$this->db->where('id', $data['id'])
  		$this->db->where('user_id', $data['user_id'])
  		$this->db->where('child_id', $data['child_id'])
  		$this->db->delete('plan');

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