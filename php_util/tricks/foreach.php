<?php
function foreach_test()
{
	$arr = array(1,2,3);
	xdebug_debug_zval('value');
	foreach($arr as $value) {
	xdebug_debug_zval('value');
		$tmp = &$value;
	xdebug_debug_zval('value');
	}
	xdebug_debug_zval('value');
	xdebug_debug_zval('arr');
	$i = 0;
	$a = $i++;	
	echo $a,PHP_EOL;
	$a = ++$i;
	echo $a,PHP_EOL;
}
function refTest()
{
	$a = 1;
	$b[0] = &$a;
	xdebug_debug_zval('a');
	xdebug_debug_zval('b');
	$b[1] = &$a;
	xdebug_debug_zval('a');
	xdebug_debug_zval('b');
}
function whileTest()
{
	$start = time();
	$i = 0;
	while($i < 1)
	{
//		  $j = 0;
//		  while($j < 1)
//			$j++;
//		echo $i;
		$i++;
//		xdebug_debug_zval('i');
	}
	$duration = time() - $start;
//	echo 'time:', $duration, PHP_EOL;
}
function forTest()
{
	$start = time();
	$str = '';
	$i = 0;
	for($i=0; $i<800000; ++$i) {
	$user_id = rand(0,500);
	$tmp[] = $user_id;
	}
	$duration = time() - $start;
	echo 'time:', $duration, PHP_EOL;

}
//forTest();
whileTest();
//foreach_test();
//refTest();
?>
