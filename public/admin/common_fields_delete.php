<?php 
// requires and includes all classes .. 
require_once("../../includes/initialize.php");
if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<?php

	if(empty($_GET['id'])) {
		$session->message( ["id is not set" , "error"] );
		redirect_to('common_fields_index.php');
	}

	$id = $_GET['id'];
	$common_field = CommonField::find_by_id($id);
	
	if(!$common_field) {
		$session->message( ["Cannot find id in DB" , "error"] );
		redirect_to('common_fields_index.php');
	}


	if($common_field->delete()) {
		$session->message( ["Common Field " . $common_field->name . " has been deleted!" , "success"] );
		redirect_to("common_fields_index.php");
	} else {
		$session->message( ["Error deleting! " . $error->get_errors() , "error"] );
		redirect_to("common_fields_index.php");
	}

?>

