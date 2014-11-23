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
	public static $connection = "";

    private function __construct(){
        $this->dsn = "{$this->dbms}:host={$this->host};dbname={$this->dbName}"; 
    	$this->connection();
    }
	
	static function getInstance()
	{
		if(self::$connection == ""){
			echo "123\n";
			self::$connection = new self;
		}
			return self::$connection;
	}
	
    private function connection()
    {
		try{
        	    $con = new PDO($this->dsn,$this->user,$this->pwd);
				echo "连接成功";
	   			$this->db = $con;
		}catch(PDOException $e){
	    	die($e->getMessage());
		}
    }
    public function query($sql)
    {
			echo $sql;
			$this->db->exec($sql) or die(print_r($this->db->errorInfo()));
    }
}
class ttt 
{

	public $test = "";
}
class test extends Thread 
{
	public $work = "";
	public $sum = 0;
	public $con = "";
	
	public function getWork()
	{
		$works = array(1,2,3,4,5);
		return $works;	
	}

	public function run()
	{
		$db = db::getInstance();
    	date_default_timezone_set("UTC");
    	//$date = strtotime("-1 day",strtotime(date('Y-m-d')));
		//echo "$date\n" ;
		for($j=1; $j<2; $j++){
			$dateparams = "-{$j} day";
//			$date = strtotime( date("Y-m-d")); 
			$week = 1;
			$day = date('Y-m-d',$date);
			echo date("Y-m-d");
			//$date = strtotime("+2 day",strtotime(date("Y-m-d")));
			for($i=0;$i<24;$i++)
			{
				$format = 'Y-m-d';
				$date = strtotime(date($format)." {$i}:00");
				$grr_player_id = rand(0,10000);
				$amount = rand(0,10000000);
				$grr_count = rand(0,10000);
				$sql = "insert `game_new_player` (`gbi_id`,`channel_id`,`number`,`time`,`create_time`,month,week,date) values (2,'".$this->work."',{$amount},{$date},{$date},11,$week,'');";
/*    			$sql = "insert `game_recharge_record` (`grr_gbi_id`,`grr_player_id`,`grr_channel`,`grr_amount`,`grr_date`,`grr_create_date`)
		 		"." values ($grr_gbi_id,$grr_player_id,'".$this->work."',$amount,$date,$date);";
*/
//				$sql = "delete from `game_recharge_record` limit 30000;";
				$db->query($sql);
				echo $this->work;
				//echo "work done $i \n" ;
				$this->sum ++;
			}
		}
		echo "pthread done ";
		return ;	
	}
}
function main()
{
	$nuts = array();
//	$db = new db();
//	$sql = "delete from `game_recharge_record` limit 1000;";
    for($i=0;$i<1;$i++) 
	{
//		$count = $db->query($sql);	
//		if($count>0)
//			echo "success!!";
//		else
	//		echo "failed";
		    //$con = db::getInstance();	
			$tmp = new test();
		foreach($tmp->getWork() as $work){
 			$thread = new test();
			$thread->work = $work;
			array_push($nuts,$thread);
		}
	}
//	return true;
	foreach($nuts as $value)
	{
		$value->start();
		//echo "pthread";
	}
	$sum  = 0;
	foreach($nuts as $value){
		while($value->isRunning()){
			sleep(10);	
		}
		if($value->join()){
			$sum += $value->sum;
		}
	}
	echo $sum;
    return ;
}
main();
?>
