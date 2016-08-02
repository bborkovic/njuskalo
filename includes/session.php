<?php 

// store just user_id in session

class Session {

	private $logged_id = false;
	public $user_id; // if it's logged in
	public $message;
	public $errors = [];

	function __construct(){
		session_start();
		$this->check_message();
		$this->check_login();
	}

	public function is_logged_in(){
		//
		return $this->logged_id;
	}

	public function login($user) {
		// database should find user based on username/password
		if($user){
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->logged_id = true;
		}
	}

	public function logout() {
		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->logged_id = false;
	}

	public function message($mess=[]){
		global $message;
		if(!empty($mess)) {
			$_SESSION['message'] = $mess; // important
			$message = $mess;
			return true;
		} else {
			// reset message - it's been read
			unset($_SESSION['message']);
			return $this->message;
		}
	}

	// public function message($mess=""){
	// 	global $message;
	// 	if(!empty($mess)) {
	// 		$_SESSION['message'] = $mess; // important
	// 		$message = $mess;
	// 		return true;
	// 	} else {
	// 		return $this->message;
	// 	}
	// }

	public function save_error($error, $module="") {
		array_push($this->errors , "Error: {$error}, Module: {$module}");
	}

	public function get_errors() {
		if( !empty($this->errors) ) {
			return join("; " , $this->errors);
		} else {
			return "";
		}
	}




	// private methods
	private function check_login() {
		if(isset($_SESSION['user_id'])) {
			$this->user_id = $_SESSION['user_id'];
			$this->logged_id = true;
		} else {
			unset($this->user_id);
			$this->logged_id=false;
		}
	}

	private function check_message() {
		if(isset($_SESSION['message'])) {
			$this->message = $_SESSION['message'];
		} else {
			$this->message = [];
		}
	}



}

$session = new Session();

// declare this variable so it's available 
$message = $session->message();
?>