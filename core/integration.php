<?php
include_once 'core.php';
include 'skins/' .Config::$theme .'/setup.php';
include_once 'integration/integration.php';

//Pull through user ID
$frontend = new FrontEnd;
setCurrentUser($frontend->getUserId());
startSession(getCurrentUID(),$frontend->getName(getCurrentUID()));
//Check user is in db and run checks.
$frontend->pullUserInfo(getCurrentUID());
$frontend->checkGroups(getCurrentUID(),getCurrentLID());
$frontend->disconnect();
$page = new Lan_pages;
$page->name = GETSafe('page');
$page->find();


if($page->fetch()){
	$file = 'modules/' . $page->module . '/' . $page->file . '.php';

	if(file_exists($file)){
		include $file;
		$master->RenderPage($page->module .'.'. $page->file .'.htm');
	}
	else
	{
		$master->AddError("The file for this page does not exist!");
	}
}
else
{
	$master->AddError("Unknown page!");
}


if($master->HasFatalError()){
	$master->RenderPage('error.htm');
}


$master->RenderSite('master.integration.htm');

return;

?>