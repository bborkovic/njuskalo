<?php 

class DatabaseObject {

	// static field that must be changed in every class
	protected static $table_name = "dummy";
	protected static $db_fields = array('id', 'dummy' ); // database columns
	// 

	// database columns:
	public $id;
	public $created_at; // saved in db as unsigned integers
	public $updated_at; // saved in db as unsigned integers
	// im mysql use function select unix_timestamp()
	// in php use function time()
	// $dt = new DateTime();
	// $dt->setTimestamp( $ts );

	// initialize object as not saved
	public $saved = false;

	// Static database methods
	public static function find_by_sql($sql="", $bind_array=[]) {
		global $database;
		$records = $database->query_select_prepared($sql , $bind_array);
		if($records) {
			$object_array = [];
			foreach ($records as $record) {
				$object_array[] = static::instantiate($record);
			}
			return $object_array;
		} else {
			return [];
		}
	}

	public static function find_by_id($id=0) {
		// use method find_by_sql
		$result = static::find_by_sql("select * from " . static::$table_name . " where id = :id limit 1" , [":id"=>$id]);
		return !empty($result) ? array_shift($result) : false;
	}

	public static function find_all() {
		//
		return static::find_by_sql("select * from " . static::$table_name);
	}

	public static function find_all_ordered( $order_columns = []) {
		$sql = "select * from " . static::$table_name;
		if( !empty($order_columns)) {
			$sql .= " order by " . join(', ' , $order_columns);
		}
		return static::find_by_sql( $sql );
	}

	public static function count_all(){
		global $database;
		return $database->count_by_sql_prepared("select count(*) from " . static::$table_name );
	}

	public static function count_by_sql($sql, $bind_array=[]){
		global $database;
		return $database->count_by_sql_prepared($sql, $bind_array);
	}

	private static function instantiate($record){
		
		$class_name = get_called_class();
		$object = new $class_name;

		foreach ($record as $attribute => $value) {
			if($object->has_attribute($attribute)){
				$object->$attribute = $value;
			}
		}
		$object->saved = true;
		return $object;
	}

	public function find_all_children($child_class_name) {
		
		$child_table_name = $child_class_name::$table_name;
		$foreign_key_name = strtolower( get_class($this) ) . "_id";
		// echo $child_class_name . " " . $child_table_name . " " . $foreign_key_name;
		$sql = "select * from {$child_table_name} where {$foreign_key_name} = :{$foreign_key_name}";
		$child_objects = $child_class_name::find_by_sql($sql,[$foreign_key_name => $this->id]);
		return $child_objects;
	}


 
	// helper methods
	private function has_attribute($attribute) {
		$object_vars = get_object_vars($this);
		return array_key_exists($attribute, $object_vars);
	}

	private function attributes() {
		$attributes = array();
		foreach( static::$db_fields as $field) {
			if ( property_exists($this, $field)) {
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	// End of heleper methods



	// Common CRUD methods
	public function create() {

		if( $this->saved ) { return false; }
		// insert existing instance object into database
		global $database;
		$attributes = $this->attributes();
		
		// id is set by database automatically
		unset($attributes["id"]);

		// array of n*?
		$sql = "insert into " . static::$table_name . " ";
		$sql .= " ( " . join(", ", array_keys($attributes) ) . " ) ";
		$sql .= " values (:" . join(', :' , array_keys($attributes)) . ')';

		if ( $database->query_dml_prepared($sql, $attributes) ) {
			$this->id = $database->last_insert_id();
			return true;
			$this->saved = true;
		} else {
			return false;
		}
	}

	// version with created_at and updated_at timestamps
	public function create_ts() {
		if( $this->saved ) { return false; }

		// this version includes timestamp attributes created_at,updated_at
		global $database;
		$attributes = $this->attributes();
		
		// id is set by database automatically
		unset($attributes["id"]);

		// array of n*?
		$sql = "insert into " . static::$table_name . " ";
		$sql .= " ( " . join(", ", array_keys($attributes) ) . " ,created_at,updated_at ) ";
		$sql .= " values (:" . join(', :' , array_keys($attributes)) . ' , unix_timestamp() , unix_timestamp())';
		if ( $database->query_dml_prepared($sql, $attributes) ) {
			$this->id = $database->last_insert_id();
			$this->saved = true;
			return true;
		} else {
			return false;
		}	
	}

	public function update() {
		// update existing instance object into database
		global $database;
		$attributes = $this->attributes();
		unset($attributes["id"]); // remove id from list
		$attributes_for_update = array();
		foreach($attributes as $k => $v) {
			$attributes_for_update[] = "{$k} = :{$k}";
		}

		$sql = "update " . static::$table_name . " ";
		$sql .= " set " . join(", ", $attributes_for_update) . " ";
		$sql .= " where id = :id";

		$attributes['id'] = $this->id;

		$records_updated = $database->query_dml_prepared($sql, $attributes);
		return $records_updated;
	}

	// version with created_at and updated_at timestamps
	public function update_ts() {
		// update existing instance object into database
		global $database;
		$attributes = $this->attributes();
		unset($attributes["id"]); // remove id from list
		$attributes_for_update = array();
		foreach($attributes as $k => $v) {
			$attributes_for_update[] = "{$k} = :{$k}";
		}

		$sql = "update " . static::$table_name . " ";
		$sql .= " set " . join(", ", $attributes_for_update) . " , updated_at = unix_timestamp() ";
		$sql .= " where id = :id";

		$attributes['id'] = $this->id;

		$records_updated = $database->query_dml_prepared($sql, $attributes);
		return $records_updated;
	}

	public function delete() {
		// insert existing instance object into database
		global $database;
		$sql = "delete from " . static::$table_name . " where id = :id limit 1";
		// echo $sql;
		$rows_deleted = $database->query_dml_prepared($sql, [ ":id" => $this->id ]);
		return ( $rows_deleted == 1 ) ? true : false;
	}
	// End of Common CRUD methods

}

?>