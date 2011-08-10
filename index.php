<?php
error_reporting(E_ALL & E_STRICT);
if(!isset($_GET["lanid"]))
 $_GET["lanid"] = 1;

if(!isset($_GET["page"]))
$_GET["page"] = "timetable";
 
if(isset($_GET["ajax"]))
 define("LANMAN_AJAX","1");



if(defined("_LANMAN_INTEGRATION")) {
	//change cwd so relative paths work correctly.
	$originalcwd = getcwd();
	chdir(dirname(__FILE__));
	include 'core/integration.php';	
	chdir($originalcwd);
}
else
{
	include 'core/intranet.php';
}
?>