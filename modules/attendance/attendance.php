<?php
//Put non UI logic in a difference file
include('attendance.logic.php');

$lan = new Lan_events;
$success = $lan->get(getCurrentLID());

$state = "notsignedup";

if($success)
{
	$lan->text = str_replace("\\n","\n",$lan->text);  
	$lan->text = str_replace("\\r","\r",$lan->text);  
	$master->Smarty->assign("lan",$lan);
	$attendees = new Lan_attendees;
	$user = new Lan_users;
	$attendees->lan_id = getCurrentLID();
	$attendees->joinAdd($user);
	$attendees->orderBy('username');
	$attendees->find();
	
	$attendeeslist= array();
	
	
	
	while ($attendees->fetch()) {
		if(streq(getCurrentUID(), $attendees->user_id))
		  $state = "signedup";
		  
		
		
		$sold = new Lan_addons_sold;
		$sold->lan_id = getCurrentLID();
		$sold->user_id = $attendees->user_id;


		$sold->find();
		$soldlists= array();
		while ($sold->fetch()) {

			$g = new Lan_addons_groups;
			$g->get($sold->addon_id);
			$soldlists[] = $g->name;
			if(getCurrentUID() == $sold->user_id && (0 == strcmp($g->allowSeating,'1')))
			$state = "hasticket";
		}
		$attendees->tickets = $soldlists;

		$seat = new Lan_seats;
		$seat->lan_id = getCurrentLID();
		$seat->user_id = $attendees->user_id;
		$success = $seat->find();
		$success = false;
		while($seat->fetch())
		{
			$success = true;
			if(0 == strcmp($seat->seat_name,"") || $seat->seat_name == null)
			{
				$attendees->seat = $seat->id;
			}
			else
			{
				$attendees->seat = $seat->seat_name;
			}
		}
		if(!$success)
		$attendees->seat = "";
		$attendeeslist[] = clone($attendees);
	}
	$master->Smarty->assign("users",$attendeeslist);
    $master->Smarty->assign("signupsfree",(int)$lan->places-count($attendeeslist));
    
    
	$tickets = new Lan_addons_events;
	$tickets->lan_id = getCurrentLID();
	$tickets->find();
	$ticketlists= array();
	while ($tickets->fetch()) {
		$group = new Lan_addons_groups();

		$group->get($tickets->addon_id);
		$tickets->name = $group->name;
		$tickets->price = $group->price;
		if($group->availible == 1)
		$ticketlists[] = clone($tickets);
	}
	$master->Smarty->assign("ticketlists",$ticketlists);
}
else
{
	$master->AddError("Unknown LAN?");
	return;
}
$master->Smarty->assign("id",$lan->id);


if(0==strcmp($state,"hasticket"))
{
	$seat = new Lan_seats;
	$seat->lan_id = getCurrentLID();
	$seat->user_id = getCurrentUID();
	if(0!=$seat->count())
	$state = "hasseat";
}
if(streq(getCurrentLID(),'0'))
$state = "anon";
$master->Smarty->assign("state",$state);
?>