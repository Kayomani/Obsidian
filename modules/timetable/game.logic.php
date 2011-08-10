<?php
if(isset($_GET["action"]))
{
	switch($_GET["action"])
	{
		case "signup":
			if(getCurrentUID() ==0)
			{
				$master->AddWarning("Anonymous users cannot sign up!");
			}
			else if(isset($_GET["tid"]))
			{
				$biggame = new Lan_timetable;
				$biggame->type ="game";
				$biggame->id = $biggame->escape($_GET["tid"]);
				if($biggame->count()==1)
				{
					$signup = new Lan_timetable_signups;
					$signup->timetable_id = $biggame->id;
					$signup->user_id = getCurrentUID();
					if($signup->count()==0)
					{
						$signup->insert();
					}
					else
					{
						$master->AddWarning("You are already signed up to this event!");
					}
				}
				else
				{
					$master->AddWarning("Unknown game?");
				}
			}
			else
			{
				$master->AddWarning("No event id set?");
			}
			break;
		case 'remsignup':
			if(isset($_GET["tid"]))
			{
				$signup = new Lan_timetable_signups;
				$signup->timetable_id = $signup->escape($_GET["tid"]);
				$signup->user_id = getCurrentUID();
				$signup->find();
				if($signup->count()!=0)
				$signup->delete();
			}
			else
			$error = "No event id set?";
			break;
		case 'createteam':
			$team = new Lan_timetable_teams;
			$team->name = $team->escape($_POST["name"]);
			$team->owner = getCurrentUID();
			$team->tag = $team->escape($_POST["tag"]);
			$team->timetable_id = $team->escape($_GET["tid"]);
			$error = $team->CreateTeam();
			break;
		case 'quitteam':
			$member = new Lan_timetable_team_members;
			$member->user_id = getCurrentUID();
			$member->team_id = $member->escape($_GET["team"]);
			$error = $member->RemoveMember($member->escape($_GET["tid"]));
			break;
		case 'addmember':
			$member = new Lan_timetable_team_members;
			$member->user_id = $member->escape($_POST["user"]);
			$member->team_id = $member->escape($_GET["team"]);
			$error = $member->JoinTeam($member->escape($_GET["tid"]));
			break;
		case 'jointeam':
			$member = new Lan_timetable_team_members;
			$member->user_id = getCurrentUID();
			$member->team_id = $member->escape($_GET["team"]);
			$error = $member->JoinTeam($member->escape($_GET["tid"]));
			break;
			break;
		case 'kick':
			$member = new Lan_timetable_team_members;
			$member->user_id = $member->escape($_GET["user"]);
			$member->team_id = $member->escape($_GET["team"]);
			$error = $member->RemoveMember($member->escape($_GET["tid"]));
			break;
		case 'promote':
			$team = new Lan_timetable_teams;
			if(0==$team->get($team->escape($_GET["team"]))){
				$error = "Unknown team!";
			}
			$team->owner = $team->escape($_GET["user"]);
			$team->update();
			break;
	}
	//if (!headers_sent() && strlen($error)!=0){   
	//	header('Location: intranet.php?p=biggame&tid='.$_GET["tid"]); exit;
	//}
}

?>