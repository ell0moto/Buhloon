<?php

class Children_model extends CI_Model {

	public function __construct()
	{
	}

	public function add_child($user_id, $name)
	{
		
		$data = array(
			'user_id' => $user_id,
			'name' => $name,
		);
				
		$this->db->insert('children', $data); //inserting new data to create unique id

	}

	public function get_child($user_id, $name)
	{

		$this->db->select('id'); //getting unique id to be assigned children_id
		$this->db->where('user_id', $user_id); //('Column name', 'specific data in that column')
		$this->db->where('name', $name);

		$query=$this->db->get('children');

		return $query->result_array(); //returns information as an associated array

	}

}