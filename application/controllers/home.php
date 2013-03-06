<?php

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

	public function index()
	{
        $view_data = array(
							'header' => array(),
							'footer' => array(),
							'form_destination' => base_url() . '/home/login'

		);

		Template::compose('index', $view_data, 'default');

    }

    public function login() 
    {
		
		$this->form_validation->set_rules('set_username', 'Username', 'required');
		$this->form_validation->set_rules('set_password', 'Password', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('temp/error');
		}
		else
		{
			$this->user_model->set_username();
			$this->load->view('temp/success');

		}

		$query = $this->input->post('check_username');

		if ($query === TRUE) 
		{
			$this->user_model->check_username();
		}
    }



	/* public function table()
	{

		$view_data = array(
							'header' => array(
												'header_message' => 'THIS IS A HEADER MESSAGE',
										),
							'footer' => array(
												'footer_message' => 'THIS IS A FOOTER MESSAGE',
										),
							'row_data' => array(
													array(
															'name' => 'fgfdh',
															'id' => 'More rows to loop!'
													),
													array(
															'name' => 'fgfdh',
															'id' => 'Yay another loop!'
													),
										),
					);

	Template::compose('table', $view_data);

	} */

}

