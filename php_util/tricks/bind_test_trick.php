<?php
function testBindParam() 
{
	$dbh = new PDO('mysql:host=10.205.16.246;dbname=yii2advanced;charset=utf8','root','1qaz2wsx');
	$query = '
		INSERT INTO `user` (`username`,`password_hash`) VALUES (:user,:pwd);';
	$statement = $dbh->prepare($query);
	$bind_params = array(':user'=>'chen',':pwd'=>'game.sina');
	foreach($bind_params as $key => &$value) {
		$statement->bindParam($key,$value);
	}
	$statement->execute();
	var_dump($statement);
	$statement->debugDumpParams();
	print_r($dbh->errorInfo());
}
testBindParam();		
?>
