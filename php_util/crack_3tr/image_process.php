<?php
$file_path = 'getPassCodeNew_book.png';
function image_process($file_path)
{
	$im = imagecreatefrompng($file_path); 
	return getimagesize($file_path);	
}
$ret = image_process($file_path);
var_dump($ret);
?>
