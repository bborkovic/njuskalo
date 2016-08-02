<?php
//require_once(LIB_PATH.DS."config.php");

class MySQLDatabase {
	
	private $connection;
	public $last_query;
	private $magic_quotes_active;
	private $real_escape_string_exists;

	
	
	function __construct() {
		$this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists( "mysqli_real_escape_string" );
	}

	public function open_connection() {
		try {
			$conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			die("Database connection failed " . $e->getMessage() );
		}
		$this->connection = $conn;
	}

	public function query($sql) {
		try {
			$sth = $this->connection->query($sql);
		} catch (Exception $e) {
			die("Database query failed ". $e->getMessage() );
		}
		return $sth;
	}

	public function fetch_array($result) {
		//
		return $result->fetchAll();
	}

	public function query_select_prepared($sql , $bind_array=[]) {
		try {
			$sth = $this->connection->prepare($sql);
			$sth->execute($bind_array);
		} catch (Exception $e) {
			global $error;
			$error->add_error($e->getMessage(), "class: Database, query_select_prepared");
			return false;
		}
		return $sth->fetchAll();
	}

	public function query_dml_prepared($sql , $bind_array=[]) {
		try {
			$sth = $this->connection->prepare($sql);
			$sth->execute($bind_array);
		} catch (Exception $e) {
			global $error;
			$error->add_error($e->getMessage(), "class: Database, query_dml_prepared");
			return false;
		}
		// returns number of rows processed
		return $sth->rowCount();
	}

	public function count_by_sql_prepared($sql, $bind_array=[]) {
		// sql must be select count(*) from where id = :id and name > :name
		$result_set = $this->query_select_prepared($sql, $bind_array);
		

		// result_set is array of records as hashes, get the first hash ( should be only one)
		$first_row = array_pop($result_set);
		
		// get only values from the hash
		$first_row_values = array_values($first_row);

		// return first one ( only one )
		return array_pop($first_row_values);
	}
	
	public function last_insert_id() {
		//
		return $this->connection->lastInsertId();
	}
}

$database = new MySQLDatabase();
$db =& $database;

?>