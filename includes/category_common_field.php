<?php 

class CategoryCommonField extends DatabaseObject {

	// table the class is related
	public static $table_name = "category_common_fields";
	protected static $db_fields 
		= array('id'
					, 'category_id'
					, 'common_field_id'
					, 'name'
					, 'template_type'
					, 'template_lov'
					);
	// columns of table users
	public $id;
	public $category_id;
	public $common_field_id;
	public $name;
	public $template_type;
	public $template_lov;
}

?>