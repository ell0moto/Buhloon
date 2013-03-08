<?php

class Main extends CI_Controller {

	private $view_data = array();

    public function __construct(){
 
        parent::__construct();
        
        $this->load->library('session');
		$this->load->library('form_validation');
		//abstracted the commonly shared view data to the site_config.php file that is being autoloaded
		$this->view_data += $this->config->item('view_data');
    }

    public function index()
	{

		// if (first section = true) display (first section 'login message') else (first section = false)
		$login_messages = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : false;
		$login_messages2 = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : false;

		$this->view_data += array(
			'form_destination' 	=> base_url() . 'home/login',
			'form_destination2' => base_url() . 'home/register',
			'login_messages'	=> $login_messages,
			'login_messages2'	=> $login_messages2,
		);

		Template::compose('index', $this->view_data, 'default');

    }

    //log a user with the id of $id
	//make sure to authenticate the request that the person actually owns the $id
	public function logout(){
	
		$this->ion_auth->logout();
		redirect($this->input->server['HTTP_REFERER']);
	
	}

}