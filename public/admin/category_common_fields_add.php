<?php 
// requires and includes all classes .. 
require_once("../../includes/initialize.php");
if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<!-- http://localhost/njuskalo/public/admin/category_common_fields_add.php?category_id=20&common_field_id=1 -->

<?php

	if(empty($_GET['category_id'])) {
		$session->message([ "category_id not set" . join(";", $_GET), "error"]);
		redirect_to("categories_index.php");
	}

	$category = Category::find_by_id( $_GET['category_id'] );
	
	if(empty($_GET['common_field_id'])) {
		$session->message([ "common_field_id not set", "error"]);
		redirect_to("category_common_fields_index.php?category_id={$category_id}");
	}
	$common_field = CommonField::find_by_id( $_GET['common_field_id'] );


	// Instantiate new CategoryCommonField class
	$category_common_field = new CategoryCommonField();
	$category_common_field->category_id = $category->id;
	$category_common_field->common_field_id = $common_field->id;
	$category_common_field->name = $common_field->name;
	$category_common_field->template_type = $common_field->template_type;
	$category_common_field->template_lov = $common_field->template_lov;
	
	if( $category_common_field->create() ){
		$session->message( ["Field " . $common_field->name . " added!" , "success"] );
		redirect_to("category_common_fields_index.php?category_id={$category->id}");
	} else {
		$session->message( ["Error while adding " . $common_field->name , "error"] );
		redirect_to("category_common_fields_index.php?category_id={$category->id}");
	}


?>

