<?php



if(isset($_GET["action"]))
{
	switch($_GET["action"])
	{
		case 'sit':
			$lan = new Lan_events;
			$lan->get(getCurrentLID());

			$attendees = new Lan_attendees;
			$attendees->lan_id = getCurrentLID();
			$attendees->user_id = getCurrentUID();
			if($attendees->count()==0)
			{
				$master->AddWarning("You are not signed up to this LAN.");
				break;
			}
			else
			{
				$allowSeating = false;

				$tickets = new Lan_addons_sold;
				$tickets->user_id = getCurrentUID();
				$tickets->lan_id = $lan->id;

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
					$exseat = new Lan_seats;
					$exseat->user_id = getCurrentUID();
					$exseat->lan_id = $lan->id;
					if(0!=$exseat->count())
					{
						$master->AddWarning("Your already seated at this LAN!");
						break;
					}


					$seat = new Lan_seats;
					if(isset($_GET["seat"]))
					{
						$success = $seat->get($seat->escape($_GET["seat"]));


						if(streq($success,'1') && streq($seat->lan_id, $seat->escape($lan->id)))
						{
							if($seat->user_id != '0' && $seat->user_id != null)
							{
								$master->AddWarning("Someone beat you to this seat..");
								$master->AddWarning("S " . $seat->user_id);
							}
							else
							{
								$seat->user_id = getCurrentUID();
								$seat->update();
								if($seat->seat_name =="" || $seat->seat_name==null)
								{
									$master->AddWarning("Confirming your seat selection of ". $seat->id);
									logMessage(getCurrentUID(),0,"User took seat " . $seat->id . " at LAN " . $lan->name . " [" . $lan->id . "]");
								}
								else
								{
									$master->AddWarning("Confirming your seat selection of " . $seat->seat_name);
									logMessage(getCurrentUID(),0,"User took seat " . $seat->seat_name . " at LAN " . $lan->name . " [" . $lan->id . "]");
								}
							}
						}
						else
						{
							$master->AddWarning("Invalid seat!");
						}
					}
					else
					$master->AddWarning("Invalid seat");

				}
				else
				{
					$master->AddWarning("You have no tickets which allow you to take a seat!");
				}
				break;
			}
			break;
		case 'unsit':
			
			$seat = new lan_seats;
			$seat->lan_id = getCurrentLID();
			$seat->user_id = getCurrentUID();
			$seat->find();

			if($seat->fetch())
			{
				$seat->user_id = 0;
				$seat->update();
				$master->AddWarning("Removed your seat selection.");
				logMessage(getCurrentUID(),0,"User removed reservation on seat " . $seat->seat_name . " at LAN " . $lan->name . " [" . $lan->id . "]");
			}
			else
			{
				$master->AddWarning("There was a problem removing your seat selection.");
			}


			break;

	}
}
?>