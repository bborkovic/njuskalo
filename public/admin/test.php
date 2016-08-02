<?php

	require_once('../../includes/initialize.php');

	$category_id = 20;
	$category = Category::find_by_id($category_id);


	// if( $category->has_children_category() ) {
	// 	echo "Has child categoris";
	// }

?>	


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php if( $category->has_children_category() ): ?>
		List all categories
	<?php else: ?>
		Display input form
	<?php endif; ?>






</body>
</html>

