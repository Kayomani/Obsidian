<?php
require_once ('core/core.php');
require_once ('libs/jsonwrapper/jsonwrapper.php');



if(isset($_GET["t"]))
{
	switch($_GET["t"])
	{
		case "seatlist":
			if(isset($_GET["lan"]))
			{
				$seats = new Lan_seats;
				$seats->lan_id = $seats->escape($_GET["lan"]);
				$seats->find();
				$seatlist= array();
				while ($seats->fetch()) {
					$seatlist[] = clone($seats);
				}
				echo json_encode($seatlist);
			}
			break;
		case "addseat":
			if(isset($_GET["lan"]))
			{
				//return;
				$seats = new Lan_seats;
				$seats->lan_id = $seats->escape($_GET["lan"]);
				$seats->x = 20;
				$seats->y = 20;
				$seats->seat_name = "";
				$seats->type = 0;
				$seats->insert();
			}
			break;
		case "getusers":
			if(isset($_GET["lan"]))
			{
				 
				$users = new Lan_attendees;
				$seats = new Lan_seats;
				$lanid = $users->escape($_GET["lan"]);
				$user_id = $users->escape($_GET["user_id"]);
				$applicable = array();
				$Frontend = new FrontEnd;

				$users->query("SELECT * FROM {$users->__table} WHERE `lan_id` = ". $lanid ." AND `user_id` NOT IN (SELECT `user_id` FROM {$seats->__table} WHERE `lan_id` = '". $lanid ."') ");

				echo "<option value=\"0\"></option>";
				if($user_id != '0')
				$applicable[$user_id] = $Frontend->getName($user_id);
				while ($users->fetch())
				$applicable[$users->user_id] = $Frontend->getName($users->user_id);
				foreach ($applicable as $key => $val)
				echo "<option value=\"". $key . "\">". $val . "</option>";
				$Frontend->disconnect();
			}
			break;
	}
}
if(isset($_POST["t"]))
{
	switch($_POST["t"])
	{
		case "moveseat":
			$seat = new Lan_seats;
			$found = $seat->get($seat->escape($_POST["id"]));
			$seat->y = $seat->escape($_POST["y"]);
			$seat->x = $seat->escape($_POST["x"]);
			if($found)
			$seat->update();
			break;
		case "setseat":
			$seat = new Lan_seats;
			$found = $seat->get($seat->escape($_POST["id"]));

			//$seat->lan_id = $seat->escape($_POST["lan_id"]);
			$seat->user_id = $seat->escape($_POST["user_id"]);
			$seat->seat_name = $seat->escape($_POST["name"]);
			$seat->y = $seat->escape($_POST["y"]);
			$seat->x = $seat->escape($_POST["x"]);
			$seat->type = $seat->escape($_POST["type"]);
			if($found)
			$seat->update();
			else
		 $seat->insert();
		 // echo print_r($_POST);
		 break;
		case "delseat":
			$seat = new Lan_seats;
			$found = $seat->get($seat->escape($_POST["id"]));
			if($found)
			$seat->delete();
			break;
	}
}

?>

