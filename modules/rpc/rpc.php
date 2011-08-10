<?php
include ('core.php');
include ("libs/phprpc/phprpc_server.php");
include ('libs/rpclib.php');
if(isset($_GET["key"]) && streq($_GET["key"], Config::$intpass))
{

$server = new PHPRPC_Server();
$server->add('GetUsers');
$server->add('CheckLogin');
$server->start();
}
else
{
	echo "Aliens, they be coming!!!1";
}
?>