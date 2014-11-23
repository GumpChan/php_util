<?php
	$dir = '/usr';
	$dir_arr = dir($dir);
	while (false != $dir_arr->read()) {
		echo $dir_arr->read(),"\n";
	}
?>
