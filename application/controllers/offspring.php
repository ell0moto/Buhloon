<?php

class Offspring extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('children_model');
    }

    public function index() { //gets all children according to specific user ID

		$data['userId'] = $this->ion_auth->get_user_id(); 
    	$query = $this->children_model->get_child($data);

		if($query){

			$content = $query;
			$code = 'success';
			$redirect = '';

		}else{

			$this->output->set_status_header('404');
			$content = $this->children_model->get_errors();
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

    public function create() {} //operations controller 

	public function show($id) { //gets specific child details only

		$query = $this->children_model->get_child($id);

		if($query){

			$content = $query;
			$code = 'success';
			$redirect = '';

		}else{

			$this->output->set_status_header('404');
			$content = $this->children_model->get_errors();
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

	public function update($id) { 

		// $this->authenticated();

    	$data = $this->input->json(false, true);

		$query = $this->children_model->update_child($data);

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

	public function delete($data) {}

	protected function authenticated(){
	//check if person was authenticated
	}


}