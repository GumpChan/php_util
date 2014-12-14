<?php
include (__DIR__.'/preg_process.php');
function header_config($url, $host, $cookie_dir)
{
	return array(
			CURLOPT_URL => $url,	
			CURLOPT_NOBODY => FALSE,
			CURLOPT_HEADER => FALSE,
			CURLOPT_USERAGENT => 'baiduspider',
			CURLOPT_ENCODING => 'gzip, deflate',
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER => get_header($host),
			CURLOPT_COOKIEJAR => $cookie_dir,
	);
}
function get_header($host) 
{
	return array(
		"Host:$host",
		'Accept-Language:zh-cn,zh;q=0.8,en-us;q=0.5,en;q=0.3',
		'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
		'Connection:keep-alive',
	);
}
function get_page($header_config) 
{
	$ch = curl_init();
	curl_setopt_array($ch,$header_config);
	$ret = curl_exec($ch);
	return $ret;
}
function save($resource_dir, $data, $file_name=NULL) 
{
	$file_name = $resource_dir.'/'.$file_name;
	if(file_exists($file_name))
		$fp = fopen($file_name, 'w+');
	else
		$fp = fopen($file_name,'w');
	return fwrite($fp,$data);
}
function get_dir($dir_name) {
	if(!file_exists($dir_name))
		mkdir($dir_name,0755);
	return __DIR__.'/'.$dir_name;
}
function main() 
{
$url = $host = 'chuanboyi.com';
$cookie_dir = get_dir('cookie');
$resource_dir = get_dir('website');
$header_config = header_config($url, $host, $cookie_dir);
$page = get_page($header_config);
$data = get_tag_a($page);
var_dump(get_tag_a($page));
echo array_count_values($data[1]), PHP_EOL;
echo count(get_tag_a($page),1);//如果统计多维数组，则count第二个参数为1，返回数组长度总和
return false;
$ret = save($resource_dir,$page,'index.html');
if($ret)
	return 'ok !!';
else
	return 'sorry !!';
echo $cookie_dir, var_dump($header_config), PHP_EOL;

}
main();

?>
