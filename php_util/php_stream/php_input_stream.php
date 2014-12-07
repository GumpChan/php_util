<?php
$raw_post_data = file_get_contents('php://input','r');
echo '-------$_POST-----------', PHP_EOL;
echo var_dump($_POST),PHP_EOL;
echo '------php://input-------',PHP_EOL;
echo $raw_post_data, PHP_EOL;
?>
