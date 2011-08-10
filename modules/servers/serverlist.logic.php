<?php

//Prototype

function handleError($errno, $errstr, $errfile, $errline, array $errcontext)
{
	// error was suppressed with the @-operator
	if (0 === error_reporting()) {
		return false;
	}

	throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}



if(isset($_GET["action"]) && streq($_GET["action"],"validate"))
{
	try{
		//set_error_handler('handleError');
		$protocol = POSTSafe("protocol");
		$address = POSTSafe("address");
		$cport = POSTSafe("port");
		$qport =  POSTSafe("qport");
		
		$master->Smarty->Assign("protocol",$protocol);
		$master->Smarty->Assign("address",$address);
		$master->Smarty->Assign("cport",$cport);
		$master->Smarty->Assign("qport",$qport);

		$server = new Lan_servers;
		$server->protocol = $protocol;
		$server->address = $address;
		$server->cport = $cport;
		$server->qport = $qport;
		
		
		if(strlen($cport)==0)
		{
			$master->Smarty->Assign("valerror","You must enter a port!");
		}
		else if(0==$server->count())
		{
			$q = new GameServerQuery;
			$server = $q->CheckPorts($server);
			$server = $q->QueryServer($server);
			if(streq($server->ping,"-1"))
			{
				$master->Smarty->Assign("valerror","Please check the information entered, I could not find a server at that location!");
			}
			else
			{
				$server->user_id = getCurrentUID();
				$server->type =0;
				$server->lastupdated = strftime("%Y-%m-%d %H:%M:00", strtotime("yesterday"));
				$key = $server->insert();
				header("Location: ?page=editserver&sid=".$key);
				die();
			}
		}
		else
		{
			$master->Smarty->Assign("valerror","A server at this location already exists!");
		}
	}
	catch (Exception $e)
	{
		$master->Smarty->Assign("valerror",$e->getMessage());
	}
}
?>