<?php
$str1='abcdefg';
$str2='adsfad123ewasfadfafd';
function strIsIn($str1, $str2)
{
    for($i=0;$i<strlen($str1);$i++) {
        echo $str1[$i];
	if(strpos($str2,$str1[$i])===false)
	    return false;
    }
    return true;
}
if(strIsIn($str1, $str2))
	echo 'yes';
else
        echo 'no';
echo PHP_EOL;
var_dump(str_split($str2));
?>
