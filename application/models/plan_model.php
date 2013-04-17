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

	public function add_plan($data) { //*
		
		$this->validator->setup_rules(array(
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
			'titleOfPlan' => array(
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
			'totalIteration' => array(
				'set_label:Iterations',
				'NotEmpty',
				'Number',
				'NumRange:0,20',
			),
			'specificReward' => array(
				'set_label:Specific Reward',
				'AlphaNumericSpace',
				'MinLength:3',
				'MaxLength:20',
			),
			'noRibbon' => array(
				'set_label:Number of Ribbons',
				'Number',
				'NumRange:0,20',
			),
			'active' => array(
				'set_label:Active',
				'Number',
				'NumRange:0,1',
			),
			'progress' => array(
				'set_label:Progress',
				'Number',
				'NumRange:0,20',
			),
			'complete' => array(
				'set_label:Complete',
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

	        $rawOutPut = array( 
				'id' => $this->db->insert_id(),
				'childId' => $data['childId'],
				'userId' => $data['userId'],
			);

	    return $rawOutPut;
	}

	public function get_plan($data) {
	  	
	  	$this->db->select(); 
		$this->db->where('userId', $data['userId']);
		$query=$this->db->get('plan');

		if($query->num_rows() > 0){
			foreach ($query->result() as $row) {
				$output[] = array( //[] makes a dynamic array so that it's an array of an array
				'id'				=> $row->id,
				'userId'			=> $row->userId,
				'childId'			=> $row->childId,
				'nameOfChild'		=> $row->nameOfChild,
				'titleOfPlan'		=> $row->titleOfPlan,
				'description'		=> $row->description,
				'totalIteration'	=> $row->totalIteration,
				'progress'			=> $row->progress,
				'specificReward'	=> $row->specificReward,
				'noRibbon'			=> $row->noRibbon,
				'active'			=> $row->active,
				'complete'			=> $row->complete,
				);
			}
			return $output;
		}else{
			$this->errors = array(
				'database'	=> 'Could not find specified plans.',
			);
			return false;
		}
	}

	public function get_notices($data) { //*
	  	
	  	$this->db->select(); 
		$this->db->where('userId', $data['userId']);
		$this->db->where('active', 1);
		$query=$this->db->get('plan');

		if($query->num_rows() > 0){
			foreach ($query->result() as $row) {
				$output[] = array( //[] makes a dynamic array so that it's an array of an array
				'id'				=> $row->id,
				'userId'			=> $row->userId,
				'childId'			=> $row->childId,
				'nameOfChild'		=> $row->nameOfChild,
				'titleOfPlan'		=> $row->titleOfPlan,
				'description'		=> $row->description,
				'totalIteration'	=> $row->totalIteration,
				'progress'			=> $row->progress,
				'specificReward'	=> $row->specificReward,
				'noRibbon'			=> $row->noRibbon,
				'active'			=> $row->active,
				'complete'			=> $row->complete,
				);
			}
			return $output;
		}else{
			$this->errors = array(
				'database'	=> 'Could not find specified plans.',
			);
			return false;
		}
	}

	public function update_plan($data){ //update progress of plan
	
		$this->validator->setup_rules(array(
			'id' => array(
				'set_label:Plan id',
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
			'titleOfPlan' => array(
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
			'totalIteration' => array(
				'set_label:Iterations',
				'NotEmpty',
				'Number',
				'NumRange:0,20',
			),
			'specificReward' => array(
				'set_label:Specific Reward',
				'AlphaNumericSpace',
				'MinLength:3',
				'MaxLength:20',
			),
			'noRibbon' => array(
				'set_label:Number of Ribbons',
				'Number',
				'NumRange:0,20',
			),
			'active' => array(
				'set_label:Active',
				'Number',
				'NumRange:0,1',
			),
			'progress' => array(
				'set_label:Progress',
				'Number',
				'NumRange:0,20',
			),
			'complete' => array(
				'set_label:Complete',
				'Number',
				'NumRange:0,1',
			),
		));
		
		if(!$this->validator->is_valid($data)){
		
			$this->errors = $this->validator->get_errors();
			return false;
			
		}
		
  		$this->db->where('id', $data['id']);
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
			'id' => array(
				'set_label:Plan id',
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
			'titleOfPlan' => array(
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
			'totalIteration' => array(
				'set_label:Iterations',
				'NotEmpty',
				'Number',
				'NumRange:0,20',
			),
			'specificReward' => array(
				'set_label:Specific Reward',
				'AlphaNumericSpace',
				'MinLength:3',
				'MaxLength:20',
			),
			'noRibbon' => array(
				'set_label:Number of Ribbons',
				'Number',
				'NumRange:0,20',
			),
			'active' => array(
				'set_label:Active',
				'Number',
				'NumRange:0,1',
			),
			'progress' => array(
				'set_label:Progress',
				'Number',
				'NumRange:0,20',
			),
			'complete' => array(
				'set_label:Complete',
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
		$this->db->update('plan', $data);
  		
  		if($this->db->affected_rows() > 0){
			return true;
		}else{
			$this->errors = array(
				'database'	=> 'Nothing to soft delete.',
			);
            return false;
		}
	}

	public function delete_plan($id) {
  		
  		$this->db->where('id', $id);
  		// $this->db->where('userId', $data['userId']);
  		// $this->db->where('childId', $data['childId']);
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