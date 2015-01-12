<?php
function maxSumArr()
{
    $arr = array(1,2,3,-3,-123,-412,4,-123);
    $tmp_sum = 0;
    $real_sum = 0;
    for($i=0; $i<count($arr); $i++) {
	$tmp_sum += $arr[$i];
	$tmp_arr[] = $arr[$i];
        if($tmp_sum > $real_sum) {
	    $real_sum = $tmp_sum;
	    $real_arr = $tmp_arr;
	} else if($tmp_sum<0) {
	    $tmp_sum = 0;
	    unset($tmp_arr);
	}
	    	
    }
    return $real_arr;
}
$ret = maxSumArr();
var_dump($ret);
?>
