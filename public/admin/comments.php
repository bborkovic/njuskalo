<?php 
	// requires and includes all classes .. 
	require_once("../../includes/initialize.php");
	if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<?php  
	if(empty($_GET['id'])) {
		redirect_to("index.php");
	}
	$photo_id = $_GET['id'];
	$photo = Photograph::find_by_id($_GET['id']);
	if(!$photo) {
		$session->message("The photo could not be found");
		redirect_to("list_photos.php");
	}

	$comments = $photo->comments();

?>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">
	<a href="list_photos.php">Back to photos</a>
	<?php echo $message; ?>
	<h4>All comments of photo <?php echo $photo->caption; ?></h4>

		<table class="table table-striped">
			<?php foreach ($comments as $comment): ?>
				<tr>
					<td>
						<p class=""><?php echo $comment->author . " says:"; ?></p>
					</td>
					<td>
						<p class=""><?php echo $comment->body; ?></p>
					</td>
					<td>
						<span class="date sub-text"><?php echo $comment->created; ?></span>
					</td>
					<td>
						<a href="delete_comment.php?comment_id=<?php echo $comment->id; ?>&photo_id=<?php echo $photo_id;?>">Delete</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>