<?php

class Operation extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('plan_model');
		$this->load->model('children_model');

    }

    public function add() 
    {
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$name = $this->input->post('name');
		$iteration = $this->input->post('iteration');
		$specific_reward = $this->input->post('specific_reward');
		$no_ribbon = $this->input->post('no_ribbon');
	
		$this->form_validation->set_rules('title', 'Goal name');
		$this->form_validation->set_rules('description', 'Short description');
		$this->form_validation->set_rules('name', 'User name');
		$this->form_validation->set_rules('iteration', 'Steps to achieve goal');
		$this->form_validation->set_rules('specific_reward', 'Short description'); //Not required to be required
		$this->form_validation->set_rules('no_ribbon', 'Number of ribbons');

		if($this->form_validation->run() == true)
		{

			$user_id = $this->ion_auth->get_user_id();

			$this->children_model->add_child($user_id, $name); //sends input to children_model for processing

			$query = $this->children_model->get_child($user_id, $name); //receives output back from children_model
			if (!empty($query))									
			{
				
				$firstkey = $query['0']; //Due to the way the array comes in from children_model
				$children_id = $firstkey['id'];

				$this->plan_model->add_plan($user_id, $children_id, $title, $description, $iteration, $specific_reward, $no_ribbon);
				redirect('main');
			}

			//put in a error message 
			FB::log($query, 'Please work');
			FB::log($children_id, 'One more time');
		
		}else{

			// //form validation not successful
			//$errors = trim(validation_errors()); //there's a bug in set_flashdata which dies when there's newline whitespace, we're just trimming it here to prevent any errors
			//$this->session->set_flashdata('message', $errors);
			// redirect($this->input->server('HTTP_REFERER'));
			//echo $errors;
		}
	}


}