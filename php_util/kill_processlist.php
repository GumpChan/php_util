<?php
class db 
{
	
	public $dbms = 'mysql';
    public $host = '10.205.16.193';
    public $dbName = 'yii2advanced';
    public $user = 'root';
    public $pwd = '';
    public $db = "";
    public $dsn = "";
	public static $connection;
	
    public static function connection()
    {
		if(self::$connection==""){
    		  try{
					$dbinfo = new self;
					$dbinfo->dsn = "$dbinfo->dbms:host=$dbinfo->host;dbname=$dbinfo->dbName";
            		$connection = new PDO($dbinfo->dsn,$dbinfo->user,$dbinfo->pwd);
                	echo "连接成功";
                    self::$connection  = $connection;
            	    return self::$connection;
          	  }catch(PDOException $e){
            	     die($e->getMessage());
        	  }
		}else{
			return self::$connection;
		}
	}
}
function main()
{
	while(1){
	$connection = db::connection();
	$processes = $connection->query("select * from information_schema.processlist;");
	foreach($processes as $process){
		var_dump($process['ID']);
		$connection->query("kill ".$process['ID']);// or die (print_r($connection->errorInfo()));
	}
	}
}
	main();

?>
