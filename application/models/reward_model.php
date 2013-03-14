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

	public function get_reward($title, $ribbon_cost, $user_id)
	{
		
		$data = array(
			'title' => $title,
			'ribbon_cost' => $ribbon_cost,
			'user_id' => $user_id,
		);
		
		return $this->db->insert('reward', $data);


		function get($table,$where=array(),$single=FALSE) {
	  	$q = $this->db->get_where($table,$where);
	  	$result = $q->result_array();
	  		if($single) {
	    	return $result[0];
	  		}
	  		return $result;
		}

	}


}