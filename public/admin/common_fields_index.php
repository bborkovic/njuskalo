<?php
require_once('../../includes/initialize.php');
if(!$session->is_logged_in()) { redirect_to("login.php"); }
?>


<?php 

	$common_fields = CommonField::find_all();

 ?>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">

	<?php output_message($message); ?>


	<!-- display the table of all categories selected -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Field name</th>
			</tr>
		</thead>
		<tbody>

		<?php foreach ($common_fields as $common_field): ?>
			<tr>
				<td>
					<a href="common_fields_edit.php?id=<?php echo $common_field->id;?>"><?php echo $common_field->name; ?></a>
				</td>
			</tr>
		<?php endforeach; ?>

		</tbody>
	</table>


	<a href="categories_new.php?parent_cat_id=<?php echo $parent_cat_id; ?>" class="btn btn-default">Add new Common Field</a>

	


</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
	    
