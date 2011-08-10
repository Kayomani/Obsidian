<?php
if(isset($_GET["imgid"])){
		
	$game = new Lan_games;
	if(1 == $game->get($game->escape($_GET["imgid"]))){
		echo  Config::$webPath. "images/games/".$game->picture;
	}
}
die();

?>