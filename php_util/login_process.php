<?php
function dataRead()
{
	
	echo 'mem_usage_start:',memory_get_usage()/(1024*1024)," M\n";
	$process_start_time = time();
	$sets = fileRead('login_json.log');
	$dau = array();
	foreach($sets as $set ) {
		$dau[$set[0]]=$set[1];	
	}
	echo count($dau)."\n";
	echo 'mem_usage_end:', memory_get_usage()/(1024*1024)," M\n";
	echo 'time:',(time()-$process_start_time),"\n";
}
function fileRead($json) 
{
	return json_decode(file_get_contents($json));	
}
dataRead();
?>
