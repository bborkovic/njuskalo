<?php // error enable
	// Enable Error reporting
	error_reporting(E_ALL ^ E_DEPRECATED);
	// error_reporting(E_ALL);
	ini_set('display_errors', 1);
?>

<?php // functions
	function insert_array( $conn, $sql, $bind_values=[]) {
		
		$stid = oci_parse($conn,$sql);
		if(!$stid) {
			echo "Execute Error: ";
			$e = oci_error($stid);
			echo "<br/>" . $e['message'];
			echo "<br/>" . $e['sqltext'];
			return false;
		}
		
		foreach ($bind_values as $key => $val) {
			oci_bind_by_name($stid, $key, $bind_values[$key]);
			// oci_bind_by_name($stid, $key, $val);
		}

		var_dump($stid);
		$ret = oci_execute($stid);
		if(!$ret) {
			$e = oci_error($stid);
			var_dump($e);
			// echo "<p>";
			// echo "	Execute Error: ";
			// $e = oci_error($stid);
			// echo "	<br/>" . $e['message'];
			// echo "	<br/>" . $e['sqltext'];
			// echo "</p>";
			return false;
		}
		return oci_num_rows($stid);
	}
?>


<?php

// Create the table with:
//   CREATE TABLE mytab (id NUMBER, text VARCHAR2(40));

$conn = oci_connect('test', 'sifratt', '10.240.135.129/mjerenja.t.ht.hr', 'AL32UTF8');

// $ret = insert_array( $conn, "insert into numbers(i, j, text) values (:i, :j, :text)", $bind_values=[":i"=>12, ":j"=>12, ":text"=>'danas']);
// echo ($ret) ? "Insert success" : "Insert fail";

$stmt = oci_parse($conn, "select text from numbers");
oci_execute($stmt);

while ($ret = oci_fetch_assoc($stmt)) {
	echo "<br/>" . $ret['TEXT'];
}



oci_close($conn);
echo "End of script";

?>

