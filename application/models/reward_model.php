<?php
class Reward_model extends CI_Model {

	public function __construct()
	{
	}

	public function post_reward($title, $ribbon_cost, $user_id)
	{
		
		$data = array(
			'title' => $title,
			'ribbon_cost' => $ribbon_cost,
			'user_id' => $user_id,
		);
		
		return $this->db->insert('reward', $data);
	}

	public function get_reward($table, $where=array(), $single=FALSE) {
	  	
	  	$query = $this->db->get_where($table, $where);
	  	$result = $query->result_array();
	  		if($single) {
	    	return $result[0];
	  		}
	  		return $result;
	}

	public function delete_reward($table, $user_id, $reward_id) {
  		
  		$this->db->where('user_id', $user_id)
  		$this->db->where('id', $reward_id)
  		$this->db->delete($table);
  		return $this->db->affected_rows();
	}



}