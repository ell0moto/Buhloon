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
		
		FB::log($data);			
		return $this->db->insert('reward', $data);
	}


}