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
    public function query($sql,$time)
    {
			//echo $sql;
			echo date('Y-m-d h',$time);
			echo "\n";
			$this->db->exec($sql) or die(print_r($this->db->errorInfo()));
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
	public function timeCal($gnp_time, $period, $interval) 
	{
		$ret = array();
		if ($period == 'day') {
			$interval = $interval;
		}
		if ($period == 'week') {
			$interval = $interval*7;
		}
		if ($period == 'month') {
			$date_param = "+{$interval} month";
		}else
			$date_param      = "-{$interval} {$period}"; 
		$ret['time']     = strtotime($date_param, $gnp_time);
		$ret['interval'] = $interval;
		$ret['create']   = strtotime(date('Y-m-d'));
		return $ret;
		
	}
	public function run()
	{
		$db = db::getInstance();
    	date_default_timezone_set("UTC");
		$gnp_date = 1414886400;//strtotime('-20 day', strtotime(date('Y-m-d')));
		for($gbi_id=1; $gbi_id<20; $gbi_id++) {
			for ($j=1; $j<300; $j++) {
				$time = $this->timeCal($gnp_date, 'day', $j);
					for($i=1; $i<71; $i++) {
						$amount = rand(20000,80000);
						$pau = rand(1000,20000);
						$grr_count = rand(0,10000);
						$duration = rand(1,60);
						$launch = rand(80000,100000);
						$sql = "insert `game_active_player_day` (`quantity`, `class`, `gbi_id`, `channel_id`, `pau`, `launch`, `time`, `create_time`) values ({$amount}, $i, {$gbi_id}, '".$this->work."', {$pau}, {$launch}, {$time['time']}, {$time['create']})";
						$db->query($sql,$time['time']);
						$this->sum ++;
					}
			}
		}
		echo "pthread done ";
		return ;	
	}
}
function main()
{
	$nuts = array();
    for ($i=0;$i<1;$i++) {
			$tmp = new test();
		foreach($tmp->getWork() as $work) {
 			$thread = new test();
			$thread->work = $work;
			array_push($nuts,$thread);
		}
	}
	foreach ($nuts as $value) {
		$value->start();
		//echo "pthread";
	}
	$sum  = 0;
	foreach ($nuts as $value) {
		while ($value->isRunning()){
			sleep(10);	
		}
		if ($value->join()) {
			$sum += $value->sum;
		}
	}
	echo $sum;
    return ;
}
main();
?>
