<?php
require_once 'queryInterface.php';
include 'edit.logic.php';
$q = new GameServerQuery;

$server = new Lan_servers;

if($server->get(GETSafe('sid')))
{
    $master->Smarty->assign("server",$server);
	$master->Smarty->assign("gameslist",$q->GetGameList());
}
else
{
	$master->AddError("The specified server does not exist!");
}

?>