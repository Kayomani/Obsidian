<?php
$events = array();



function getDiffDateTime($when){
	//$ddate = $when-strtotime("8/5/2010 5:43");
	$now = strtotime("now");
	$ddate = $when-$now;
	$days = round($ddate/(24*60*60));
	$hours = $ddate/3600;
	
	
    if($now>$when)
	{
		if($ddate>-7200)//20 minutes
		 return " Now";
		
		return "";
	}
	
	if($hours > 48)
	{
		return "". $days . " days";
	}
	else if($hours  >=1)
	{
		return "" . round($hours) . " hours " .date("i",$ddate) . " mins";
	}
	else 
	{
		return  "" .date("i",$ddate) ." minutes";
	}
}


function sortOnDateTime($data) {
	for ($i = count($data) - 1; $i >= 0; $i--) {
		$swapped = false;
		for ($j = 0; $j < $i; $j++) {
				
				
			if ( $data[$j]->datetime > $data[$j + 1]->datetime ) {
				$tmp = $data[$j];
				$data[$j] = $data[$j + 1];
				$data[$j + 1] = $tmp;
				$swapped = true;
			}
		}
		if (!$swapped) {
			return $data;
		}
	}
}


$lan = new Lan_events;
$lanid = $lan->escape(getCurrentLID());
$success = $lan->get($lanid);


if($success)
{
	$start = new Lan_timetable;
	$start->when = date("D jS M H:i", strtotime($lan->start));
	$start->type = 'start';
	$start->diff = getDiffDateTime(strtotime($lan->start));
	$start->datetime = strtotime($lan->start);
	$events[] = $start;


	$event = new Lan_timetable;
	$event->lan_id = getCurrentLID();
	$event->orderBy('"when" ASC');

	$game = new Lan_games;
	$event->selectAs($game,"game_%s");
	$event->joinAdd($game,"LEFT");
	$event->find();
	while ($event->fetch()) {

		$event->diff = getDiffDateTime(strtotime($event->occurs));
		//Remove old events
		if(strlen($event->diff)==0)
		continue;
		
		
		$users = new Lan_timetable_signups;
		$users->timetable_id = $event->id;

		$event->signups = $users->count();
		$users->user_id = getCurrentUID();

		if(getCurrentUID() == 0)
		{
			$event->currentUserSignedUp = false;
		}
		else
		{
			$event->currentUserSignedUp = $users->count()!=0;

		}

		if(streq("1",$event->teambased)){
			$event->PopulateTeams();
		}

		$event->datetime = strtotime($event->occurs);
		
		//Pull additional info based on type
		switch($event->type){
			//	case 'start':
			//case 'end':
			//	 $event->when = date("D jS M G:i", strtotime($event->when));
			//	break;
			case 'food':

				//break;
			case 'biggame':
					
			 //  break;
			case 'tournament':

				//break;
			default:
				$event->when = date("D G:i", strtotime($event->occurs));
				break;
		}


		//die();
		$events[] = clone($event);
	}



	$end = new Lan_timetable;
	$end->when =  date("D jS M H:i", strtotime($lan->end));
	$end->type = 'end';
	$end->diff = getDiffDateTime(strtotime($lan->end));
	$end->datetime = strtotime($lan->end);
	$events[] = $end;
/*
	//Put in day markers
	$oneday = (24 * 60 * 60);
	//var_dump(date("m-d-Y 00:01:00", strtotime($lan->start) + $oneday));
	//die();
	$querydate = strtotime(date("d-m-Y 00:01:00", strtotime($lan->start) + $oneday));
	// var_dump($querydate);
	// var_dump($lan->end);
	while($querydate <strtotime($lan->end))
	{

		$day = new Lan_timetable;
		$day->datetime = $querydate;
		$day->when =  date("l", $querydate);
		$day->type = 'day';

		//$end->diff = getDiffDateTime(strtotime($lan->end));

		$events[] = $day;
		$querydate = $querydate + $oneday;
	}
*/
	$events = sortOnDateTime($events);

	/*for ($i = count($events) - 1; $i >= 0; $i--) {
		var_dump(date("D jS M H:i", $events[$i]->datetime));

		}*/

	$master->Smarty->assign("events",$events);
	$master->Smarty->assign("addevent",CheckPermission("timetable","add event"));
	$master->Smarty->assign("editown",CheckPermission("timetable","edit own event"));
	$master->Smarty->assign("editall",CheckPermission("timetable","edit all events"));
}
?>