<?php 

class Form {

	public $model_class;
	public $fields;
	public $method;
	public $action;
	public $validations;
	public $field_types = array(
		"alphaNumeric" => "text"
		);

	function __construct($class_name, $fields=[]){
		if(is_object($class_name)) {
			$this->model_class = $class_name;
		} else {
			$this->model_class = new $class_name;
		}
		$this->fields = $fields;
		// get validations from Model validations array
		$this->validations = $this->model_class->validations;
	}

	public function render() {

		$return_html = "";

		$this->render_form_begin();

		foreach ($this->fields as $field) {

			if( isset($this->model_class->$field)) {
				$value = $this->model_class->$field;
			} else {
				$value = "";
			}
			$this->render_form_element($field, $value);
		}
		$this->render_button();
		$this->render_form_end();
	}

	public function render_form_begin(){

		echo "<form role=\"form\" action=\"{$this->action}\" method=\"{$this->method}\">";
	}

	public function render_form_end(){

		echo "</form>";
	}

	public function render_button(){

		echo "<button type=\"submit\" class=\"btn btn-default\" name=\"submit\" value=\"Upload\">Save</button>";
	}

	public function render_form_element($field, $value) {
		// echo $field . "<br/>";
		if( isset($this->validations[$field]["label"]) ) {
			$label = $this->validations[$field]["label"];
		} else {
			$label = "No label";
		}
		echo "<div class=\"form-group\">";
		echo "<label for=\"{$field}\">{$label}</label>";
		echo "<input type=\"text\" class=\"form-control\" name=\"{$field}\" value=\"{$value}\"/>";
		echo "</div>";
	}

	// populate class with POST elements
	public function parsePost($post_array) {
		foreach ($this->fields as $field) {
			$this->model_class->$field = $post_array[$field];
		}
		return $this->model_class;
	}

}



?>