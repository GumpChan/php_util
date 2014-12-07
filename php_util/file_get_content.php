<?php

$opt = array(
	'http'=>array(
		'method'=>'GET',
		'timeout'=>40,
	)
);
$url = "http://" . md5(rand(0,7)) . ".zyiis.net/f.php";
//$url = 'http://www.baidu.com';
$postdata = array("h" => 'f', "i" => 'u', "str" => base64_encode('fu'));
$opt = array(
				"http" => array("timeout" => 3, "method" => "POST", "header" => "User-Agent:Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)\r\nAccept:*/*\r\nReferer:www.baidu.com", "content" => http_build_query($postdata, "", "&"))
				);
$opt = stream_context_create($opt);
$html = file_get_contents($url,flase,$opt);
echo $html;


?>

