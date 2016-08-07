<?php 
require_once('../../includes/initialize.php');
// if(!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<?php 

	echo $logged_user->id;

?>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
      


