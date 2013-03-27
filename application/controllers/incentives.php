<?php

class Incentives extends CI_Controller {

    public function __construct() {
    	parent::__construct();
		$this->load->model('reward_model');
    }

    public function index() {

    	$data['user_id'] = $this->ion_auth->get_user_id(); 
		$query = $this->reward_model->get_reward($data);

		if($query){
			$output = output_message_mapper($query);
		}else{
			$this->output->set_status_header('404');
			$output = array(
				'error'			=> output_message_mapper($this->reward_model->get_errors()),
			);
		}
		
		Template::compose(false, $output, 'json');

    }

    public function create() {

    	$this->authenticated();

		$data = $this->input->json(false, true);
		$data = input_message_mapper($data); // takes camelcased keys and removes prefix and turns them into snake_case

		$data['user_id'] = $this->ion_auth->get_user_id(); 	// retrieves user id, then inputs it into $data array
		$query = $this->reward_model->post_reward($data);

		if($query){
			$output = array(
				'status'		=> 'Created',
				'resourceId'	=> $query,
			);
		}else{
			$this->output->set_status_header('400');
			$output = array(
				'error'			=> output_message_mapper($this->reward_model->get_errors()),
			);
		}
		
		Template::compose(false, $output, 'json');

	}

	public function show($id) {}

	public function update($id) {}

	public function delete($data) {

		$this->authenticated();

		$query = $this->reward_model->delete_reward($data);

		if($query){
			$output = array(
				'status'		=> 'Deleted',
				'resourceId'	=> $query,
			);
		}else{
			$this->output->set_status_header('400');
			$output = array(
				'error'			=> output_message_mapper($this->reward_model->get_errors()),
			);
		}
		
		Template::compose(false, $output, 'json');
	}

	protected function authenticated(){
	//check if person was authenticated
	}

}