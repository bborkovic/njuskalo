<?php 

require_once("../../includes/initialize.php");
if($session->is_logged_in()) { redirect_to("index.php"); }

if ( isset($_POST['submit'])){ // form has been submitted!
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	$found_user = User::authenticate($username,$password);

	if( $found_user) {
		$session->login($found_user);
		$session->message(["You have successfuly login", "success"]);
		redirect_to("index.php");
	} else {
		// username/pass was not found
		$session->message(["username/password combination incorrect", "error"]);
		redirect_to("login.php");
	}
} else { //isset($_POST['submit'])
	$username = "";
	$password = "";
}

?>


<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">
	<h2>Staff Login</h2>
	<?php echo output_message(); ?>

	<form role="form" action="login.php" method="post">
		<div class="form-group">
			<label for="username">Username:</label>
			<input type="text" class="form-control" name="username" maxlength="30" placeholder="Enter username" />
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" name="password" maxlength="30" placeholder="Enter password" />
		</div>
		<button type="submit" class="btn btn-default" name="submit" value="1">Login</button>

		<!-- <input type="submit" name="submit" value="Login" /> -->
	</form>
</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>