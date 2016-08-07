<?php 
// requires and includes all classes .. 
require_once("../../includes/initialize.php");
if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<?php

	if(empty($_GET['id'])) {
		$session->message( ["id is not set" , "error"] );
		redirect_to('category_common_fields_index.php');
	}

	$id = $_GET['id'];
	$category_common_field = CategoryCommonField::find_by_id($id);
	
	if(!$category_common_field) {
		$session->message( ["Cannot find id in DB" , "error"] );
		redirect_to('category_common_fields_index.php');
	}

	$name=$category_common_field->name;
	$template_type=$category_common_field->template_type;
	$template_lov=$category_common_field->template_lov;

	if(isset($_POST['submit'])) {
		$category_common_field->name = $_POST['name'];
		$category_common_field->template_type = $_POST['template_type'];
		$category_common_field->template_lov = $_POST['template_lov'];
		
		if($category_common_field->update()) {
			$session->message( ["Common Field " . $category_common_field->name . " has been saved!" , "success"] );
			redirect_to("category_common_fields_index.php?category_id={$category_common_field->category_id}");
		} else {
			$session->message( ["Error saving! " . $error->get_errors(), "error"] );
			redirect_to("category_common_fields_edit.php?id={$id}");
		}
	}

?>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">
	<h4>Create New Common Field</h4>
	
<?php output_message(); ?>
	
	<form role="form" action="category_common_fields_edit.php?id=<?php echo $id; ?>" method="post">
		
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
		
		<button type="submit" class="btn btn-default" name="submit" value="1">Save</button>

		<a href="category_common_fields_index.php?category_id=<?php echo $category_common_field->category_id; ?>" role="button" class="btn btn-default">Cancel</a>
		
	</form>
</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>