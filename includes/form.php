<?php 

class Form {

	public $model_class;
	public $fields;

	public $field_types = array(
		"alphaNumeric" => "text"
		);

	function __construct($class_name, $fields=[]){
		$this->model_class = new $class_name;
		$this->fields = $fields;
	}

	public function render() {

		$return_html = "";

		foreach ($this->fields as $field) {
			$validation = $this->class->validation[$field];
			echo $field . "<br/>";
			// $return_html .= add_form_element("text", "label");
		}

		echo $return_html;

		// echo "<form role=\"form\" action=\"ads_new.php?category_id=1\" method=\"post\">";
		// echo "<div class=\"form-group\">";
		// echo "<label for=\"title\">Naslov Oglasa:</label>";
		// echo "<input type=\"text\" class=\"form-control\" name=\"title\" value=\"enter something\"/>";
		// echo "</div>";
		// echo "<button type=\"submit\" class=\"btn btn-default\" name=\"submit\" value=\"Upload\">Objavi</button>";
		// echo "<button type=\"button\" class=\"btn btn-default\">";
		// echo "<a href=\"categories_index.php?parent_cat_id=1\">Cancel</a>";
		// echo "</button>";
		// echo "</form>";

	}

}



?>