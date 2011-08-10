<?php

if(isset($_GET["uid"])){
	
	$user = new Lan_users;

	
	if($user->get(GETSafe("uid"))){
		$user->updateSteamData();
		$user->update();
		
		if(strlen($user->avatar)==0)
		  $user->avatar = Config::$webPath . "images/other.png";
		
		$master->Smarty->assign("steamdata" ,$user->getSteamData());
		$master->Smarty->assign("user" ,$user);
		//Find if attending this lan
		$attendance = new Lan_attendees;
	    $attendance->user_id = $user->user_id;
	    $attendance->lan_id = getCurrentLID();
	    $master->Smarty->assign("attending", ($attendance->count()!=0));
	    //Get seat
	    if($attendance->count()!=0){
	    	$seat = new lan_seats;
	    	$seat->user_id = $user->user_id;
	    	$seat->lan_id = getCurrentLID();
	    	$seat->find();
	    	if($seat->fetch()){
	    		$master->Smarty->assign("seat", $seat);
	    	}
	    }
	    
	    //Find if arrived
	    $arrivals = new Lan_arrivals;
	    $arrivals->user_id = $user->user_id;
	    $arrivals->lan_id = getCurrentLID();
	    $master->Smarty->assign("arrived", ($arrivals->count()!=0));
	    //List attended Lans
	    $lans = array();
	    $attendance = new Lan_attendees;
	    $event = new Lan_events;
	    $attendance->joinAdd($event);
	    $attendance->user_id = $user->user_id;
	    $attendance->find();
	    while($attendance->fetch()){
	    	$attendance->start = date("jS F y", strtotime($attendance->start));
	    	$lans[] = clone($attendance);
	    }
	    $master->Smarty->assign("attendance", $lans);
	}
	else
	{
		$master->AddError("Unknown user!");
	}
	
	
	
	
	
	
}
else
{
	$master->AddError("No user ID passed!");
}


$user


?>