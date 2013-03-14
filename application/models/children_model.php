<?php
//Active records: Keys as column's => Values as data
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

		// If child name does not already exists, insert child name & user id to create unique id. 
		if (!$this->name_check($user_id, $name))
		{
			$this->db->insert('children', $data);
		}

		// Retireves unique id from database, and returns id
		$this->db->select('id'); 
		$this->db->where('user_id', $user_id);
		$this->db->where('name', $name);
		$query=$this->db->get('children');
		$result = $query->row_array();
		return $result['id'];
		
	} 

	public function name_check($user_id, $name) // Helper function
	{	
		// Retrieves any rows from database with the particular user_id 
  		$query = $this->db->get_where('children', array('user_id' => $user_id)); 
  		$result = $query->result_array();

  			// Runs loop to search for particular value, if found returns that value
			foreach($result as $key => $values) {
			if ($values['name'] == $name) {
			return $name;
			}
		}
	}

}