<?php
if(isset($_GET["action"]))
{
	switch($_GET["action"])
	{
		case "signup":
			if(getCurrentUID() ==0)
			{
				$master->AddWarning("Anonymous users cannot sign up!");
			}
			else if(isset($_GET["tid"]))
			{
				$biggame = new Lan_timetable;
				$biggame->type ="food";

				
				if(1 == $biggame->get($biggame->escape($_GET["tid"])))
				{
					$maxsignups  = $biggame->maxplayers;
					$signupcount = new Lan_timetable_signups;
					$signupcount->timetable_id = $biggame->id;
					$signupcount->find();
					if($signupcount->count()<$maxsignups || $maxsignups == 0)
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
							$master->AddWarning("You are already signed up to this event!");
						}
					}
					else
					{
						$master->AddWarning("This event has already reached its maximum signups!");
					}
				}
				else
				{
					$master->AddWarning("Unknown food run?");
				}
			}
			else
			{
				$master->AddWarning("No event id set?");
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
			$master->AddWarning("No event id set?");
			break;
	}
}

?>