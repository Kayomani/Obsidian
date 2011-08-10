<?php
if(isset($_GET["action"]))
{
	switch($_GET["action"])
	{
		case "signup":
			if(getCurrentUID() ==0)
			{
				$error = "Anonymous users cannot sign up!";
			}
			else if(isset($_GET["tid"]))
			{
				$biggame = new Lan_timetable;
				$biggame->type ="tournament";
				$biggame->id = $biggame->escape($_GET["tid"]);
				if($biggame->count()==1)
				{
					$signup = new Lan_timetable_signups;
					$signup->timetable_id = $biggame->id;
					$signup->user_id = getCurrentUID();
					if($signup->count()==0)
					{
						$signup->insert();
					}
					else
					{
						$error = "You are already signed up to this event!";
					}
				}
				else
				{
					$error = "Unknown big game?";
				}
			}
			else
			{
				$error = "No event id set?";
			}
			break;
		case "remsignup":
			if(isset($_GET["tid"]))
			{
				$signup = new Lan_timetable_signups;
				$signup->timetable_id = $signup->escape($_GET["tid"]);
				$signup->user_id = getCurrentUID();
				$signup->find();
				if($signup->count()!=0)
				 $signup->delete();
			}
			else
			 $error = "No event id set?";
			break;
	}
}

?>