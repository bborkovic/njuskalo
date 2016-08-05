<?php

	require_once('../../includes/initialize.php');

	$category_id = 20;
	

$category_common_fields = CategoryCommonField::find_by_sql("select * from category_common_fields where category_id = :category_id" , [ ":category_id"=>$category_id ] );

?>	


