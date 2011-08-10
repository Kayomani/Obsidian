<?php

include 'ttedit.logic.php';

$gamelist = array();
$game = new Lan_games;
$game->orderBy('name');
$game->find();
while($game->fetch()){
	$gamelist[] = clone($game);
}
$master->Smarty->assign("gamelist",$gamelist);




if (isset($_GET["tid"]))
{
	$tt = new Lan_timetable;
	if(1==$tt->get($tt->escape($_GET["tid"])))
	{
		
		
		if(!($master->checkUserIsAdmin() || streq($tt->owner,getCurrentUID()) || streq($tt->owner,"") ))
		{
		   $error = "You don't have permission to edit this event!";
		}
		
		if($master->checkUserIsAdmin())
         $master->Smarty->assign("userIsAdmin","1");
		$userlist = array();
		$user = new Lan_users;
		$attendees = new Lan_attendees;
		$lanid = getCurrentLID();
		$user->query("SELECT user_id,username FROM {$user->__table}  WHERE {$user->__table}.user_id IN (SELECT user_id FROM {$attendees->__table} WHERE `lan_id` = '$lanid') ORDER BY user_id");
		while($user->fetch()){
			$userlist[] = clone($user);
		}
		$master->Smarty->assign("userlist",$userlist);

		$tt->details = stripslashes($tt->details);
		$master->Smarty->assign("event",$tt);
		$game = new Lan_games;
		if(!$logoAssigned && 1 == $game->get($tt->game)){
			$master->Smarty->assign("image","images/games/".$game->picture);
				
		}
		setupLanTime("when", $tt->occurs,$master->Smarty);
	}
	else
	$error = "Unknown event.";
}
else if(!isset($_POST["submitBtn"])){

	$event = new Lan_timetable;
	$event->owner = getCurrentUID();
	$master->Smarty->assign("event",$event);
	setupLanTime("when", null,$master->Smarty);
	$userlist = array();
		$user = new Lan_users;
		$attendees = new Lan_attendees;
		$lanid = getCurrentLID();
		$user->query("SELECT user_id,username FROM {$user->__table}  WHERE {$user->__table}.user_id IN (SELECT user_id FROM {$attendees->__table} WHERE `lan_id` = '$lanid') ORDER BY user_id");
		while($user->fetch()){
			$userlist[] = clone($user);
		}
		$master->Smarty->assign("userlist",$userlist);
}

//$master->Smarty->assign("_page",file_get_contents("skins/" . Config::$theme . "/lantime.htm"));
?>