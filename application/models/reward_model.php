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
			'user_id' => array(
				'set_label:User Id',
				'NotEmpty',
				'Number',
			),
			'title_of_reward' => array(
				'set_label:Rewards title',
				'NotEmpty',
				'AlphaNumericSpace',
				'MinLength:3',
				'MaxLength:40',
			),
			'ribbon_cost' => array(
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

	public function get_reward($data) {
	
		$query = $this->db->get_where('reward', array('user_id' => $data['user_id']));
		
		if($query->num_rows() > 0){
			$row = $query->row();
			$data = array(
				'id'				=> $id,
				'user_id'			=> $row->user_id,
				'title_of_reward'	=> $row->title_of_reward,
				'ribbon_cost'		=> $row->ribbon_cost,
			);
			return $data;
		}else{
			$this->errors = array(
				'database'	=> 'Could not find specified rewards.',
			);
			return false;
		}
		
	}

	public function delete_reward($data) {
  		
  		$this->db->where('id', $data['id'])
  		$this->db->where('user_id', $data['user_id'])
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