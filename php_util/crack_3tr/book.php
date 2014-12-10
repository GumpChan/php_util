<?php
function search_trains($search_url, $time = null)
{
	$cookie_dir = __DIR__.'/cookie/book';
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
		CURLOPT_COOKIEFILE => $cookie_dir,
		CURLOPT_COOKIEJAR => $cookie_dir,
	);
	curl_setopt_array($ch, $options);
	$xyz = curl_exec($ch);
	$fp = fopen('log.html','w');
	$arr = json_decode($xyz);
	$data = $arr->data;
	foreach($data as $data) {
	echo '车次：', $data->queryLeftNewDTO->station_train_code, PHP_EOL;
	echo '软卧：', $data->queryLeftNewDTO->rw_num, ' 硬卧：', $data->queryLeftNewDTO->yw_num, PHP_EOL;
	}
	$fw_flag = fwrite($fp, $xyz);	
	if(!$fw_flag)
		echo '写入失败';
	return $xyz;
}
$search_rul = 'https://kyfw.12306.cn/otn/lcxxcx/query?purpose_codes=ADULT&queryDate=2015-02-16&from_station=BJP&to_station=CCT';
$search_url_logined = 'https://kyfw.12306.cn/otn/leftTicket/queryT?leftTicketDTO.train_date=2015-02-16&leftTicketDTO.from_station=BJP&leftTicketDTO.to_station=CCT&purpose_codes=ADULT';
search_trains($search_url_logined);



?>
