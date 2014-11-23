<?php
function urlReplace($url,$param,$value) 
{
	$url = 'http://game.sina.com/index.php?id=1121&pic=123';
	$regex = '#(?<=[&|?])([\w.]+)=([\w.]+)#';
//	$regex = '#[&|?]([\w.]+)=#';
	if(preg_match_all($regex,$url,$matches))
	//	print_r($matches);
	var_dump($matches);
	$regex = array();
	$regex[0] = '#(?<=[&|?])([\w.]+)(?<!=)#';
	$regex[1] = '#(?<=[\w]=)([\w]+)#';
	$replace = array();
	$replace[0] = 'test';
	$replace[1] = 'rest';
	$abc = preg_replace($regex,$replace,$url);
    var_dump($abc);
}
urlReplace('11','11','11');
?>
