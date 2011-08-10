<?php
include_once 'core.php';
include 'skins/' .Config::$theme .'/setup.php';



$page = new Lan_pages;
$page->name = GETSafe('page');
$page->find();


if($page->fetch()){
	$file = 'modules/' . $page->module . '/' . $page->file . '.php';

	if(file_exists($file)){
		include $file;
		$master->RenderPage($page->module .'.'. $page->file .'.htm');
		$master->Smarty->assign("master_page_name", $page->friendlyname);
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


if(strlen($page->template)!=0)
{
  $master->RenderSite('master.'. $page->template. '.htm');
}
else
{
	$master->RenderSite('master.intranet.htm');
}

return;
//old code




$page = 'timetable';

if(isset($_GET["p"]))
{
	// TODO: Sanitise
	$page =$_GET["p"];
}

$page = 'intranet/modules/' . $page . '.php';
if(file_exists($page))
include $page;
else
$smarty->assign("_page","Unknown Page");





$smarty->assign("state","none");
$Frontend = new FrontEnd;
//$smarty->assign("userid",$Frontend->getUserId());
$lan = new Lan_events;
$lanid = $lan->escape(getCurrentLID());
$success = $lan->get($lanid);
$smarty->assign("userIsAdmin",getUserIsAdmin());
$smarty->assign("lan",$lan);
//	$str = 'The server name is {$smarty.server.SERVER_NAME|upper} ' .'at {$id}';
//$smarty->assign('foo',$str);
$smarty->assign("session",$_SESSION);

//Hardcode sidebar for now
include 'intranet/modules/session.php';
include 'intranet/modules/remaining.php';
include 'intranet/modules/yourevents.php';


if(strlen($error)!=0)
{

	$smarty->assign("_page",file_get_contents("skins/" . Config::$theme . "/error.tpl"));
	$smarty->assign("msg",$error);
}





echo $page;
?>