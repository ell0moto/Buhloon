<?php

class Dummy extends CI_Controller{

	public function __construct() {
		parent::__contstruct();

	}

	public function index() {

		$json_data = array(
			'message' => 'Hi!',
		);

		Template::compose(false, $json_data, 'json');
	}
}