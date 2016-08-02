<?php 
# Enable Error reporting
error_reporting(E_ALL ^ E_DEPRECATED);
// error_reporting(E_ALL);
ini_set('display_errors', 1);

?>




<?php

// Create the table with:
//   CREATE TABLE mytab (id NUMBER, text VARCHAR2(40));

$conn = oci_connect('test', 'sifratt', '10.240.135.129/mjerenja.t.ht.hr');

if (!$conn) {
    $m = oci_error();
    trigger_error(htmlentities($m['message']), E_USER_ERROR);
}

$stid = oci_parse($conn,"INSERT INTO mytab (id, text) VALUES(:id_bv, :text_bv)");

$id = 1;
$text = "Data to insert     ";
oci_bind_by_name($stid, ":id_bv", $id);
oci_bind_by_name($stid, ":text_bv", $text);
oci_execute($stid);

// Table now contains: 1, 'Data to insert     '

?>

