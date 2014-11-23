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
    public function query($sql,$type)
    {
			//echo $sql;
			if($type == 'search')
				$this->db->exec($sql) or die(print_r($this->db->errorInfo()));
			else
				$this->db->query($sql) or die(print_r($this->db->errorInfo()));
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
		$db->query($this->sql);
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
			$thread->sql  = 'select sum(t.quantity) as quantity, sum(a.pau) as pau, t.time  from `game_retention_day` t left join `game_active_player_day` a on t.gbi_id = a.gbi_id and t.time = a.time where t.gbi_id = 2 group by t.`time`;';
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
