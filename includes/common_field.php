<?php 

class CommonField extends DatabaseObject {

	// table the class is related
	protected static $table_name = "common_fields";
	protected static $db_fields = array('id','name','template_type','template_lov');
	// columns of table users
	public $id;
	public $name;
	public $template_type;
	public $template_lov;





}

?>