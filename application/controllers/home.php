<?php

class Home extends CI_Controller {

	private $view_data = array(); //Unsure why we had to make view_data a property since it is autoloaded?

    public function __construct()
    {
        parent::__construct();

		//abstracted the commonly shared view data to the site_config.php file that is being autoloaded
		$this->view_data += $this->config->item('view_data');
    }

	public function index()
	{

		Template::compose('index', $this->view_data, 'default');
    }

  
}
