<?php
require_once('../../includes/initialize.php');
if(!$session->is_logged_in()) { redirect_to("login.php"); }
?>


<?php // process url parameters  
	if(empty($_GET['category_id'])) {
		$session->message([ "Category id not set" , "error"]);
		redirect_to('categories_index.php');
	}
	$category_id = $_GET['category_id'];
	$category = Category::find_by_id($category_id);
	$category_common_fields = CategoryCommonField::find_by_sql("select * from category_common_fields where category_id = :category_id" , [ ":category_id"=>$category_id]);
	$common_fields = CommonField::find_all();
?>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">

	<?php output_message($message); ?>

	<h5><a href="categories_index.php?parent_cat_id=<?php echo $category->parent_cat_id; ?>">Back to categories</a></h5>

	<div class="row">
		
		<!-- display all fields from category -->
		<div class="col col-sm-6"> 
			<h4>Category Fields</h4>
			<table class="table table-striped">
				<?php foreach($category_common_fields as $category_common_field): ?>
				<tr>
					<td><a href="category_common_fields_edit.php?id=<?php echo $category_common_field->id; ?>"><?php echo $category_common_field->name; ?></a>
					</td>

					<td><a href="remove">Remove &gt</a></td>
				</tr>
			<?php endforeach; ?>
			</table>
		</div>

		<div class="col col-sm-1"> 
		</div>

		<!-- display all available common fields -->
		<div class="col col-sm-5"> 
			<h4>Template Fields</h4>
			<table class="table table-striped">
				<?php foreach($common_fields as $common_field): ?>
				<tr>
					<td><a href="category_common_fields_add.php?category_id=<?php echo $category_id; ?>&common_field_id=<?php echo $common_field->id; ?>">&lt Add</a></td>
					<td><?php echo $common_field->name; ?></td>
				</tr>
				
			<?php endforeach; ?>
			</table>

		</div>

	</div>	
		
	<a href="common_fields_new.php" class="btn btn-default">
		Add new Common Field
	</a>
</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
	    
