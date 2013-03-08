<?php
class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function set_username()
	{
		
		$data = array(
			'username' => $this->input->post('set_username'),
			'password' => $this->input->post('set_password')
		);
								
		return $this->db->insert('user', $data);
	}

	public function login($username, $password)
	 {
	   $this->db->select('id, username, password');
	   $this->db->from('user');
	   $this->db->where('username', $username);
	   $this->db->where('password', MD5($password));
	   $this->db->limit(1);

	   $query = $this->db->get();

	   if($query->num_rows() == 1) //num_rows() returns the number of rows from the ab get()
	   {
	     return $query->result(); //result() returns the query result as an array of objects
	   }
	   else
	   {
	     return false;
	   }
	 }


}



