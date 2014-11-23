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
			$this->db->exec($sql) or die(print_r($this->db->errorInfo()));
    }

	public function timeCal($gnp_time, $period, $interval)
    {
        $ret = array();
        if ($period == 'day') {
            $interval = $interval;
        }
        if ($period == 'week') {
            $interval = $interval;
        }
        if ($period == 'month') {
            $date_param = "-{$interval} month";
        }else
            $date_param      = "-{$interval} {$period}";
        $ret['time']     = strtotime($date_param, $gnp_time);
        $ret['interval'] = $interval;
        $ret['create']   = $ret['time'];
        return $ret;

    }
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
		$grr_gbi_id = rand(0,100);
		$gnp_time   = strtotime('2014-11-1');
		for($j=7;$j<70;$j++){
			$time_interval = $j;
            $time = $db->timeCal($gnp_time, 'day', $time_interval);
			for($class=1;$class<71;$class++)
			{
				$grr_player_id = rand(0,10000);
				$amount = rand(8000,10000);
				$plu = rand(1000,5000);
				$sql = "insert `game_lost_player_day` (`gbi_id`,`channel_id`,`class`,`quantity`,`plu`,`time`,`create_time`) values (2,'".$this->work."',{$class},{$amount},{$plu},{$time['time']},{$time['create']});";
				$db->query($sql);
				echo $this->work;
				echo "work done $class \n" ;
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
    for($i=0;$i<1;$i++) 
	{
			$tmp = new test();
		foreach($tmp->getWork() as $work) {
 			$thread = new test();
			$thread->work = $work;
			array_push($nuts,$thread);
		}
	}
	foreach($nuts as $value)
	{
		$value->start();
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
