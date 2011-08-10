<?php

if(isset($_GET["action"]))
{
	switch($_GET["action"])
	{
		case 'signup':
			
			if(streq("0",getCurrentUID()))
			{
				$master->Smarty->assign("message","Anonymous users cannot register.");
				break;
			}
			else
			{
				$lan = new Lan_events;
				$success = $lan->get(getCurrentLID());
				if($success)
				{
					$attendees = new Lan_attendees;
					$attendees->lan_id = getCurrentLID();
					$attendees->user_id = getCurrentUID();
					if($attendees->count()==0)
					{
                         $attendees->insert();
                         logMessage(getCurrentUID(),0,"User signed up to LAN " . $lan->name . " [" . $lan->id . "]");
                         $master->Smarty->assign("message","You were successfully signed up.");
					     break;
					}
					else
					{
					  $master->Smarty->assign("message","You are already signed up to this LAN!");
					  break;
					}
				}
				else
				{
					$master->Smarty->assign("message","Unknown LAN selected.");
					break;
				}
			}
			break;
			case 'removeme':
			if(streq("0",getCurrentUID()))
			{
				$master->Smarty->assign("message","Anonymous users cannot unregister.");
				break;
			}
			else
			{
				$lan = new Lan_events;
				$success = $lan->get(getCurrentLID());
				if($success)
				{
					$attendees = new Lan_attendees;
					$attendees->lan_id = getCurrentLID();
					$attendees->user_id = getCurrentUID();
					if($attendees->count()==0)
					{
                         $master->Smarty->assign("message","Oddly enough your already not signed up to this event!");
					     break;
					}
					else
					{
					  $attendees->delete();
					  $master->Smarty->assign("message","Removed your sign up!");
					  logMessage(getCurrentUID(),0,"User is no longer attending LAN " . $lan->name . " [" . $lan->id . "]");
					  //check if they have any seats for this lan, if so remove them.
					  $seat = new Lan_seats;
					  $seat->user_id =getCurrentUID();
					  $seat->lan_id = getCurrentLID();
					  if($seat->find())
					    $seat->delete();
					  break;
					}
				}
				else
				{
					$master->Smarty->assign("message","Unknown LAN selected.");
					break;
				}
			}
			break;
	}
}
?>