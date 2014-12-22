<?php
	$arr = array(10,2,3,4,5,6,7,8);
function fillArr() 
{
	$arr = array();
	for($i=0;$i<=1000000;$i++) {
		$arr[] = rand(0,1000000);	
	}
	return $arr;
}
function secMax($arr)
{
	$start_time = microtime(true);
	echo 'start_time',$start_time, PHP_EOL;
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
	echo 'end_time',microtime(true), PHP_EOL;
	echo 'period',microtime(true)-$start_time, PHP_EOL;
	return array($max,$secMax);
}
$arr = fillArr(); 
$ret = secMax($arr);
$start_time = microtime(true);
rsort($ret);
echo 'period_sort:',microtime(true)-$start_time, PHP_EOL;
?>

