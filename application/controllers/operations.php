<?php

class Operations extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('plan_model');
		$this->load->model('children_model');
    }

    public function index() { //gets specific plan

		$data['user_id'] = $this->ion_auth->get_user_id(); 
    	$query = $this->plan_model->get_plan($data);

    	if($query){
			foreach($query as &$course){ //Will need to be modified as $course gets processed by message mapper
				$course = output_message_mapper($course);
			}
			$output = $query;
		}else{
			$this->output->set_status_header('404');
			$output = array(
				'error'			=> output_message_mapper($this->children_model->get_errors()),
				'error'			=> output_message_mapper($this->plan_model->get_errors()),
			);
		}
		
		Template::compose(false, $output, 'json');

    }

    public function create() { //creates child & plan

    	$this->authenticated();

    	$data = $this->input->json(false, true);
		$data = input_message_mapper($data); // takes camelcased keys and removes prefix and turns them into snake_case

		$data['user_id'] = $this->ion_auth->get_user_id(); 	// retrieves user id, then inputs it into $data array
		$data['child_id'] = $this->children_model->add_child($data); // Send input to children_model, returns child_id required for plan_model.

		if (!empty($child_id)) {

			$query = $this->plan_model->add_plan($data); // Children_model returned an id to $child_id successfully

			if($query) {

				$output = array(
				'status'		=> 'Created',
				'resourceId'	=> $query,
				);
			}else{

				$this->output->set_status_header('400');
				$output = array(
				'error'			=> output_message_mapper($this->plan_model->get_errors()),
				);
			}

			Template::compose(false, $output, 'json');
		
		}else{

			// Child_id unccessful
			//put in a error message 

		}
	}

	public function show() { //gets specific child details only

		$data['user_id'] = $this->ion_auth->get_user_id(); 
		$query = $this->children_model->get_child($data);

		if($query){
			$output = output_message_mapper($query);
		}else{
			$this->output->set_status_header('404');
			$output = array(
				'error'			=> output_message_mapper($this->children_model->get_errors()),
			);
		}
		
		Template::compose(false, $output, 'json');
	}

	public function update($id) {}

	public function delete($data) {

		$this->authenticated();

		$query = $this->plan_model->delete_plan($data);

		if($query){
			$output = array(
				'status'		=> 'Deleted',
				'resourceId'	=> $query,
			);
		}else{
			$this->output->set_status_header('400');
			$output = array(
				'error'			=> output_message_mapper($this->plan_model->get_errors()),
			);
		}
		
		Template::compose(false, $output, 'json');
	}

	protected function authenticated(){
	//check if person was authenticated
	}


}