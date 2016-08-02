<?php 
	// requires and includes all classes .. 
	require_once("../../includes/initialize.php");
	if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<?php 
	
	if(empty($_GET['id'])) {
		$session->message("No photograph ID provided.");
		redirect_to('list_photos.php');
	}

		$photo = Photograph::find_by_id($_GET['id']);
		$caption = $photo->caption;

		if( $photo && $photo->destroy()) {
			$session->message( "The photo {$caption} was deleted");
			redirect_to('list_photos.php');
		} else {
			$session->message("The photo {$caption} could not be deleted");
			redirect_to('list_photos.php');
		}

?>

