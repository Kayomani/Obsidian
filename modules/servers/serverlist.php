<?php

//error_reporting(E_ALL);
//require_once 'libs/gameq/GameQ.php';
require_once 'queryInterface.php';
require_once 'serverlist.logic.php';
$list = array();
$userlist = array();
$variablelist = array();
$q = new GameServerQuery;
$server = new Lan_servers;
$server->find();
while($server->fetch()){
	$q->QueryServer($server);

	$server->icon = $q->FindMapImage($server);

	$list[] = clone($server);
	$userlist[] = $server->getPlayers();
	$variablelist[] = $server->getServerVars();
	$server->update();
}


//Parse autoscanner list
$datafile = "modules/servers/data/list.xml";
$scanserverid = -1;
if(file_exists($datafile))
{
	$modified = strtotime("now")- filemtime($datafile);
	$master->Smarty->assign("scanmod",$modified);

	//Add servers
	try{
		$nodes = new SimpleXMLElement(file_get_contents($datafile));

		foreach($nodes as $servernode)
		{
			//Make sure the server isn't already listed.
			$inlist = false;
			foreach($list as $servers)
			{
				if(streq($servernode->address,$servers->address . ":" . $servers->cport))
				{
					$inline = true;
				}
			}
				
			if(!$inlist)
			{
				$server = new Lan_servers;
				$address = substr($servernode->address,0,strpos($servernode->address,":"));
				$port = substr($servernode->address,strpos($servernode->address,":")+1,strlen($servernode->address)-(strpos($servernode->address,":")+1));
				$server->playercount = $servernode->playercount;
				$server->maxplayers = $servernode->maxplayers;
				$server->cport = $port;
				$server->qport = $port;
				$server->sport= $port;
				$server->server_id = $scanserverid--;
				$server->map = $servernode->map;
				$server->dedicated = "?";
				$server->address = $address;
				$server->gamename = $servernode->game;
				$server->hostname = $servernode->name;
				$server->ping = $servernode->ping;
				$server->user_id = -1;

				$varlist = array();
				foreach($servernode->rules->rule as $k => $v)
				{
					$prop = (string)$v->prop;
					$val = (string)$v->value;
					$varlist[$prop] = $val;
				}
				$ulist = array();
				foreach($servernode->players->player as $k => $v)
				{
					$p = new Lan_servers_player;
					$p->name = (string)$v->name;
					$p->time = (string)$v->time;
					$p->score = (string)$v->frags;
					$ulist[] = $p;
				}

				
				$userlist[] = $ulist;
				$variablelist[] = $varlist;
				$server->icon = $q->FindMapImage($server);
				$list[] = $server;
			}
				
				
		}
	}
	catch(Exception $ex){}
}

$gamelist = $q->GetGameList();
$master->Smarty->assign("gameslist",$gamelist);

foreach($list as $server){
	$name = $server->game;
	if(array_key_exists($server->game,$gamelist))
	{
		$server->game = $gamelist[$server->game];
	}
}

$master->Smarty->assign("servers",$list);
$master->Smarty->assign("userlist",$userlist);
$master->Smarty->assign("variablelist",$variablelist);


if(isset($_GET["action"]) && streq($_GET["action"],"showplayers"))
{
	$master->Smarty->assign("forceshowplayers",GETSafe("sid"));
}

$offservercount = 0;
$unoffservercount =0;

foreach($list as $server){
	if(streq($server->type,"1"))
	$offservercount++;
	else
	$unoffservercount++;
}

$master->Smarty->assign("hasoffical",($offservercount>0));
$master->Smarty->assign("hasunofficial",($unoffservercount>0));

?>