<?php

$text = "Pulling steam data<br />";

$user = new Lan_users;
$user->find();
while($user->fetch()){
	$user->updateSteamData();
	$user->update();
	$text .= "Updating steam data for $user->username <br />";
}

$master->Smarty->assign("_text",$text);
?>