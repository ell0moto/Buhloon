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
			'name_of_child' => array(
				'set_label:Childs Name',
				'NotEmpty',
				'AlphaNumericSpace',
				'MinLength:3',
				'MaxLength:40',
			),
			'title_of_plan' => array(
				'set_label:Plans title',
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
			'total_iteration' => array(
				'set_label:Iterations',
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
		$this->db->where('child_id', $data['child_id']); //Will need to be redesigned for get plan specific to child and get plan for user_id only
		$this->db->where('active'), $data); //Modify to get plans with 0 and 1 active or plans with 1 active.
		$query=$this->db->get('plan');

		if($query->num_rows() > 0){
			$row = $query->row();
			$data = array(
				'id'				=> $id,
				'user_id'			=> $row->user_id,
				'child_id'			=> $row->child_id,
				'name_of_child'		=> $row->name_of_child,
				'title_of_plan'		=> $row->title_of_plan,
				'description'		=> $row->description,
				'total_iteration'	=> $row->total_iteration,
				'progress'			=> $row->progress,
				'specific_reward'	=> $row->specific_reward,
				'no_ribbon'			=> $row->no_ribbon,
				'active'			=> $row->active,
			);
			return $data;
		}else{
			$this->errors = array(
				'database'	=> 'Could not find specified plan.',
			);
			return false;
		}
	}

	public function update_plan($id, $data){ //update progress of plan
	
		$this->validator->setup_rules(array(
			'user_id' => array(
				'set_label:User Id',
				'Number',
			),
			'child_id' => array(
				'set_label:Child Id',
				'Number',
			),
			'progress' => array(
				'set_label:Active',
				'Number',
				'NumRange:0,1',
			),
		));
		
		if(!$this->validator->is_valid($data)){
		
			$this->errors = $this->validator->get_errors();
			return false;
			
		}
		
  		$this->db->where('id', $data['id']);
  		$this->db->where('user_id', $data['user_id']);
  		$this->db->where('child_id', $data['child_id']);
		$this->db->update('plan', $data);
		
		//greated or equal to zero (means update worked)
		if($this->db->affected_rows() > 0){
		
			return true;
		
		}else{
			
			$this->errors = array(
				'database'	=> 'Nothing to update.',
			);
            return false;
		
		}
	
	}

	public function soft_delete_plan($data) { //Update plan to be no longer active

		$this->validator->setup_rules(array(
			'user_id' => array(
				'set_label:User Id',
				'Number',
			),
			'child_id' => array(
				'set_label:Child Id',
				'Number',
			),
			'active' => array(
				'set_label:Active',
				'Number',
				'NumRange:0,1',
			),
		));
		
		if(!$this->validator->is_valid($data)){
		
			$this->errors = $this->validator->get_errors();
			return false;
			
		}
  		
  		$this->db->where('id', $data['id']);
  		$this->db->where('user_id', $data['user_id']);
  		$this->db->where('child_id', $data['child_id']);
		$this->db->update('plan', $data);
  		
  		if($this->db->affected_rows() > 0){
			return true;
		}else{
			$this->errors = array(
				'database'	=> 'Nothing to delete.',
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