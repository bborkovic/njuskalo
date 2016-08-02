<?php 
	// requires and includes all classes .. 
	require_once("../includes/initialize.php");
?>

<?php

	$page = empty($_GET['page']) ? 1 : (int)$_GET['page'];
	$per_page = 4;
	$total_count = Photograph::count_all();

	$pagination = new Pagination($page, $per_page, $total_count);
	$photos = Photograph::find_by_sql("select * from photographs limit {$per_page} offset " . $pagination->offset());
	?>

<?php require_once(SITE_ROOT.DS.'public/layouts/header.php'); ?>

<div class="panel-body">
	<h4>List of all photos</h4>"panel-body">
	<h4>List of all photos</h4>
	<?php echo $message; ?>
	<div class="row">
		<?php foreach($photos as $photo): ?>
			<div class="col col-sm-3">
				<a href="display_photo.php?id=<?php echo $photo->id; ?>">
					<img src="<?php echo $photo->image_path(); ?>" class="img-responsive center-block" alt="Cinque Terre" style="max-height:250px">
					<p><?php echo $photo->caption; ?></p>
				</a>
			</div>
		<?php endforeach; ?>
	</div>

	<?php echo $pagination->display_pagination("index.php"); ?>
<!-- 	<ul class="pagination  pagination-lg">
	  <li><a href="index.php?page=1">1</a></li>
	  <li><a href="index.php?page=2">2</a></li>
	  <li><a href="index.php?page=3">3</a></li>
	  <li><a href="index.php?page=4">4</a></li>
	</ul> -->

</div>


<?php

	foreach($photos as $photo) {
		echo $photo;
	}

?>

<?php require_once(SITE_ROOT.DS.'public/layouts/footer.php'); ?>