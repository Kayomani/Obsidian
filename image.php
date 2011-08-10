<?php
include_once 'core/util.php';
$cachedir = "cache/images/";

$source = "images/".GETSafe('img');
$x =  GETSafe('x');
$y =  GETSafe('y');
$cachefile = md5($source .$x .$y);
$path= pathinfo($source);
$ext = strtolower($path["extension"]);

if(!$source|| !$x || !$y)
die("Missing Params");


if(!file_exists($cachedir . $cachefile))
{
	if(!is_dir($cachedir))
	mkdir($cachedir,0777);

	smart_resize_image($source,$x,$y,false,$cachedir.$cachefile,false,false);
}



$im = file_get_contents($cachedir . $cachefile);
header(   'Expires: '.gmdate('D, d M Y H:i:s', strtotime("+20 week")).'GMT');  

switch($ext)
{
	case "jpeg":
	case "jpg":
		header('Content-type: image/jpeg');
		header('Content-transfer-encoding: binary');
		break;
	case "gif":
		header('Content-type: image/gif');
		header('Content-transfer-encoding: binary');
		break;
	case "png":
		header('Content-type: image/png');
		header('Content-transfer-encoding: binary');
		break;
}


echo $im;
die();
?>