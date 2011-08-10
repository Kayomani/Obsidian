<?php

    $eventlist = array();
	$event = new Lan_timetable;
	$event->lan_id = getCurrentLID();
	
	$game = new Lan_games;
	$event->selectAs($game,"game_%s");
	$event->joinAdd($game,"LEFT");
	$event->orderBy("occurs");
	$event->find();
	while ($event->fetch()) {
		$eventlist[] = clone($event);
	}
	
	$master->Smarty->assign("events",$eventlist);

?>