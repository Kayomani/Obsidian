<?php

include 'tournament.logic.php';

$biggame = new Lan_timetable;
$biggame->type ="tournament";

if(isset($_GET["tid"]))
{
	if($biggame->get($biggame->escape($_GET["tid"])))
	{
		$biggame->fetch();
		//Find sign ups
		$tts = new Lan_timetable_signups;
		$user = new Lan_users;
		$tts->joinAdd($user);
		$tts->timetable_id = $biggame->id;
		$list = array();
		$tts->find();
		$currentUserSignedUp = false;

		while($tts->fetch()){
			if(streq($tts->user_id,getCurrentUID()))
			$currentUserSignedUp = true;
			$list[] = clone($tts);
		}

		$game = new Lan_games;
		if( 1 == $game->get($biggame->game)){
			$smarty->assign("image","images/games/".$game->picture);
			$smarty->assign("gamename",$game->name);
		}

		$smarty->assign("currentUserSignedUp",$currentUserSignedUp);
		$smarty->assign("biggame",$biggame);
		$smarty->assign("signups",$list);
		$smarty->assign("_page",file_get_contents("skins/" . Config::$theme . "/intranet/modules/tournament.tpl"));
		return;
	}
}

$error = "Unknown event!";

?>