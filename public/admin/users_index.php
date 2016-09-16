<?php
require_once('../../includes/initialize.php');
// if(!$session->is_logged_in()) { redirect_to("login.php"); }
?>


<?php 

	$users = User::find_all();

	// $root_id = User::find_root_id();

	// if(empty($_GET['parent_cat_id'])) { 
	// 	$parent_cat_id = $root_id;
	// } else { $parent_cat_id = $_GET['parent_cat_id']; }
	// $curr_category = Category::find_by_id($parent_cat_id);

	// $categories = Category::find_by_sql("select * from categories where parent_cat_id = :id and name <> 'root' order by name", [":id"=>$parent_cat_id]);


	// // find all parents
	// $array_of_parents = Category::find_all_parents($parent_cat_id, $root_id);

 ?>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">

	<?php output_message(); ?>

	<!-- display the table of all categories selected -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Username</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>

		<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo $user->username; ?></td>
				<td><a href="users_edit.php?category_id=<?php echo $user->id;?>">Edit</a></td>
			</tr>
		<?php endforeach; ?>

		</tbody>
	</table>

	<h5>Create new user</h5>
	<a href="users_new.php" class="btn btn-default">Create</a>

</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
	    
