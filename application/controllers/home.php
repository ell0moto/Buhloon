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
			'form_destination_login' 	=> base_url() . 'sessions/login',
			'form_destination_register' => base_url() . 'sessions/register',
			'login_messages'	=> $login_messages,
			'login_messages2'	=> $login_messages2,
		);

		Template::compose('index', $this->view_data, 'default');
    }

  
}
