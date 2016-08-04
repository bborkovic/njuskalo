<?php  

class Comment extends DatabaseObject {

// override parent defaults
	protected static $table_name="comments";
	protected static $db_fields = array("id", "photograph_id", "created", "author", "body");
	 
// database fields
	public $id;
	public $photograph_id;
	public $created;
	public $author;
	public $body;

	// create instance of comment class
	public static function make( $photo_id, $author="Anonymous", $body="" ) {
		if(!empty($photo_id) && !empty($author) && !empty($body)) {
			$comment = new Comment();
			$comment->photograph_id = (int)$photo_id;
			$comment->created = strftime("%Y-%m-%d %H:%M:%S", time());
			$comment->author = $author;
			$comment->body = $body;
			return $comment;	
		} else {
			return false;
		}
	}

	// return all comments for particular photo
	public static function find_comments_on($photo_id) {
		global $database;
		$sql = " select * from " . self::$table_name . " ";
		//$sql .= " where photograph_id = " . $database->escape_value($photo_id);
		$sql .= " where photograph_id = " . $photo_id;
		$sql .= " order by created asc";
		return self::find_by_sql($sql);
	}
}


?>