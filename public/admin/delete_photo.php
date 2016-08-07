<?php 
	// requires and includes all classes .. 
	require_once("../../includes/initialize.php");
	if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<?php 
	
	if( empty($_GET['photo_id']) || empty($_GET['ad_id']) ) {
		$session->message(["No id provided.", "info"]);
		redirect_to('my_ads_index.php');
	}

	$ad_id = $_GET['ad_id'];
	$photo = Photograph::find_by_id($_GET['photo_id']);
	$caption = $photo->caption;

	if( $photo && $photo->destroy()) {
		$session->message( ["Photo deleted!" , "success"]);
		redirect_to("ads_edit.php?ad_id={$ad_id}");
	} else {
		$session->message(["The photo {$photo->filename} could not be deleted", "error"]);
		redirect_to("ads_edit.php?ad_id={$ad_id}");
	}

?>

