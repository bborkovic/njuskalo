<?php 
require_once('../../includes/initialize.php');
// if(!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<?php 



?>


<div class="panel-body">

	<?php 
		
		$user = User::find_by_id(1);

	?>

</div>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
      


