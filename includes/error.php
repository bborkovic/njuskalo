<?php 

class Error {

	public $errors = [];

	public function add_error( $error_message="", $module="") {
		//
		array_push($this->errors, [ $error_message , $module ]);
	}

	public function get_errors() {
		// when errors are pulled , array of errors is cleared
		$return_errors = "";

		foreach ( $this->errors as $error) {
			$return_errors .= "; " . join(", " , $error);
		}
		return $return_errors;
	}
}

$error = new Error();


?>