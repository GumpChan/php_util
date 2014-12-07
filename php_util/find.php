<?php
	ini_set('register_argc_argv','on');	
	$longopts = array("arr::","match_val:");	
	$val = getopt("",$longopts);
	//var_dump($val);
	$match_val = (int)$val['match_val'];
	if(isset($val['arr']))
		$arr = $val['arr'];
	else
		$arr = array(100=>1,1=>2,3,123,14234,34562,12,34,6,20,100,123456);
	asort($arr);
	var_dump($arr);
	function find($match_val, $arr)
	{
		//echo count($arr), PHP_EOL;
		if(empty($arr))
			return 'not match!!';
		$index = array_keys($arr);
		$offset = floor((count($index)-1)/2); 
		$mid_index = $index[$offset];
		if($arr[$mid_index] > $match_val) {
		 	$arr = array_slice($arr, 0, $offset, true);
			//echo	var_dump($arr),'~~~~',$offset;
			$mid_index = find($match_val,$arr);
		} else if($arr[$mid_index] < $match_val) {
			$arr = array_slice($arr, $offset+1,NULL, true);
			$mid_index = find($match_val, $arr);
		}
			return $mid_index;
		//echo $mid_key, PHP_EOL; 
	}
	echo 'match_key:', find($match_val,$arr), PHP_EOL;
?>
