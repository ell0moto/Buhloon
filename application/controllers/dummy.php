<?php

class Dummy extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
	
		$json_data = array(
			array(
				'message' => 'Hi!',
			),
			array(
				'message' => 'Hifdgfd!',
			),
			array(
				'message' => 'Hi!fdgdfg',
			),
			array(
				'message' => 'Hifgf!',
			),
			array(
				'message' => 'Hdfgdfi!',
			),
			array(
				'message' => 'Hidfgdfg!',
			),
			array(
				'message' => 'Hfdgdfgi!',
			),
			array(
				'message' => 'Hdfgdfgi!',
			),
		);
		
		Template::compose(false, $json_data, 'json');
	
	}

}