<?php

class Plan_model extends CI_Model {

	public function __construct()
	{

	}

	public function add_plan($user_id, $child_id, $title, $description, $iteration, $specific_reward, $no_ribbon)
	{
		
		$data = array(
			'user_id' => $user_id,
			'child_id' => $child_id,
			'title' => $title,
			'description' => $description,
			'iteration' => $iteration,
			'specific_reward' => $specific_reward,
			'no_ribbon' => $no_ribbon,
		);
			
		return $this->db->insert('plan', $data);
	}

		public function get_plan($table, $user_id, $child_id, $single=FALSE) {
	  	
	  	$this->db->select(); 
		$this->db->where('user_id', $user_id);
		$this->db->where('child_id', $child_id);
		$query=$this->db->get($table);
	  	$result = $query->result_array();
	  		if($single) {
	    	return $result[0];
	  		}
	  		return $result;
	}

	public function delete_plan($table, $id, $user_id, $child_id) {
  		
  		$this->db->where('id', $id)
  		$this->db->where('user_id', $user_id)
  		$this->db->where('child_id', $child_id)
  		$this->db->delete($table);
  		return $this->db->affected_rows();
	}


}