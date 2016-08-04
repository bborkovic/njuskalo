<?php 
// requires and includes all classes .. 
require_once("../../includes/initialize.php");
if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<?php

	if(empty($_GET['parent_cat_id'])) {
		redirect_to('categories.php');
	}

	$parent_cat_id = $_GET['parent_cat_id'];

	$name="";
	$description="";

	if(isset($_POST['submit'])) {
		$category = new Category();
		$category->parent_cat_id = $parent_cat_id;
		$category->name = $_POST['name'];
		$category->description = $_POST['description'];

		$name=$category->name;
		$description=$category->description;

		if($category->create()) {
			$session->message( ["Category " . $category->name . " has been saved!" , "success"] );
			redirect_to("categories_index.php?parent_cat_id={$parent_cat_id}");
		} else {
			$session->message( ["Error saving! " . $error->get_errors() , "error"] );
			redirect_to("categories_new.php?parent_cat_id={$parent_cat_id}");
		}
	}

?>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">
	<h4>Create New Category</h4>
	
<?php output_message(); ?>
	
	<form role="form" action="categories_new.php?parent_cat_id=<?php echo $parent_cat_id; ?>" method="post">
		<div class="form-group">
			<label for="name">Category Name:</label>
			<input type="text" class="form-control" name="name" value="<?php echo $name; ?>"/>
		</div>
		<div class="form-group">
			<label for="description">Category Description:</label>
			<input type="text" class="form-control" name="description" value="<?php echo $description; ?>"/>
		</div>
		<button type="submit" class="btn btn-default" name="submit" value="Upload">Create</button>
		<button type="button" class="btn btn-default">
			<a href="categories_index.php?parent_cat_id=<?php echo $parent_cat_id; ?>">Cancel</a>
		</button>
	</form>
</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>