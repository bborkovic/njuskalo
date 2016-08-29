<?php

// Create the table with:
//   CREATE TABLE mytab (id NUMBER, text VARCHAR2(40));

$conn = oci_connect('test', 'sifratt', 'sela2p/mjerenja.t.ht.hr');
if (!$conn) {
    $m = oci_error();
    trigger_error(htmlentities($m['message']), E_USER_ERROR);
}

$stid = oci_parse($conn,"select table_name from user_tables where rownum < 10");

oci_execute($stid);


oci_fetch_all($stid, $records, null, null, OCI_FETCHSTATEMENT_BY_ROW);
// var_dump($records);

// var_dump($record)

// echo count($records);

foreach($records as $record ) {
	echo "<br/>";
	echo $record['TABLE_NAME'];
}

// 
// while($row = oci_fetch_object($stid)) {
// 	echo "<br/>" . $row->TABLE_NAME;
// }

// Table now contains: 1, 'Data to insert     '

?>