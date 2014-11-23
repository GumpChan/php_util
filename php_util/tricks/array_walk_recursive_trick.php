<?php
function test($item,$key,&$arr)
{
	unset($arr[$key]);
}
function walkTrick()
{
	$arr = array(1,2);
	var_dump(array_walk($arr, "test", &$arr));	
}
walkTrick();

?>
