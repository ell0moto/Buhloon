<?php

/**
 * Replaces the core exceptions library
 * Makes all errors come back as JSON data, which will be in the format of
 * {content: '', code: ''}
 * Also with the appropriate HTTP status code
 */
class MY_Exceptions extends CI_Exceptions{

	public function show_error($heading, $message, $template = 'error_general', $status_code = 500){
	
		//set the HTTP code
		set_status_header($status_code);
		
		//implode the messages if they are an array
		if(is_array($message)){
			implode(' ', $message);
		}
		
		//adding the heading to the message as well
		$message = $heading . ' ' . $message;
		
		//the $code will be a system error if the status code starts with 5
		//otherwise it will always be error
		$code = ($status_code[0] == 5) ? 'system_error' : 'error';

		if (ob_get_level() > $this->ob_level + 1)
		{
			ob_end_flush();
		}
		ob_start();
		
		//send out the output!
		header('Content-type: application/json');
		$output = array(
			'content'	=> $message,
			'code'		=> $code,
		);
		echo json_encode($output, JSON_NUMERIC_CHECK);
		
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	
	}
	
	public function show_php_error($severity, $message, $filepath, $line){
	
		//set the status header to a 500 code
		set_status_header(500);
	
		$severity = isset($this->levels[$severity]) ? $this->levels[$severity] : $severity;
		
		$filepath = str_replace('\\', '/', $filepath);

		// For safety reasons we do not show the full file path
		if (FALSE !== strpos($filepath, '/')){
			$x = explode('/', $filepath);
			$filepath = $x[count($x)-2].'/'.end($x);
		}

		if (ob_get_level() > $this->ob_level + 1){
			ob_end_flush();
		}
		ob_start();
		
		//possible backtrace
		if(defined('SHOW_DEBUG_BACKTRACE') AND SHOW_DEBUG_BACKTRACE === TRUE){
			foreach(debug_backtrace() as $error){
				if(isset($error['file']) AND strpos($error['file'], realpath(BASEPATH)) !== 0){
					$backtrace[] = array(
						'file'		=> $error['file'],
						'line'		=> $error['line'],
						'function'	=> $error['function'],
					);
				}
			}
		}
		
		//ok we need to return this php error object
		$php_errors = array(
			'severity'		=> $severity,
			'message'		=> $message,
			'filename'		=> $filepath,
			'lineNumber'	=> $line,
			'backtrace'		=> $backtrace,
		);
		
		//send out the output!
		header('Content-type: application/json');
		$output = array(
			'content'	=> $php_errors,
			'code'		=> 'system_error',
		);
		echo json_encode($output, JSON_NUMERIC_CHECK);
		
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;
		
	}
	
}