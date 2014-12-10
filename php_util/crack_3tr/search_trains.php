<?php
    ini_set('register_argc_argv','on');
    $longopts = array("time:");
    $val = getopt("",$longopts);
function request($search_url, $time=null) {
$cookie_dir = tempnam(__DIR__.'/cookie','cookie');
	//var_dump($cookie_dir);
	$ch = curl_init();
	$header1 = array(
		'Host:kyfw.12306.cn
		Accept-Language:zh-cn,zh;q=0.8,en-us;q=0.5,en;q=0.3
		Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
		Connection:keep-alive'
	);
	$header = array(
		'Host:localhost',
		'Accept-Language:zh-cn,zh;q=0.8,en-us;q=0.5,en;q=0.3',
		'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
		'Connection:keep-alive',
	);
	$options = array(
	//	CURLOPT_URL => 'http://localhost/yii2Release/advanced/backend/web/index.php?r=site/login',	
		CURLOPT_URL => $search_url,	
//		CURLOPT_URL => 'https://www.baidu.com',	
		CURLOPT_NOBODY => FALSE,
		CURLOPT_HEADER => FALSE,
		CURLOPT_PORT  => 443,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_SSL_VERIFYHOST => FALSE,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:34.0) Gecko/20100101 Firefox/34.0',
		CURLOPT_ENCODING => 'gzip, deflate',
		CURLOPT_HTTPHEADER => $header1,
		CURLOPT_COOKIEJAR => $cookie_dir,
	);
	curl_setopt_array($ch, $options);
	$ret = curl_exec($ch);
	return $ret;	

}
function search_trains($search_url, $time = null)
{
	$fp = fopen('log.html','w');
	$xyz = request($search_url);
	$arr = json_decode($xyz);
	$data = $arr->data;
	$flag = 1;
	while($flag) {
		$xyz = request($search_url);
		$arr = json_decode($xyz);
		$data = $arr->data;
		echo '车次：', $data[18]->queryLeftNewDTO->station_train_code, PHP_EOL;
		echo '软卧：', $data[18]->queryLeftNewDTO->rw_num, ' 硬卧：', $data[17]->queryLeftNewDTO->yw_num, PHP_EOL;
		echo '车次：', $data[17]->queryLeftNewDTO->station_train_code, PHP_EOL;
		echo '软卧：', $data[17]->queryLeftNewDTO->rw_num, ' 硬卧：', $data[17]->queryLeftNewDTO->yw_num, PHP_EOL;
		sleep(1);
	}
	return false;
	foreach($data as $data) { //18,19
	echo '车次：', $data->queryLeftNewDTO->station_train_code, PHP_EOL;
	echo '软卧：', $data->queryLeftNewDTO->rw_num, ' 硬卧：', $data->queryLeftNewDTO->yw_num, PHP_EOL;
	}
	$fw_flag = fwrite($fp, $xyz);	
	if(!$fw_flag)
		echo '写入失败';
	return $xyz;
}
$val['time'] = isset($val['time'])?date('Y-m-d',strtotime($val['time'])):date('Y-m-d',strtotime('+68 day'));
$search_rul = 'https://kyfw.12306.cn/otn/lcxxcx/query?purpose_codes=ADULT&queryDate=2015-02-16&from_station=BJP&to_station=CCT';
$search_url_logined = 'https://kyfw.12306.cn/otn/leftTicket/queryT?leftTicketDTO.train_date='.$val['time'].'&leftTicketDTO.from_station=BJP&leftTicketDTO.to_station=CCT&purpose_codes=ADULT';
search_trains($search_url_logined);



?>
