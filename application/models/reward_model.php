<?php

use Polycademy\Validation\Validator;
//Active records: Keys as column's => Values as data
class Reward_model extends CI_Model {

	protected $validator;
	protected $errors;

	public function __construct() {
	
		parent::__construct();
		$this->validator = new Validator;
		
	}

	public function post_reward($data) {
		
		$this->validator->setup_rules(array(
			'userId' => array(
				'set_label:User ID',
				'NotEmpty',
				'Number',
			),
			'titleOfReward' => array(
				'set_label:Rewards title',
				'NotEmpty',
				'AlphaNumericSpace',
				'MinLength:3',
				'MaxLength:40',
			),
			'ribbonCost' => array(
				'set_label:Ribbon Cost',
				'NotEmpty',
				'Number',
				'NumRange:0,99',
			),
		));

		if(!$this->validator->is_valid($data)) {
		
		//returns array of key for data and value
		$this->errors = $this->validator->get_errors();
		return false;
			
		}
		
		$query = $this->db->insert('reward', $data);

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

	public function get_reward($id) {
	
		$query = $this->db->get_where('reward', array('userId' => $id)); //modified ID number
		
		if($query->num_rows() > 0){
			foreach ($query->result() as $row) {
				$data[] = array( //[] makes a dynamic array so that it's an array of an array

					'id'				=> $row->id,
					'userId'			=> $row->userId,
					'titleOfReward'		=> $row->titleOfReward,
					'ribbonCost'		=> $row->ribbonCost,
				);
			}
			return $data;
		}else{
			$this->errors = array(
				'database'	=> 'Could not find specified rewards.',
			);
			return false;
		}
		
	}

	public function delete_reward($id) {
  		
  		$this->db->where('id', $id);
  		// $this->db->where('userId', $data['userId']):
  		$this->db->delete('reward');
  		
  		if($this->db->affected_rows() > 0){
			return true;
		}else{
			$this->errors = array(
				'database'	=> 'Nothing to delete.',
			);
            return false;
		}

	}

	public function get_errors() {
		return $this->errors;
	}

}