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
		$form = new Form($user, ["username", "password", "first_name", "last_name", "post_number"] );

		$form->validate_field("username" , "");

		echo "<br/><br/>Validation Errors:<br/>";
		print_r($form->validation_errors);



	?>

</div>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
      


