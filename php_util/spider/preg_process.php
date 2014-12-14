<?php
function get_tag_a($data) 
{
	//$data = "href='http://www.baidu.com';";
	$regex = "#(?<=href=[\'|\"])(.+)(?=.php)#isU";//([;|]+)#';
	preg_match_all($regex,$data,$matches);
	return $matches;

}
//$data = 'href=\'www.baidu.com\'';
//get_tag_a($data);


?>
