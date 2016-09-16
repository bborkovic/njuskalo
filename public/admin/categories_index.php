<?php
require_once('../../includes/initialize.php');
if(!$session->is_logged_in()) { redirect_to("login.php"); }
?>


<?php 

	$root_id = Category::find_root_id();

	if(empty($_GET['parent_cat_id'])) { 
		$parent_cat_id = $root_id;
	} else { $parent_cat_id = $_GET['parent_cat_id']; }
	$curr_category = Category::find_by_id($parent_cat_id);

	$categories = Category::find_by_sql("select * from categories where parent_cat_id = :id and name <> 'root' order by name", [":id"=>$parent_cat_id]);


	// find all parents
	$array_of_parents = Category::find_all_parents($parent_cat_id, $root_id);

 ?>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">

	<?php output_message(); ?>

	<!-- display navigation of parent categories -->
	<ol class="breadcrumb">
		<?php foreach ( $array_of_parents as $link): ?>
			<li class="active"><a href="categories_index.php?parent_cat_id=<?php echo $link->id; ?>"><?php echo ($link->id == $parent_cat_id) ? '<strong>'.$link->name.'</strong>' : $link->name; ?></a></li>
		<?php endforeach; ?>
	</ol>


	<!-- display the table of all categories selected -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Category Name</th>
				<th>Edit</th>
				<th>Edit Fields</th>
			</tr>
		</thead>
		<tbody>

		<?php foreach ($categories as $category): ?>
			<tr>
				<td>
					<a href="categories_index.php?parent_cat_id=<?php echo $category->id;?>"><?php echo $category->name; ?></a>
				</td>
				<td><a href="categories_edit.php?category_id=<?php echo $category->id;?>">Edit</a></td>
				<td><a href="category_common_fields_index.php?category_id=<?php echo $category->id;?>">Edit Fields</a></td>
			</tr>
		<?php endforeach; ?>

		</tbody>
	</table>

	<h5>Create new category inside <strong>&lt <?php echo $curr_category->name; ?> &gt</strong></h5>
	<a href="categories_new.php?parent_cat_id=<?php echo $parent_cat_id; ?>" class="btn btn-default">Create</a>

	


</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
	    
