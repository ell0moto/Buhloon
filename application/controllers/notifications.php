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
			foreach($query as &$course){ //Will need to be modified as $course gets processed by message mapper
				$course = output_message_mapper($course);
			}
			$output = $query;
		}else{
			$this->output->set_status_header('404');
			$output = array(
				'error'			=> output_message_mapper($this->activity_model->get_errors()),
				'error'			=> output_message_mapper($this->obligation_model->get_errors()),
			);
		}
		
		Template::compose(false, $output, 'json');
    }

   	public function update($id) {}

	public function delete($data) { //soft delete
		
		$this->authenticated();
		
		$query = $this->plan_model->soft_delete_plan($data); //
		
		if($query){
			$output = array(
				'status'		=> 'Deleted',
				'resourceId'	=> $id,
			);
		}else{
			$this->output->set_status_header('204');
			$output = array(
				'error'			=> output_message_mapper($this->plan_model->get_errors()),
			);
		}
		
	}
	} 

	protected function authenticated(){
	//check if person was authenticated
	}


}