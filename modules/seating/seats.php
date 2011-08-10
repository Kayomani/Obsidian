<?php
include ('seats.logic.php');


$master->Smarty->assign("state","none");

$lan = new Lan_events;
$lanid = getCurrentLID();
$success = $lan->get($lanid);
if($success)
{
	if(!file_exists($lan->layout) || $lan->layout=="")
	$lan->layout = "images/no_seating_plan.png";
	$master->Smarty->assign("img",$lan->layout);
	$master->Smarty->assign("size",cssifysize($lan->layout));

	$attendees = new Lan_seats;
	$user = new Lan_users;
	$attendees->lan_id = $lanid;
	$attendees->joinAdd($user, "LEFT");
	$attendees->orderBy('seat_name');
	$attendees->orderBy('id');
	$attendees->find();
	$attendeeslist= array();

	while ($attendees->fetch()) {
		if($attendees->user_id==null)
		  $attendees->user_id = "0";
		$attendeeslist[] = clone($attendees);
	}

	$master->Smarty->assign("attendees",$attendeeslist);

	if(!streq('0', getCurrentUID()))
	{
		$exseat = new Lan_seats;
		$exseat->user_id = getCurrentUID();
		$exseat->lan_id = getCurrentLID();
		if(0==$exseat->count())
		{
			$allowSeating = false;

			$tickets = new Lan_addons_sold;
			$tickets->user_id =  getCurrentUID();
			$tickets->lan_id = getCurrentLID();

			$ticktypes = new Lan_addons_groups;
			$tickets->joinAdd($ticktypes,"LEFT");
			$tickets->selectAs($ticktypes,'type_%s');

			$tickets->find();
			$a = array();
			while ($tickets->fetch()) {
				if(0==strcmp($tickets->type_allowSeating,'1'))
				$allowSeating = true;
			}

			if($allowSeating)
			{
				$master->Smarty->assign("state","noseat");
			}
		}
		else
		{
			$master->Smarty->assign("state","seated");
			$exseat->find();
			$exseat->fetch();
			$seatname = $exseat->seat_name;

			if(strlen($seatname)==0)
			$seatname = $exseat->id;
			$master->Smarty->assign("seatid",$seatname);
		}
	}
}
else
{
	$master->AddError("Could not find LAN info!");
}

?>