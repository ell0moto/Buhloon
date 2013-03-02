<?php

class Home extends CI_Controller {

    public function __construct(){
 
        parent::__construct();
    }

	public function index(){
        
        $view_data = array(
			'header' => array(
				'header_message' => 'THIS IS A HEADER MESSAGE',
			),
			'footer' => array(
				'footer_message' => 'THIS IS A FOOTER MESSAGE',
			),
			'message' => 'THIS IS A STANDARD MESSAGE for the INDEX VIEW',
		);

		Template::compose('index', $view_data);
        
    }

	public function table(){

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

	}

}

