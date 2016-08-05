<?php 
require_once('../../includes/initialize.php');
// if(!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">

	<?php output_message(); ?>
	<p><a href="categories_index.php">Categories</a></p>
	<p><a href="common_fields_index.php">Common Fields</a></p>
	
</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
	    
