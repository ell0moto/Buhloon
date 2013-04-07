<?php

class Incentives extends CI_Controller {

    public function __construct() {
    	parent::__construct();
		$this->load->model('reward_model');
    }

    public function index() {

    	$id = $this->ion_auth->get_user_id(); 
		$query = $this->reward_model->get_reward($id);

		if($query){

			$content = $query;
			$code = 'success';
			$redirect = '';

		}else{

			$this->output->set_status_header('404');
			$content = $this->reward_model->get_errors();
			$code = 'error';
			$redirect = '';
		}

		$output = array( //Client Side .get will only accept an array of objects or an object. This creates an array of objects
			'content' => $content,
			'code' => $code,
			'redirect' => $redirect,
			);
		
		Template::compose(false, $output, 'json');

    }

    public function create() {

    	// $this->authenticated($data);

		$data = $this->input->json(false, true);

		$data['userId'] = $this->ion_auth->get_user_id(); 	// retrieves user id, then inputs it into $data array
		$query = $this->reward_model->post_reward($data);

		if($query){

			$content = $query;
			$code = 'success';
			$redirect = '';

		}else{

			$this->output->set_status_header('400');

			$content = $this->reward_model->get_errors();
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

	public function show($id) {}

	public function update($id) {}

	public function delete($id) {

		// $this->authenticated();

		$query = $this->reward_model->delete_reward($id);

		if($query){

			$content = $query;
			$code = 'success';
			$redirect = '';

		}else{

			$this->output->set_status_header('400');

			$content = $this->reward_model->get_errors();
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