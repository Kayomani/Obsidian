<?php
interface QueryInterface
{
	function QueryServer($server);
	function GetGameList();
	function FindMapImage($server);
	function CheckPorts($server);
}
//Statically import lgsl for now
require_once("libs/lgsl/lgsl.php");

?>