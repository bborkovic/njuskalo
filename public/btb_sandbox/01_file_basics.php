<?php  

echo __FILE__ . "<br/>";
echo __LINE__ . "<br/>";
echo dirname(__FILE__). "<br/>";
echo __DIR__ . "<br/>";

echo file_exists(__FILE__) ? 'yes' : 'no';
echo "<br/>";
echo file_exists('data.txt') ? 'yes' : 'no';
echo "<br/>";
echo file_exists('data2.txt') ? 'yes' : 'no';
echo "<br/>";
echo file_exists(__DIR__) ? 'yes' : 'no';

echo "<hr>";
echo "Is it file?" . "<br/>";
echo is_file(__DIR__) ? 'yes' : 'no';
echo "<br/>";
echo is_file(__FILE__) ? 'yes' : 'no';
echo "<br/>";
echo is_dir(__DIR__) ? 'yes' : 'no';

i

?>


