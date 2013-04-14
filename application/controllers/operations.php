<?php

class Operations extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('plan_model');
		$this->load->model('children_model');
    }

    public function index() { //gets all plans according to user ID

    	$data['userId'] = $this->ion_auth->get_user_id();
    	$query = $this->plan_model->get_plan($data);

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

    public function create() { //creates child & plan

    	// $this->authenticated();

    	$data = $this->input->json(false, true);

		$data['userId'] = $this->ion_auth->get_user_id(); 	// retrieves user id, then inputs it into $data array
		$data['childId'] = $this->children_model->add_child($data); // Send input to children_model, returns child_id required for plan_model.

		$query = $this->plan_model->add_plan($data); // Children_model returned an id to $child_id successfully

			if($query){

				$content = $query;
				$code = 'success';
				$redirect = '';

			}else{

				$this->output->set_status_header('400');

				$content = array(
					'Plan Model' => $this->plan_model->get_errors(),
					'Children Model' => $this->children_model->get_errors(),
					);
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

	public function show($id) { //gets plans according to child ID

		$query = $this->plan_model->get_plan($id);

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

	public function update($id) { //incoming data will need to be redesigned. 

		// $this->authenticated();

    	$data = $this->input->json(false, true);

		$query = $this->plan_model->update_plan($data);

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

	public function delete($id) {

		// $this->authenticated();

		$query = $this->plan_model->delete_plan($id);

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