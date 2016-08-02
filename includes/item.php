<?php 

class Item extends DatabaseObject {
	
	// table the class is related
	protected static $table_name = "items";
	protected static $db_fields = array("id", "name", "description", "age");
	
	// columns of table users
	public $id;
	public $name;
	public $description;
	public $age;



}

?>