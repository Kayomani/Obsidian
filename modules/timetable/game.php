<?php

include 'game.logic.php';

$biggame = new Lan_timetable;
$bguser = new Lan_users;
$biggame->type ="game";
$biggame->joinAdd($bguser, "LEFT");
if(isset($_GET["tid"]))
{
	if($biggame->get($biggame->escape($_GET["tid"])))
	{
		$biggame->fetch();
		//Find sign ups
		$tts = new Lan_timetable_signups;
		$user = new Lan_users;
		$tts->joinAdd($user, "LEFT");
		//$tgame = new Lan_games;
		//$tts->joinAdd($tgame, "LEFT");
		$tts->timetable_id = $biggame->id;
		$list = array();
		$tts->find();
		$currentUserSignedUp = "no";

		while($tts->fetch()){
			if(streq($tts->user_id,getCurrentUID()))
			$currentUserSignedUp = "signup";
			$list[] = clone($tts);
		}

		$master->Smarty->assign("signups",$list);
		$game = new Lan_games;
		if( 1 == $game->get($biggame->game)){
			$master->Smarty->assign("image","images/games/".$game->picture);
			$master->Smarty->assign("gamename",$game->name);
			
			if(!streq($biggame->game,"0"))
			{
				$link = "http://apps.metacritic.com/search/process?ty=3&ts=".$game->name."&tfs=game_title&sb=0&game_platform=PC&x=11&y=6&release_date_s=";
				$link = str_replace(" ","+",$link);
				$master->Smarty->assign("gameinfolink",$link);	
			}
		}

		
		if(streq("1",$biggame->teambased)){
			$teams = array();	
			
			$team = new Lan_timetable_teams;
			$team->timetable_id = $biggame->id;
			$team->find();
			while($team->fetch()){
				$team->PopulateMembers();
				$team->userinteam = false;
				foreach($team->members as $member){
					if(streq($member->user_id,getCurrentUID())){
			          $currentUserSignedUp = "team";
			          $team->userinteam = true;
					}
				}
				$teams[] = clone($team);
			}
			
			$master->Smarty->assign("teams",$teams);
			
			//Admin: Find all attending players not currently in a team
			$addableusers = array();
			$attendees = new Lan_attendees;
			$users = new Lan_users;
			$teams = new Lan_timetable_teams;
			$signups = new Lan_timetable_signups;
			$members = new Lan_timetable_team_members;
			$attendees->query("SELECT DISTINCT ({$users->__table}.user_id), {$users->__table}.username " .
                              "FROM {$attendees->__table} ".
                              "LEFT JOIN {$users->__table} ON {$attendees->__table}.user_id = {$users->__table}.user_id ".
                              "WHERE {$attendees->__table}.user_id NOT IN (" .
			
                              "SELECT DISTINCT ( user_id) ".
                              "FROM {$teams->__table} CENTER JOIN {$members->__table} " .
			                  "WHERE timetable_id = '$biggame->id' )".
                              
                              "AND username IS NOT NULL");
			while($attendees->fetch()){
				$addableusers[] = clone($attendees);
			}
			$master->Smarty->assign("addableusers",$addableusers);
			
			//Captain: Find all pug players
			$addableusers = array();
			$attendees = new Lan_attendees;
			$users = new Lan_users;
			$teams = new Lan_timetable_teams;
			$signups = new Lan_timetable_signups;
			$members = new Lan_timetable_team_members;
			$attendees->query("SELECT {$users->__table}.user_id, {$users->__table}.username " .
                              "FROM {$signups->__table} ".
                              "LEFT JOIN {$users->__table} ON {$signups->__table}.user_id = {$users->__table}.user_id ".
                              "WHERE {$signups->__table}.user_id NOT IN (" .
			
                              "SELECT DISTINCT ( user_id) ".
                              "FROM {$teams->__table} CENTER JOIN {$members->__table} " .
			                  "WHERE timetable_id = '$biggame->id' )".
                              
                              "AND username IS NOT NULL " . 
			                  "AND {$signups->__table}.timetable_id = '$biggame->id'");
			while($attendees->fetch()){
				$addableusers[] = clone($attendees);
			}
			$master->Smarty->assign("pugplayers",$addableusers);
			
			
			
		}
		
		$master->Smarty->assign("currentUserSignedUp",$currentUserSignedUp);
	    $biggame->occurs =  date("l jS H:i", strtotime($biggame->occurs));
		$master->Smarty->assign("biggame",$biggame);
		//$master->Smarty->assign("signups",$list);
		return;
	}
}

$error = "Unknown event!";

?>