<?php
$file_path = 'getPassCodeNew1.png';
function image_process($file_path)
{
	$res = imagecreatefrompng($file_path); 
	$size = getimagesize($file_path);	
	for($i=0; $i < $size[1]; ++$i) {
        for($j=0; $j < $size[0]; ++$j) {
				$rgb = imagecolorat($res,$j,$i);
				$rgbarray = imagecolorsforindex($res, $rgb);
				$r= $rgbarray['red'] * 0.25;
				$g= $rgbarray['green'] * 0.25;
				$b= $rgbarray['blue'] * 0.25;
				$t= round(($r+$g+$b) /128);

				if($t == 0) {
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
