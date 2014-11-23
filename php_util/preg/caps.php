<?php
$str = "AFsadfsadfasfAAFAxASFASasdfasdfasfwerSdFASFDAASFDsaasfsadfafDFSsfASSF";
$regex = "/(?<=([A-Z]{2}))[a-z]{1}(?=([A-Z]{2}))/";
$matches = array();
if(preg_match_all($regex,$str,$matches,PREG_OFFSET_CAPTURE)){
	var_dump($matches);
}
	var_dump($str);
?>
