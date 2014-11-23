<?php
function awk() 
{
	$proc_start_time = time();
	$result = shell_exec("grep -P -o '\d+,\d+,\d+,\d+' login.log | awk -F, '{print $1}' | sort | uniq  | wc -l");	
	echo $result."\n";
	echo 'time:',time()-$proc_start_time,"\n";
}
awk();

?>
