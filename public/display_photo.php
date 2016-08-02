<?php 
	// requires and includes all classes .. 
	require_once("../includes/initialize.php");
?>

<?php
	if(empty($_GET['id'])) {
		$session->message("No id to display");
		redirect_to('list_photos.php');
	}

	$photo = Photograph::find_by_id($_GET['id']);
	if(!$photo) {
		$session->message("Photo Id does not exist in database.");
		redirect_to('list_photos.php');
	}

	// if post is submitted
	if(isset($_POST['submit'])) {
		$author = trim( $_POST['author']);
		$body = trim( $_POST['body']);

		if( strlen($author)==0 || strlen($body)==0){
			$session->message("Comment not saved. Both fields are mandatory.");
			redirect_to("display_photo.php?id={$photo->id}");
		}

		$new_comment = Comment::make($photo->id, $author, $body);
		if( $new_comment && $new_comment->create()) {
			$session->message("Comment saved");
			redirect_to("display_photo.php?id={$photo->id}");
		} else {
			$message = "Commet not saved";
		}
	} else {
		$author = "";
		$body = "";
	}

	$comments = $photo->comments();


?>

<?php require_once(SITE_ROOT.DS.'public/layouts/header.php'); ?>


<div class="panel-body">
	<h4><?php echo $photo->caption; ?></h4>

	<a href="list_photos.php">Back to photos</a>
	<img src="<?php echo $photo->image_path(); ?>" class="img-responsive">

	<!-- list all comments -->



	

	<!-- form -->
	<div class="row"> 
		<div class="col col-md-6">
			<h4>New Comment</h4>
			<?php echo output_message($message); ?>
			<form role="form" action="display_photo.php?id=<?php echo $photo->id; ?>" method="post">
				<div class="form-group">
					<label for="author">Author:</label>
					<input type="text" class="form-control" name="author" maxlength="30" value="" />
				</div>
				<div class="form-group">
					<label for="body">Text body:</label>
					<textarea class="form-control" name="body" cols="40" rows="8"></textarea>
				</div>
				<button type="submit" class="btn btn-default" name="submit" value="1">Post your comment</button>

				<!-- <input type="submit" name="submit" value="Login" /> -->
			</form>	
		</div>
		<div class="col col-md-6">
			<h4>Comments:</h4>
			<ul class="commentList">
				<?php foreach ($comments as $comment): ?>
				<li>
					<div class="commentText">
						<p class=""><?php echo $comment->author . " says:"; ?></p>
						<p class=""><?php echo $comment->body; ?></p>
						<span class="date sub-text"><?php echo $comment->created; ?></span>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
	</div> <!-- <div class="row">   -->



</div>


<?php require_once(SITE_ROOT.DS.'public/layouts/footer.php'); ?>


