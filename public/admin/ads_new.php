<?php 
// requires and includes all classes .. 
require_once("../../includes/initialize.php");
if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<?php
	$root_id = Category::find_root_id();
	if(empty($_GET['category_id'])) {
		$category_id = $root_id;
	} else {
		$category_id = $_GET['category_id'];
	}
	$category = Category::find_by_id($category_id);
	$category_common_fields = CategoryCommonField::find_by_sql("select * from category_common_fields where category_id = :category_id" , [ ":category_id"=>$category_id]);

	$title="";
	$description="";

	if(isset($_POST['submit'])) {
		
		// First , table ads
		$ad = new Ad();
		$ad->category_id = $category_id;
		$ad->user_id = $logged_user->id;
		$ad->title = $_POST['title'];
		$ad->description = $_POST['description'];

		$ad->id = 100;
		if(!$ad->create()) {
			$session->message( ["Error saving Ad! " . $ad->title . " " . $error->get_errors() , "error"] );
			redirect_to("ads_new.php?category_id={$category_id}");
		}
		
		// Then , table ad_common_fields
		unset($_POST["title"]);
		unset($_POST["description"]);
		unset($_POST["submit"]);

		foreach($_POST as $k => $v) {
			$ad_common_field = new AdCommonField();
			$ad_common_field->ad_id = $ad->id;
			$ad_common_field->common_field_id = $k;
			$ad_common_field->name = '';
			$ad_common_field->value = $v;

			// var_dump($ad_common_field);
			if(!$ad_common_field->create() ) {
				$session->message( ["Error saving ad_common_field! " . $ad->title . " " . $error->get_errors() , "error"] );
				redirect_to("ads_new.php?category_id={$category_id}");
			}
		}

		$session->message( [ "All Saved", "info"] );
		redirect_to('my_ads_index.php');
	}


?>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">
	<h4>Kreiraj novi oglas</h4>
	
		<?php output_message(); ?>

		<?php if( $category->has_children_category() ): ?>
			<?php 	$categories = Category::get_subcategories($category_id); ?>
				<h5>Step 1: Select Category</h5>

				<?php $array_of_parents = Category::find_all_parents($category_id, $root_id); ?>
				<ol class="breadcrumb">
					<?php foreach ( $array_of_parents as $link): ?>
						<li class="active"><a href="add_new.php?category_id=<?php echo $link->id; ?>"><?php echo ($link->id == $category_id) ? '<strong>'.$link->name.'</strong>' : $link->name; ?></a></li>
					<?php endforeach; ?>
				</ol>

				<table class="table table-striped">
					<tbody>
					<?php foreach ($categories as $cat): ?>
						<tr>
							<td>
								<a href="ads_new.php?category_id=<?php echo $cat->id;?>"><?php echo $cat->name; ?></a>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
		<?php else: ?>
			<h5>Category: <?php echo $category->name; ?></h5>
			<form role="form" action="ads_new.php?category_id=<?php echo $category_id; ?>" method="post">
				
				<!-- fields for table ads -->
				<div class="form-group">
					<label for="title">Naslov Oglasa:</label>
					<input type="text" class="form-control" name="title" value="<?php echo $title; ?>"/>
				</div>
				
				<div class="form-group">
					<label for="description">Detalji:</label>
					<textarea class="form-control" name="description" cols="40" rows="8">default value</textarea>
				</div>
				
				<!-- fields for table ad_common_fields -->
				<?php foreach($category_common_fields as $common_field): ?>
					<?php $name=$common_field->name; $id=$common_field->id; ?>
					
					<?php if($common_field->template_type == 'LOV'): ?>
						<?php $options = explode(",", $common_field->template_lov); ?>
						<div class="form-group">
							<label for="<?php echo $name; ?>"><?php echo $name; ?></label>
							<select class="form-control" name="<?php echo $id; ?>">
								<?php foreach($options as $option): ?>
									<option><?php echo $option; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					<?php else: ?> 
						<div class="form-group">
							<label for="<?php echo $name; ?>"><?php echo $name; ?>:</label>
							<input class="form-control" name="<?php echo $id; ?>"></input>
						</div>
					<?php endif; ?>

				<?php endforeach; ?>	


				<button type="submit" class="btn btn-default" name="submit" value="Upload">Objavi</button>

				<button type="button" class="btn btn-default">
					<a href="categories_index.php?parent_cat_id=<?php echo $category_id; ?>">Cancel</a>
				</button>
				
			</form>



		<?php endif; ?>

</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>