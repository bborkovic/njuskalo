<?php
require_once('../../includes/initialize.php');
if(!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<!-- Controller -->
<?php 


	if(isset($_POST['submit'])) {
		$form = new Form("User", ["username", "password", "first_name", "last_name", "post_number"] );
		$user = $form->parsePost($_POST, true);

		// Save user to DB and display message if necessary
		if($user->create()) {
			$session->message( ["User {$user->username} has been saved!" , "success"] );
			redirect_to("users_index.php");
		} else {
			$session->message( ["Error saving! " . $error->get_errors() , "error"] );
			redirect_to("users_new.php");
		}

	}

 ?>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>


<!-- View -->
<div class="panel-body">

	<?php output_message(); ?>

	<?php 
		$form = new Form("User", ["username", "password", "first_name", "last_name", "post_number"] );
		$form->method = "post";
		$form->action = "users_new.php"; // Single Page submit
		$form->render();
	?>


</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
	    
