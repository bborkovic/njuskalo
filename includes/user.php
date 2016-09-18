<?php 
require_once(LIB_PATH.DS."database.php");
class User extends DatabaseObject {
	
	// table the class is related
	public static $table_name = "users";
	protected static $db_fields = array('id','username','password','first_name','last_name','city,','adress,','post_number,','phone_number,','email');
	// columns of table users
	
	public $children = array(
		'Ad' => array( // Class Name
			'table_name' => 'ads',
			'foreign_key' => 'user_id'
			),
		'children2' => array( // This is class Name
			'table_name' => 'table_name',
			'foreign_key' => 'key_name'
			)
		);

	public $parents = array(
		);




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

	public $validation = array(
		"username" => array(
			"label" => "Username",
			"rule" => "alphaNumeric",
			"required" => true,
			"allowEmpty" => false,
			"maxlength" => 20,
			"minlength" => 5,
			"message" => "Username is not correct"
			),
		"first_name" => array(
			"label" => "First Name",
			"rule" => "alphaNumeric",
			"required" => false,
			"allowEmpty" => false,
			"maxlength" => 20,
			"minlength" => 5,
			"message" => "First name is not correct"
			)
	);





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
} // End of Class



// Instantiate current logged user class 
// so the username, and so on are available
if ( $session->is_logged_in() ) {
	$logged_user = User::find_by_id($session->user_id);
} else {
	$logged_user = new User();
}

?>