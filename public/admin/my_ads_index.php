<?php
require_once('../../includes/initialize.php');
if(!$session->is_logged_in()) { redirect_to("login.php"); }
?>


<?php 

	// find all of my ads
	$ads = Ad::find_by_sql("select * from ads where user_id = :user_id", [":user_id" => $logged_user->id]);

 ?>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">

	<?php output_message(); ?>

	<h4>List of your ads</h4>

	<!-- display the table of all categories selected -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
			</tr>
		</thead>
		<tbody>

		<?php foreach ($ads as $ad): ?>
			<tr>
				<td>
					<a href="ads_edit.php?ad_id=<?php echo $ad->id; ?>"><?php echo $ad->title; ?>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>

		</tbody>
	</table>


	<a href="ads_new.php" role="button" class="btn btn-default">New Ad</a>

	


</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
	    
