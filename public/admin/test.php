<?php 
require_once('../../includes/initialize.php');
// if(!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<?php 



?>


<div class="panel-body">
	<?php // Render User form
		$user = User::find_by_id(1);
		$form = new Form($user, array("username", "first_name", "last_name", "post_number", "phone_number", "email")  );
		$form->validations['phone_number']['label'] = "Phone Number";
		$form->method = "post";
		$form->action = "link_to_action.php?id=100";
		$form->render();
	?>
</div>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>
      


