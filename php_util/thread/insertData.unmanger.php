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
		$this->db->exec($sql);
    }
}
class test extends Thread 
{
	public $work = "";
	
	public function getWork()
	{
		$works = array('appStore','googlePlay','91','weiyou','test');
		return $works;	
	}

	public function run()
	{
    	$db = new db();
    	date_default_timezone_set("UTC");
    	$date = strtotime("now");
		$works = $this->getWork();
		echo "\n" ;
		$grr_gbi_id = rand(0,100);
	    foreach($works as $value){
			for($i=0;$i<250000;$i++)
			{
				$grr_player_id = rand(0,10000);
				$amount = rand(0,10000000);
    			$sql = "insert `game_recharge_record` (`grr_gbi_id`,`grr_player_id`,`grr_channel`,`grr_total`,`grr_amount`,`grr_date`,`grr_create_date`)
		 			"." values ($grr_gbi_id,$grr_player_id,'".$value."',123,$amount,$date,$date);";
				$db->query($sql);
				echo $value;
				echo "pthread running $i \n" ;
			}
		}
		return ;	
	}
}
function main()
{
	$nuts = array();
    for($i=0;$i<1000;$i++)
	{
		$tmp = new test();
		array_push($nuts,$tmp);
		//$tmp->run();//根据grr_channel,grr_player_id多任务并行未完成
	}
	foreach($nuts as $value)
	{
		$value->start();
		echo "pthread";
	}
    return ;
}
main();
?>
