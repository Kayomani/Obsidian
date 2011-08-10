<?php

if(isset($_GET["action"]) && streq($_GET["action"],"edit") && isset($_POST["address"]))
{
	$server = new Lan_servers;

	if($server->get(GETSafe('sid')))
	{
		$server->address = POSTSafe("address");
		$server->cport = POSTSafe("port");
		$server->qport = POSTSafe("qport");
		$server->hostnameoverride = POSTSafe("hostnameoverride");
		$server->comment = POSTSafe("comment");
		if(isset($_POST["official"]))
		$server->type = 1;
		else
		$server->type =0;
		if(isset($_POST["delete"]))
		{
			$server->delete();
			header("Location: ?page=serverlist");
			die();
		}
		else
		$server->update();
	}
}

?>