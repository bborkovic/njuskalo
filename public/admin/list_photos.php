<?php 
	// requires and includes all classes .. 
	require_once("../../includes/initialize.php");
	if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<?php  
	$photos = Photograph::find_all();
?>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">
	<h4>List of all photos</h4>
	
	<?php echo $message; ?>

	<table class="table table-condensed">
		<thead>
			<tr>
			<th></th>
			<th>Caption</th>
			<th>Size</th>
			<th>Links</th>
			<th>Comment Count</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($photos as $photo): ?>
				<tr>
					<td><img src="../<?php echo $photo->image_path(); ?>" class="img-responsive" alt="Cinque Terre" width="150"></td>
					<td><?php echo $photo->caption; ?></td>
					<td><?php echo $photo->size_as_text(); ?></td>
					<td>
						<p><a href="delete_photo.php?id=<?php echo $photo->id; ?>">delete</a></p>
					</td>
					<td>
						<a href="comments.php?id=<?php echo $photo->id; ?>">
							<?php echo $photo->count_comments(); ?>
						</a>
							
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<a href="photo_upload.php">Upload a new photograph</a>
</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>