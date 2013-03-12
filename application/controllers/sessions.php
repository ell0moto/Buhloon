<?php

class Sessions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

		$this->load->library('form_validation');

    }

    public function login() 
    {

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == true){
			
			if($this->ion_auth->login($username, $password)){ //login input is ran to the ionAuth 'login' model & returns a boolean. 
			
				//login successful
				redirect('main');
				return $username;

			}else{
			
				//login not successful
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect($this->input->server('HTTP_REFERER'));
			}
		
		}else{

			//form validation not successful
			$errors = trim(validation_errors()); //there's a bug in set_flashdata which dies when there's newline whitespace, we're just trimming it here to prevent any errors
			$this->session->set_flashdata('message', $errors);
			redirect($this->input->server('HTTP_REFERER'));
		}
	}


    public function register() 
    {
    	$username = $this->input->post('username');
		$password = $this->input->post('password');
	
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == true){
			
			if($this->ion_auth->register($username, $password)){ //login input is ran to the ionAuth 'login' model & returns a boolean. 
			
				//registration successful
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('home');
			}else{
			
				//registration not successful
				//$this->session->set_flashdata('message2', $this->ion_auth->errors());
				redirect($this->input->server('HTTP_REFERER'));
			}
		
		}else{

			//form validation not successful
			//$errors = trim(validation_errors()); //there's a bug in set_flashdata which dies when there's newline whitespace, we're just trimming it here to prevent any errors
			//$this->session->set_flashdata('message2', $errors);
			redirect($this->input->server('HTTP_REFERER'));
		}
    }

    //log a user with the id of $id
	//make sure to authenticate the request that the person actually owns the $id
	public function logout(){
	
		$this->ion_auth->logout();
		redirect('home');
	
	}

}