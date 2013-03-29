<?php

class Incentives extends CI_Controller {

    public function __construct() {
    	parent::__construct();
		$this->load->model('reward_model');
    }

    public function index() {

    	$id = 2; //Modifed at this stage (REMOVE)

    	// $data['user_id'] = $this->ion_auth->get_user_id(); 
		$query = $this->reward_model->get_reward($id);

		if($query){
			foreach($query as &$reward) { //foreach loop required because input is multiple result array.
				$reward = output_message_mapper($reward);
			}
				$content = $query;
				$code = 'success';
				$redirect = '';
		}else{
			$this->output->set_status_header('404');
			$content = output_message_mapper($this->reward_model->get_errors());
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

    public function create() {

    	// $this->authenticated($data);

		$data = $this->input->json(false, true);
		$data = input_message_mapper($data); // takes camelcased keys and removes prefix and turns them into snake_case

		// $data['user_id'] = $this->ion_auth->get_user_id(); 	// retrieves user id, then inputs it into $data array
		$query = $this->reward_model->post_reward($data);

		if($query){

			$content = $query;
			$code = 'success';
			$redirect = '';

		}else{

			$this->output->set_status_header('400');

			$content = output_message_mapper($this->reward_model->get_errors());
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

			$content = output_message_mapper($this->reward_model->get_errors());
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