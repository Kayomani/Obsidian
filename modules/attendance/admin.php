<?php

//Put non UI logic in a difference file
include('admin.logic.php');

function convertDateIn($data)
{
	$date = strtotime($data);
	$fdate = strftime("%Y-%m-%d %H:%M:00", $date);
	return $fdate;
}

function convertDateOut($data)
{
	$date = strtotime($data);
	$fdate = strftime("%d/%m/%Y %H:%M", $date);
	return $fdate;
}


$lan = new Lan_events;
if(isset($_GET["id"]))
{
	if($lan->get($lan->escape($_GET["id"])))
	{
		$lan->start = convertDateOut($lan->start);
		$lan->end = convertDateOut($lan->end);

        // Get attendees
		$attendees = new Lan_attendees;
		$attendees->lan_id = $lan->id;
		$attendees->find();
		$attendeeslist= array();
		
		$Frontend = new FrontEnd;
		$allusers = $Frontend->getAllUsers();			
			
		while ($attendees->fetch()) {
			// Get tickets for the attendee
			$sold = new Lan_addons_sold;
			$sold->lan_id = $lan->id;
			$sold->user_id = $attendees->user_id;
			$sold->find();
			$soldlists= array();
			while ($sold->fetch()) {

				$g = new Lan_addons_groups;
				$g->get($sold->addon_id);
				$g->tid =$sold->id;
				$soldlists[] = clone($g);
				
			}
			$attendees->tickets = $soldlists;
			//Get user info
			$attendees->username = $Frontend->getName($attendees->user_id);
			
			//Get availible tickets
			$tickets = new Lan_addons_groups;
			$ticketlist = array();
			$tickets->find();
			while($tickets->fetch()){
				$found = false;
				
				foreach($soldlists as $value)
				{
					//echo $value->id . " to " . $tickets->id ."<br />";
					if(streq($value->id,$tickets->id))
					$found  = true;
				}
				if(!$found)
				  $ticketlist[] = clone($tickets);
			}
			
			$attendees->availtickets = $ticketlist;
			
			//if(in_array($attendees->username,$allusers,false))
			 unset($allusers[$attendees->username]);
			
			
			//Get seat
			$seat = new Lan_seats;
			$seat->lan_id = $lan->id;
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
		$master->Smarty->assign("allusers", $allusers);
		$master->Smarty->assign("attendees",$attendeeslist);
	}
	$master->Smarty->assign("data",$lan);
}
?>