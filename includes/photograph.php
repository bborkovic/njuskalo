<?php  

class Photograph extends DatabaseObject {

// override parent defaults
	protected static $table_name="photographs";
	protected static $db_fields = array("id", "filename", "type", "size", "caption");
	
// database fields
	public $id;
	public $filename;
	public $type;
	public $size;
	public $caption;

// additional variables
	private $temp_path;
	protected $upload_dir="images";
	public $errors = array();
	protected $upload_errors = array(
		// http://www.php.net/manual/en/features.file-upload.errors.php
		UPLOAD_ERR_OK 				=> "No errors.",
		UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
		UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
		UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
		UPLOAD_ERR_NO_FILE 		=> "No file.",
		UPLOAD_ERR_NO_TMP_DIR 	=> "No temporary directory.",
		UPLOAD_ERR_CANT_WRITE 	=> "Can't write to disk.",
		UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
	);

// Pass in $_FILE['uploaded_file']
	public function attach_file( $file ) { 
		// performing error checking
		if(!$file || empty($file) || !is_array($file)) {
			$this->errors[] = "No file was uploaded";
			return false;
		} elseif ( $file['error'] != 0) {
			// error, report what PHP says went wrong
			$this->errors[] = $this->upload_errors[$file['error']];
			return false;
		} else {
		// set object attributes to the form parameters
		$this->temp_path = $file['tmp_name'];
		$this->filename  = $file['name'];
		$this->type      = $file['type'];
		$this->size      = $file['size'];
		return true;
		}
	}

	// override inherited method
	public function save() {
		if(isset($this->id)) {
			// Really just update the caption
			$this->update();
		} else {
			// Check the errors
			// cannot save if there are preexisting errors
			if(!empty($this->errors)) { return false; }

			// Make sure the caption is not too long for DB
			if(strlen($this->caption) > 255) {
				$this->errors[] = "The caption can only be 255 characters long";
				return false;
			}

			// Check the filename and file location
			if(empty($this->filename) || empty($this->temp_path)) {
				$this->errors[] = "The file location was not available.";
				return false;
			}

			$target_path = SITE_ROOT.DS.'public'.DS. $this->upload_dir .DS. $this->filename;
			if(file_exists($target_path)) {
				$this->errors[] = "The file {$this->filename} already exists";
				return false;
			}

			if( move_uploaded_file($this->temp_path, $target_path)) {
				// Success
				if($this->create()) {
					unset($this->temp_path);
					return true;
				}
			} else {
				// fail
				$this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder";
				return false;
			}
		}
	}

	public function image_path() {
		//
		return $this->upload_dir.DS.$this->filename;
	}

	// format size to be user-friendly
	public function size_as_text() {
		if($this->size < 1024) {
			return "{$this->size} bytes";
		} elseif ($this->size < 1048576) {
			$size_kb = round($this->size/1024);
			return "{$size_kb} kB";
		} else {
			$size_mb = round($this->size/1024/1024);
			return "{$size_mb} mB";
		}
	}

	public function destroy() {
		// First , remove the database entry
		// Then , remove the file
		if( $this->delete()) {
			$target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
			return unlink($target_path) ? true : false;
		} else {
			return false;
		}
		// Then, remove the file
	}

	public function comments() {
		// Return all comments on this photo
		// return all objects;
		return Comment::find_comments_on($this->id);
	}

	public function count_comments(){
		// Return count of comments
		// for particular photo
		global $database;
		$sql = "select count(*) from comments where photograph_id = :photograph_id";
		return Photograph::count_by_sql($sql, [":photograph_id"=>$this->id]);
	}

}

?>


