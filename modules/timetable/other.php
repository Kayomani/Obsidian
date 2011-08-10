<?php

include 'other.logic.php';

$biggame = new Lan_timetable;
$biggame->type ="food";

if(isset($_GET["tid"]))
{
	$user = new Lan_users;
	$biggame->joinAdd($user, "LEFT");
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
        $signups = 0;
		while($tts->fetch()){
			if(streq($tts->user_id,getCurrentUID()))
			$currentUserSignedUp = true;
			$list[] = clone($tts);
			$signups++;
		}
        $biggame->signups = $signups;
		$game = new Lan_games;
		if( 1 == $game->get($biggame->game)){
			$master->Smarty->assign("image","images/games/".$game->picture);
			$master->Smarty->assign("gamename",$game->name);
		}
        $biggame->occurs =  date("l jS H:i", strtotime($biggame->occurs));
		$master->Smarty->assign("currentUserSignedUp",$currentUserSignedUp);
		$master->Smarty->assign("foodrun",$biggame);
		$master->Smarty->assign("signups",$list);
		return;
	}
}

$error = "Unknown event!";

?>