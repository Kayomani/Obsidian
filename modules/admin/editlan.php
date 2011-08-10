<?php

//if(!checkUserAdmin($smarty))
//  return;
  
require_once('XML/HTMLSax3.php');
require_once 'HTML/Safe.php';


if(!CheckPermission("admin","edit lans")){
	$master->AddError("You do not have permission to access this page!");
}

function convertDateIn($data)
{
	$date = strtotime($data);
	$fdate = strftime("%Y-%m-%d %H:%M:00", $date);
	return $fdate;
}

function convertDateOut($data)
{
	$date = strtotime($data);
	$fdate = strftime("%m/%d/%Y %H:%M", $date);
	return $fdate;
}


if(isset($_POST["lan"]))
{
	$lan = new Lan_events;
	$success = $lan->get($lan->escape(POSTSafe("lan")));
	$lan->name = POSTSafe("name");
	$lan->mode_id =  POSTSafe("mode");
	$lan->start = convertDateIn(POSTSafe("starttime"));
	$lan->end = convertDateIn(POSTSafe("endtime"));
	$lan->places = POSTSafe("places");
	$lan->layout = POSTSafe("layout");
	
	$parser =& new HTML_Safe();
    $lan->text = $parser->parse(POSTSafe("text"));
    
	if(isset($_POST["delete"]))
	{
		if($success)
		{
			$lan->delete();
		}  
	}
	else
	{
		if($success)
		$lan->update();
		else
		$lan->insert();
	}
	header('Location: ?page=adminmenu');
	return;
}
$lan = new Lan_events;
if(isset($_GET["id"]))
{
	if($lan->get($lan->escape($_GET["id"])))
	{
		$lan->text =  stripcslashes($lan->text);
		$lan->start = convertDateOut($lan->start);
		$lan->end = convertDateOut($lan->end);
	}

}
$master->Smarty->assign("data",$lan);

$modes = new Lan_permission_modes;
$modelist = array();
$modes->find();

while($modes->fetch()){
	$modelist[] = clone($modes);	
}


$master->Smarty->assign("modelist",$modelist);

?>