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

	//return child photos
	public function find_all_images() { 
		$sql = " select * from photographs ";
		$sql .= " where ad_id = :ad_id";
		return Photograph::find_by_sql($sql, [":ad_id"=>$this->id]);
	}

	// return child fields
	public function find_all_fields() { 
		$sql = " select * from ad_common_fields ";
		$sql .= " where ad_id = :ad_id";
		return AdCommonField::find_by_sql($sql, [":ad_id"=>$this->id]);
	}




}

?>