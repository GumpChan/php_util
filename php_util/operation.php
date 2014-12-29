<?php
function level()
{
	if($a = 1 && $b = 2)
		echo $a, PHP_EOL, $b;
	return ;
}
function or_operation()
{
$a = 0;
$b = 0;
if($a = 3 || $b = 3) {
	$a++;
	$b++;
}
echo $a, $b, PHP_EOL;
$a = 0;
$b = 0;
if(($a = 3) || $b = 3) {
	$a++;
	$b++;
}
echo $a, $b, PHP_EOL;
$a = 0;
$b = 0;
if($a = 3 | $b = 3) {
	$a++;
	$b++;
}
echo $a, $b, PHP_EOL;

}
function main()
{
	//or_operation();	
//	var_dump($a = 4 |$b = 1);
	$str = NULL;
	echo base64_encode($str);
}
main();
