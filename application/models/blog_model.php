<?php

class Blog_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function create($item) {
		$data = array(
				'title' => $item,
			);
			//insert into the blog table, using the $data array
			$this->db->insert('blog', $data);

		return $this->db->insert_id();
	}

	public function read_all() {
		
		$this->db->select('*')->from('blog');

		$blog_result = $this->db->get();

		if($blog_result->num_rows() > 0) {

			$blog_result = $blog_result->result_array();
			return $blog_result;

		}else{
			return false;
		}
	}
}