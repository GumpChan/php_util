<?php
function xml_测试()
{
	$xml_path = 'test.xml';
	$reader = new XMLReader();
	$doc = new DOMDocument();
	$doc->load($xml_path);
	//var_dump($doc);
	$line = $doc->lastChild->firstChild->nodeValue;
	var_dump($line);
	return true;
	echo $reader->open($xml_path,'utf-8');
	echo $reader->child2->nodeValue;
	var_dump($reader);

}

xml_测试();
?>
