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
				$biggame->type ="other";

				
				if(1 == $biggame->get($biggame->escape($_GET["tid"])))
				{
					$maxsignups  = $biggame->maxplayers;
					$signupcount = new Lan_timetable_signups;
					$signupcount->timetable_id = $biggame->id;
					$signupcount->find();
					if($signupcount->count()<$maxsignups)
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
						$error = "This event has already reached its maximum signups!";
					}
				}
				else
				{
					$error = "Unknown food run?";
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