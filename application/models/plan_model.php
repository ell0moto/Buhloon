<?php

class Plan_model extends CI_Model {

	public function __construct()
	{

	}

	public function add_plan($user_id, $children_id, $title, $description, $iteration, $specific_reward, $no_ribbon)
	{
		
		$data = array(
			'user_id' => $user_id,
			'children_id' => $children_id,
			'title' => $title,
			'description' => $description,
			'iteration' => $iteration,
			'specific_reward' => $specific_reward,
			'no_ribbon' => $no_ribbon,
		);
			
		return $this->db->insert('plan', $data);
	}


}