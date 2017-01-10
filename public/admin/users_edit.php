<?php
require_once('../../includes/initialize.php');
if(!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<!-- Controller -->
<?php 
		
	if( isset($_GET['id'])) {
		$user = User::find_by_id( $_GET['id'] );
	}

	if(isset($_POST['submit'])) {
		$form = new Form($user, ["username", "password", "first_name", "last_name", "post_number"] );
		$form->action = "users_edit.php?id=" . $user->id;
		$form->method = "post";
		$user = $form->parsePost($_POST, true);

		if( $form->has_validation_errors() ) {
			$error_fields = implode( ", " , array_keys($form->validation_errors) );
			$session->message( ["Validation Errors! " . $error_fields, "error"] );
		} else {
			// Save user to DB and display message if necessary
			if($user->update()) {
				$session->message( ["User {$user->username} has been saved!" , "success"] );
				redirect_to("users_edit.php?id=$user->id");
			} else {
				$session->message( ["Error saving! " . $error->get_errors() , "error"] );
				redirect_to("users_edit.php?id=$user->id");
			}
		}
	}

 ?>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>


<!-- View -->
<div class="panel-body">

<?php output_message(); ?>

	<?php

		if(!isset($form)) {
			$form = new Form($user, ["username", "password", "first_name", "last_name", "post_number"] );
			$form->method = "post";
			$form->action = "users_edit.php?id=" . $user->id; // Single Page submit			
		}
		$form->render();

	?>


</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
	    
