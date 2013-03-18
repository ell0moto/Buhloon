<?php

class Rest_model extends CI_Model {

	public $dummy_data;

	public function __construct () {

		parent::__construct();

		//here's some dummy data, that would in the database

		$this->dummy_data = array (
			array (
				'id' => '2',
				'name' => 'Tim',
				'power' => 'over 10,000'),

			array (
				'id' => '3',
				'name' => 'Hank',
				'power' => 'over 10,000'),

			array (
				'id' => '4',
				'name' => 'Sam',
				'power' => 'over 10,000'),

			);
	}

	public function read_all($limit = false, $offset = false) {

		//you would need to do db->select everything, then find out how many there is, and then iterate through it, and return it...

		foreach($this->dummy_data as $row) {

			$data[] = array (
				'id' => $row['id'],
				'name' => $row['name'],
				'power_magic' => $row['power'],
			);
		}

		return $data;
	}
}