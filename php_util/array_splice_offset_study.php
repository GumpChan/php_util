<?php
	$arr = array(1,2,3,4,5,6,78);
	$length = count($arr);
	var_dump(array_slice($arr,0,3,true));
	var_dump(	array_slice($arr,-1,1,true));

?>
