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
				<th>Template Type</th>
				<th>Template LOV</th>
				<th>Delete?</th>
			</tr>
		</thead>
		<tbody>

		<?php foreach ($common_fields as $common_field): ?>
			<tr>
				<td>
					<a href="common_fields_edit.php?id=<?php echo $common_field->id; ?>"><?php echo $common_field->name; ?>
					</a>
				</td>
				<td><?php echo $common_field->template_type; ?></td>
				<td><?php echo $common_field->template_lov; ?></td>
				<td>
					<a href="common_fields_delete.php?id=<?php echo $common_field->id; ?>">Delete</a>
				</td>
			</tr>
		<?php endforeach; ?>

		</tbody>
	</table>


	<a href="common_fields_new.php" class="btn btn-default">
		Add new Common Field
	</a>

	


</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
	    
