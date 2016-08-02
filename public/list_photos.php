<?php 
	// requires and includes all classes .. 
	require_once("../includes/initialize.php");
?>

<?php  
	$photos = Photograph::find_all();
?>

<?php require_once(SITE_ROOT.DS.'public/layouts/header.php'); ?>


<div class="panel-body">
	<h4>List of all photos</h4>
	<?php echo $message; ?>

		<?php foreach($photos as $photo): ?>
			<div class="col col-sm-3">
				<a href="display_photo.php?id=<?php echo $photo->id; ?>">
					<img src="<?php echo $photo->image_path(); ?>" class="img-responsive" alt="Cinque Terre" style="max-height:250px">
				</a>
			</div>
		<?php endforeach; ?>

</div>
	


<?php require_once(SITE_ROOT.DS.'public/layouts/footer.php'); ?>