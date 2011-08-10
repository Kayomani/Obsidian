<?php

require 'modules/lantime/lantime.php';

function parseForm($id = null){
	global $master;
	$titem = new Lan_timetable;
	if($id !=null)
	$titem->get($titem->escape($id));
	if(isset($_POST["game"]))
	{
		$titem->game = $titem->escape($_POST["game"]);
		if(strlen($_POST["othergame"])!=0)
		{
			$titem->game= 0;
		}
	}
	$titem->lan_id = getCurrentLID();
	//$titem->owner
	$titem->type = $titem->escape($_POST["eventtype"]);
	$titem->occurs =  strftime("%Y-%m-%d %H:%M:00", getLanTime("when"));  // "2010-06-05 19:41:54";//$titem->escape($_POST["when"]);
	//var_dump($titem->occurs);
	//die();
	if(isset($_POST["eventname"]))
	$titem->eventname = $titem->escape($_POST["eventname"]);
	if(isset($_POST["othergame"]))
	$titem->othergame = $titem->escape($_POST["othergame"]);
	if(isset($_POST["maxplayers"]))
	$titem->maxplayers = $titem->escape($_POST["maxplayers"]);
	if(isset($_POST["minplayers"]))
	$titem->minplayers = $titem->escape($_POST["minplayers"]);
	if(isset($_POST["details"]))
	$titem->details = addslashes($_POST["details"]);

	
	if($master->checkUserIsAdmin() &&isset($_POST["official"]))
	$titem->userevent = 0;
	else
	$titem->userevent = 1;
	 
	if(isset($_POST["usesignups"]))
	$titem->allowsignups = 1;
	else
	$titem->allowsignups = 0;
	
	if(isset($_POST["maxmembers"]))
	$titem->teamsize = $titem->escape($_POST["maxmembers"]);
	else
	$titem->teamsize = 0;
	
	if(isset($_POST["teams"]) && streq("yes",$_POST["teams"]))
    $titem->teambased = 1;
	else
	$titem->teambased = 0;
	if($master->checkUserIsAdmin() && isset($_POST["organiser"]))
	$titem->owner = $titem->escape($_POST["organiser"]);
	else
	$titem->owner = getCurrentUID();
	return $titem;
}
$logoAssigned = false;

if(isset($_GET["action"]))
{
	switch($_GET["action"]){

		case 'edit':
			if(isset($_POST["submitBtn"]))
			{
				$form = null;
				if(isset($_POST["id"]))
				$form = parseForm($_POST["id"]);
				else
				{

					$form = parseForm();
				}

				$form->details = stripslashes($form->details);
				$master->Smarty->assign("event",$form);

				if(isset($_POST["delete"]))
				{
					$form->delete();
					header('Location: intranet.php?p=timetable');
					die();
				}
				else if(streq($_POST["submitBtn"],"Update"))
				{
					//Update or switch type
					$game = new Lan_games;
					if(isset($_POST["game"]) && (1 == $game->get($game->escape($_POST["game"])))){
						$master->Smarty->assign("image","images/games/".$game->picture);
						$logoAssigned = true;

					}
					else
					{
						$master->Smarty->assign("image","images/games/other.png");
					}
					setupLanTime("when", strtotime($form->occurs),$master->Smarty);

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
				else
				{
					//Save

					if(0==strlen($form->id))
					{
						if(CheckPermission("timetable","add event"))
						  $form->insert();
						else
						{
							$master->AddError("You do not have permissions to add events.");
							break;
						}
					}
					else
					{
						
						if(CheckPermission("timetable","edit all events") || (CheckPermission("timetable","edit own event") && streq(getCurrentUID(),$form->owner)))
						  $form->update();
						else
						{
							$master->AddError("You don't have permission to edit this event.");
							break;
						}
					}
					header('Location: ?p=timetable');
					die();
				}

			}
			break;
	}
}
?>