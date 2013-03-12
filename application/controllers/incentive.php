<?php

class Incentive extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('reward_model');

    }

    public function create() 
    {
		$title = $this->input->post('title');
		$ribbon_cost = $this->input->post('ribbon_cost');
	
		$this->form_validation->set_rules('title', 'Reward name', 'required');
		$this->form_validation->set_rules('ribbon_cost', 'Ribbons', 'required');

		if($this->form_validation->run() == true){
			
			$user_id = $this->ion_auth->get_user_id();

			$this->reward_model->post_reward($title, $ribbon_cost, $user_id);
			
			redirect('main');

		
		}else{

			// //form validation not successful
			// $errors = trim(validation_errors()); //there's a bug in set_flashdata which dies when there's newline whitespace, we're just trimming it here to prevent any errors
			// $this->session->set_flashdata('message', $errors);
			// redirect($this->input->server('HTTP_REFERER'));
		}
	}


}