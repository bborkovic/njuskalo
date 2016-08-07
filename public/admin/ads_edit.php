<?php 
// requires and includes all classes .. 
require_once("../../includes/initialize.php");
if( !$session->is_logged_in() ) { redirect_to("login.php"); }
?>

<?php
	$root_id = Category::find_root_id();
	if(empty($_GET['ad_id'])) {
		$session->message( ["Wrong ad_id! " , "error"] );
		redirect_to('my_ads_index.php');
	}

	// instantiate ad	
	$ad = Ad::find_by_id( $_GET['ad_id'] );
	if(!$ad) {
		$session->message( ["Ad not found! " , "error"] );
		redirect_to('my_ads_index.php');
	}
	$photos = $ad->find_all_images();
	$ad_common_fields = $ad->find_all_fields();

	if(isset($_POST['submit'])) {
		
		// First, update table ads if there is change
		if( $ad->title != $_POST['title'] or $ad->description != $_POST['description']) {
			$ad->title = $_POST['title'];
			$ad->description = $_POST['description'];

			if(!$ad->update()) {
				$session->message( ["Error saving Ad! " . $ad->title . " " . $error->get_errors() , "error"] );
				redirect_to("ads_edit.php?ad_id={$ad->id}");
			}
		}

		// Then , table ad_common_fields
		unset($_POST["title"]);
		unset($_POST["description"]);
		unset($_POST["submit"]);

		foreach($_POST as $k => $v) {
			$ad_common_fields = AdCommonField::find_by_sql( "select * from ad_common_fields where ad_id = :ad_id and common_field_id = :common_field_id limit 1" , [ ":ad_id" => $ad->id, ":common_field_id" => $k ]);
			$ad_common_field = $ad_common_fields[0];
			
			if( $ad_common_field->value != $v) {
				
				$ad_common_field->value = $v;
				var_dump($ad_common_field);
				if(!$ad_common_field->update() ) {
					$session->message( ["Error saving ad_common_field! " . $ad->title . " " . $error->get_errors() , "error"] );
					//redirect_to("ads_edit.php?ad_id=" . $ad->id);
				}
			} 
		}
		$session->message( [ "All Saved", "info"] );
		redirect_to("ads_edit.php?ad_id=" . $ad->id);
	}

	// process form data
	if(isset($_POST['upload'])) {
		$photo = new Photograph();
		$photo->ad_id = $ad->id;
		$photo->caption = $_POST['caption'];
		$photo->attach_file($_FILES['file_upload']);

		if($photo->save()) {
			$session->message(["File {$photo->filename} uploaded successfully." , "success"]);
			redirect_to('ads_edit.php?ad_id=' . $ad->id);
		} else {
			// failure
			$message = join("<br/>" , $photo->errors);
			$session->message(["Error while upload." . join("<br/>" , $photo->errors) . $error->get_errors() , "error"]);
			redirect_to('ads_edit.php?ad_id=' . $ad->id);
		}
	}

?>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_header.php'); ?>

<div class="panel-body">
	<h4>Change Data</h4>
	
	<?php output_message(); ?>
	
	<div class="row">
	<!-- <h5>Category is: </h5> -->
		<form role="form" action="ads_edit.php?ad_id=<?php echo $ad->id; ?>" method="post">
			
			<div class="col col-md-6">
				<!-- fields for table ad_common_fields -->
				<?php foreach($ad_common_fields as $field): ?>
					<?php $common_field = CategoryCommonField::find_by_id($field->common_field_id); 
						$name=$common_field->name;
						$id=$common_field->id;
					?>
					
					<?php if($common_field->template_type == 'LOV'): ?>
						<?php $options = explode(",", $common_field->template_lov); ?>
						<div class="form-group">
							<label for="<?php echo $name; ?>"><?php echo $name; ?></label>
							<select class="form-control" name="<?php echo $id; ?>">
								<?php foreach($options as $option): ?>
									<option<?php echo ($option==$field->value) ? " selected" : ""; ?>><?php echo $option; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					<?php else: ?> 
						<div class="form-group">
							<label for="<?php echo $name; ?>"><?php echo $name; ?>:</label>
							<input class="form-control" name="<?php echo $id; ?>" value="<?php echo $field->value; ?>"></input>
						</div>
					<?php endif; ?>

				<?php endforeach; ?>	
			</div>

			<!-- fields for table ads -->
			<div class="col col-md-6">
				<div class="form-group">
					<label for="title">Naslov Oglasa:</label>
					<input type="text" class="form-control" name="title" value="<?php echo $ad->title; ?>"/>
				</div>
				
				<div class="form-group">
					<label for="description">Detalji:</label>
					<textarea class="form-control" name="description" cols="40" rows="8"><?php echo $ad->description; ?></textarea>
				</div>

					<button type="submit" class="btn btn-default" name="submit" value="Upload">Save</button>

					<button type="button" class="btn btn-default">
						<a href="my_ads_index.php">Cancel</a>
					</button>
			</div>
		
		</form>
	</div>


		<!-- Display Thumbnail of all photos -->
	<div class="row">	
		<?php foreach($photos as $photo): ?>
        <div class="col-xs-18 col-sm-6 col-md-3">
          <div class="thumbnail">
            <img src="<?php echo "../" . $photo->image_path(); ?>" alt="">
              <div class="caption">
                <!-- <h4>Thumbnail label</h4> -->
                <p>
                	<a href="delete_photo.php?photo_id=<?php echo $photo->id;?>&ad_id=<?php echo $ad->id; ?>" class="btn btn-info btn-xs" role="button">Delete</a>
                	<!-- <a href="#" class="btn btn-default btn-xs" role="button">Button</a> -->
                </p>
            </div>
          </div>
        </div>
		<?php endforeach; ?>
	</div>

	<div class="row">
		<div class="col col-md-6">
			<form role="form" action="ads_edit.php?ad_id=<?php echo $ad->id; ?>" enctype="multipart/form-data" method="post">
				<input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
				<div class="form-group">
					<label for="username">Browse for photo:</label>
					<input type="file" class="form-control" name="file_upload"/>
				</div>
				<div class="form-group">
					<label for="caption">Caption:</label>
					<input type="text" class="form-control" name="caption"/>
				</div>
				<button type="submit" class="btn btn-default" name="upload" value="Upload">Upload</button>
			</form>
		</div>



	</div>

</div>

<?php require_once(SITE_ROOT.DS.'public/layouts/admin_footer.php'); ?>