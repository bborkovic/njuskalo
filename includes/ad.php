<?php 

class Ad extends DatabaseObject {

	// table the class is related
	protected static $table_name = "ads";
	protected static $db_fields = array('id','category_id','user_id','title','description');
	// columns of table users
	public $id;
	public $category_id;
	public $user_id;
	public $title;
	public $description;


}

?>