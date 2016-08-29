<?php 
require_once(LIB_PATH.DS."database.php");
class User extends DatabaseObject {
	
	// table the class is related
	public static $table_name = "users";
	protected static $db_fields = array('id','username','password','first_name','last_name','city,','adress,','post_number,','phone_number,','email');
	// columns of table users
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $city;
	public $adress;
	public $post_number;
	public $phone_number;
	public $email;


	public static function authenticate($username="", $password="") {
		global $database;
		// $username = $database->escape_value($username);
		// $password = $database->escape_value($password);
		$sql = "select * from users ";
		$sql .= "where username = :username ";
		$sql .= " and password = :password ";
		$sql .= " limit 1";

		$result_array = self::find_by_sql($sql , [":username"=>$username , ":password"=>$password]);
		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public function full_name() {
		// returns full name if there is instance
		return $this->first_name . " " . $this->last_name;
	}
}

// Instantiate current logged user class 
// so the username, and so on are available
if ( $session->is_logged_in() ) {
	$logged_user = User::find_by_id($session->user_id);
} else {
	$logged_user = new User();
}

?>