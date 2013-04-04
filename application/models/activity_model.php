<?php

use Polycademy\Validation\Validator;
//Active records: Keys as column's => Values as data
class Activity_model extends CI_Model {

	protected $validator;
	protected $errors;

	public function __construct() {
	
		parent::__construct();
		$this->validator = new Validator;
		
	}

	public function add_activity($data) {}

	public function get_activity($data) {
	  	
	  	$this->db->select(); 
		$this->db->where('userId', $data['userId']);
		$this->db->where('active'), 1);
		$query=$this->db->get('plan');
		
		if($query->num_rows() > 0){
			$row = $query->row();
			$data = array(
				'id'					=> $id,
				'userId'				=> $row->userId,
				'childId'				=> $row->childId,
				'nameOfChild'			=> $row->nameOfChild,
				'titleOfPlan'			=> $row->titleOfPlan,
				'currentIteration'		=> $row->currentIteration,
				'totalIteration'		=> $row->totalIteration,
				'specificReward'		=> $row->specificReward,
				'active'				=> $row->active,
			);
			return $data;
		}else{
			$this->errors = array(
				'database'	=> 'Could not find specified activity.',
			);
			return false;
		}
	}

	public function delete_activity($data) { //soft delete

		$this->validator->setup_rules(array(
			'userId' => array(
				'set_label:User Id',
				'Number',
			),
			'childId' => array(
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
  		$this->db->where('userId', $data['userId']);
  		$this->db->where('childId', $data['childId']);
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

	public function get_errors(){
		return $this->errors;
	}

}