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
			$date_param      = "+{$interval} {$period}"; 
		$ret['time']     = strtotime($date_param, $gnp_time);
		$ret['interval'] = $interval;
		$ret['create']   = $ret['time'];
		return $ret;
		
	}
	public function run()
	{
		$db = db::getInstance();
    	date_default_timezone_set("UTC");
		$gnp_date = 1415145600;//strtotime('-20 day', strtotime(date('Y-m-d')));
		for ($j=1; $j<7; $j++) {
//			$date_param = "-{$j} day";
  //  		$date = strtotime($date_param,strtotime(date('Y-m-d')));
	//		$week = strtotime('Monday this week', $date);
	//		$month = strtotime(date('Y-m-01', $date));
			$time_interval = $j;
			$time = $this->timeCal($gnp_date, 'day', $time_interval);
	//		if($week > $date)
	//			$week = strtotime("Monday this week", strtotime("-1 day", $date));//周陷阱 默认是周日是周的第一天 
	//		$day = $date ;
	//		for ($i=1; $i<=23; $i++) {
	//			$date_params = "+{$i} hour ";
	//			$date = strtotime($date_params,$date);
	//			echo "week:".date("Y-m-d", $week)."date:".date("Y-m-d h", $date)."\n";
					$grr_player_id = rand(0,10000);
					$amount = rand(10000,100000);
					$grr_count = rand(0,10000);
		//			$sql = "insert `game_retention_month` (`gbi_id`, `quantity`, `channel_id`, `gnp_month`, `time_interval`, `time`, `create_time`) values ('2', {$amount}, '".$this->work."', {$gnp_date}, {$time_interval}, {$time['time']}, {$time['create']});";
			//		$sql = "insert `game_new_player` (`gbi_id`, `quantity`, `channel_id`, `month`, `week`, `day`, `time`, `create_time`) values (2, {$amount}, '".$this->work."', {$month}, {$week}, {$day}, {$date}, {$date})";
			//		$sql = "insert `game_recharge_stats` (`gbi_id`,`pu`,`channel_id`,`total`,`time`,`create_time`,`count`,month,week) values (2,{$grr_player_id},'".$this->work."',{$amount},{$date},{$date},{$grr_count},$month,$week);"; 
					$sql = "insert `game_retention_day` (`quantity`, `gbi_id`, `channel_id`, `gnp_day`, `time_interval`, `time`, `create_time`) values ({$amount}, 2, '".$this->work."', {$gnp_date}, {$time_interval}, {$time['time']}, {$time['create']})";

					$db->query($sql);
					$this->sum ++;
//			}
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
