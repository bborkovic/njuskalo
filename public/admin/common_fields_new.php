<?php 
// requires and includes all classes .. 
require_once("../../includes/initialize.php");
if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<?php

	$name="";
	$template_type="";
	$template_lov="";

	if(isset($_POST['submit'])) {
		$common_field = new CommonField();
		$common_field->name = $_POST['name'];
		$common_field->template_type = $_POST['template_type'];
		$common_field->template_lov = $_POST['template_lov'];
		
		if($common_field->create()) {
			$session->message( ["Common Field " . $common_field->name . " has been saved!" , "success"] );
			redirect_to("common_fields_index.php");
		} else {
			$session->message( ["Error saving! " . $error->get_errors() , "error"] );
			redirect_to("common_fields_new.php");
		}
	}

?>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">
	<h4>Create New Common Field</h4>
	
<?php output_message(); ?>
	
	<form role="form" action="common_fields_new.php" method="post">
		
		<div class="form-group">
			<label for="name">Category Name:</label>
			<input type="text" class="form-control" name="name" value="<?php echo $name; ?>"/>
		</div>
		
		<div class="form-group">
			<label for="template_type">Template Type:</label>
			<input type="text" class="form-control" name="template_type" value="<?php echo $template_type; ?>"/>
		</div>

		<div class="form-group">
			<label for="template_lov">Template List of Values:</label>
			<input type="text" class="form-control" name="template_lov" value="<?php echo $template_lov; ?>"/>
		</div>
		
		<button type="submit" class="btn btn-default" name="submit" value="1">Create</button>

		<a href="common_fields_index.php" role="button" class="btn btn-default">Cancel</a>
		
	</form>
</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>