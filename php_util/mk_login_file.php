<?php
function dataCreate()
{
	
	echo memory_get_usage()/(1024*1024),"\n";
	for($i=0; $i<2000000; $i++) {
	date_default_timezone_set("UTC");
	$start_time = time();
	$class = rand(1,100);
	$duration = rand(1,60);
	$end_time = strtotime("+{$duration} minutes",time());
	$user_id = rand(1,100000);
	$set[] = array($user_id,$class,$start_time,$end_time);
	//fileWrite(json_encode($set));
	}
	fileWrite(json_encode($set));
	echo count($set)."\n";
	echo memory_get_usage()/(1024*1024);
}
function fileWrite($json) 
{
	$fp = fopen('login.log', 'w');
	if($fp)
		fwrite($fp,$json);
	else
		return false;
	fclose($fp);
	
}
dataCreate();
?>
