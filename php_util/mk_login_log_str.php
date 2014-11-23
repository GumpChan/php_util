<?php
function dataCreate()
{
	
	echo 'mem_usage_start:',memory_get_usage()/(1024*1024)," M\n";
	$process_start_time = time();
	$str = '';
	for($i=0; $i<2000000; $i++) {
	date_default_timezone_set("UTC");
	$start_time = time();
	$class = rand(1,100);
	$duration = rand(1,60);
	$end_time = strtotime("+{$duration} minutes",time());
	$user_id = rand(1,100000);
	$str .= "[{$user_id},{$class},{$start_time},{$end_time}], \n";	
	}
	fileWrite("{\n".$str."}$i\n");
	echo 'mem_usage_end:', memory_get_usage()/(1024*1024)," M\n";
	echo 'time:',(time()-$process_start_time),"\n";
}
function fileWrite($data) 
{
	$fp = fopen('login.log', 'w');
	if($fp)
		fwrite($fp,$data);
	else
		return false;
	fclose($fp);
	
}
dataCreate();
?>
