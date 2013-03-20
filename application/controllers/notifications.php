<?php

class Notifications extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('activity_model');
		$this->load->model('obligation_model');
    }

    public function index() {

    }

	public function delete($id) { //soft delete

	} 

	protected function authenticated(){
	//check if person was authenticated
	}


}