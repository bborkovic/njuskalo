<?php 
// requires and includes all classes .. 
require_once("../../includes/initialize.php");
if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<?php 
	// process form data
	if(isset($_POST['submit'])) {
		$photo = new Photograph();
		$photo->caption = $_POST['caption'];
		$photo->attach_file($_FILES['file_upload']);
		if($photo->save()) {
			$session->message("File {$photo->filename} uploaded successfully.");
			redirect_to('list_photos.php');
		} else {
			// failure
			$message = join("<br/>" , $photo->errors);
		}
	}

?>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">
	<h4>Photo Upload</h4>
	
	<?php 
		if( !empty($message)){
			echo '<div class="alert alert-info">';
				echo output_message($message);
			echo '</div>';
		} 
	?>
	
	<form role="form" action="photo_upload.php" enctype="multipart/form-data" method="post">
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
		<div class="form-group">
			<label for="username">Browse for photo:</label>
			<input type="file" class="form-control" name="file_upload"/>
		</div>
		<div class="form-group">
			<label for="caption">Caption:</label>
			<input type="text" class="form-control" name="caption"/>
		</div>
		<button type="submit" class="btn btn-default" name="submit" value="Upload">Upload</button>
	</form>
</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>