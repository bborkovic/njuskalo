<?php 

class AdCommonField extends DatabaseObject {

	// table the class is related
	protected static $table_name = "ad_common_fields";
	protected static $db_fields 
		= array('id'
				, 'ad_id'
				, 'common_field_id'
				, 'name'
				, 'value'
				);
	// columns of table users
	public $id;
	public $ad_id;
	public $common_field_id;
	public $name;
	public $value;

}

?>