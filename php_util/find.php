<?php
	$arr = array(1,2,3);
	echo count($arr);
	function find($key, $arr)
	{
		$mid_key = count($arr)/2-1;
		echo $mid_key; 
	}
	find(1,$arr);
?>
