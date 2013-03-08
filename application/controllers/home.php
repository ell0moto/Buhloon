<?php

class Home extends CI_Controller {

	private $view_data = array(); //Unsure why we had to make view_data a property since it is autoloaded?

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
		$this->load->library('form_validation');
		//abstracted the commonly shared view data to the site_config.php file that is being autoloaded
		$this->view_data += $this->config->item('view_data');
    }

	public function index()
	{
		//Checks to see if already logged in
		if($this->ion_auth->logged_in()){
			redirect(base_url() . 'main');
		}

		// if (first section = true) display (first section 'login message') else (first section = false)
		$login_messages = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : false;
		$login_messages2 = ($this->session->flashdata('message2')) ? $this->session->flashdata('message') : false;

		$this->view_data += array(
			'form_destination' 	=> base_url() . 'home/login',
			'form_destination2' => base_url() . 'home/register',
			'login_messages'	=> $login_messages,
			'login_messages2'	=> $login_messages2,
		);

		Template::compose('index', $this->view_data, 'default');
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
				redirect(base_url() . 'main');
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



}

