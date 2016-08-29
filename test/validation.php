<?php 

$validations = array(
	"name" => array(
		 "type" => "words" // email, number , ...
		,"regex" => "([\w-]+)"
		,"maxlength" => 40
		)
	,"email" => array(
		 "type" => "email" // email, number , ...
		,"regex" => "([\w-]+)"
		,"maxlength" => 30
		)
);

foreach($validations as $key => $value_arr) {
	echo "<hr/>";
	echo "<strong>{$key}</strong><br/>";
	echo $value_arr['type'] . "<br/>";
	echo $value_arr['regex'] . "<br/>";
}


?>


and the f<!-- orm name is the max length of simple session
available in the last option in the mean time available -->