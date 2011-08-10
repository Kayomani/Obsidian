<?php

if(isset($_GET["a"]) && isset($_GET["tid"]))
{
	switch($_GET["a"])
	{
		case 'rem':
			// Get tickets for the attendee
			$sold = new Lan_addons_sold;
			$success = $sold->get($_GET["tid"]);
			if($success)
			{
			   $Frontend = new FrontEnd;
			   $g = new Lan_addons_groups;
			   $g->get($sold->addon_id);
			   
			   $lan  = new Lan_events;
		       $lan->get($lan->escape($_GET["id"]));
			   logMessage($Frontend->getUserId(),0,"Removed ticket '" . $g->name . "' from " .$Frontend->getName($sold->user_id) . " at " . $lan->name); 
			   $sold->delete();
			}
		break;
	    case 'remu':
			// Get tickets for the attendee
			$user= new Lan_attendees;
			$success = $user->get($user->escape($_GET["tid"]));
			$lan  = new Lan_events;
			$lan->get($lan->escape($_GET["id"]));
			if($success)
			{
			  $Frontend = new FrontEnd;
			  logMessage($Frontend->getUserId(),0,"Removed attendance for " . $Frontend->getName($user->user_id) . "' from " . $lan->name . " [" . $lan->id. "]");
			  $user->delete();
			}
		break;
	}
}


if(isset($_POST["user"]) && isset($_POST["lan"]))
{
	$newuser = new Lan_attendees;
	$newuser->lan_id = $newuser->escape($_POST["lan"]);
	$newuser->user_id = $newuser->escape($_POST["user"]);
	$newuser->insert();
	$Frontend = new FrontEnd;
	
	$lan  = new Lan_events;
	$lan->get($lan->escape($_GET["id"]));
	logMessage($Frontend->getUserId(),0,"Added attendee " . $Frontend->getName($newuser->user_id) . " at " . $lan->name);
}

if(isset($_POST["lanid"]) && isset($_POST["ticket"]))
{
	$newticket = new Lan_addons_sold;
	$newticket->lan_id = $newticket->escape($_POST["lanid"]);
	$newticket->user_id = $newticket->escape($_POST["user"]);
	$newticket->addon_id = $newticket->escape($_POST["ticket"]);
	$newticket->insert();
	
	$lan  = new Lan_events;
	$lan->get($lan->escape($_GET["id"]));
	
	$group = new Lan_addons_groups;
	$group->get($newticket->escape($_POST["ticket"]));
	$Frontend = new FrontEnd;
	
	logMessage($Frontend->getUserId(),0,"Added new '" . $group->name . "' ticket for " . $Frontend->getName($newticket->user_id) . " at " . $lan->name);
}

?>