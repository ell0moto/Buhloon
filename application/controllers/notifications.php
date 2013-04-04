<?php

class Notifications extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('activity_model');
		$this->load->model('obligation_model');
    }

    public function index($data) { //get all notifications

		$data['user_id'] = $this->ion_auth->get_user_id(); 
    	$query = $this->plan_model->get_plan($data); //gets plan notifications

		if($query){

			$content = $query;
			$code = 'success';
			$redirect = '';

		}else{

			$this->output->set_status_header('404');
			$content = $this->plan_model->get_errors();
			$code = 'error';
			$redirect = '';
		}

		$output = array( //Client Side .query is expecting an array, that is why we have done it like this.
			'content' => $content,
			'code' => $code,
			'redirect' => $redirect,
			);
		
		Template::compose(false, $output, 'json');
    }

   	public function update($id) {}

	public function delete($data) { //soft delete
		
		$this->authenticated();
		
		$query = $this->plan_model->soft_delete_plan($data); //
		
		if($query){

			$content = $query;
			$code = 'success';
			$redirect = '';

		}else{

			$this->output->set_status_header('400');

			$content = $this->plan_model->get_errors();
			$code = 'error';
			$redirect = '';
		}

		$output = array(
			'content' => $content,
			'code' => $code,
			'redirect' => $redirect,
			);
		
		Template::compose(false, $output, 'json');
		
	}

	protected function authenticated(){
	//check if person was authenticated
	}


}