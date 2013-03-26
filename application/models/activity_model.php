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

	public function add_activity($data) {
		
		//Validator not required as retrieving database information (already validated)

		$query = $this->db->insert('activity', $data);

			if(!$query) {
		 
				$msg = $this->db->_error_message();
				$num = $this->db->_error_number();
				$last_query = $this->db->last_query();
							
				log_message('error', 'Problem inserting to reward table: ' . $msg . ' (' . $num . '), using this query: "' . $last_query . '"');
							
				$this->errors = array(
								'database'	=> 'Problem inserting data to reward table.',
						);
							
				return false;
			}

		return $this->db->insert_id();
	}

	public function get_activity($data) {
	  	
	  	$this->db->select(); 
		$this->db->where('user_id', $data['user_id']);
		$this->db->where('active'), 1);
		$query=$this->db->get('activity');
		
		if($query->num_rows() > 0){
			$row = $query->row();
			$data = array(
				'id'					=> $id,
				'user_id'				=> $row->user_id,
				'child_id'				=> $row->child_id,
				'name_of_child'			=> $row->name_of_child,
				'title_of_plan'			=> $row->title_of_plan,
				'current_iteration'		=> $row->current_iteration,
				'total_iteration'		=> $row->total_iteration,
				'specific_reward'		=> $row->specific_reward,
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

	public function get_errors(){
		return $this->errors;
	}

}