<?php

use Polycademy\Validation\Validator;

class Accounts extends CI_Controller{

	private $validator;

	public function __construct(){
		
		parent::__construct();
		
		$this->load->library('ion_auth');
		$this->validator = new Validator;
	
	}
	
	public function index(){
	
	}
	
	//show information about a particular user
	//only if the person is logged in and owner OR admin
	public function show($id){
	
		if($this->ion_auth->logged_in()){
			//logged in
			
			//check if the current user owns the id
			$current_user = $this->ion_auth->user()->row();
			
			if($current_user->id == $id OR $this->ion_auth->is_admin()){
			
				$selected_user = $this->ion_auth->user($id)->row();
				$groups = $this->ion_auth->get_users_groups($id)->result_array();
			
				//need group...
				$output = array(
					'content'	=> array(
						'id'			=> $selected_user->id,
						'ipAddress'		=> inet_ntop($selected_user->ipAddress), //processed from binary format, only used in MySQL...
						'username'		=> $selected_user->username,
						'email'			=> $selected_user->email,
						'createdOn'		=> $selected_user->createdOn,
						'lastLogin'		=> $selected_user->lastLogin,
						'active'		=> $selected_user->active,
						'groups'		=> $groups,
					),
					'code'		=> 'success',
				);
				
			}
			
		}else{
			//not logged in
		
			$this->output->set_status_header(401);
			
			$output = array(
				'content'	=> 'You are unauthorised to view user data without logging in.',
				'code'		=> 'error',
			);
		
		}
		
		Template::compose(false, $output, 'json');
		
	}
	
	//create a new user account
	public function create(){
	
		$data = $this->input->json(false, true);
		
		$this->validator->setup_rules(array(
			'username'		=> array(
				'set_label:Username',
				'NotEmpty',
				'AlphaNumericSpace',
				'MinLength:4',
				'MaxLength:100',
			),
			'password'		=> array(
				'set_label:Password',
				'NotEmpty',
				'AlphaSlug',
				'MinLength:8',
				'MaxLength:80'
			),
			// 'email'			=> array(
			// 	'set_label:Email',
			// 	'NotEmpty',
			// 	'Email',
			// 	'MinLength:4',
			// 	'MaxLength:100',
			// ),
			// 'firstName'		=> array(
			// 	'set_label:First Name',
			// 	'NotEmpty',
			// 	'AlphaNumericSpace',
			// 	'MinLength:2',
			// 	'MaxLength:50',
			// ),
			// 'lastName'		=> array(
			// 	'set_label:Last Name',
			// 	'NotEmpty',
			// 	'AlphaNumericSpace',
			// 	'MinLength:2',
			// 	'MaxLength:50',
			// ),
		));
		
		if(!$this->validator->is_valid($data)){
		
			$this->output->set_status_header(400);
			
			$output = array(
				'content'	=> $this->validator->get_errors(),
				'code'		=> 'validation_error',
			);
		
		}else{
		
			//cut the array, assumes that additional data is after username, password and email
			$additional_data = array_slice($data, 2);
			
			if($user_id = $this->ion_auth->register($data['username'], $data['password'])){
			// , $data['email'], $additional_data If ion_auth needs an initial email.
				$output = array(
					'content'	=> $user_id,
					'code'		=> 'success',
				);
			
			}else{
			
				$this->output->set_status_header(400);
				
				$output = array(
					'content'	=> $this->ion_auth->errors_array(),
					'code'		=> 'validation_error',
				);
			
			}
		
		}
		
		Template::compose(false, $output, 'json');
	
	}
	
	public function update($id){
		
	}
	
	public function delete($id){
		
	}

}