<?php

class Notifications extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('plan_model');
		$this->load->model('obligation_model');
    }

    public function index() { //get all notifications

		$data['userId'] = $this->ion_auth->get_user_id(); 
    	$query = $this->plan_model->get_notices($data);
    	// $query = $this->obligation_model->get_obligations($data);

		if($query){

			$content = $query;
			$code = 'success';
			$redirect = '';

		}else{

			$this->output->set_status_header('404');
			$content = array(
				'Plan Model' => $this->plan_model->get_errors(),
				'Obligation Model' => $this->obligation_model->get_errors(),
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

    public function create() { //creates obligation

    	// $this->authenticated();

  //   	$data = $this->input->json(false, true);

		// $data['userId'] = $this->ion_auth->get_user_id(); 	// retrieves user id, then inputs it into $data array
		// $data['childId'] = $this->children_model->add_child($data); // Send input to children_model, returns child_id required for plan_model.

		// $query = $this->plan_model->add_plan($data); // Children_model returned an id to $child_id successfully

		// 	if($query){

		// 		$content = $query;
		// 		$code = 'success';
		// 		$redirect = '';

		// 	}else{

		// 		$this->output->set_status_header('400');

		// 		$content = array(
		// 			'Plan Model' => $this->plan_model->get_errors(),
		// 			'Children Model' => $this->children_model->get_errors(),
		// 			);
		// 		$code = 'error';
		// 		$redirect = '';
		// 	}

		// $output = array( 
		// 	'content' => $content,
		// 	'code' => $code,
		// 	'redirect' => $redirect,
		// 	);

		// Template::compose(false, $output, 'json');

	}

   	public function update($id) {}

	public function delete($id) { //soft delete
		
		// $this->authenticated();

		$data = $this->input->json(false, true);

		FB::log($data,'inside delete function NOTIFICATIONS CONTROLLER');
		
		// NEEDS TO BE MODIFIED FOR 2 UNIQUE INPUTS
		$query = $this->plan_model->soft_delete_plan($data); 
		
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