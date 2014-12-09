<?php
$file_path = 'getPassCodeNew1.png';
function image_process($file_path)
{
	$res = imagecreatefrompng($file_path); 
	$size = getimagesize($file_path);	
	for($i=0; $i < $size[1]; ++$i) {
        for($j=0; $j < $size[0]; ++$j) {
				$rgb = imagecolorat($res,$j,$i);
				$rgbarr = imagecolorsforindex($res, $rgb);
				if($rgbarr['red'])
				echo var_dump($rgbarr), PHP_EOL;
				$r= $rgbarr['red'] * 0.33;
				$g= $rgbarr['green'] * 0.33;
				$b= $rgbarr['blue'] * 0.33;
				$t= round(($r+$g+$b) /255);

				if($t == 0) {//$r !=202
					$data[$i][$j]=1;
				}else {
					$data[$i][$j]=0;
				}
		}
  }
	return array(
		$data,
		$size
	);
}
function draw($data, $size) 
{
		for($i=0; $i<$size[1]; ++$i)  
        {  
            for($j=0; $j<$size[0]; ++$j)  
            {  
                echo $data[$i][$j];  
            }  
            echo PHP_EOL;  
        }  	


}
$ret = image_process($file_path);
draw($ret[0], $ret[1]);
?>
