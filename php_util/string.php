<?php
$str = '123123123dadfafds中文';
for($i=0; $i<strlen($str); $i++) {
    echo strlen($str), '--', $i, '--', $str[$i].$str[$i+1], PHP_EOL;

}


?>

