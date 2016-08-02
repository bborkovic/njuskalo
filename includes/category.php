<?php 

class Category extends DatabaseObject {

	// table the class is related
	protected static $table_name = "categories";
	protected static $db_fields = array('id','parent_cat_id','name','description');
	// columns of table users
	public $id;
	public $parent_cat_id;
	public $name;
	public $description;

	public static function find_all_parents($id="", $root_id="") {
		$array_of_parents = array();
		if( empty($id) || empty($root_id)) {
			return $array_of_parents;
		} else {
			while( true ) {
				$category = Category::find_by_id($id);
				$array_of_parents[] = $category;
				if ( $id == $root_id ) { break; }
				$id = $category->parent_cat_id;
			}
			return array_reverse($array_of_parents);
		}
	}

	public static function find_root_id() {
		//
		return 4;
	}

	public static function get_subcategories($id) {
		$categories = Category::find_by_sql("select * from categories where parent_cat_id = :id and name <> 'root'", [":id"=>$id]);
		return $categories;
	}

	public function has_children_category() {
		$cnt = Category::count_by_sql("select count(*) from categories where parent_cat_id=:id", [":id"=>($this->id)]);
		return ( $cnt == 0 ) ? false : true;
	}

	// public static function has_children_category($id) {
	// 	$cnt = self::count_by_sql("select count(*) from categories where parent_cat_id=:id", [":id"=>$id]);
	// 	return ( $cnt == 0 ) ? false : true;
	// }



}

?>