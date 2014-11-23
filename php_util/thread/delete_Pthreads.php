<?php

class db 
{

    public $dbms = 'mysql';
    public $host = '10.205.16.246';
    public $dbName = 'yii2advanced';
    public $user = 'root';
    public $pwd = '';
    public $db = "";
    public $dsn = "";

    function __construct(){
        $this->dsn = "$this->dbms:host=$this->host;dbname=$this->dbName"; 
    	$this->connection();
    }
	
    private function connection()
    {
		try{
            $connection = new PDO($this->dsn,$this->user,$this->pwd);
    	    echo "连接成功";
	    	$this->db = $connection;
	   	    return ;
		}catch(PDOException $e){
	    	die($e->getMessage());
		}
    }
    public function query($sql)
    {
		return $this->db->exec($sql) or die(print_r($this->db->errorInfo(),true));
    }
}
class test extends Thread 
{
	public $work = "";
	public $value = "";
		
	public function getWork()
	{
		$works = array('appStore','googlePlay','91','weiyou','test');
		return $works;	
	}

	public function run()
	{
    	$db = new db();
    	date_default_timezone_set("UTC");
		$sql = "delete from `game_recharge_record` limit 50000;";
		for($i=0;$i<10;$i++){
			$db->query($sql);
		}
		echo "success";
		$this->value = "123";
	}
}
function main()
{
	$nuts = array();
    for($i=0;$i<5;$i++)
	{
			$tmp = new test();
			array_push($nuts,$tmp);
			$tmp->start();
	}
	foreach($nuts as $value => $key)
	{
		while($key->isRunning()){
			echo "thread$value processing";
			sleep(3);
		}
	}
    return ;
}
main();
?>
