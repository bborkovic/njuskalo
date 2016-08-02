<?php 
	// requires and includes all classes .. 
	require_once("../../includes/initialize.php");
	if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<?php  
	if(empty($_GET['comment_id']) || empty($_GET['photo_id'])) {
		redirect_to("index.php");
	}

	$photo_id = $_GET['photo_id'];
	$comment_id = $_GET['comment_id'];
	
	$comment = Comment::find_by_id( $comment_id );
	if(!$comment) {
		$session->message("Comment could not be found");
		redirect_to("comments.php?id={$photo_id}");
	}

	$comment->delete();
	$session->message("Comment deleted");
	redirect_to("comments.php?id={$photo_id}");

?>