<?php
	$arr = array(10,2,3,4,5,6,7,8);
function secMax($arr)
{
	$max = $arr[0];	
	$secMax = $arr[1];
	for($i=1;$i<count($arr);$i++) {
		if($max < $arr[$i]) {
			$secMax = $max;
			$max = $arr[$i];
		} else if ($secMax < $arr[$i]) {
			$secMax = $arr[$i];
		}
	}
	return array($max,$secMax);
}
$ret = secMax($arr);
?>

